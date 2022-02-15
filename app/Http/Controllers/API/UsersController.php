<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use \Crypt;
use File;

class UsersController extends BaseController
{

    public function index(Request $request)
    {
        $input = $request->all();
        $userid = auth('api')->user()->id;
        
        $users = array();
        
        //Data Code For Direct Users with Auth Table used
        $users = DB::table('users')
                ->select([
                    'users.*',
                ])
                ->where('users.u_role', '=', 2)
                ->get()->toArray();
        //End Code For Direct Users without Auth Table used
        
       
        if (!empty($users)) {
            return $this->sendResponse($users, 'User retrieved successfully.');
        } else {
            
            return $this->sendResponse($users, 'No User Added Yet.');
        }
    }
    
   
    public function profile(Request $request)
    {
        $input = $request->all();
        $userid = auth('api')->user()->id;
       
        $users = array();
        
        
        $users = DB::table('users')
                ->select([
                    'users.*',
                ])
                ->where('users.id', '=', $userid)
                ->first();
        
        //End Code For Direct Users without Auth Table used
        
        if (!empty($users)) {
            return $this->sendResponse($users, 'User profile retrieved successfully.');
        } else {
            return $this->sendResponse($users->toArray(), 'No User Added Yet.');
        }
    }
    

    public function getLoginData(Request $request)
    {

        $userData = $request->email;

        $data = '';
        $data = DB::table('users')
            ->select([
                'users.email',
                

            ])
            ->where('users.email', '=', $userData)->first();

        return $this->sendResponse($data, 'User retrieved successfully.');
    }

    /**
     *
     * @param Request Add new User
     * @return type Json
     */
    public function storeUser(Request $request)
    {

        $input = $request->all();
        $loggeduserid = auth('api')->user()->id;
        
        $errors = [];
        $failed = false;
        $validator = Validator::make($request->all(), [
            
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'min:6|required_with:re_password|same:re_password',
            're_password' => 'required',
            'budget' => 'required',
            'contact' => 'required',
            
        ],
            [
                'email.unique' => 'The Email has already been taken.',
            ]);

        if ($validator->fails()) {
            $failed = true;
            array_push($errors, $validator->getMessageBag()->toArray());
        }
        
        if ($failed == true) {
            return $this->sendError($validator->errors()->first(), 422, $errors);
        }
        
        $input['password'] = bcrypt($input['password']);
        $date = date('Y-m-d H:i:s');
        
        try {
            $input['u_role'] = 2;
            $input['status'] = 1;
            
            $user = User::create($input);
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
            
            return $this->sendResponse($success, 'User Created successfully.');
        } catch (\Exception $e) {
            return $this->sendError($e->getmessage(), 300);
        }
    }

    /**
     *
     * @param Request Edit User
     * @return type Json
     */
    public function edit(Request $request)
    {
        $userid = auth('api')->user()->id;
        $input = $request->all();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 422, $validator->errors());
        }
        
        
        
        
        //$input['password'] = bcrypt($input['password']);
        
        try {
            
        
            $user = Auth::user();
            $user->name=$request->input('name');
            $user->save();
            
            
        
//                DB::table('users')
//                    ->where('id', $userid)
//                    ->update(['name' => $input['name']]);
            
        } catch (Exception $e) {
            return $this->sendError($e->getmessage(), 300);
        }
    }

    
    public function createWp(Request $request)
    {

        $userid = auth('api')->user()->id;
        $input = $request->all();

        $data = '';
        $data = DB::table('users')
            ->select([
                'users.email',
                'users.name',

            ])
            ->where('users.id', '=', $userid)->first();
        
        return $this->sendResponse($data, 'User retrieved successfully.');
    }
}
