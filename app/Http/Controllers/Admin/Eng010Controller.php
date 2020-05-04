<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\Eng010;
use App\User;

class Eng010Controller extends Controller
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
        $eng010 = Eng010::paginate(15);
        return view('admin.eng010.index')->withEng010($eng010);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eng010.create');
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
    
            $eng010 = new Eng010;
            $eng010->lastName = $request->lastName;
            $eng010->otherNames = $request->otherNames;
            $eng010->regNo = $request->regNo;
            $eng010->gender = $request->gender;
            $eng010->state = $request->state;
            $eng010->assessment = $request->assessment;
            $eng010->exam = $request->exam;
            // $eng010->total = $request->total;
            // $eng010->grade = $request->grade;
            // $eng010->point = $request->point;

             $eng010->total = $eng010->assessment + $eng010->exam;

             if ($eng010->total >= 70) {
                 $eng010->grade = 'A';
                 $eng010->point = '5';
             
             }elseif ($eng010->total >= 60) {
                $eng010->grade = 'B';
                 $eng010->point = '4';
             
                 
             }elseif ($eng010->total >= 50) {
                $eng010->grade = 'C';
                 $eng010->point = '3';
             
                 
             }elseif ($eng010->total >= 45) {
                $eng010->grade = 'D';
                 $eng010->point = '2';
             
                 
             }elseif($eng010->total >= 40) {
                $eng010->grade = 'E';
                 $eng010->point = '1';     
             
         }else{
                $eng010->grade = 'F';
                 $eng010->point = '0';     
             }

            $eng010->save();
            return redirect()->route('eng010.index')
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
        $eng010 = Eng010::find($id);
        return view('admin.eng010.show')->withEng010($eng010);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eng010 = Eng010::find($id);
        
        return view('admin.eng010.edit')->withEng010($eng010);

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
    
            $eng010 = Eng010::find($id);

            $eng010->lastName = $request->input('lastName');
            $eng010->otherNames = $request->input('otherNames');
            $eng010->regNo = $request->input('regNo');
            $eng010->gender = $request->input('gender');
            $eng010->state = $request->input('state');
            $eng010->assessment = $request->input('assessment');
            $eng010->exam = $request->input('exam');

             $eng010->total = $eng010->assessment + $eng010->exam;

             if ($eng010->total >= 70) {
                 $eng010->grade = 'A';
                 $eng010->point = '5';
             
             }elseif ($eng010->total >= 60) {
                $eng010->grade = 'B';
                 $eng010->point = '4';
             
                 
             }elseif ($eng010->total >= 50) {
                $eng010->grade = 'C';
                 $eng010->point = '3';
             
                 
             }elseif ($eng010->total >= 45) {
                $eng010->grade = 'D';
                 $eng010->point = '2';
             
                 
             }elseif($eng010->total >= 40) {
                $eng010->grade = 'E';
                 $eng010->point = '1';     
             
         }else{
                $eng010->grade = 'F';
                 $eng010->point = '0';     
             }

            $eng010->save();
            return redirect()->route('eng010.index', $eng010->id)
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
        $eng010 = Eng010::find($id);
        $eng010->delete();

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('eng010.index')
        ->with('success_message', ' Result deleted Successfully!!');
    }

    public function truncate()
    {
       DB::table('eng_010')->truncate();
        

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('eng010.index')
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
                    Eng010::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('eng010.index')
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

        $eng010 = Eng010::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->paginate(12);

        // $eng010 = Eng010::search($query)->paginate(12);

        return view('admin.eng010.search')->with('eng010', $eng010);
    }


}
