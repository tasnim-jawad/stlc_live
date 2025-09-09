<?php

namespace App\Modules\Management\AboutUsManagement\AboutUs\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\AboutUsManagement\AboutUs\Models\Model::class;

    public static function execute($request, $slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }
            $requestData = $request->validated();
            $requestData['features'] = $requestData['features'] ?? [];
            // dd($requestData);
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
            $data->update($requestData);
            return messageResponse('Item updated successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
