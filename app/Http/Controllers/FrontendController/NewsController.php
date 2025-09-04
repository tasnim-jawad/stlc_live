<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modules\Management\PropertyManagement\PropertyCategory\Models\Model as PropertyCategory;
use App\Modules\Management\BlogManagement\Blog\Models\BlogCommentsModel as BlogComments;
use App\Modules\Management\BlogManagement\Blog\Models\Model as Blog; // Assuming this is the correct namespace for BlogModel

class NewsController extends Controller
{
    public function index()
    {
        $blog_category = DB::table('blog_categories')
            ->leftJoin('blogs', function($join) {
                $join->on('blog_categories.id', '=', 'blogs.blog_category_id')
                    ->where('blogs.status', 'active');
            })
            ->select('blog_categories.*', DB::raw('COUNT(blogs.id) as blog_count'))
            ->groupBy('blog_categories.id')
            ->orderBy('blog_count', 'desc')
            ->get();


        // $blogs = DB::table("blogs")
        //     ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
        //     ->select('blogs.*', 'blog_categories.title as category_name')
        //     ->paginate(10);
        $blogs = Blog::with('comments')->with('blog_category')->where('status', 'active')->paginate(4);
        $top_rated_blogs_query = DB::table("blogs")
            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
            ->where('blogs.status', 'active')
            ->select('blogs.*', 'blog_categories.title as category_name');

        $total_blogs = $top_rated_blogs_query->count();

        if ($total_blogs > 5) {
            $top_rated_blogs = $top_rated_blogs_query
                ->inRandomOrder()
                ->limit(5)
                ->get();
        } else {
            $top_rated_blogs = $top_rated_blogs_query->get();
        }


        $latest_blogs = DB::table("blogs")
            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
            ->where('blogs.status', 'active')
            ->select('blogs.*', 'blog_categories.title as category_name')
            ->orderBy('blogs.created_at', 'desc')
            ->limit(5)
            ->get();

        $property_category_list = PropertyCategory::where('status', 'active')->orderBy('name', 'asc')->get();
        return view(
            'frontend.pages.news.news',
            compact('blogs', 'blog_category', 'top_rated_blogs', 'latest_blogs')
        );
    }

    public function blog_search(Request $request)
    {
        $query = $request->get('q');

        $blogs = Blog::where('title', 'LIKE', "%{$query}%")
            ->select('id', 'title', 'slug') // adjust as needed
            ->limit(10)
            ->get();

        return response()->json($blogs);
    }

    
    public function news_details($slug)
    {
        $blog = Blog::with('comments')->with('blog_category')->where('slug', $slug)->first();
        // dd($blog);
        $blog_category = DB::table('blog_categories')
            ->leftJoin('blogs', function($join) {
                $join->on('blog_categories.id', '=', 'blogs.blog_category_id')
                    ->where('blogs.status', 'active');
            })
            ->select('blog_categories.*', DB::raw('COUNT(blogs.id) as blog_count'))
            ->groupBy('blog_categories.id')
            ->orderBy('blog_count', 'desc')
            ->get();

        $top_rated_blogs_query = DB::table("blogs")
            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
            ->where('blogs.status', 'active')
            ->select('blogs.*', 'blog_categories.title as category_name');

        $total_blogs = $top_rated_blogs_query->count();

        if ($total_blogs > 5) {
            $top_rated_blogs = $top_rated_blogs_query
                ->inRandomOrder()
                ->limit(5)
                ->get();
        } else {
            $top_rated_blogs = $top_rated_blogs_query->get();
        }


        $latest_blogs = DB::table("blogs")
            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
            ->where('blogs.status', 'active')
            ->select('blogs.*', 'blog_categories.title as category_name')
            ->orderBy('blogs.created_at', 'desc')
            ->limit(5)
            ->get();

        
        return view('frontend.pages.news.news_details.news_details', 
        compact('top_rated_blogs', 'latest_blogs', 'blog_category','blog'));
    }


    public function news_category($slug)
    {
        $category = DB::table('blog_categories')
            ->where('slug', $slug)
            ->first();

        $blog_category = DB::table('blog_categories')
            ->leftJoin('blogs', function($join) {
                $join->on('blog_categories.id', '=', 'blogs.blog_category_id')
                    ->where('blogs.status', 'active');
            })
            ->select('blog_categories.*', DB::raw('COUNT(blogs.id) as blog_count'))
            ->groupBy('blog_categories.id')
            ->orderBy('blog_count', 'desc')
            ->get();


        $blogs = DB::table("blogs")
            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
            ->select('blogs.*', 'blog_categories.title as category_name')
            ->where('blog_categories.slug', $slug)
            ->where('blogs.status', 'active')
            ->paginate(10);

        $top_rated_blogs_query = DB::table("blogs")
            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
            ->select('blogs.*', 'blog_categories.title as category_name');

        $total_blogs = $top_rated_blogs_query->count();

        if ($total_blogs > 5) {
            $top_rated_blogs = $top_rated_blogs_query
                ->inRandomOrder()
                ->limit(5)
                ->get();
        } else {
            $top_rated_blogs = $top_rated_blogs_query->get();
        }


        $latest_blogs = DB::table("blogs")
            ->join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
            ->select('blogs.*', 'blog_categories.title as category_name')
            ->where('blogs.status', 'active')
            ->orderBy('blogs.created_at', 'desc')
            ->limit(5)
            ->get();

        return view(
            'frontend.pages.news.news',
            compact('blogs', 'blog_category', 'top_rated_blogs', 'latest_blogs', 'category')
        );
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->get('search');

        $blogs = DB::table("blogs")
            ->where('title', 'like', "%{$query}%")
            ->where('status', 'active')
            ->limit(10)
            ->get();

        if ($blogs->count() > 0) {
            $output = '';
            foreach ($blogs as $blog) {
                $output .= '<a href="' . route('news_details', $blog->slug) . '">' . e($blog->title) . '</a>';
            }
        } else {
            $output = '<p>No results found</p>';
        }

        return response($output);
    }

    public function blog_comment(Request $request)
    {
        // dd(request()->all());
        try {
            $validated = $request->validate([
                'blog_id' => 'required|exists:blogs,id',
                'comment' => 'required|string',
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:50',
                'website' => 'nullable|string|max:100',
            ]);
        
            $comment = new BlogComments();
            $comment->blog_id = $validated['blog_id'];
            $comment->comment = $request->input('comment');
            $comment->name = $request->input('name');
            $comment->email = $request->input('email');
            $comment->website = $request->input('website');
            $comment->creator = auth()->id() ?? 0; // 0 if guest
            $comment->save();
            // dd($review);
            return redirect()->back()->with('success', 'comment submitted successfully!');
        
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
