<html>
<body>

<ul class="nav nav-pills" style=" background-color:brown; font-weight: bold; ">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}" style="color:white; font-size:15px;">
    <i class="fa fa-home"> </i>Home</a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="{{ route('first') }}" style="color:white; font-size:15px;">First semester </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('second') }}" style="color:white; font-size:15px;">Second semester</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('myResults') }}" style="color:white; font-size:15px;">All results</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#" style="color:white; font-size:15px;">Course allocations</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('password.form') }}" style="color:white; font-size:15px;">
    <i class="fa fa-key"> </i>Change Password</a>
  </li>
  
</ul>

</body>
</html>