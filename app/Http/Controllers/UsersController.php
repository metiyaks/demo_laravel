<?php
/* love the clean code */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
class UsersController extends Controller
{

    public function index($type = null)
    {
        
        return view('users.index', ['type' => $type]);
    }
    public function dashboard()
    {
        return view('dashboard');
    }
    
    public function profile($type = null)
    {
        return view('users.profile', ['type' => $type]);
    }
    public function add()
    {
        return view('users.add');
    }
    public function edit($id)
    {
        return view('users.edit');
    }
    
    public function security($type = null)
    {
        return view('users.security', ['type' => $type]);
    }
    public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){
        Excel::import(new ImportUser, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportUsers(Request $request){
        return Excel::download(new ExportUser, 'users.csv');
    }
}
