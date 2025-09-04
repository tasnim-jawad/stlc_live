<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Management\PropertyManagement\Property\Models\Model as Property;
use App\Modules\Management\PropertyManagement\PropertyCategory\Models\Model as PropertyCategory;
use App\Modules\Management\PropertyManagement\Property\Models\PropertyCustomerReviewModel;

class PropertiesController extends Controller
{
    public function index()
    {
        $property_category_list = PropertyCategory::where('status', 'active')->orderBy('name', 'asc')->pluck('name')->toArray();
        // dd($property_category_list);
        
        $properties_data = [];
        
        foreach ($property_category_list as $name) {
            $properties = Property::with('category')
                ->where('status', 'active')
                ->whereHas('category', function($q) use ($name) {
                    $q->where('name', $name);
                })
                ->inRandomOrder()
                ->latest()
                ->limit(3)
                ->get();
        
            $properties_data[$name] = $properties;
        }
        // dd($properties_data['Comercial']);
        return view('frontend.pages.properties.properties',
            compact('property_category_list','properties_data')
        );
    }
    public function categories()
    
    {   
        $property_category_list = PropertyCategory::where('status', 'active')->orderBy('name', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $property_category_list,
        ]);
    }

    public function category_wise($category)
    
    {   
        $category_name = $category;
        $category_data = PropertyCategory::where('name', $category)->where('status', 'active')->firstOrFail();
        // dd($category_data);
        $properties = Property::with('category')
            ->where('status', 'active')
            ->where('property_category_id', $category_data->id)
            ->latest()
            ->get();
        // dd($properties);
        return view('frontend.pages.properties.category_wise.category_wise',
            compact('properties','category_name')
        );
    }
    public function luxury()
    
    {
        $properties = Property::with('category')
            ->where('status', 'active')
            ->whereHas('category', function($q) {
                $q->where('name', 'Luxury');
            })
            ->inRandomOrder()
            ->latest()
            ->get();

        return view('frontend.pages.properties.luxury.luxury',
            compact('properties')
        );
    }
    public function comercial()
    {
        $properties = Property::with('category')
            ->where('status', 'active')
            ->whereHas('category', function($q) {
                $q->where('name', 'Comercial');
            })
            ->inRandomOrder()
            ->latest()
            ->get();
        return view('frontend.pages.properties.comercial.comercial',
            compact('properties')
        );
    }
    public function classic()
    {
        $properties = Property::with('category')
            ->where('status', 'active')
            ->whereHas('category', function($q) {
                $q->where('name', 'Classic');
            })
            ->inRandomOrder()
            ->latest()
            ->get();
        return view('frontend.pages.properties.classic.classic',
            compact('properties')
        );
    }
    public function wellness()
    {
        $properties = Property::with('category')
            ->where('status', 'active')
            ->whereHas('category', function($q) {
                $q->where('name', 'Welness Communities');
            })
            ->inRandomOrder()
            ->latest()
            ->get();
        return view('frontend.pages.properties.wellness.wellness',
            compact('properties')
        );
    }
    public function ongoing()
    {
        $properties = Property::with('category')
            ->where('status', 'active')
            ->whereHas('category', function($q) {
                $q->where('name', 'Ongoing');
            })
            ->inRandomOrder()
            ->latest()
            ->get();
        return view('frontend.pages.properties.ongoing.ongoing',
            compact('properties')
        );
    }
    public function upgoing()
    {
        $properties = Property::with('category')
            ->where('status', 'active')
            ->whereHas('category', function($q) {
                $q->where('name', 'upcoming');
            })
            ->inRandomOrder()
            ->latest()
            ->get();
        return view('frontend.pages.properties.upgoing.upgoing',
            compact('properties')
        );
    }
    public function completed()
    {
        $properties = Property::with('category')
            ->where('status', 'active')
            ->whereHas('category', function($q) {
                $q->where('name', 'Completed');
            })
            ->inRandomOrder()
            ->latest()
            ->get();
        return view('frontend.pages.properties.completed.completed',
            compact('properties')
        );
    }
    public function details(Request $request, $id)
    {
        // Check if it's numeric
        if (!is_numeric($id)) {
            abort(404); // or return redirect()->back()->with('error', 'Invalid ID');
        }
        
        $property = Property::with('category')
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();
        // dd($property);
        $property_customer_reviews = PropertyCustomerReviewModel::where('property_id', $id)
            ->active()
            ->latest()
            ->get();
        // dd($property_customer_reviews);
        $related_properties = Property::with('category')
            ->where('property_category_id', $property->property_category_id)
            ->where('status', 'active')
            ->where('id', '!=', $property->id)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        // dd($related_properties);
        return view('frontend.pages.properties.property_details.property_details', compact('property', 'property_customer_reviews','related_properties'));
    }

    public function property_customer_review(Request $request)
    {
        // dd(request()->all());
        try {
            $validated = $request->validate([
                'property_id' => 'required|exists:properties,id',
                'comment' => 'required|string',
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:50',
                'website' => 'nullable|string|max:100',
                'rating' => 'required|integer|min:1|max:5',
            ]);
        
            $review = new PropertyCustomerReviewModel();
            $review->property_id = $validated['property_id'];
            $review->comment = $request->input('comment');
            $review->name = $request->input('name');
            $review->email = $request->input('email');
            $review->website = $request->input('website');
            $review->rating = $request->input('rating') ?? 5;
            $review->creator = auth()->id() ?? 0; // 0 if guest
            $review->save();
            // dd($review);
            return redirect()->back()->with('success', 'Review submitted successfully!');
        
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with errors
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Throwable $th) {
            // Optional: log or show error
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

}
