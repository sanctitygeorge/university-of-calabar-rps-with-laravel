<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\Chm010;
use App\User;

class Chm010Controller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $chm010 = DB::table('chm_010')
        // ->join('users', 'chm_010.studentID', '=', 'users.id')
        // ->select('users.reg_no', 'chm_010.*')
        // ->orderBy('grade','asc')
        // ->get();
        $chm010 = Chm010::paginate(15);
        return view('admin.chm010.index')->withChm010($chm010);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.chm010.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'lastName' => 'required|string',
            'otherNames' => 'required|string',
            'regNo' => 'required|string',
            'gender' => 'required|string',
            'state' => 'required|string',
            'assessment' => 'required|integer',
            'exam' => 'required|integer',
            // 'total' => 'required|integer',
            // 'grade' => 'required|string|max:2',
            // 'point' => 'required|integer',
             ));
    
            $chm010 = new Chm010;
            $chm010->lastName = $request->lastName;
            $chm010->otherNames = $request->otherNames;
            $chm010->regNo = $request->regNo;
            $chm010->gender = $request->gender;
            $chm010->state = $request->state;
            $chm010->assessment = $request->assessment;
            $chm010->exam = $request->exam;
            // $chm010->total = $request->total;
            // $chm010->grade = $request->grade;
            // $chm010->point = $request->point;

             $chm010->total = $chm010->assessment + $chm010->exam;

             if ($chm010->total >= 70) {
                 $chm010->grade = 'A';
                 $chm010->point = '5';
             
             }elseif ($chm010->total >= 60) {
                $chm010->grade = 'B';
                 $chm010->point = '4';
             
                 
             }elseif ($chm010->total >= 50) {
                $chm010->grade = 'C';
                 $chm010->point = '3';
             
                 
             }elseif ($chm010->total >= 45) {
                $chm010->grade = 'D';
                 $chm010->point = '2';
             
                 
             }elseif($chm010->total >= 40) {
                $chm010->grade = 'E';
                 $chm010->point = '1';     
             
         }else{
                $chm010->grade = 'F';
                 $chm010->point = '0';     
             }

            $chm010->save();
            return redirect()->route('chm010.index')
            ->with('success_message', 'New Result Added Successfully!!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chm010 = Chm010::find($id);
        return view('admin.chm010.show')->withChm010($chm010);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chm010 = Chm010::find($id);
        // $students = User::all();
        
        // $stud = array();
       
        // foreach($students as $student){

        //     $stud[$student->id] = $student->reg_no;
        // }

        return view('admin.chm010.edit')->withChm010($chm010);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'lastName' => 'required|string',
            'otherNames' => 'required|string',
            'regNo' => 'required|string',
            'gender' => 'required|string',
            'state' => 'required|string',
            'assessment' => 'required|integer',
            'exam' => 'required|integer',
             ));
    
            $chm010 = Chm010::find($id);

            $chm010->lastName = $request->input('lastName');
            $chm010->otherNames = $request->input('otherNames');
            $chm010->regNo = $request->input('regNo');
            $chm010->gender = $request->input('gender');
            $chm010->state = $request->input('state');
            $chm010->assessment = $request->input('assessment');
            $chm010->exam = $request->input('exam');

             $chm010->total = $chm010->assessment + $chm010->exam;

             if ($chm010->total >= 70) {
                 $chm010->grade = 'A';
                 $chm010->point = '5';
             
             }elseif ($chm010->total >= 60) {
                $chm010->grade = 'B';
                 $chm010->point = '4';
             
                 
             }elseif ($chm010->total >= 50) {
                $chm010->grade = 'C';
                 $chm010->point = '3';
             
                 
             }elseif ($chm010->total >= 45) {
                $chm010->grade = 'D';
                 $chm010->point = '2';
             
                 
             }elseif($chm010->total >= 40) {
                $chm010->grade = 'E';
                 $chm010->point = '1';     
             
         }else{
                $chm010->grade = 'F';
                 $chm010->point = '0';     
             }

            $chm010->save();
            return redirect()->route('chm010.index', $chm010->id)
            ->with('success_message', ' Result Updated Successfully!!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chm010 = Chm010::find($id);
        $chm010->delete();

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('chm010.index')
        ->with('success_message', ' Result deleted Successfully!!');
    }

    public function truncate()
    {
       DB::table('chm_010')->truncate();
        

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('chm010.index')
        ->with('success_message', ' Results deleted Successfully!!');
    }



public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ], [
            'file.required' => "Enter a file to upload!",
        ]);

        if ($request->hasFile('file')) {
            $extension = File::extension($request->file->getClientOriginalName());

            if ($extension == "xlsx" || $extension == "xls") {

                $path = $request->file->getRealPath();

                //  Load on file excel
                
                // $data = Excel::load($path, function($reader) {
                $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader){
                    Chm010::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('chm010.index')
                ->with('success_message', 'Result(s) uploaded successfully!');
            }

            return back()->with('error_message', 'Error: invalid uploaded file! Enter the xlsx or xls files');
        }
    }



    //Perform Search on Result table
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);

        $query = $request->input('query');

        $chm010 = Chm010::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->paginate(12);

        // $chm010 = chm010::search($query)->paginate(12);

        return view('admin.chm010.search')->with('chm010', $chm010);
    }



}


    