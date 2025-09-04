<?php

namespace App\Modules\Management\BlogManagement\Blog\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use App\Modules\Management\BlogManagement\BlogCategory\Models\Model as BlogCategory;
// use App\Modules\Management\BlogPostCategory\Models\BlogPostCategoryModel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Management\BlogManagement\Blog\Models\BlogCommentsModel ; // Assuming this is the correct namespace for BlogCommentsModel

class Model extends EloquentModel
{
    use SoftDeletes;
    protected $table = "blogs";
    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = $data->title . " " . $random_no;
            $data->slug = Str::slug($slug); //use Illuminate\Support\Str;
            if (strlen($data->slug) > 50) {
                $data->slug = substr($data->slug, strlen($data->slug) - 50, strlen($data->slug));
            }
            if (auth()->check()) {
                $data->creator = auth()->user()->id;
            }
            $data->save();
        });
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(BlogCategory::class, 'blog_blog_categories', 'blog_id', 'blog_category_id')
    //         ->withTimestamps();
    // }
    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogCommentsModel::class, 'blog_id');
    }



    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function scopeInactive($q)
    {
        return $q->where('status', 'inactive');
    }
    public function scopeTrased($q)
    {
        return $q->onlyTrashed();
    }
}
