<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Datatables;

class Certificate extends Controller
{
    //

    public function index(){

        return view('certificate');
    }

    public function LoadCertificate(){

        $certificates = \App\Certificate::select('Student_ID','Certificate_ID','name')->get();


        return Datatables::of($certificates)->addColumn('action', function ($users) {
            return '<a href="editUser?id='.$users->id.'" style="margin-right: 8px;"><i class="fa fa-edit fa-lg"></i></a>
                     <a href="delete/'.$users->id.'" ><i class="fa fa-trash fa-lg"></i></a>
                      <a href="delete/'.$users->id.'" ><i class="fa fa-trash fa-lg"></i></a>
                       ';
        })->make(true);
    }
}
