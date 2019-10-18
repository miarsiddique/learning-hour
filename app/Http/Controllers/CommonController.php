<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Resources\UserResource as UserItem;
use App\Http\Resources\UserCollection;

class CommonController extends Controller
{
   public function dbValue()
   {
   		$builder  = DB::table('users as u')
   						->Join('contacts as c', 'u.id', '=', 'c.user_id')
   						->Join('products as p', 'u.id', '=', 'p.user_id')
   						->select('u.*','u.name as user_name', 'p.*');   		
   		$data = $builder->get();

   		return $data;
   } 

   public function usersList()
   {
   		$users = DB::table('users')->paginate(2);
   		// $users->message = 'User list display successfully'; 
   		return  (new UserCollection($users))->additional([
   			'meta2' => [
   				'message' => 'success',
   				'error' => 'false',
   				'status_code' => 200
   			],
   		]);
   }
}
