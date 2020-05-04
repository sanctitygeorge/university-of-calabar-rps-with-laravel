<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\Phy020;
use App\User;


class Phy020Controller extends Controller
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
        $phy020 = Phy020::paginate(15);
        return view('admin.phy020.index')->withPhy020($phy020);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.phy020.create');
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
    
            $phy020 = new Phy020;
            $phy020->lastName = $request->lastName;
            $phy020->otherNames = $request->otherNames;
            $phy020->regNo = $request->regNo;
            $phy020->gender = $request->gender;
            $phy020->state = $request->state;
            $phy020->assessment = $request->assessment;
            $phy020->exam = $request->exam;
            // $phy020->total = $request->total;
            // $phy020->grade = $request->grade;
            // $phy020->point = $request->point;

             $phy020->total = $phy020->assessment + $phy020->exam;

             if ($phy020->total >= 70) {
                 $phy020->grade = 'A';
                 $phy020->point = '5';
             
             }elseif ($phy020->total >= 60) {
                $phy020->grade = 'B';
                 $phy020->point = '4';
             
                 
             }elseif ($phy020->total >= 50) {
                $phy020->grade = 'C';
                 $phy020->point = '3';
             
                 
             }elseif ($phy020->total >= 45) {
                $phy020->grade = 'D';
                 $phy020->point = '2';
             
                 
             }elseif($phy020->total >= 40) {
                $phy020->grade = 'E';
                 $phy020->point = '1';     
             
         }else{
                $phy020->grade = 'F';
                 $phy020->point = '0';     
             }

            $phy020->save();
            return redirect()->route('phy020.index')
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
        $phy020 = Phy020::find($id);
        return view('admin.phy020.show')->withPhy020($phy020);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phy020 = Phy020::find($id);
        return view('admin.phy020.edit')->withPhy020($phy020);
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
    
            $phy020 = phy020::find($id);

            $phy020->lastName = $request->input('lastName');
            $phy020->otherNames = $request->input('otherNames');
            $phy020->regNo = $request->input('regNo');
            $phy020->gender = $request->input('gender');
            $phy020->state = $request->input('state');
            $phy020->assessment = $request->input('assessment');
            $phy020->exam = $request->input('exam');

             $phy020->total = $phy020->assessment + $phy020->exam;

             if ($phy020->total >= 70) {
                 $phy020->grade = 'A';
                 $phy020->point = '5';
             
             }elseif ($phy020->total >= 60) {
                $phy020->grade = 'B';
                 $phy020->point = '4';
             
                 
             }elseif ($phy020->total >= 50) {
                $phy020->grade = 'C';
                 $phy020->point = '3';
             
                 
             }elseif ($phy020->total >= 45) {
                $phy020->grade = 'D';
                 $phy020->point = '2';
             
                 
             }elseif($phy020->total >= 40) {
                $phy020->grade = 'E';
                 $phy020->point = '1';     
             
         }else{
                $phy020->grade = 'F';
                 $phy020->point = '0';     
             }

            $phy020->save();
            return redirect()->route('phy020.index', $phy020->id)
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
        $phy020 = Phy020::find($id);
        $phy020->delete();

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('phy020.index')
        ->with('success_message', ' Result deleted Successfully!!');
    }

    public function truncate()
    {
       DB::table('phy_020')->truncate();
        

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('phy020.index')
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
                    Phy020::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('phy020.index')
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

        $phy020 = Phy020::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->paginate(12);

        // $chm010 = chm010::search($query)->paginate(12);

        return view('admin.phy020.search')->with('phy020', $phy020);
    }
}
