<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function __invoke(Request $request) {
        $subscriber = $request->user();

        $messages = collect();

        foreach ($subscriber->messageLists as $list) {
            foreach ($list->messages()->orderBy('id')->take(5)->get() as $message) {
                $messages->push($message);
            }
        }

        return view('feed', ['messages' => $messages]);
    }
}
