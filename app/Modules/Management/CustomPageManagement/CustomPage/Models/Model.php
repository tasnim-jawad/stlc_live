<?php

namespace App\Modules\Management\CustomPageManagement\CustomPage\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
class Model extends EloquentModel
{
    use SoftDeletes;
    protected $table = "custom_pages";
    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($data) {
            $slug = $data->title;
            $data->slug = Str::slug($slug); //use Illuminate\Support\Str;
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
}