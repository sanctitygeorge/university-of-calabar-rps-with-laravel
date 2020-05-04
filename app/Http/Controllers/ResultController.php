<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Bio010;
use App\Mth010;
use App\Chm010;
use App\Eng010;
use App\Phy010;
use App\User;

class ResultController extends Controller
{
    
        public function index()
        {
            $student = Auth::user();
            $student_reg = Auth::user()->regNo;


            $eng010 = DB::table('eng_010')
                    ->select(DB::raw('"Eng010" AS courseCode,"Predegree English 1" AS courseTitle, eng_010.*'))
                    ->where('eng_010.regNo' , $student_reg);
              
            $mth010 = DB::table('mth_010')
                    ->select(DB::raw('"MTH010" AS coursecode,"Predegree Mathematics 1" AS courseTitle, mth_010.*'))
                    ->where('mth_010.regNo' , $student_reg);
            
            $chm010 = DB::table('chm_010')
                    ->select(DB::raw('"CHM010" AS courseCode,"Predegree Chemistry 1" AS courseTitle, chm_010.*'))
                    ->where('chm_010.regNo' , $student_reg);
            
            $bio010 = DB::table('bio_010')
                    ->select(DB::raw('"BIO010" AS courseCode,"Predegree Biology 1" AS courseTitle, bio_010.*'))
                    ->where('bio_010.regNo' , $student_reg);
            

            $firstSemester = DB::table('phy_010')
                    ->select(DB::raw('"PHY010" AS courseCode,"Predegree Physics 1" AS courseTitle, phy_010.*'))
                    ->where('phy_010.regNo' , $student_reg)
                    ->union($bio010)
                    ->union($mth010)
                    ->union($chm010)
                    ->union($eng010)
                    ->get();

            $eng020 = DB::table('eng_020')
                    ->select(DB::raw('"Eng020" AS courseCode,"Predegree English 2" AS courseTitle, eng_020.*'))
                    ->where('eng_020.regNo' , $student_reg);

            $mth020 = DB::table('mth_020')
                    ->select(DB::raw('"MTH020" AS coursecode,"Predegree Mathematics 2" AS courseTitle, mth_020.*'))
                    ->where('mth_020.regNo' , $student_reg);

            $chm020 = DB::table('chm_020')
                    ->select(DB::raw('"CHM020" AS courseCode,"Predegree Chemistry 2" AS courseTitle, chm_020.*'))
                    ->where('chm_020.regNo' , $student_reg);

            $bio020 = DB::table('bio_020')
                    ->select(DB::raw('"BIO010" AS courseCode,"Predegree Biology 2" AS courseTitle, bio_020.*'))
                    ->where('bio_020.regNo' , $student_reg);

            $secondSemester = DB::table('phy_020')
                    ->select(DB::raw('"PHY020" AS courseCode,"Predegree Physics 2" AS courseTitle, phy_020.*'))
                    ->where('phy_020.regNo' , $student_reg)
                    ->union($bio020)
                    ->union($mth020)
                    ->union($chm020)
                    ->union($eng020)
                    ->get();

                    return view('results.myResults')->withStudent($student)
                    ->withFirstSemester($firstSemester)->withSecondSemester($secondSemester);
        }



        public function firstSemester()
        {
            $student = Auth::user();
            $student_reg = Auth::user()->regNo;


            $eng010 = DB::table('eng_010')
                    ->select(DB::raw('"Eng010" AS courseCode,"Predegree English 1" AS courseTitle, eng_010.*'))
                    ->where('eng_010.regNo' , $student_reg);
              
            $mth010 = DB::table('mth_010')
                    ->select(DB::raw('"MTH010" AS coursecode,"Predegree Mathematics 1" AS courseTitle, mth_010.*'))
                    ->where('mth_010.regNo' , $student_reg);
            
            $chm010 = DB::table('chm_010')
                    ->select(DB::raw('"CHM010" AS courseCode,"Predegree Chemistry 1" AS courseTitle, chm_010.*'))
                    ->where('chm_010.regNo' , $student_reg);
            
            $bio010 = DB::table('bio_010')
                    ->select(DB::raw('"BIO010" AS courseCode,"Predegree Biology 1" AS courseTitle, bio_010.*'))
                    ->where('bio_010.regNo' , $student_reg);
            

            $results = DB::table('phy_010')
                    ->select(DB::raw('"PHY010" AS courseCode,"Predegree Physics 1" AS courseTitle, phy_010.*'))
                    ->where('phy_010.regNo' , $student_reg)
                    ->union($bio010)
                    ->union($mth010)
                    ->union($chm010)
                    ->union($eng010)
                    ->get();

            return view('results.first')->withStudent($student)->withResults($results);
        }


        public function secondSemester()
        {
            $student = Auth::user();
            $student_reg = Auth::user()->regNo;

            $eng020 = DB::table('eng_020')
                    ->select(DB::raw('"Eng020" AS courseCode,"Predegree English 2" AS courseTitle, eng_020.*'))
                    ->where('eng_020.regNo' , $student_reg);

            $mth020 = DB::table('mth_020')
                    ->select(DB::raw('"MTH020" AS coursecode,"Predegree Mathematics 2" AS courseTitle, mth_020.*'))
                    ->where('mth_020.regNo' , $student_reg);

            $chm020 = DB::table('chm_020')
                    ->select(DB::raw('"CHM020" AS courseCode,"Predegree Chemistry 2" AS courseTitle, chm_020.*'))
                    ->where('chm_020.regNo' , $student_reg);

            $bio020 = DB::table('bio_020')
                    ->select(DB::raw('"BIO010" AS courseCode,"Predegree Biology 2" AS courseTitle, bio_020.*'))
                    ->where('bio_020.regNo' , $student_reg);

            $results = DB::table('phy_020')
                    ->select(DB::raw('"PHY020" AS courseCode,"Predegree Physics 2" AS courseTitle, phy_020.*'))
                    ->where('phy_020.regNo' , $student_reg)
                    ->union($bio020)
                    ->union($mth020)
                    ->union($chm020)
                    ->union($eng020)
                    ->get();

            return view('results.second')->withStudent($student)->withResults($results);
        }

}


