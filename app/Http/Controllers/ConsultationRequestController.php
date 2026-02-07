<?php

namespace App\Http\Controllers;

use App\Models\ConsultationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConsultationRequestController extends Controller
{
    /**
     * Store a newly created consultation request in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string',
                'car_type' => 'nullable|string|max:100',
                'budget' => 'nullable|string|max:100',
                'note' => 'nullable|string|max:1000',
            ], [
                'name.required' => 'Vui lòng nhập họ và tên',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'phone.regex' => 'Số điện thoại không hợp lệ',
            ]);

            // Prepare the note with additional information
            $fullNote = '';
            if (!empty($validated['car_type'])) {
                $fullNote .= "Loại xe: " . $validated['car_type'] . "\n";
            }
            if (!empty($validated['budget'])) {
                $fullNote .= "Ngân sách: " . $validated['budget'] . "\n";
            }
            if (!empty($validated['note'])) {
                $fullNote .= "Ghi chú: " . $validated['note'];
            }

            // Create consultation request
            $consultationRequest = ConsultationRequest::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'note' => $fullNote ?: null,
                'source' => 'website',
                'status' => 'pending',
                'user_id' => auth()->id(), // If user is logged in
                'car_id' => $request->input('car_id'), // Optional car_id if registering for specific car
            ]);

            // Log the new consultation request
            Log::info('New consultation request created', [
                'id' => $consultationRequest->id,
                'name' => $consultationRequest->name,
                'phone' => $consultationRequest->phone,
            ]);

            // Return success response
            return back()->with('success', 'Đăng ký tư vấn thành công! Chúng tôi sẽ liên hệ với bạn trong 24h.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Vui lòng kiểm tra lại thông tin đăng ký.');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating consultation request', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            dd($e->getMessage());

            // Return error response
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra. Vui lòng thử lại sau.');
        }
    }

    /**
     * Store consultation request for a specific car.
     */
    public function storeForCar(Request $request, $carId)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string',
                'email' => 'nullable|email|max:255',
                'note' => 'nullable|string|max:1000',
                'preferred_contact_time' => 'nullable|in:morning,afternoon,evening,anytime,weekend',
            ], [
                'name.required' => 'Vui lòng nhập họ và tên',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'phone.regex' => 'Số điện thoại không hợp lệ',
                'email.email' => 'Email không hợp lệ',
            ]);

            // Create consultation request for specific car
            $consultationRequest = ConsultationRequest::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'] ?? null,
                'note' => $validated['note'] ?? null,
                'preferred_contact_time' => $validated['preferred_contact_time'] ?? 'anytime',
                'source' => 'website',
                'status' => 'pending',
                'user_id' => auth()->id(),
                'car_id' => $carId,
            ]);

            // Log the new consultation request
            Log::info('New car consultation request created', [
                'id' => $consultationRequest->id,
                'car_id' => $carId,
                'name' => $consultationRequest->name,
            ]);

            // Return success response
            return back()->with('success', 'Đăng ký tư vấn thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Vui lòng kiểm tra lại thông tin đăng ký.');

        } catch (\Exception $e) {
            Log::error('Error creating car consultation request', [
                'car_id' => $carId,
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra. Vui lòng thử lại sau.');
        }
    }
}
