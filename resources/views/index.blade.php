
@extends('layouts.app')
@section('content')


      

		<div class="container">
			<div class="jumbotron" style="background-image: url(img/unicalview3.jpg);">
			
		<h1 align="center" style="color:white;"><strong>UNICAL</strong></h1>
			<h2 align="center" style="color:white;"><strong>Pre-Degree Portal</strong></h2>
			</div>

			
                    @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                       <h5><a href="{{ url('/home') }}">Dashboard</a></h5>
                    @else
                      
                    @endauth
                </div>
            @endif
			
		</div>
  
  <!-- <div class="container"> -->
  <div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
    <li data-target="#demo" data-slide-to="3"></li>
  </ul>

  <!-- The slideshow -->
  <div class="jumbotron">
  <div class="carousel-inner">
  <div class="carousel-item active">
      <img src= "{{ asset('img/unical 8.jpg') }}" alt="slide 1" style="width:1300px; height:450px;">
    <div class="carousel-caption">
    <h2 style="color:brown;">University E-Library</h3>
    <h3 style="color:brown;">Fully equipped in order to improve standard of learning</h3>
  </div>
    </div>
    <div class="carousel-item">
      <img src= "{{ asset('img/unical 3.jpg') }}" alt="slide 2" style="width:1300px; height:450px;">
     <div class="carousel-caption">
    <h2 style="color:white;">University Main Library</h3>
    <h3 style="color:white;">Fully equipped with up to date textbooks, journals, articles on various topics </h3>
  </div>
    </div>
    <div class="carousel-item">
      <img src= "{{ asset('img/unical 10.png') }}" alt="slide 3" style="width:1300px; height:450px;">
    <div class="carousel-caption">
    <h2 style="color:brown;">Enterprenuership Development</h3>
    <h3 style="color:brown;">where students will learn all kinds of skills outside class curriculum</h3>
  </div>
    </div>
    <div class="carousel-item">
      <img src= "{{ asset('img/unical 5.jpg') }}" alt="slide 4" style="width:1300px; height:450px;">
     <div class="carousel-caption">
    <h2 style="color:brown;">Students Week</h3>
    <h3 style="color:brown;"> This is where the our students showcase their indigenous culture 
          and other recreational activities</h3>
  </div>
    </div>
    <div class="carousel-item">
      <img src= "{{ asset('img/unical 7.jpg') }}" alt="slide 5" style="width:1300px; height:450px;">
     <div class="carousel-caption">
    <h2 style="color:white;">University of Calabar</h3>
    <h3 style="color:white;">is made up of about 100+ Departments and about 20+ Faculties </h3>
  </div>
    </div>
    <div class="carousel-item">
      <img src= "{{ asset('img/unical 9.jpg') }}" alt="slide 6" style="width:1300px; height:450px;">
     <div class="carousel-caption">
    <h2 style="color:white;">University of Calabar</h3>
    <h3 style="color:white;">has one of the biggest lecture venues in West African Universities</h3>
  </div>
    </div>
    
  </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
</div>

<div class="container" style="background-color: #fff;">

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
  </ul>
  
</div>
			
        @endsection