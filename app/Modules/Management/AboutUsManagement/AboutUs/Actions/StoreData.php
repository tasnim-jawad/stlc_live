<?php

namespace App\Modules\Management\AboutUsManagement\AboutUs\Actions;

class StoreData
{
    static $model = \App\Modules\Management\AboutUsManagement\AboutUs\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            $requestData['features'] = $requestData['features'] ?? [];
            dd($requestData);

            if ($request->hasFile('primary_image')) {

                foreach ($request->file('primary_image') as $key => $primary_image) {
                    $currentDate = now()->format('Y/m');
                    $requestData['primary_image'][$key] = uploader($primary_image, 'uploads/AboutUs/primary_image/' . $currentDate);
                }
            }

            if ($request->hasFile('secondary_image')) {
                $secondary_image = $request->file('secondary_image');
                $currentDate = now()->format('Y/m');
                $requestData['secondary_image'] = uploader($secondary_image, 'uploads/about/' . $currentDate);
            }
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
