<?php

namespace App\Modules\Management\OurTeamManagement\OurTeam\Actions;

class StoreData
{
    static $model = \App\Modules\Management\OurTeamManagement\OurTeam\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            $requestData['social_link'] = $requestData['social_link'] ?? [];
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $currentDate = now()->format('Y/m');
                $requestData['image'] = uploader($image, 'uploads/team/' . $currentDate);
            }

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}