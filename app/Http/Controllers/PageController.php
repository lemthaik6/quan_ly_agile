<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show About page
     */
    public function about()
    {
        return view('shop.about');
    }

    /**
     * Show Contact page
     */
    public function contact()
    {
        return view('shop.contact');
    }

    /**
     * Handle contact form submission
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // In a real application, you would save this to database or send email
        // For now, we'll just store in session and redirect
        
        return back()->with('success', 'Cảm ơn bạn đã gửi tin nhắn! Chúng tôi sẽ liên hệ với bạn sớm.');
    }
}
