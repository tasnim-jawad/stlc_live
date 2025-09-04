<?php

namespace App\Modules\Management\TestimonialManagement\Testimonial\Controller;
use App\Modules\Management\TestimonialManagement\Testimonial\Actions\GetAllData;
use App\Modules\Management\TestimonialManagement\Testimonial\Actions\DestroyData;
use App\Modules\Management\TestimonialManagement\Testimonial\Actions\GetSingleData;
use App\Modules\Management\TestimonialManagement\Testimonial\Actions\StoreData;
use App\Modules\Management\TestimonialManagement\Testimonial\Actions\UpdateData;
use App\Modules\Management\TestimonialManagement\Testimonial\Actions\UpdateStatus;
use App\Modules\Management\TestimonialManagement\Testimonial\Actions\SoftDelete;
use App\Modules\Management\TestimonialManagement\Testimonial\Actions\RestoreData;
use App\Modules\Management\TestimonialManagement\Testimonial\Actions\ImportData;
use App\Modules\Management\TestimonialManagement\Testimonial\Validations\BulkActionsValidation;
use App\Modules\Management\TestimonialManagement\Testimonial\Validations\DataStoreValidation;
use App\Modules\Management\TestimonialManagement\Testimonial\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index( ){

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

}