<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Crypt;
use Hash;
use Illuminate\Support\Facades\DB;
class ExportUser implements FromCollection, WithHeadings
{
    
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return User::all();
        return User::select('email', 'email as e','name')->where('users.u_role', '=', 2)->get();
    }
    
    public function headings(): array
    {
        return [
            'user_login',
            'user_email',
            'display_name',

        ];
    }


}
