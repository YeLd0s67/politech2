<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Prof;
use App\Group;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Response;

class ProfController extends Controller
{
    public function view(){
        $profs = Prof::all();
        return view('profs', [
            'profs' => $profs
        ]);
    }

    public function insert(){
        $groups = Group::all();
        return view('profs_insert', [
            'groups' => $groups, 
        ]);
    }

    public function store(Request $request){
        // Validation
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'short_name' => 'required',
            'groups' => 'required',
            'year' => 'required',
         ]); 

       $data = array(
            "code" => $request->code,
            "description" => $request->description,
            "short_name" => $request->short_name,
            "groups" => $request->groups,
            "year" => $request->year,
        );
       Prof::insert($data);
  
       return redirect()->back();
     } 
}
