<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Management\PropertyManagement\PropertyCategory\Models\Model as PropertyCategory;
use App\Modules\Management\GalleryManagement\ImageGallery\Models\Model as ImageGallery;
use App\Modules\Management\GalleryManagement\VideoGallery\Models\Model as VideoGallery;

class GalleryController extends Controller
{
    public function index()
    {
        $images = ImageGallery::where('status', 'active')->inRandomOrder()->take(3)->get();
        $videos = VideoGallery::where('status', 'active')->inRandomOrder()->take(3)->get();

        return view('frontend.pages.gallery.gallery',
            compact('images','videos')
        );
    }
    public function image()
    {
        $images = ImageGallery::with('category')->where('status', 'active')->get();
        // dd($images);
        return view('frontend.pages.gallery.image.image',
            compact('images')
        );
    } 
    public function video()
    {
        $videos = VideoGallery::with('category')->where('status', 'active')->get();
        return view('frontend.pages.gallery.video.video',
            compact('videos')
        );
    } 
}
