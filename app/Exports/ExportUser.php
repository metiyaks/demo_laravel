<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Crypt;
use Hash;
class ExportUser implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        $data = array();
//        $data = User::all()->toArray();
//        
//        
//        if(!empty($data)) {
//            foreach($data as $k=>$v) {
//                $v['password'] = Hash::check($v['password'], $v['password'], []);
//                
//                echo '<pre>';
//                print_r($v);
//                die;
//            }
//        }
//        echo '<pre>';
//        print_r($data);
//        die;
        //return User::all();
        return User::select('name','email')->where('users.u_role', '=', 2)->get();
    }
}
