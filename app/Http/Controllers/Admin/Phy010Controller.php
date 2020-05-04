<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\Phy010;
use App\User;


class Phy010Controller extends Controller
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
        $phy010 = Phy010::paginate(15);
        return view('admin.phy010.index')->withPhy010($phy010);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.phy010.create');
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
    
            $phy010 = new Phy010;
            $phy010->lastName = $request->lastName;
            $phy010->otherNames = $request->otherNames;
            $phy010->regNo = $request->regNo;
            $phy010->gender = $request->gender;
            $phy010->state = $request->state;
            $phy010->assessment = $request->assessment;
            $phy010->exam = $request->exam;
            // $phy010->total = $request->total;
            // $phy010->grade = $request->grade;
            // $phy010->point = $request->point;

             $phy010->total = $phy010->assessment + $phy010->exam;

             if ($phy010->total >= 70) {
                 $phy010->grade = 'A';
                 $phy010->point = '5';
             
             }elseif ($phy010->total >= 60) {
                $phy010->grade = 'B';
                 $phy010->point = '4';
             
                 
             }elseif ($phy010->total >= 50) {
                $phy010->grade = 'C';
                 $phy010->point = '3';
             
                 
             }elseif ($phy010->total >= 45) {
                $phy010->grade = 'D';
                 $phy010->point = '2';
             
                 
             }elseif($phy010->total >= 40) {
                $phy010->grade = 'E';
                 $phy010->point = '1';     
             
         }else{
                $phy010->grade = 'F';
                 $phy010->point = '0';     
             }

            $phy010->save();
            return redirect()->route('phy010.index')
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
        $phy010 = Phy010::find($id);
        return view('admin.phy010.show')->withPhy010($phy010);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phy010 = Phy010::find($id);

        return view('admin.phy010.edit')->withPhy010($phy010);
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
    
            $phy010 = Phy010::find($id);

            $phy010->lastName = $request->input('lastName');
            $phy010->otherNames = $request->input('otherNames');
            $phy010->regNo = $request->input('regNo');
            $phy010->gender = $request->input('gender');
            $phy010->state = $request->input('state');
            $phy010->assessment = $request->input('assessment');
            $phy010->exam = $request->input('exam');

             $phy010->total = $phy010->assessment + $phy010->exam;

             if ($phy010->total >= 70) {
                 $phy010->grade = 'A';
                 $phy010->point = '5';
             
             }elseif ($phy010->total >= 60) {
                $phy010->grade = 'B';
                 $phy010->point = '4';
             
                 
             }elseif ($phy010->total >= 50) {
                $phy010->grade = 'C';
                 $phy010->point = '3';
             
                 
             }elseif ($phy010->total >= 45) {
                $phy010->grade = 'D';
                 $phy010->point = '2';
             
                 
             }elseif($phy010->total >= 40) {
                $phy010->grade = 'E';
                 $phy010->point = '1';     
             
         }else{
                $phy010->grade = 'F';
                 $phy010->point = '0';     
             }

            $phy010->save();
            return redirect()->route('phy010.index', $phy010->id)
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
        $phy010 = Phy010::find($id);
        $phy010->delete();

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('phy010.index')
        ->with('success_message', ' Result deleted Successfully!!');
    }

    public function truncate()
    {
       DB::table('phy_010')->truncate();
        

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('phy010.index')
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
                    Phy010::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('phy010.index')
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

        $phy010 = Phy010::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->paginate(12);

        // $chm010 = chm010::search($query)->paginate(12);

        return view('admin.phy010.search')->with('phy010', $phy010);
    }
}
