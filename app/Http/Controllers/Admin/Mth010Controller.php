<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\Mth010;
use App\User;


class Mth010Controller extends Controller
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
        $mth010 = Mth010::paginate(15);
        return view('admin.mth010.index')->withMth010($mth010);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.mth010.create');
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
    
            $mth010 = new Mth010;
            $mth010->lastName = $request->lastName;
            $mth010->otherNames = $request->otherNames;
            $mth010->regNo = $request->regNo;
            $mth010->gender = $request->gender;
            $mth010->state = $request->state;
            $mth010->assessment = $request->assessment;
            $mth010->exam = $request->exam;
            // $mth010->total = $request->total;
            // $mth010->grade = $request->grade;
            // $mth010->point = $request->point;

             $mth010->total = $mth010->assessment + $mth010->exam;

             if ($mth010->total >= 70) {
                 $mth010->grade = 'A';
                 $mth010->point = '5';
             
             }elseif ($mth010->total >= 60) {
                $mth010->grade = 'B';
                 $mth010->point = '4';
             
                 
             }elseif ($mth010->total >= 50) {
                $mth010->grade = 'C';
                 $mth010->point = '3';
             
                 
             }elseif ($mth010->total >= 45) {
                $mth010->grade = 'D';
                 $mth010->point = '2';
             
                 
             }elseif($mth010->total >= 40) {
                $mth010->grade = 'E';
                 $mth010->point = '1';     
             
         }else{
                $mth010->grade = 'F';
                 $mth010->point = '0';     
             }

            $mth010->save();
            return redirect()->route('mth010.index')
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
        $mth010 = Mth010::find($id);
        return view('admin.mth010.show')->withMth010($mth010);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mth010 = Mth010::find($id);
        return view('admin.mth010.edit')->withMth010($mth010); 
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
    
            $mth010 = Mth010::find($id);

            $mth010->lastName = $request->input('lastName');
            $mth010->otherNames = $request->input('otherNames');
            $mth010->regNo = $request->input('regNo');
            $mth010->gender = $request->input('gender');
            $mth010->state = $request->input('state');
            $mth010->assessment = $request->input('assessment');
            $mth010->exam = $request->input('exam');

             $mth010->total = $mth010->assessment + $mth010->exam;

             if ($mth010->total >= 70) {
                 $mth010->grade = 'A';
                 $mth010->point = '5';
             
             }elseif ($mth010->total >= 60) {
                $mth010->grade = 'B';
                 $mth010->point = '4';
             
                 
             }elseif ($mth010->total >= 50) {
                $mth010->grade = 'C';
                 $mth010->point = '3';
             
                 
             }elseif ($mth010->total >= 45) {
                $mth010->grade = 'D';
                 $mth010->point = '2';
             
                 
             }elseif($mth010->total >= 40) {
                $mth010->grade = 'E';
                 $mth010->point = '1';     
             
         }else{
                $mth010->grade = 'F';
                 $mth010->point = '0';     
             }

            $mth010->save();
            return redirect()->route('mth010.index', $mth010->id)
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
        $mth010 = mth010::find($id);
        $mth010->delete();

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('mth010.index')
        ->with('success_message', ' Result deleted Successfully!!');
    }

    public function truncate()
    {
       DB::table('mth_010')->truncate();
        

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('mth010.index')
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
                    Mth010::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('mth010.index')
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

        $mth010 = Mth010::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->paginate(12);

        // $chm010 = chm010::search($query)->paginate(12);

        return view('admin.mth010.search')->with('mth010', $mth010);
    }

}
