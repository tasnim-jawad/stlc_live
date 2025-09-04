<?php

namespace App\Modules\Management\TodaySellsManagement\TodaySells\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\TodaySellsManagement\TodaySells\Models\Model::class;

    public static function execute($request, $slug)
    {
        try {
            $data = self::$model::query()->where('slug', $slug)->first();
            if (!$data) {
                return messageResponse('Data not found...', null, 404, 'error');
            }
            $requestData = $request->validated();
            $currentDate = now()->format('Y/m');

            $requestData['image_gallery_left'] = self::mergeGallery($request, $data, 'image_gallery_left', $currentDate);
            $requestData['image_gallery_right'] = self::mergeGallery($request, $data, 'image_gallery_right', $currentDate);

            $data->update($requestData);
            return messageResponse('Item updated successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }

    private static function mergeGallery($request, $data, $field, $currentDate)
    {
        $existing = $data->{$field} ?? [];
        $new = [];
        // If direct image(s) in request
        if ($request->has($field) && !$request->hasFile($field)) {
            $new = is_array($request->{$field}) ? $request->{$field} : [$request->{$field}];
        }
        // If file upload(s)
        if ($request->hasFile($field)) {
            foreach ($request->file($field) as $file) {
                $new[] = uploader($file, 'uploads/gallery/' . $currentDate);
            }
        }
        // Merge and remove duplicates
        return array_values(array_unique(array_merge($existing, $new)));
    }
}
