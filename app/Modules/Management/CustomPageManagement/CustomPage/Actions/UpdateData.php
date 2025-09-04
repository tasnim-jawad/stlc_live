<?php

namespace App\Modules\Management\CustomPageManagement\CustomPage\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\CustomPageManagement\CustomPage\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();
            if ($request->hasFile('banner_image')) {
                $banner_image = $request->file('banner_image');
                $currentDate = now()->format('Y/m');
                $requestData['banner_image'] = uploader($banner_image, 'uploads/custom_page/' . $currentDate);
            }
            $data->update($requestData);
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}