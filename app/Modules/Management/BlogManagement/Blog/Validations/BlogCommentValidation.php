<?php

namespace App\Modules\Management\BlogManagement\Blog\Validations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCommentValidation
{
    /**
     * Validate comment store request
     */
    public static function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50',
            'website' => 'nullable|url|max:100',
            'comment' => 'required|string|max:1000',
        ];

        $messages = [
            'name.required' => 'Name is required',
            'name.max' => 'Name cannot be more than 100 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'email.max' => 'Email cannot be more than 50 characters',
            'website.url' => 'Please enter a valid website URL',
            'website.max' => 'Website URL cannot be more than 100 characters',
            'comment.required' => 'Comment is required',
            'comment.max' => 'Comment cannot be more than 1000 characters',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
