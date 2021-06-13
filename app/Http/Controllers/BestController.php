<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Best;


class BestController extends Controller
{
    public function index(){
        $bests = Best::all();

        return view('bests', [
            'bests'=>$bests
        ]);
    }
    public function get_insert_view(){
        return view('best_insert');
    }

    public function delete(Request $request){
        Best::where('id',$request->best_id)->delete();
        return redirect()->back();
    }

    public function insert(Request $request){  
        $this->validate($request, [
            "name" => 'required',
            "code" => 'required',
            "end_year" => 'required',
            "job" => 'required',
            "business" => 'required',
            "study" => 'required',
            "tech" => 'required',
            "army" => 'required',
            "abroad" => 'required',
            "child" => 'required',
            "work" => 'required',
        ]);
        $data = array(
            "name" => $request->name,
            "code" => $request->code,
            "end_year" => $request->end_year,
            "job" => $request->job,
            "business" => $request->business,
            "study" => $request->study,
            "tech" => $request->tech,
            "army" => $request->army,
            "abroad" => $request->abroad,
            "child" => $request->child,
            "work" => $request->work
        );
        Best::insert($data);
        return redirect()->back()->with('message', 'Енгізілді!');
    }
}
