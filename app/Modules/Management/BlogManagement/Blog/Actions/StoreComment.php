<?php

namespace App\Modules\Management\BlogManagement\Blog\Actions;

use App\Modules\Management\BlogManagement\Blog\Validations\BlogCommentValidation;

class StoreComment
{
    static $model = \App\Modules\Management\BlogManagement\Blog\Models\BlogCommentsModel::class;

    public static function execute($request , $blogId)
    {
        try {
            $validator = BlogCommentValidation::store($request);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }


            $comment = self::$model::query()->create([
                'blog_id' => $blogId,
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'comment' => $request->comment,
                'status' => 'active'
            ]);


            if ($comment) {
                return messageResponse('Item added successfully', $comment, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }

    
}
