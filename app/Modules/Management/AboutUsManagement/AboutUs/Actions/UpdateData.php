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



            if ($request->hasFile('primary_image')) {
                // Get existing primary_image array or initialize as empty array
                $existingImages = $data->primary_image ? (is_array($data->primary_image) ? $data->primary_image : json_decode($data->primary_image, true)) : [];

                // Start with existing images
                $requestData['primary_image'] = $existingImages;

                foreach ($request->file('primary_image') as $primary_image) {
                    $currentDate = now()->format('Y/m');
                    $uploadedImagePath = uploader($primary_image, 'uploads/AboutUs/primary_image/' . $currentDate);
                    // Append new image to existing array
                    $requestData['primary_image'][] = $uploadedImagePath;
                }
            }

            if ($request->hasFile('secondary_image')) {
                $secondary_image = $request->file('secondary_image');
                $currentDate = now()->format('Y/m');
                $requestData['secondary_image'] = uploader($secondary_image, 'uploads/AboutUs/secondary_image/' . $currentDate);
            }
            $data->update($requestData);
            return messageResponse('Item updated successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
