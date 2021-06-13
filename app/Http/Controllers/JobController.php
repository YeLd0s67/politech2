<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Response;

class JobController extends Controller
{
    public function view(){
        $jobs = Jobs::all();
        return view('jobs', [
            'jobs' => $jobs
        ]);
    }

    public function insert(){
        return view('job_insert');
    }

    public function store(Request $request){
   
        // Validation
       $request->validate([
          'code' => 'required',
          'name' => 'required',
          'grad' => 'required',
          'group' => 'required'

       ]); 

       $data = array(
           "code" => $request->code,
           "name" => $request->name,
           "grad" => $request->grad,
           "group" => $request->group

       );
       Jobs::insert($data);
  
       return redirect()->back()->with('message', 'Енгізілді!');     
    }
    
    public function delete(Request $request){
        Jobs::where('id', $request->job_id)->delete();
        return redirect()->back();
    }
   
}
