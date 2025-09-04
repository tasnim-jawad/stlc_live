<?php

namespace App\Modules\Management\PropertyManagement\Property\Actions;

class StoreData
{
    static $model = \App\Modules\Management\PropertyManagement\Property\Models\Model::class;

    public static function execute($request)
    {
        try {
            // dd($request->all());
            $requestData = $request->validated();
            $requestData['facts_and_features'] = $requestData['facts_and_features'] ?? [];
            $requestData['amenities'] = $requestData['amenities'] ?? [];
            $requestData['floor_plan'] = $requestData['floor_plan'] ?? [];
            $requestData['floor_plan_details'] = $requestData['floor_plan_details'] ?? [];

            // dd($requestData);

            if ($request->hasFile('property_video_thmbnail')) {
                $property_video_thmbnail = $request->file('property_video_thmbnail');
                $currentDate = now()->format('Y/m');
                $requestData['property_video_thmbnail'] = uploader($property_video_thmbnail, 'uploads/property/property_video_thmbnail/' . $currentDate);
            }

            if ($request->hasFile('banner_image')) {
                foreach ($request->file('banner_image') as $key => $banner_image) {
                    $currentDate = now()->format('Y/m');
                    $requestData['banner_image'][$key] = uploader($banner_image, 'uploads/property/banner_image/' . $currentDate);
                }
            }


            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $key => $gallery) {
                    $currentDate = now()->format('Y/m');
                    $requestData['gallery'][$key] = uploader($gallery, 'uploads/property/gallery/' . $currentDate);
                }
            }

            if (!empty($requestData['floor_plan'])) {
                foreach ($requestData['floor_plan'] as $index => $floor) {
                    if (isset($floor['image']) && $floor['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $currentDate = now()->format('Y/m');
                        $uploadedPath = uploader($floor['image'], 'uploads/property/floor_plan/' . $currentDate);
                        $requestData['floor_plan'][$index]['image'] = $uploadedPath;
                    }
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
