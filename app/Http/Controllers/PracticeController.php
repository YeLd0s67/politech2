<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Practice;
use App\Teacher;
use App\Subject;
use App\Prof;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Http\Response;

class PracticeController extends Controller
{
    public function view(){
        $practices = Practice::all();
        $profs = Prof::all();
        return view('practice', [
            'practices' => $practices,
            'profs' => $profs
        ]);
    }

    public function insert(){
        $profs = Prof::all();
        return view('practice_insert', [
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
          'practice' => 'required',
          'practice_type' => 'required',
          'advisor' => 'required'

       ]); 

       $data = array(
           "speciality" => $request->speciality,
           "year" => $request->year,
           "semester" => $request->semester,
           "group" => $request->group,
           "practice" => $request->practice,
           "practice_type" => $request->practice_type,
           "advisor" => $request->advisor

       );
       Practice::insert($data);
  
       return redirect()->back()->with('message', 'Енгізілді!');     
    }
    
    public function delete(Request $request){
        Practice::where('id', $request->practice_id)->delete();
        return redirect()->back();
    }

    public function downloadPraticelist(Request $request)
    {
        $subjects = Practice::where('speciality', $request->speciality)
                            ->get();
        $filename = 'пәндер.csv';
        $handle = fopen('пәндер.csv', 'w+');
        $columns = array('Мамандық', 'Оқуға түскен жылы', 'Семестр', 'Топ', 'Практика атауы', 'Практика түрі', 'Жетекшінің Аты-жөні');
        fputcsv($handle, $columns);
        foreach ($subjects as $subject){    
            fputcsv($handle, array(
                                $subject->speciality, 
                                $subject->year,
                                $subject->semester,
                                $subject->group,
                                $subject->practice, 
                                $subject->practice_type, 
                                $subject->advisor
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
