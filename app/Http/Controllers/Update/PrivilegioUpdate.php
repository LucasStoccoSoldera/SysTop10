<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Models\Privilegio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivilegioUpdate extends Controller
{

    protected function  editPrivilegio($id)
    {
        $object = Privilegio::find($id);
        return response()->json($object);
    }

    protected function updatePrivilegio(Request $request)
    {
    }

}
