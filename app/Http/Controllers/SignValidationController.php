<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListSignature;

class SignValidationController extends Controller
{
    public function index(Request $request) {


        $data = ListSignature::where('id_list',$request['id'])->first();

        return view('admin.validate.index', ['data'=>$data]);
    }
}
