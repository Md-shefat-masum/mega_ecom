<?php

namespace App\Modules\TagManagement\ProductTag;

use App\Modules\TagManagement\ProductTag\Actions\All;
use App\Modules\TagManagement\ProductTag\Actions\Destroy;
use App\Modules\TagManagement\ProductTag\Actions\Show;
use App\Modules\TagManagement\ProductTag\Actions\Store;
use App\Modules\TagManagement\ProductTag\Actions\Update;
use App\Modules\TagManagement\ProductTag\Actions\SoftDelete;
use App\Modules\TagManagement\ProductTag\Actions\Restore;
use App\Modules\TagManagement\ProductTag\Actions\Import;
use App\Modules\TagManagement\ProductTag\Validations\BulkActionsValidation;
use App\Modules\TagManagement\ProductTag\Validations\GetAllValidation;
use App\Modules\TagManagement\ProductTag\Validations\Validation;
use App\Modules\TagManagement\ProductTag\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index(GetAllValidation $request)
    {
        $data = All::execute($request);
        return $data;
    }

    public function store(Validation $request)
    {
        $data = Store::execute($request);
        return $data;
    }

    public function show($slug)
    {
        $data = Show::execute($slug);
        return $data;
    }

    public function update(Validation $request, $slug)
    {
        $data = Update::execute($request, $slug);
        return $data;
    }

    public function softDelete()
    {
        $data = SoftDelete::execute();
        return $data;
    }
    public function destroy($slug)
    {
        $data = Destroy::execute($slug);
        return $data;
    }
    public function restore()
    {
        $data = Restore::execute();
        return $data;
    }
    public function import()
    {
        $data = Import::execute();
        return $data;
    }
    public function bulkAction(BulkActionsValidation $request)
    {
        $data = BulkActions::execute($request);
        return $data;
    }

}