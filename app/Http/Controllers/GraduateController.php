<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Graduate;
use App\Achivement;


class GraduateController extends Controller
{
    public function index(){
        $graduates = Graduate::all();

        return view('graduates', [
            'graduates'=>$graduates
        ]);
    }
    public function get_insert_view(){
        return view('insert_graduate');
    }

    public function view($key){
        $graduate= Graduate::where('id', '=', $key)->get();
        return view('view_graduate', [
            'graduate'=>$graduate
        ]);
    }

    public function view_update($key){
        $graduate = Graduate::where('id', '=', $key)->get();
        return view('edit_graduate', [
            'graduate'=>$graduate
        ]);
    }

    public function update(Request $request){
        $this->validate($request, [
            "iin" => 'required',
            "surename" => 'required',
            "name" => 'required',
            "middle" => 'required',
            "birthday" => 'required',
            "gender" => 'required',
            "nation" => 'required',
            "spec_code" => 'required',
            "spec" => 'required',
            "group" => 'required',
            "grant" => 'required',
            "company" => 'required',
            "study" => 'required',
            "university" => 'required',
            "study_type" => 'required',
            "university_year" => 'required',
            "end_year" => 'required',
            "work" => 'required',
            "army" => 'required',
            "abroad" => 'required',
            "child" => 'required',
            "unemployed" => 'required',
            "address" => 'required',
            "email" => 'required',
            "phone" => 'required',
            "business" => 'required',
        ]);
        $data = array(
            "iin" => $request->iin,
            "last_name" => $request->surename,
            "first_name" => $request->name,
            "middle_name" => $request->middle,
            "date_birth" => $request->birthday,
            "gender" => $request->gender,
            "nation" => $request->nation,
            "other_nation" => $request->other_nation,
            "spec_code" => $request->spec_code,
            "spec" => $request->spec,
            "group" => $request->group,
            "grant" => $request->grant,
            "company" => $request->company,
            "study" => $request->study,
            "university" => $request->university,
            "study_type" => $request->study_type,
            "university_year" => $request->university_year,
            "end_year" => $request->end_year,
            "work" => $request->work,
            "army" => $request->army,
            "abroad" => $request->abroad,
            "child" => $request->child,
            "unemployed" => $request->unemployed,
            "address" => $request->address,
            "email" => $request->email,
            "phone" => $request->phone,
            "business" => $request->business
        );
        Graduate::where('iin', $request->iin)->update([
            "iin" => $request->iin,
            "last_name" => $request->surename,
            "first_name" => $request->name,
            "middle_name" => $request->middle,
            "date_birth" => $request->birthday,
            "gender" => $request->gender,
            "nation" => $request->nation,
            "other_nation" => $request->other_nation,
            "spec_code" => $request->spec_code,
            "spec" => $request->spec,
            "group" => $request->group,
            "grant" => $request->grant,
            "company" => $request->company,
            "study" => $request->study,
            "university" => $request->university,
            "study_type" => $request->study_type,
            "university_year" => $request->university_year,
            "end_year" => $request->end_year,
            "work" => $request->work,
            "army" => $request->army,
            "abroad" => $request->abroad,
            "child" => $request->child,
            "unemployed" => $request->unemployed,
            "address" => $request->address,
            "email" => $request->email,
            "phone" => $request->phone,
            "business" => $request->business
            ]);
        
        return redirect()->back()->with('message', 'Өзгертілді!');
    }
    
    public function delete(Request $request){
        Graduate::where('id',$request->graduate_id)->delete();
        return redirect()->back();
    }

    public function insert(Request $request){  
        $this->validate($request, [
            "iin" => 'required',
            "surename" => 'required',
            "name" => 'required',
            "middle" => 'required',
            "birthday" => 'required',
            "gender" => 'required',
            "nation" => 'required',
            "spec_code" => 'required',
            "spec" => 'required',
            "group" => 'required',
            "grant" => 'required',
            "company" => 'required',
            "study" => 'required',
            "university" => 'required',
            "study_type" => 'required',
            "university_year" => 'required',
            "end_year" => 'required',
            "work" => 'required',
            "army" => 'required',
            "abroad" => 'required',
            "child" => 'required',
            "unemployed" => 'required',
            "address" => 'required',
            "email" => 'required',
            "phone" => 'required',
            "business" => 'required',
        ]);
        $data = array(
            "iin" => $request->iin,
            "last_name" => $request->surename,
            "first_name" => $request->name,
            "middle_name" => $request->middle,
            "date_birth" => $request->birthday,
            "gender" => $request->gender,
            "nation" => $request->nation,
            "other_nation" => $request->other_nation,
            "spec_code" => $request->spec_code,
            "spec" => $request->spec,
            "group" => $request->group,
            "grant" => $request->grant,
            "company" => $request->company,
            "study" => $request->study,
            "university" => $request->university,
            "study_type" => $request->study_type,
            "university_year" => $request->university_year,
            "end_year" => $request->end_year,
            "work" => $request->work,
            "army" => $request->army,
            "abroad" => $request->abroad,
            "child" => $request->child,
            "unemployed" => $request->unemployed,
            "address" => $request->address,
            "email" => $request->email,
            "phone" => $request->phone,
            "business" => $request->business
        );
        Graduate::insert($data);
        return redirect()->back()->with('message', 'Енгізілді!');
    }

}
