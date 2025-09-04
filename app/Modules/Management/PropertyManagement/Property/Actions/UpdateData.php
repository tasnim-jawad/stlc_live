<?php

namespace App\Modules\Management\PropertyManagement\Property\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\PropertyManagement\Property\Models\Model::class;

    public static function execute($request, $slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }
            $requestData = $request->validated();
            $requestData['facts_and_features'] = $requestData['facts_and_features'] ?? [];
            $requestData['amenities'] = $requestData['amenities'] ?? [];
            $requestData['floor_plan'] = $requestData['floor_plan'] ?? [];
            $requestData['floor_plan_details'] = $requestData['floor_plan_details'] ?? [];

            if ($request->hasFile('property_video_thmbnail')) {
                $property_video_thmbnail = $request->file('property_video_thmbnail');
                $currentDate = now()->format('Y/m');
                $requestData['property_video_thmbnail'] = uploader($property_video_thmbnail, 'uploads/property/property_video_thmbnail/' . $currentDate);
            }

            $requestData['banner_image'] = $data->banner_image ?? [];
            if ($request->hasFile('banner_image')) {
                $currentDate = now()->format('Y/m');
                foreach ($request->file('banner_image') as $key => $banner_image) {
                    $requestData['banner_image'][] = uploader($banner_image, 'uploads/property/banner_image/' . $currentDate);
                }
            }
            // dd($requestData);?
            $requestData['gallery'] = $data->gallery ?? [];
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $key => $gallery) {
                    $currentDate = now()->format('Y/m');
                    $requestData['gallery'][] = uploader($gallery, 'uploads/property/gallery/' . $currentDate);
                }
            }

            $existingFloorPlans = $data->floor_plan ?? [];
            $newFloorPlans = $request->input('floor_plan', []);

            if (!empty($newFloorPlans)) {
                foreach ($newFloorPlans as $index => $floor) {
                    // If there's an uploaded image at this index
                    if ($request->hasFile("floor_plan.$index.image")) {
                        $currentDate = now()->format('Y/m');
                        $uploadedFile = $request->file("floor_plan.$index.image");
                        $floor['image'] = uploader($uploadedFile, 'uploads/property/floor_plan/' . $currentDate);
                    } else {
                        // Retain existing image if available
                        $floor['image'] = $existingFloorPlans[$index]['image'] ?? null;
                    }

                    $existingFloorPlans[$index] = $floor;
                }
            }

            $requestData['floor_plan'] = $existingFloorPlans;

            $data->update($requestData);
            return messageResponse('Item updated successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
