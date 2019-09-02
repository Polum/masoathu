<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-10-19
 * Time: 4:29 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserDetail;

class UserController extends Controller
{
    /**
     * function to collect all users from te db and list them.
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    function index()
    {
        return User::all();
    }

    public function editUser($id)
    {
        $user = User::find($id);
        // return view('auth.edit', compact('user'));
        return redirect('edit-user')->with( ['user' => $user] );
    }


    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        $user['id'] = $request->id;
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['password'] = bcrypt($request->password);
        $user['user_type'] = $request->user_type;
        $user['region_id'] = $request->region_id;

        if($user->save()){
            return redirect('users');
        }

        return $user;
    }
    
    public function apiUsers()
    {
      $data  = array (
        0 => 
        array (
          'id' => 10,
          'name' => 'Rodgers Phiri',
          'station base' => 'Blantyre',
          'phone_number' => '0993195184',
          'email' => 'ZO10@zodiak.com',
          'password' => '54#rih4703',
        ),
        1 => 
        array (
          'id' => 11,
          'name' => 'Ketrina Kazako',
          'station base' => 'Blantyre',
          'phone_number' => '0998838880',
          'email' => 'ZO11@zodiak.com',
          'password' => '620.!aZ7957',
        ),
        2 => 
        array (
          'id' => 12,
          'name' => 'Hussen Mdala',
          'station base' => 'Blantyre',
          'phone_number' => '0999441028',
          'email' => 'ZO12@zodiak.com',
          'password' => '9220950M.*2',
        ),
        3 => 
        array (
          'id' => 13,
          'name' => 'David Phiri',
          'station base' => 'Blantyre',
          'phone_number' => '0992111112',
          'email' => 'ZO13@zodiak.com',
          'password' => '2Ra37029n88',
        ),
        4 => 
        array (
          'id' => 14,
          'name' => 'Phillip Kazako',
          'station base' => 'Blantyre',
          'phone_number' => '0994271992',
          'email' => 'ZO14@zodiak.com',
          'password' => '17V79ya71%44',
        ),
        5 => 
        array (
          'id' => 15,
          'name' => 'Cathy Malunga',
          'station base' => 'Blantyre',
          'phone_number' => '0996443966',
          'email' => 'ZO15@zodiak.com',
          'password' => '606Khu119L86',
        ),
        6 => 
        array (
          'id' => 16,
          'name' => 'test',
          'station base' => 'test',
          'phone_number' => '09999999',
          'email' => 'ZO10@test.com',
          'password' => '993259202test',
        ),
      );

      return response()->json(["data" => $data]);
    }
}