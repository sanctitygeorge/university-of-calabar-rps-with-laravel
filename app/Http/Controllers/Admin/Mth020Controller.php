<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\Mth020;
use App\User;


class Mth020Controller extends Controller
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
        $mth020 = Mth020::paginate(15);
        return view('admin.mth020.index')->withMth020($mth020);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mth020.create');
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
    
            $mth020 = new Mth020;
            $mth020->lastName = $request->lastName;
            $mth020->otherNames = $request->otherNames;
            $mth020->regNo = $request->regNo;
            $mth020->gender = $request->gender;
            $mth020->state = $request->state;
            $mth020->assessment = $request->assessment;
            $mth020->exam = $request->exam;
            // $mth020->total = $request->total;
            // $mth020->grade = $request->grade;
            // $mth020->point = $request->point;

             $mth020->total = $mth020->assessment + $mth020->exam;

             if ($mth020->total >= 70) {
                 $mth020->grade = 'A';
                 $mth020->point = '5';
             
             }elseif ($mth020->total >= 60) {
                $mth020->grade = 'B';
                 $mth020->point = '4';
             
                 
             }elseif ($mth020->total >= 50) {
                $mth020->grade = 'C';
                 $mth020->point = '3';
             
                 
             }elseif ($mth020->total >= 45) {
                $mth020->grade = 'D';
                 $mth020->point = '2';
             
                 
             }elseif($mth020->total >= 40) {
                $mth020->grade = 'E';
                 $mth020->point = '1';     
             
         }else{
                $mth020->grade = 'F';
                 $mth020->point = '0';     
             }

            $mth020->save();
            return redirect()->route('mth020.index')
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
        $mth020 = Mth020::find($id);
        return view('admin.mth020.show')->withMth020($mth020);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mth020 = Mth020::find($id);

        return view('admin.mth020.edit')->withMth020($mth020); 
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
    
            $mth020 = Mth020::find($id);

            $mth020->lastName = $request->input('lastName');
            $mth020->otherNames = $request->input('otherNames');
            $mth020->regNo = $request->input('regNo');
            $mth020->gender = $request->input('gender');
            $mth020->state = $request->input('state');
            $mth020->assessment = $request->input('assessment');
            $mth020->exam = $request->input('exam');

             $mth020->total = $mth020->assessment + $mth020->exam;

             if ($mth020->total >= 70) {
                 $mth020->grade = 'A';
                 $mth020->point = '5';
             
             }elseif ($mth020->total >= 60) {
                $mth020->grade = 'B';
                 $mth020->point = '4';
             
                 
             }elseif ($mth020->total >= 50) {
                $mth020->grade = 'C';
                 $mth020->point = '3';
             
                 
             }elseif ($mth020->total >= 45) {
                $mth020->grade = 'D';
                 $mth020->point = '2';
             
                 
             }elseif($mth020->total >= 40) {
                $mth020->grade = 'E';
                 $mth020->point = '1';     
             
         }else{
                $mth020->grade = 'F';
                 $mth020->point = '0';     
             }

            $mth020->save();
            return redirect()->route('mth020.index', $mth020->id)
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
        $mth020 = Mth020::find($id);
        $mth020->delete();

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('mth020.index')
        ->with('success_message', ' Result deleted Successfully!!');
    }


    public function truncate()
    {
       DB::table('mth_020')->truncate();
        

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('mth020.index')
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
                    Mth020::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('mth020.index')
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

        $mth020 = Mth020::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->paginate(12);

        // $chm010 = chm010::search($query)->paginate(12);

        return view('admin.mth020.search')->with('mth020', $mth020);
    }

}
