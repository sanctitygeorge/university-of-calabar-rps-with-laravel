<html>
<body>
    
    
<ul class="nav nav-pills"  style=" background-color:brown; font-weight: bold; font-size: 15px; font-color:black;">

        <li class="nav-item dropdown">
        <div class="dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">English</a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('eng010.index') }}">ENG 010</a>
            <a class="dropdown-item" href="{{ route('eng020.index') }}">ENG 020</a>
            </div>
        </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">Mathematics</a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('mth010.index') }}">MTH010</a>
            <a class="dropdown-item" href="{{ route('mth020.index') }}">MTH020</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">Chemistry</a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('chm010.index') }}">CHM010</a>
            <a class="dropdown-item" href="{{ route('chm020.index') }}">CHM020</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">Physics</a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('phy010.index') }}">PHY010</a>
            <a class="dropdown-item" href="{{ route('phy020.index') }}">PHY020</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">Biology</a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('bio010.index') }}">BIO 010</a>
            <a class="dropdown-item" href="{{ route('bio020.index') }}">BIO 020</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">Students</a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('students.index')}}">View Students</a>
            <a class="dropdown-item" href="{{ route('students.create')}}">Add Student</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-password.form')}}" style="color:white;">
             <i class="fa fa-key"> </i>Change Password</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard')}}" style="color:white;">Home</a>
        </li>

        
</ul>
</body>


</html>