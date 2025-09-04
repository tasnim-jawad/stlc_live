<?php

namespace App\Modules\Management\BlogManagement\Blog\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\BlogManagement\Blog\Models\Model::class;

    public static function execute($request, $slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }
            $requestData = $request->validated();
            if ($request->hasFile('thumbnail_image')) {
                $thumbnail_image = $request->file('thumbnail_image');
                $currentDate = now()->format('Y/m');
                $requestData['thumbnail_image'] = uploader($thumbnail_image, 'uploads/blog/thumbnail_image/' . $currentDate);
            }
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $currentDate = now()->format('Y/m');
                $requestData['image'] = uploader($image, 'uploads/blog/image/' . $currentDate);
            }
            $data->update($requestData);
            return messageResponse('Item updated successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
