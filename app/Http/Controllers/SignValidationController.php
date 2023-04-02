<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListSignature;

class SignValidationController extends Controller
{
    public function index(Request $request) {
//        $validate = $request->validate([
//           'id'=>'required|integer'
//        ]);

        $id = $request['id'];

        $data = ListSignature::where('id',$id)->get();

        dd($data);

        return view('admin.validate.index', $data);
    }
}
