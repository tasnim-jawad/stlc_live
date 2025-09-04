<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Management\CustomPageManagement\CustomPage\Models\Model as CustomPage;

class CustomPageController extends Controller
{
    public function index($perma_link){
        $custom_page = CustomPage::where('page_permalink', $perma_link)->first();
        // dd($custom_page);
        if(!$custom_page){
            return view('errors.404');
        }
        return view('frontend.pages.custom_page.custom_page',
            compact('custom_page')
        );
    }
}
