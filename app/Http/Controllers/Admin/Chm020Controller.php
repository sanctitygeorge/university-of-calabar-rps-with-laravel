<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\Chm020;
use App\User;

class Chm020Controller extends Controller
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
        $chm020 = Chm020::paginate(15);
        return view('admin.chm020.index')->withChm020($chm020);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('admin.chm020.create');
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
    
            $chm020 = new Chm020;
            $chm020->lastName = $request->lastName;
            $chm020->otherNames = $request->otherNames;
            $chm020->regNo = $request->regNo;
            $chm020->gender = $request->gender;
            $chm020->state = $request->state;
            $chm020->assessment = $request->assessment;
            $chm020->exam = $request->exam;
            // $chm020->total = $request->total;
            // $chm020->grade = $request->grade;
            // $chm020->point = $request->point;

             $chm020->total = $chm020->assessment + $chm020->exam;

             if ($chm020->total >= 70) {
                 $chm020->grade = 'A';
                 $chm020->point = '5';
             
             }elseif ($chm020->total >= 60) {
                $chm020->grade = 'B';
                 $chm020->point = '4';
             
                 
             }elseif ($chm020->total >= 50) {
                $chm020->grade = 'C';
                 $chm020->point = '3';
             
                 
             }elseif ($chm020->total >= 45) {
                $chm020->grade = 'D';
                 $chm020->point = '2';
             
                 
             }elseif($chm020->total >= 40) {
                $chm020->grade = 'E';
                 $chm020->point = '1';     
             
         }else{
                $chm020->grade = 'F';
                 $chm020->point = '0';     
             }

            $chm020->save();
            return redirect()->route('chm020.index')
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
        $chm020 = Chm020::find($id);
        return view('admin.chm020.show')->withChm020($chm020);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chm020 = Chm020::find($id);
        // $students = User::all();
        

        return view('admin.chm020.edit')->withChm020($chm020);
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
    
            $chm020 = Chm020::find($id);

            $chm020->lastName = $request->input('lastName');
            $chm020->otherNames = $request->input('otherNames');
            $chm020->regNo = $request->input('regNo');
            $chm020->gender = $request->input('gender');
            $chm020->state = $request->input('state');
            $chm020->assessment = $request->input('assessment');
            $chm020->exam = $request->input('exam');

             $chm020->total = $chm020->assessment + $chm020->exam;

             if ($chm020->total >= 70) {
                 $chm020->grade = 'A';
                 $chm020->point = '5';
             
             }elseif ($chm020->total >= 60) {
                $chm020->grade = 'B';
                 $chm020->point = '4';
             
                 
             }elseif ($chm020->total >= 50) {
                $chm020->grade = 'C';
                 $chm020->point = '3';
             
                 
             }elseif ($chm020->total >= 45) {
                $chm020->grade = 'D';
                 $chm020->point = '2';
             
                 
             }elseif($chm020->total >= 40) {
                $chm020->grade = 'E';
                 $chm020->point = '1';     
             
         }else{
                $chm020->grade = 'F';
                 $chm020->point = '0';     
             }

            $chm020->save();
            return redirect()->route('chm020.index', $chm020->id)
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
        $chm020 = Chm020::find($id);
        $chm020->delete();

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('chm020.index')
        ->with('success_message', ' Result deleted Successfully!!');
    }

    public function truncate()
    {
       DB::table('chm_020')->truncate();
        

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('chm020.index')
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
                    Chm020::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('chm020.index')
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

        $chm020 = Chm020::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->paginate(12);

        // $chm010 = chm010::search($query)->paginate(12);

        return view('admin.chm020.search')->with('chm020', $chm020);
    }


}
