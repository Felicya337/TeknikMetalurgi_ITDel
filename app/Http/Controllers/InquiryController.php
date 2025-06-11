<?php

namespace App\Http\Controllers;

use App\Models\UserInquiry;
use App\Events\NewInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'type' => 'required|in:question,review',
            'user_type' => 'required_if:type,question|in:internal,masyarakat',
            'content' => 'required|string|min:10|max:5000',
            'rating' => 'required_if:type,review|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            Log::warning('Inquiry validation failed', [
                'errors' => $validator->errors()->toArray(),
                'request' => $request->all(),
            ]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            $data = $validator->validated();
            $data['content'] = strip_tags($data['content']);
            $inquiry = UserInquiry::create($data);

            event(new NewInquiryNotification($inquiry));

            Log::info('Inquiry created successfully', [
                'inquiry_id' => $inquiry->id,
                'data' => $data,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create inquiry', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }
}
