<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\Bio010;
use App\User;

class Bio010Controller extends Controller
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
    
        $bio010 = Bio010::paginate(15);
        return view('admin.bio010.index')->withBio010($bio010);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('admin.bio010.create');
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
             ));
    
            $bio010 = new Bio010;
            $bio010->lastName = $request->lastName;
            $bio010->otherNames = $request->otherNames;
            $bio010->regNo = $request->regNo;
            $bio010->gender = $request->gender;
            $bio010->state = $request->state;
            $bio010->assessment = $request->assessment;
            $bio010->exam = $request->exam;

             $bio010->total = $bio010->assessment + $bio010->exam;

             if ($bio010->total >= 70) {
                 $bio010->grade = 'A';
                 $bio010->point = '5';
             
             }elseif ($bio010->total >= 60) {
                $bio010->grade = 'B';
                 $bio010->point = '4';
             
                 
             }elseif ($bio010->total >= 50) {
                $bio010->grade = 'C';
                 $bio010->point = '3';
             
                 
             }elseif ($bio010->total >= 45) {
                $bio010->grade = 'D';
                 $bio010->point = '2';
             
                 
             }elseif($bio010->total >= 40) {
                $bio010->grade = 'E';
                 $bio010->point = '1';     
             
         }else{
                $bio010->grade = 'F';
                 $bio010->point = '0';     
             }

            $bio010->save();
            return redirect()->route('bio010.index')
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
        $bio010 = Bio010::find($id);
        return view('admin.bio010.show')->withBio010($bio010);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bio010 = Bio010::find($id);
        // $students = User::all();
        
        // $stud = array();
       
        // foreach($students as $student){

        //     $stud[$student->id] = $student->reg_no;
        // }

        return view('admin.bio010.edit')->withBio010($bio010);

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
            // 'courseCode' => 'required|string',
            // 'courseTitle' => 'required|string',
            // 'studentID' => 'required|integer',
            'assessment' => 'required|integer',
            'exam' => 'required|integer',
             ));
    
            $bio010 = Bio010::find($id);
            $bio010->lastName = $request->input('lastName');
            $bio010->otherNames = $request->input('otherNames');
            $bio010->regNo = $request->input('regNo');
            $bio010->gender = $request->input('gender');
            $bio010->state = $request->input('state');
            $bio010->assessment = $request->input('assessment');
            $bio010->exam = $request->input('exam');

             $bio010->total = $bio010->assessment + $bio010->exam;

             if ($bio010->total >= 70) {
                 $bio010->grade = 'A';
                 $bio010->point = '5';
             
             }elseif ($bio010->total >= 60) {
                $bio010->grade = 'B';
                 $bio010->point = '4';
             
                 
             }elseif ($bio010->total >= 50) {
                $bio010->grade = 'C';
                 $bio010->point = '3';
             
                 
             }elseif ($bio010->total >= 45) {
                $bio010->grade = 'D';
                 $bio010->point = '2';
             
                 
             }elseif($bio010->total >= 40) {
                $bio010->grade = 'E';
                 $bio010->point = '1';     
             
         }else{
                $bio010->grade = 'F';
                 $bio010->point = '0';     
             }

            $bio010->save();
            return redirect()->route('bio010.index', $bio010->id)
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
        $bio010 = Bio010::find($id);
        $bio010->delete();

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('bio010.index')
        ->with('success_message', ' Result deleted Successfully!!');
    }

    public function truncate()
    {
       DB::table('bio_010')->truncate();
        

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('bio010.index')
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
                    Bio010::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('bio010.index')
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

        $bio010 = Bio010::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->paginate(12);

        // $bio010 = bio010::search($query)->paginate(12);

        return view('admin.bio010.search')->with('bio010', $bio010);
    }


}
