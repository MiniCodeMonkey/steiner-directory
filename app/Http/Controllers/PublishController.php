<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublishController extends Controller
{
    public function showForm() {
        return view('publish');
    }

    public function handleSubmit(Request $request) {
    }
}
