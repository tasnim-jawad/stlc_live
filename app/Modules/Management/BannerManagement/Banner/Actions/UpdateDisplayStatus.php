<?php

namespace App\Modules\Management\BannerManagement\Banner\Actions;

class UpdateDisplayStatus
{
    static $model = \App\Modules\Management\BannerManagement\Banner\Models\Model::class;

    public static function execute()
    {
        try {
            if (!$data = self::$model::query()->where('slug', request('slug'))->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }
            if ($data->display_status == 1) {
                $data->display_status = 0;
            } else {
                $data->display_status = 1;

                self::$model::query()
                ->where('id', '!=', $data->id)
                ->update(['display_status' => 0]);
            }

            $data->update();
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}