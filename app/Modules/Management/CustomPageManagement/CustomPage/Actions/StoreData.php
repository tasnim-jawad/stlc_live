<?php

namespace App\Modules\Management\CustomPageManagement\CustomPage\Actions;

class StoreData
{
    static $model = \App\Modules\Management\CustomPageManagement\CustomPage\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            if ($request->hasFile('banner_image')) {
                $banner_image = $request->file('banner_image');
                $currentDate = now()->format('Y/m');
                $requestData['banner_image'] = uploader($banner_image, 'uploads/custom_page/' . $currentDate);
            }

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}