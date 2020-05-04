<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\Bio020;
use App\User;


class Bio020Controller extends Controller
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
       $bio020 = Bio020::paginate(15);
        return view('admin.bio020.index')->withBio020($bio020);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.bio020.create');
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
    
            $bio020 = new Bio020;
            $bio020->lastName = $request->lastName;
            $bio020->otherNames = $request->otherNames;
            $bio020->regNo = $request->regNo;
            $bio020->gender = $request->gender;
            $bio020->state = $request->state;
            $bio020->assessment = $request->assessment;
            $bio020->exam = $request->exam;
            // $bio020->total = $request->total;
            // $bio020->grade = $request->grade;
            // $bio020->point = $request->point;

             $bio020->total = $bio020->assessment + $bio020->exam;

             if ($bio020->total >= 70) {
                 $bio020->grade = 'A';
                 $bio020->point = '5';
             
             }elseif ($bio020->total >= 60) {
                $bio020->grade = 'B';
                 $bio020->point = '4';
             
                 
             }elseif ($bio020->total >= 50) {
                $bio020->grade = 'C';
                 $bio020->point = '3';
             
                 
             }elseif ($bio020->total >= 45) {
                $bio020->grade = 'D';
                 $bio020->point = '2';
             
                 
             }elseif($bio020->total >= 40) {
                $bio020->grade = 'E';
                 $bio020->point = '1';     
             
         }else{
                $bio020->grade = 'F';
                 $bio020->point = '0';     
             }

            $bio020->save();
            return redirect()->route('bio020.index')
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
        $bio020 = Bio020::find($id);
        return view('admin.bio020.show')->withBio020($bio020);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bio020 = Bio020::find($id);
        

        return view('admin.bio020.edit')->withBio020($bio020);

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
    
            $bio020 = Bio020::find($id);

            $bio020->lastName = $request->input('lastName');
            $bio020->otherNames = $request->input('otherNames');
            $bio020->regNo = $request->input('regNo');
            $bio020->gender = $request->input('gender');
            $bio020->state = $request->input('state');
            $bio020->assessment = $request->input('assessment');
            $bio020->exam = $request->input('exam');

             $bio020->total = $bio020->assessment + $bio020->exam;

             if ($bio020->total >= 70) {
                 $bio020->grade = 'A';
                 $bio020->point = '5';
             
             }elseif ($bio020->total >= 60) {
                $bio020->grade = 'B';
                 $bio020->point = '4';
             
                 
             }elseif ($bio020->total >= 50) {
                $bio020->grade = 'C';
                 $bio020->point = '3';
             
                 
             }elseif ($bio020->total >= 45) {
                $bio020->grade = 'D';
                 $bio020->point = '2';
             
                 
             }elseif($bio020->total >= 40) {
                $bio020->grade = 'E';
                 $bio020->point = '1';     
             
         }else{
                $bio020->grade = 'F';
                 $bio020->point = '0';     
             }

            $bio020->save();
            return redirect()->route('bio020.index', $bio020->id)
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
        $bio020 = bio020::find($id);
        $bio020->delete();

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('bio020.index')
        ->with('success_message', ' Result deleted Successfully!!');
    }

    public function truncate()
    {
       DB::table('bio_020')->truncate();
        

        // Session::flash('success', 'Result Deleted Successfully!');
        return redirect()->route('bio020.index')
        ->with('success_message', ' Results deleted Successfully!!');
    }

//RESULTS IMPORT
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
                    Bio020::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('bio020.index')
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

        $bio020 = Bio020::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->paginate(12);

        // $bio020 = bio020::search($query)->paginate(12);

        return view('admin.bio020.search')->with('bio020', $bio020);
    }

}
