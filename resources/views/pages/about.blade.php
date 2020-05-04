@extends('layouts.app')

@section('content')
<br>
<div class="container" style="background-color: #fff;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 align="center">About Us</h1></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
<br>
                    <ul>
    <li>
      <p>The Pre-degree Programmes of UNICAL is a full-time one-year pre-matriculation training, 
        consisting of Science and Management programmes designed to prepare students for various degree programmes of the University of Calabar, Calabar. 
        The programme also prepares students indirectly for the Unified Tertiary Matriculation Examination (JAMB-UTME).
        The management of the Pre-degree programmes is composed of the Heads of Programmes (Science and Management), five Assistant Coordinators (one for each subject) and the Administrative staff.
</p>
    </li>
    <li>
      <h3>Admission Requirements into Pre-degree Science</h3>
        <p>
          The requirements for admission into the Pre-degree programmes are credits in Senior Secondary School Certificate/General Certificate of Education (SSCE/GCE), 
          National Examination Council (NECO), Ordinary Level Examination (in not more than two sittings) in Chemistry, English Language, Mathematics, Biology, or Agricultural Science and Physics.
        </p>
    </li>

    <li>
      <h3>Pre-degree Science Programmes</h3>
            All Pre-degree students must take English Language and Mathematics subjects in addition to three other subjects; 
            Biology, Chemistry and Physics for science students.
    </li>

    <br>
    <li>
        <p>
                This portal was established in November 2017, 
                as an undergraduate research work from the department of Computer Science, 2013/2014 session.
            </p>
            <p>
                This Portal keeps track of Pre-Degree students' results.Students can also check their lecture venues, 
                course allocations and lecture/examination timetable.  
            </p>
    </li>
  </ul>
            
                
                </div>
                <h4 align="center">
                <a href="/"> Back Home</a>
                </h4>
            </div>
        </div>
    </div>
</div>
@endsection
