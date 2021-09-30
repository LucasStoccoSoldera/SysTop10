<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Models\Privilegio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivilegioUpdate extends Controller
{

    protected function  editPrivilegio(Request $request)
    {
        $object = Privilegio::find($request->IDEdit)->get();
        return response()->json([compact('object')]);
    }

    protected function updatePrivilegio(Request $request)
    {
    }

}
