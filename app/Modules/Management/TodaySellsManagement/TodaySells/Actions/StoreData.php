<?php

namespace App\Modules\Management\TodaySellsManagement\TodaySells\Actions;

class StoreData
{
    static $model = \App\Modules\Management\TodaySellsManagement\TodaySells\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();



            $requestData['features'] = $requestData['features'] ?? [];
            $requestData['key_features'] = $requestData['key_features'] ?? [];

            if ($request->hasFile('image_gallery_left')) {
                foreach ($request->file('image_gallery_left') as $key => $gallery_left) {
                    $currentDate = now()->format('Y/m');
                    $requestData['image_gallery_left'][$key] = uploader($gallery_left, 'uploads/gallery/' . $currentDate);
                }
            }

            if ($request->hasFile('image_gallery_right')) {
                foreach ($request->file('image_gallery_right') as $key => $gallery_right) {
                    $currentDate = now()->format('Y/m');
                    $requestData['image_gallery_right'][$key] = uploader($gallery_right, 'uploads/gallery/' . $currentDate);
                }
            }


            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
