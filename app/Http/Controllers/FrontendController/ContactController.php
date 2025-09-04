<?php

namespace App\Http\Controllers\FrontendController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Modules\Management\PropertyManagement\PropertyCategory\Models\Model as PropertyCategory;

class ContactController extends Controller
{
    public function index()
    {
        $property_category_list = PropertyCategory::where('status', 'active')->orderBy('name', 'asc')->get();
        return view('frontend.pages.contact.contact',compact('property_category_list'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service_type' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        DB::table('contacts')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'service_types' => $request->service_type,
            'message' => $request->message,
            'created_at' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->route('contact')->with('success', 'Thank you! Your message has been received.');
    }
}
