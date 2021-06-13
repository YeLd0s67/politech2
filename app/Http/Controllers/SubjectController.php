<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Teacher;
use App\Prof;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    public function view(){
        $subjects = Subject::all();
        $profs = Prof::all();
        return view('subject', [
            'subjects' => $subjects,
            'profs' => $profs
        ]);
    }

    public function insert(){
        $profs = Prof::all();
        return view('subject_insert', [
            'profs' => $profs
        ]);
    }

    public function store(Request $request){
   
        // Validation
       $request->validate([
          'speciality' => 'required',
          'year' => 'required',
          'semester' => 'required',
          'group' => 'required',
          'subject' => 'required',
          'exam' => 'required',
          'bakylau' => 'required',
          'course_job' => 'required'

       ]); 

       $data = array(
           "speciality" => $request->speciality,
           "year" => $request->year,
           "semester" => $request->semester,
           "group" => $request->group,
           "subject" => $request->subject,
           "exam" => $request->exam,
           "bakylau" => $request->bakylau,
           "course_job" => $request->course_job

       );
       Subject::insert($data);
  
       return redirect()->back()->with('message', 'Енгізілді!');     
    }
    
    public function delete(Request $request){
        Subject::where('id', $request->subject_id)->delete();
        return redirect()->back();
    }

    public function downloadSubjectslist(Request $request)
    {
        $subjects = Subject::where('speciality', $request->speciality)
                            ->get();
        $filename = 'пәндер.csv';
        $handle = fopen('пәндер.csv', 'w+');
        $columns = array('Мамандық', 'Оқуға түскен жылы', 'Семестр', 'Топ', 'Пән атауы', 'Студенттерді бағалау түрі', 'Бақылау жұмысы', 'Курстық жоба');
        fputcsv($handle, $columns);
        foreach ($subjects as $subject){    
            fputcsv($handle, array(
                                $subject->speciality, 
                                $subject->year,
                                $subject->semester,
                                $subject->group,
                                $subject->subject, 
                                $subject->exam,
                                $subject->bakylau, 
                                $subject->course_job
                            )
                    );
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'пәндер.csv', $headers);
    }
   
}
