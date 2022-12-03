<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Mail\ContactUs;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function contact()
    {
        return view("pages.contact", [
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }

    public function contactus(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "name" => "required|max:50",
            "subject" => "required",
            "message" => "required"
        ]);

        $mailData = $request->all();

        Mail::to("bidaouiasalah@gmail.com")->send(new ContactUs($mailData));

        return back()->with([
            "success_message" => "Thank You for your email, We will get back to you ASAP"
        ]);
    }
}
