<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);
        Subscriber::create($data);
        return back()->with('status', 'Subscribed Successfully');
    }
    public function store2(Request $request)
    {
        $data = $request->validate([
            'email2' => 'required|email|unique:subscribers,email'
        ]);
        Subscriber::create($data);
        return back()->with('status2', 'Subscribed Successfully');
    }
}
