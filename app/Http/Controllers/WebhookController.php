<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function __invoke(Request $request) {
        $phone = $request->input('From');
        $message = trim($request->input('Body'));
        info($phone . PHP_EOL . $message);
    }
}
