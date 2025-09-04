<?php

namespace App\Modules\Management\PropertyManagement\Property\Controller;

use App\Modules\Management\PropertyManagement\Property\Actions\GetAllData;
use App\Modules\Management\PropertyManagement\Property\Actions\DestroyData;
use App\Modules\Management\PropertyManagement\Property\Actions\GetSingleData;
use App\Modules\Management\PropertyManagement\Property\Actions\StoreData;
use App\Modules\Management\PropertyManagement\Property\Actions\UpdateData;
use App\Modules\Management\PropertyManagement\Property\Actions\UpdateStatus;
use App\Modules\Management\PropertyManagement\Property\Actions\SoftDelete;
use App\Modules\Management\PropertyManagement\Property\Actions\RestoreData;
use App\Modules\Management\PropertyManagement\Property\Actions\ImportData;
use App\Modules\Management\PropertyManagement\Property\Actions\DeletePropertyImage;
use App\Modules\Management\PropertyManagement\Property\Actions\DeletePropertyFloorPlanImage;
use App\Modules\Management\PropertyManagement\Property\Validations\BulkActionsValidation;
use App\Modules\Management\PropertyManagement\Property\Validations\DataStoreValidation;
use App\Modules\Management\PropertyManagement\Property\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index()
    {

        $data = GetAllData::execute();
        return $data;
    }

    public function store(DataStoreValidation $request)
    {
        $data = StoreData::execute($request);
        return $data;
    }

    public function show($slug)
    {
        $data = GetSingleData::execute($slug);
        return $data;
    }

    public function update(DataStoreValidation $request, $slug)
    {
        $data = UpdateData::execute($request, $slug);
        return $data;
    }
    public function updateStatus()
    {
        $data = UpdateStatus::execute();
        return $data;
    }

    public function softDelete()
    {
        $data = SoftDelete::execute();
        return $data;
    }
    public function destroy($slug)
    {
        $data = DestroyData::execute($slug);
        return $data;
    }
    public function restore()
    {
        $data = RestoreData::execute();
        return $data;
    }
    public function import()
    {
        $data = ImportData::execute();
        return $data;
    }
    public function bulkAction(BulkActionsValidation $request)
    {
        $data = BulkActions::execute($request);
        return $data;
    }
    public function DeletePropertyImage($slug)
    {
        $data = DeletePropertyImage::execute($slug);
        return $data;
    }
    public function DeletePropertyFloorPlanImage($slug)
    {
        $data = DeletePropertyFloorPlanImage::execute($slug);
        return $data;
    }
}
