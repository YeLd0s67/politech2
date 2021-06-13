<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Student;
use App\Achivement;


class StudentController extends Controller
{
    public function index(){
        $students = Student::all();

        return view('students', [
            'students'=>$students
        ]);
    }
    public function get_insert_view(){
        return view('insert_student');
    }

    public function view($key){
        $student = Student::where('id', '=', $key)->get();
        return view('view_student', [
            'student'=>$student
        ]);
    }

    public function view_update($key){
        $student = Student::where('id', '=', $key)->get();
        return view('edit_students', [
            'student'=>$student
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
            "citizen" => 'required',
            "nation" => 'required',
            "spec" => 'required',
            "group" => 'required',
            "passport" => 'required',
            "passport_given" => 'required',
            "address" => 'required',
            "phone" => 'required',
            "school" => 'required',
            "lang" => 'required',
            "family_children" => 'required',
            "clubs" => 'required',
            "parent_names" => 'required',
            "work" => 'required',
            "parent_passport" => 'required',
            "parent_iin" => 'required',
            "status" => 'required',
        ]);
        $data = array(
            "iin" => $request->iin,
            "last_name" => $request->surename,
            "first_name" => $request->name,
            "middle_name" => $request->middle,
            "date_birth" => $request->birthday,
            "gender" => $request->gender,
            "citizen" => $request->citizen,
            "other_citizen" => $request->other_citizen,
            "nation" => $request->nation,
            "other_nation" => $request->other_nation,
            "spec" => $request->spec,
            "group" => $request->group,
            "passport" => $request->passport,
            "passport_given" => $request->passport_given,
            "address" => $request->address,
            "phone" => $request->phone,
            "school" => $request->school,
            "lang" => $request->lang,
            "family_children" => $request->family_children,
            "clubs" => $request->clubs,
            "parent_names" => $request->parent_names,
            "work" => $request->work,
            "parent_passport" => $request->parent_passport,
            "parent_iin" => $request->parent_iin,
            "status" => $request->status
        );
        Student::where('iin', $request->iin)->update([
            "iin" => $request->iin,
            "last_name" => $request->surename,
            "first_name" => $request->name,
            "middle_name" => $request->middle,
            "date_birth" => $request->birthday,
            "gender" => $request->gender,
            "citizen" => $request->citizen,
            "other_citizen" => $request->other_citizen,
            "nation" => $request->nation,
            "other_nation" => $request->other_nation,
            "spec" => $request->spec,
            "group" => $request->group,
            "passport" => $request->passport,
            "passport_given" => $request->passport_given,
            "address" => $request->address,
            "phone" => $request->phone,
            "school" => $request->school,
            "lang" => $request->lang,
            "family_children" => $request->family_children,
            "clubs" => $request->clubs,
            "parent_names" => $request->parent_names,
            "work" => $request->work,
            "parent_passport" => $request->parent_passport,
            "parent_iin" => $request->parent_iin,
            "status" => $request->status
            ]);
        
        return redirect()->back()->with('message', 'Өзгертілді!');
    }
    
    public function delete(Request $request){
        Student::where('id',$request->student_id)->delete();
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
            "citizen" => 'required',
            "nation" => 'required',
            "spec" => 'required',
            "group" => 'required',
            "passport" => 'required',
            "passport_given" => 'required',
            "address" => 'required',
            "phone" => 'required',
            "school" => 'required',
            "lang" => 'required',
            "family_children" => 'required',
            "clubs" => 'required',
            "parent_names" => 'required',
            "work" => 'required',
            "parent_passport" => 'required',
            "parent_iin" => 'required',
            "status" => 'required',
        ]);
        $data = array(
            "iin" => $request->iin,
            "last_name" => $request->surename,
            "first_name" => $request->name,
            "middle_name" => $request->middle,
            "date_birth" => $request->birthday,
            "gender" => $request->gender,
            "citizen" => $request->citizen,
            "other_citizen" => $request->other_citizen,
            "nation" => $request->nation,
            "other_nation" => $request->other_nation,
            "spec" => $request->spec,
            "group" => $request->group,
            "passport" => $request->passport,
            "passport_given" => $request->passport_given,
            "address" => $request->address,
            "phone" => $request->phone,
            "school" => $request->school,
            "lang" => $request->lang,
            "family_children" => $request->family_children,
            "clubs" => $request->clubs,
            "parent_names" => $request->parent_names,
            "work" => $request->work,
            "parent_passport" => $request->parent_passport,
            "parent_iin" => $request->parent_iin,
            "status" => $request->status
        );
        Student::insert($data);
        return redirect()->back()->with('message', 'Енгізілді!');
    }

    public function get_achive_view(){
        $achives = Achivement::all();

        return view('achive_students', [
            'achives'=>$achives
        ]);
    }

    public function get_achive_insert_view(){

        return view('achive_student_insert');
    }

    public function achive_delete(Request $request){
        Achivement::where('id',$request->achive_id)->delete();
        return redirect()->back();
    }

    public function achive_store(Request $request){  
        $this->validate($request, [
            "name" => 'required',
            "year" => 'required',
            "groups" => 'required',
            "advisor" => 'required',
            "shara" => 'required',
            "level" => 'required',
            "shara_name" => 'required',
            "period" => 'required',
            "achivement" => 'required'
        ]);
        $data = array(
            "name" => $request->name,
            "year" => $request->year,
            "groups" => $request->groups,
            "advisor" => $request->advisor,
            "shara" => $request->shara,
            "level" => $request->level,
            "shara_name" => $request->shara_name,
            "period" => $request->period,
            "achivement" => $request->achivement
        );
        Achivement::insert($data);
        return redirect()->back()->with('message', 'Енгізілді!');
    }
}
