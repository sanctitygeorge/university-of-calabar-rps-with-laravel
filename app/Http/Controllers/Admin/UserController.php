<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;
use Input;
use File;
use App\User;
use Session;


class UserController extends Controller
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
        $students = User::paginate(15);
        return view('admin.students.index')->withStudents($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.students.create');
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
                'otherNames' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'regNo' => 'required|string|max:255|unique:users',
                'phone' => 'required|string|max:255',
                'gender' => 'required|string|',
                'state' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                 ));
        
                $student = new User;
                $student->otherNames = $request->otherNames;
                $student->lastName  = $request->lastName;
                $student->regNo    = $request->regNo;
                $student->phone   = $request->phone;
                $student->gender    = $request->gender;
                $student->state     = $request->state;
                $student->email     = $request->email;
                $student->password  =bcrypt($request['password']);
               
                $student->save();
        
                // Session::flash('success', 'New Student Added Successfully!');
                return redirect()->route('students.index')
                ->with('success_message', 'New Student Added Successfully!!');     
        }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = User::find($id);
        return view('admin.students.show')->withStudent($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = User::find($id);
        return view('admin.students.edit')->withStudent($student);
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
            'otherNames' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'regNo' => 'required|string|max:255',
            'phone' => 'required|string|',
            'gender' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
         ));

         $student = User::find($id);
        $student->otherNames = $request->input('otherNames');
        $student->lastName  = $request->input('lastName');
        $student->regNo    = $request->input('regNo');
        $student->phone   = $request->input('phone');
        $student->gender    = $request->input('gender');
        $student->state     = $request->input('state');
        $student->email     = $request->input('email');
       
        $student->save();

        
        return redirect()->route('students.index',$student->id)
        ->with('success_message', 'Student Record Updated Successfully!!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = User::find($id);
        $student->delete();

        return redirect()->route('students.index')
        ->with('success_message', 'Student Record Deleted Successfully!!');
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
                    User::insert($reader->toArray());
                })->get();

                // Load multi file excel
                // $data1 = Excel::selectSheets('Sheet1')->load($path, function($reader) {
                //    Book::insert($reader->toArray());
                // })->get();

                return redirect()->route('students.index')
                ->with('success_message', 'Details uploaded successfully!');
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

        $students = User::where('lastName', 'like', "%$query")
                           ->orWhere('regNo', '=', "$query")
                           ->orWhere('email', 'like', "%$query")
                           ->paginate(12);

        // $students = students::search($query)->paginate(12);

        return view('admin.students.search')->with('students', $students);
    }

}
