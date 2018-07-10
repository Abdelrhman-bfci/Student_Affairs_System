<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;

use Datatables;

class UserController extends Controller
{

    function index(){

        return view('user');
    }
    protected $redirectTo = '/User';


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    function AddUser(){

        return view('AddUser');

    }

    protected function create(Request $data)
    {
         User::create([
            'name' => $data->get('name'),
            'email' => $data->get('email'),
            'password' => bcrypt($data->get('password'))
        ]);

        return redirect('User');
    }

    /*
     * delete user by id TODO::make route and Design for delet the user
     */
    function DeleteUser($id){



        $u = User::find($id);

        $u->delete();

        return redirect('User');

    }
    /*
     * Update The user TODO::make route and ui for this function in this controller
     */
    function editeUser(Request $request){

        $id  = $request->get('id');

        $user = User::find($id);

        return view('edituser' ,['user'=>$user]);
    }

    function saveUser( Request $request){

           $id =  $request->get('id');

           $user = User::find($id);

           $user->update([
               'name' => $request->get('name'),
               'email' => $request->get('email'),
               'password' => bcrypt($request->get('password'))
           ]);


      return redirect('User');
    }

    function loadUserData(){

        $users = User::select('id','name','email')->get();


            return Datatables::of($users)->addColumn('action', function ($users) {
                return '<a href="editUser?id='.$users->id.'" style="margin-right: 8px;"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="delete/'.$users->id.'" ><i class="fa fa-trash fa-lg"></i></a>
                       ';
            })->make(true);


    }

}
