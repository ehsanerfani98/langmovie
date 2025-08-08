<?php

namespace App\Services\Ippanel;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OtpService
{
    protected $apiKey;
    protected $originator;
    protected $patternCode;
    protected $baseUrl;

    public function __construct()
    {
        // $this->apiKey = config('services.ippanel.api_key');
        // $this->originator = config('services.ippanel.originator');
        // $this->patternCode = config('services.ippanel.pattern_code');
        $this->apiKey = get_setting('apiKey');
        $this->originator = get_setting('originator');
        $this->patternCode = get_setting('patternCode');
        $this->baseUrl = 'https://rest.ippanel.com/v1/messages/patterns/send';
    }

    /**
     * Generate and send OTP code to the given phone number
     *
     * @param string $phone phone number
     * @return array
     */
    public function send(string $phone): array
    {
        try {
            // Normalize phone number format
            $phone = $this->normalizephone($phone);

            // Generate OTP code (6 digits)
            $code = $this->generateCode();

            // Store OTP code in cache with 2 minutes expiration
            $this->storeCode($phone, $code);
            if (boolval(get_setting('sms_status'))) {
                return [
                    'success' => true,
                    'code' => $code

                ];
            } else {
                // Send OTP via ippanel API
                $response = $this->sendSms($phone, $code);

                return [
                    'success' => true,
                    'message' => 'کد تایید با موفقیت ارسال شد',
                    'data' => [
                        'reference_id' => $response['bulk_id'] ?? null,
                        'expires_in' => 120 // 2 minutes in seconds
                    ]
                ];
            }



        } catch (Exception $e) {
            Log::error('OTP send error: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'خطا در ارسال کد تایید',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Verify the OTP code
     *
     * @param string $phone phone number
     * @param string $code OTP code
     * @return array
     */
    public function verify(string $phone, string $code): array
    {
        $phone = $this->normalizephone($phone);
        $cachedCode = $this->getCode($phone);

        if (!$cachedCode) {
            return [
                'success' => false,
                'message' => 'کد تایید منقضی شده است'
            ];
        }

        if ($cachedCode !== $code) {
            return [
                'success' => false,
                'message' => 'کد تایید اشتباه است'
            ];
        }

        // Clear the cache after successful verification
        $this->clearCode($phone);

        return [
            'success' => true,
            'message' => 'کد تایید با موفقیت تایید شد',
            'redirect' => route('dashboard')
        ];
    }

    /**
     * Generate random OTP code
     *
     * @return string
     */
    protected function generateCode(): string
    {
        return str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Store OTP code in cache
     *
     * @param string $phone
     * @param string $code
     * @return void
     */
    protected function storeCode(string $phone, string $code): void
    {
        $key = 'otp_' . $phone;
        Cache::put($key, $code, now()->addMinutes(2));
    }

    /**
     * Get stored OTP code from cache
     *
     * @param string $phone
     * @return string|null
     */
    protected function getCode(string $phone): ?string
    {
        $key = 'otp_' . $phone;
        return Cache::get($key);
    }

    /**
     * Clear OTP code from cache
     *
     * @param string $phone
     * @return void
     */
    protected function clearCode(string $phone): void
    {
        $key = 'otp_' . $phone;
        Cache::forget($key);
    }

    /**
     * Normalize phone number to international format
     *
     * @param string $phone
     * @return string
     */
    protected function normalizephone(string $phone): string
    {
        // Remove any non-digit characters
        $phone = preg_replace('/\D/', '', $phone);

        // Add country code if needed (assuming Iranian number)
        if (strlen($phone) === 10 && substr($phone, 0, 1) === '9') {
            $phone = '98' . $phone;
        } elseif (strlen($phone) === 11 && substr($phone, 0, 2) === '09') {
            $phone = '98' . substr($phone, 1);
        }

        return $phone;
    }

    /**
     * Send SMS using ippanel API
     *
     * @param string $phone
     * @param string $code
     * @return array
     * @throws Exception
     */
    protected function sendSms(string $phone, string $code): array
    {
        // Pattern values for OTP template
        $patternValues = [
            'verification-code' => $code,
        ];

        // Prepare the request
        $client = new \GuzzleHttp\Client();

        $response = $client->post($this->baseUrl, [
            'headers' => [
                'Authorization' => 'AccessKey ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'pattern_code' => $this->patternCode,
                'originator' => $this->originator,
                'recipient' => $phone,
                'values' => $patternValues,
            ],
        ]);

        $responseBody = json_decode($response->getBody()->getContents(), true);

        if (!isset($responseBody['status']) || $responseBody['status'] !== 'OK') {
            throw new Exception('IPPanel API Error: ' . ($responseBody['message'] ?? 'Unknown error'));
        }

        return $responseBody;
    }
}