<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\Eng020;
use App\User;

class Eng020Controller extends Controller
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
    
        $eng020 = Eng020::paginate(15);
        return view('admin.eng020.index')->withEng020($eng020);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.eng020.create');
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
    
            $eng020 = new Eng020;
            $eng020->lastName = $request->lastName;
            $eng020->otherNames = $request->otherNames;
            $eng020->regNo = $request->regNo;
            $eng020->gender = $request->gender;
            $eng020->state = $request->state;
            $eng020->assessment = $request->assessment;
            $eng020->exam = $request->exam;
            // $eng020->total = $request->total;
            // $eng020->grade = $request->grade;
            // $eng020->point = $request->point;

             $eng020->total = $eng020->assessment + $eng020->exam;

             if ($eng020->total >= 70) {
                 $eng020->grade = 'A';
                 $eng020->point = '5';
             
             }elseif ($eng020->total >= 60) {
                $eng020->grade = 'B';
                 $eng020->point = '4';
             
                 
             }elseif ($eng020->total >= 50) {
                $eng020->grade = 'C';
                 $eng020->point = '3';
             
                 
             }elseif ($eng020->total >= 45) {
                $eng020->grade = 'D';
                 $eng020->point = '2';
             
                 
             }elseif($eng020->total >= 40) {
                $eng020->grade = 'E';
                 $eng020->point = '1';     
             
         }else{
                $eng020->grade = 'F';
                 $eng020->point = '0';     
             }

            $eng020->save();
            return redirect()->route('eng020.index')
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
        $eng020 = Eng020::find($id);
        return view('admin.eng020.show')->withEng020($eng020);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eng020 = Eng020::find($id);

        return view('admin.eng020.edit')->withEng020($eng020);

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
    
            $eng020 = Eng020::find($id);

            $eng020->lastName = $request->input('lastName');
            $eng020->otherNames = $request->input('otherNames');
            $eng020->regNo = $request->input('regNo');
            $eng020->gender = $request->input('gender');
            $eng020->state = $request->input('state');
            $eng020->assessment = $request->input('assessment');
            $eng020->exam = $request->input('exam');

             $eng020->total = $eng020->assessment + $eng020->exam;

             if ($eng020->total >= 70) {
                 $eng020->grade = 'A';
                 $eng020->point = '5';
             
             }elseif ($eng020->total >= 60) {
                $eng020->grade = 'B';
                 $eng020->point = '4';
             
                 
             }elseif ($eng020->total >= 50) {
                $eng020->grade = 'C';
                 $eng020->point = '3';
             
                 
             }elseif ($eng020->total >= 45) {
                $eng020->grade = 'D';
                 $eng020->point = '2';
             
                 
             }elseif($eng020->total >= 40) {
                $eng020->grade = 'E';
                 $eng020->point = '1';     
             
         }else{
                $eng020->grade = 'F';
                 $eng020->point = '0';     
             }

            $eng020->save();
            return redirect()->route('eng020.index', $eng020->id)
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
        $eng020 = Eng020::find($id);
        $eng020->delete();

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('eng020.index')
        ->with('success_message', ' Result deleted Successfully!!');
    }


    public function truncate()
    {
       DB::table('eng_020')->truncate();
        

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('eng020.index')
        ->with('success_message', ' Results deleted Successfully!!');
    }

    //import results

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
                    Eng020::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('eng020.index')
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

        $eng020 = Eng020::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->paginate(12);

        // $chm010 = chm010::search($query)->paginate(12);

        return view('admin.eng020.search')->with('eng020', $eng020);
    }

}
