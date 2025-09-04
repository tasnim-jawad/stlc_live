<?php

namespace App\Modules\Management\TodaySellsManagement\TodaySells\Actions;

class DeleteGalleryImage
{
    static $model = \App\Modules\Management\TodaySellsManagement\TodaySells\Models\Model::class;

    public static function execute()
    {
        try {
            if (!$data = self::$model::where('slug', request()->slug)->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }

            $requestData = json_decode(request()->data);

            $fields = ['image_gallery_left', 'image_gallery_right'];

            if (
                isset($requestData->field, $requestData->index) &&
                in_array($requestData->field, $fields)
            ) {
                $field = $requestData->field;
                $index = $requestData->index;

                // Get current array
                $images = $data->$field ?? [];

                if (isset($images[$index])) {
                    $imagePath = $images[$index];

                    // Delete file if it exists
                    if (!empty($imagePath) && file_exists(public_path($imagePath))) {
                        unlink(public_path($imagePath));
                    }

                    // Remove image and re-index
                    unset($images[$index]);
                    $images = array_values($images);

                    // Save back to model
                    $data->$field = $images;
                    $data->save();
                }
            }
            return messageResponse('Item Successfully deleted', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
