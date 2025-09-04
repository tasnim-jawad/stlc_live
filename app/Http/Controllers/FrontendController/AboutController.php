<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use Botble\RealEstate\Models\Project;
use Illuminate\Http\Request;
use App\Modules\Management\BannerManagement\Banner\Models\Model as Banner;
use App\Modules\Management\AboutUsManagement\AboutUs\Models\Model as AboutUs;
use App\Modules\Management\AtAGlanceManagement\AtAGlance\Models\Model as AtaGlance;
use App\Modules\Management\OurTeamManagement\OurTeam\Models\Model as OurTeam;
use App\Modules\Management\TodaySellsManagement\TodaySells\Models\Model as TodaySells;
use App\Modules\Management\OurServiceManagement\OurService\Models\Model as OurService;
use App\Modules\Management\TestimonialManagement\Testimonial\Models\Model as Testimonial;
use App\Modules\Management\BlogManagement\Blog\Models\Model as Blog;
use App\Modules\Management\PropertyManagement\Property\Models\Model as Property;
use App\Modules\Management\PropertyManagement\PropertyCategory\Models\Model as PropertyCategory;

class AboutController extends Controller
{
    public function index()
    {
        $banner = Banner::where('status', 'active')->latest()->first();
        $about_us = AboutUs::where('page_type','about_us')->where('status', 'active')->latest()->first();
        $our_mission = AboutUs::where('page_type','our_mission')->where('status', 'active')->latest()->first();
        $our_vission = AboutUs::where('page_type','our_vission')->where('status', 'active')->latest()->first();
        $at_a_glance = AtaGlance::where('status', 'active')->latest()->limit(4)->get();
        $our_team = OurTeam::where('status', 'active')->latest()->limit(4)->get();
        $today_sells = TodaySells::where('status', 'active')->latest()->first();
        $our_services = OurService::where('status', 'active')->latest()->limit(3)->get();
        $testimonials = Testimonial::where('status', 'active')->latest()->limit(3)->get();
        $blogs = Blog::with('blog_category')
                ->where('status', 'active')
                ->inRandomOrder()
                ->get();
        $properties = Property::with('category')
                ->where('status', 'active')
                ->inRandomOrder()
                ->latest()->limit(3)->get();
        $property_category_list = PropertyCategory::where('status', 'active')->orderBy('name', 'asc')->get();        
        // dd($blogs->toArray());
        // dd($about_us?->video_url);
        // $projects = Project::orderBy('id','DESC')
        //     ->with([
        //         'customFields',    
        //     ])
        //     ->limit(6)->get();
        // dd($projects->toArray());
        return view('frontend.pages.about.about',
            compact(
                'banner',
                'about_us', 
                'our_mission',
                'our_vission',
                'at_a_glance',
                'our_team',
                'today_sells',
                'our_services',
                'testimonials',
                'blogs',
                'properties',
                'property_category_list',
            ));
    }
    
}
