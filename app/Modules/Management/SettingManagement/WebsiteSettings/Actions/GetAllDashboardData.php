<?php

namespace App\Modules\Management\SettingManagement\WebsiteSettings\Actions;

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

class GetAllDashboardData
{
    static $model = \App\Modules\Management\SettingManagement\WebsiteSettings\Models\Model::class;

    public static function execute()
    {
        try {

            $banner = Banner::count();
            $about_us = AboutUs::where('page_type', 'about_us')->count();
            $our_mission = AboutUs::where('page_type', 'our_mission')->count();
            $our_vission = AboutUs::where('page_type', 'our_vission')->count();
            $at_a_glance = AtaGlance::count();
            $our_team = OurTeam::count();
            $today_sells = TodaySells::count();
            $our_services = OurService::count();
            $testimonials = Testimonial::count();
            $blogs = Blog::count();
            $properties = Property::count();

            $property_category_list = PropertyCategory::count();



            return entityResponse([
                'banner' => $banner,
                'about_us' => $about_us,
                'our_mission' => $our_mission,
                'our_vission' => $our_vission,
                'at_a_glance' => $at_a_glance,
                'our_team' => $our_team,
                'today_sells' => $today_sells,
                'our_services' => $our_services,
                'testimonials' => $testimonials,
                'blogs' => $blogs,
                'properties' => $properties,
                'property_category_list' => $property_category_list
            ]);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
