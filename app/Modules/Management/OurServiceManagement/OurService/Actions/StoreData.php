<?php

namespace App\Modules\Management\OurServiceManagement\OurService\Actions;

class StoreData
{
    static $model = \App\Modules\Management\OurServiceManagement\OurService\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $currentDate = now()->format('Y/m');
                $requestData['image'] = uploader($image, 'uploads/service/' . $currentDate);
            }
            if ($request->hasFile('primary_image')) {
                $primary_image = $request->file('primary_image');
                $currentDate = now()->format('Y/m');
                $requestData['primary_image'] = uploader($primary_image, 'uploads/service/' . $currentDate);
            }

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}