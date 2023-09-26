<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendMessageJob;
use App\Models\Subscriber;

class LoginController extends Controller
{
    public function showForm() {
        return view('login');
    }

    public function handleSubmit(Request $request) {
        if ($request->has('phone')) {
            $phone = $this->getPhoneFromRequest($request);
            $subscriber = Subscriber::where('phone', $phone)->first();

            if (!$subscriber) {
                return view('login', ['errorMessage' => 'Telefonnummeret er ikke tilmeldt']);
            }

            $code = mt_rand(100000, 999999);
            session()->put('login_code', $code);
            session()->put('login_phone', $phone);
            session()->put('login_timestamp', now());

            SendMessageJob::dispatch($phone, 'Din kode til Steiner listen er ' . $code);

            return view('login-code');
        }

        if ($request->has('code')) {
            $timestamp = session()->get('login_timestamp');
            if (!$timestamp || $timestamp->diffInMinutes() > 5) {
                return view('login', ['errorMessage' => 'Koden er udløbet. Prøv venligst igen']);
            }

            if ($request->input('code') == session()->get('login_code')) {
                $subscriber = Subscriber::where('phone', session()->get('login_phone'))->firstOrFail();

                session()->forget('login_code');
                session()->forget('login_phone');
                session()->forget('login_timestamp');

                Auth::login($subscriber, true);
                return redirect('feed');
            } else {
                return view('login', ['errorMessage' => 'Forkert kode. Prøv venligst igen']);
            }
        }
    }

    private function getPhoneFromRequest(Request $request): string {
        $phone = $request->input('phone');

        if (substr($phone, 0, 1) !== '+') {
            $phone = '+45' . $phone;
        }

        $phone = str_replace(' ', '', $phone);

        return $phone;
    }
}
