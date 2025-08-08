<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadTemp(Request $request)
    {
        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/temp_uploads');
            $file->move($path, $filename);

            return response()->json([
                'path' => $path,
                'original_name' => $filename
            ]);
        }

        return response()->json(['error' => 'فایلی ارسال نشده'], 400);
    }

}
