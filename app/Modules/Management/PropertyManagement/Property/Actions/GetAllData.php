<?php

namespace App\Modules\Management\PropertyManagement\Property\Actions;

class GetAllData
{
    static $model = \App\Modules\Management\PropertyManagement\Property\Models\Model::class;

    public static function execute()
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'desc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $start_date = request()->input('start_date');
            $end_date = request()->input('end_date');
            $with = ['category'];
            $condition = [];

            $data = self::$model::query();

            if (request()->has('search') && request()->input('search')) {
                $searchKey = request()->input('search');
                $data = $data->where(function ($q) use ($searchKey) {
                    // $q->where('banner_image', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('property_group_id', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('property_category_id', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('property_status', 'like', '%' . $searchKey . '%');
                    $q->orWhere('property_name', 'like', '%' . $searchKey . '%');
                    $q->orWhere('property_address', 'like', '%' . $searchKey . '%');
                    $q->orWhere('date', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('property_description', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('property_detail', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('facts_and_features', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('gallery', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('amenities', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('floor_plan', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('property_video_url', 'like', '%' . $searchKey . '%');
                    // $q->orWhere('map_location_url', 'like', '%' . $searchKey . '%');
                });
            }

            if ($start_date && $end_date) {
                if ($end_date > $start_date) {
                    $data->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
                } elseif ($end_date == $start_date) {
                    $data->whereDate('created_at', $start_date);
                }
            }

            if ($status == 'trased') {
                $data = $data->trased();
            }

            if (request()->has('random_data') && request()->input('random_data') == 1) {
             
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->inRandomOrder()
                    ->get();
                return entityResponse($data);
            }

            if (
                request()->has('property_category_id') &&
                request()->input('property_category_id') != '' &&
                request()->input('property_category_id') != null
            ) {
                $property_category_id = request()->input('property_category_id');
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('property_category_id', $property_category_id)
                    ->where('status', $status)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);

                return entityResponse([
                    ...$data->toArray(),
                    "active_data_count" => self::$model::active()->count(),
                    "inactive_data_count" => self::$model::inactive()->count(),
                    "trased_data_count" => self::$model::trased()->count(),
                ]);
            }

            if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType)
                    ->get();
                return entityResponse($data);
            } else if ($status == 'trased') {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);
            } else {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);
            }

            return entityResponse([
                ...$data->toArray(),
                "active_data_count" => self::$model::active()->count(),
                "inactive_data_count" => self::$model::inactive()->count(),
                "trased_data_count" => self::$model::trased()->count(),
            ]);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
