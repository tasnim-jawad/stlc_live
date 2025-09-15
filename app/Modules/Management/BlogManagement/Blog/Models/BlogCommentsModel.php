<?php

namespace App\Modules\Management\BlogManagement\Blog\Models;


use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCommentsModel  extends EloquentModel
{
    use SoftDeletes;
    protected $table = "blog_comments";
    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = "comment-" . $data->id . "-" . $random_no;
            $data->slug = Str::slug($slug);
            if (strlen($data->slug) > 50) {
                $data->slug = substr($data->slug, strlen($data->slug) - 50, strlen($data->slug));
            }
            if (auth()->check()) {
                $data->creator = auth()->user()->id;
            }
            $data->save();
        });
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

    public function blog()
    {
        return $this->belongsTo(\App\Modules\Management\BlogManagement\Blog\Models\Model::class, 'blog_id');
    }
}
