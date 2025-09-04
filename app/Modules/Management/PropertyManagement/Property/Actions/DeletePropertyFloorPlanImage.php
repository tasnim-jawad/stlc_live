<?php

namespace App\Modules\Management\PropertyManagement\Property\Actions;

class DeletePropertyFloorPlanImage
{
    static $model = \App\Modules\Management\PropertyManagement\Property\Models\Model::class;

    public static function execute($slug)
    {
        try {

            // dd(request()->all(), $slug);

            if (!$data = self::$model::where('slug', $slug)->first()) {

                return messageResponse('Data not found...', $data, 404, 'error');
            }


            $index = request()->index;

            if (isset($data->floor_plan[$index])) {
                $floorPlans = $data->floor_plan;
                if (!empty($floorPlans[$index]['image']) && file_exists(public_path($floorPlans[$index]['image']))) {
                    unlink(public_path($floorPlans[$index]['image']));
                }
                unset($floorPlans[$index]);
                $data->floor_plan = array_values($floorPlans);
                $data->save();
            }
            // Return success message
            return messageResponse('Item Successfully deleted', [], 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
