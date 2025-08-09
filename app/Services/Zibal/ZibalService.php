<?php

namespace App\Services\Zibal;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZibalService
{
    /**
     * Zibal merchant ID
     * @var string
     */
    protected $merchantId;

    /**
     * Determines whether to use sandbox mode
     * @var bool
     */
    protected $sandbox;

    /**
     * API endpoints for Zibal
     * @var array
     */
    protected $endpoints = [
        'production' => [
            'request' => 'https://gateway.zibal.ir/v1/request',
            'verify'  => 'https://gateway.zibal.ir/v1/verify',
            'startPay' => 'https://gateway.zibal.ir/start/',
        ],
        'sandbox' => [
            'request' => 'https://sandbox.zibal.ir/v1/request',
            'verify'  => 'https://sandbox.zibal.ir/v1/verify',
            'startPay' => 'https://sandbox.zibal.ir/start/',
        ],
    ];

    public function __construct(string $merchantId = null, bool $sandbox = null)
    {
        $this->merchantId = $merchantId ?? env('ZIBAL_MERCHANT');
        $this->sandbox = $sandbox ?? false;
    }

    public function setMerchantId(string $merchantId)
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    public function setSandbox(bool $sandbox)
    {
        $this->sandbox = $sandbox;
        return $this;
    }

    protected function getEndpoints()
    {
        return $this->sandbox ? $this->endpoints['sandbox'] : $this->endpoints['production'];
    }

    /**
     * Request a payment from Zibal
     *
     * @param int $amount Amount in Rial
     * @param string $callbackUrl
     * @param string|null $description
     * @param string|null $orderId
     * @return array
     */
    public function request(int $amount, string $callbackUrl, string $description = null, string $orderId = null)
    {
        $endpoints = $this->getEndpoints();

        $data = [
            'merchant'    => $this->merchantId,
            'amount'      => $amount,
            'callbackUrl' => $callbackUrl,
            'description' => $description ?? 'پرداخت از طریق زیبال',
        ];

        if ($orderId) {
            $data['orderId'] = $orderId;
        }

        try {
            $response = Http::post($endpoints['request'], $data);
            $result = $response->json();

            if ($response->successful() && isset($result['result']) && $result['result'] == 100) {
                return [
                    'success' => true,
                    'trackId' => $result['trackId'],
                    'paymentUrl' => $endpoints['startPay'] . $result['trackId'],
                ];
            }

            return [
                'success' => false,
                'error' => [
                    'code' => $result['result'] ?? null,
                    'message' => $result['message'] ?? 'خطای ناشناخته',
                ],
            ];
        } catch (\Exception $e) {
            Log::error('Zibal payment request failed: ' . $e->getMessage());

            return [
                'success' => false,
                'error' => [
                    'code' => 'EXCEPTION',
                    'message' => 'مشکلی در درخواست پرداخت پیش آمد',
                ],
            ];
        }
    }

    /**
     * Verify a payment
     *
     * @param string $trackId
     * @return array
     */
    public function verify(string $trackId)
    {
        $endpoints = $this->getEndpoints();

        $data = [
            'merchant' => $this->merchantId,
            'trackId'  => $trackId,
        ];

        try {
            $response = Http::post($endpoints['verify'], $data);
            $result = $response->json();

            if ($response->successful() && isset($result['result']) && $result['result'] == 100) {
                return [
                    'success' => true,
                    'refNumber' => $result['refNumber'] ?? null,
                    'cardNumber' => $result['cardNumber'] ?? null,
                ];
            }

            return [
                'success' => false,
                'error' => [
                    'code' => $result['result'] ?? null,
                    'message' => $result['message'] ?? 'تأیید پرداخت ناموفق بود',
                ],
            ];
        } catch (\Exception $e) {
            Log::error('Zibal payment verification failed: ' . $e->getMessage());

            return [
                'success' => false,
                'error' => [
                    'code' => 'EXCEPTION',
                    'message' => 'مشکلی در تأیید پرداخت پیش آمد',
                ],
            ];
        }
    }

    public function getRedirectUrl(string $trackId)
    {
        $endpoints = $this->getEndpoints();
        return $endpoints['startPay'] . $trackId;
    }
}
