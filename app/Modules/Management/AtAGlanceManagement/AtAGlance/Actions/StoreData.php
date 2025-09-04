<?php

namespace App\Modules\Management\AtAGlanceManagement\AtAGlance\Actions;

class StoreData
{
    static $model = \App\Modules\Management\AtAGlanceManagement\AtAGlance\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $currentDate = now()->format('Y/m');
                $requestData['icon'] = uploader($icon, 'uploads/at_a_glance/' . $currentDate);
            }

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}