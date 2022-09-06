<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Admin Dashboard | UMAT </title>
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/edit.css'); }} ">
    <link rel="icon" href="{{ URL::asset('images/umat_logo.png') }}">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    </head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
@include('sweetalert::alert')
  <div class="sidebar active" id="sidebar">
    <div class="logo-details">
      <img class="dashboard-logo" src="{{ URL::asset('images/umat_logo.png') }}" width="25">
      <span class="logo_name">UMAT | TTG</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="{{ route('home')}}">
          <i class='bx bx-home'></i>
            <span class="links_name">Home</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.generator')}}">
            
          <i class='bx bx-loader bx-spin' ></i>
            <span class="links_name">Generator</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.halls')}}">
          <i class='bx bxs-school'></i>
            <span class="links_name">Lecture Halls</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.courses')}}" class="active">
          <i class='bx bx-book'></i>
            <span class="links_name">Courses</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.lecturers')}}">
          <i class='bx bxs-user-voice'></i>
            <span class="links_name">Lecturers</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.classes')}}">
          <i class='bx bx-shape-square'></i>
            <span class="links_name">Classes</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.settings')}}">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        <li class="log_out">
          <a href="{{ route('auth.logout')}}">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Edit Course</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
        <img src="{{ URL::asset('storage/images/'.$LoggedUserInfo['profile_img']) }}" alt="">
        <span class="admin_name">{{ $LoggedUserInfo['name'] }}</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>
    <div class="home-content" style="height: 1000px;">
      <div class="addHallsContainer">
          <div class="overlay-content" id="overlay-content">
            <h1 class="main-heading">Edit Course</h1>
            @if(Session::get('success'))
              <div style="color: red;">
                {{ Session::get('success') }}
              </div>
            @endif
            @if(Session::get('fail'))
              <div style="color: red;">
                {{ Session::get('fail') }}
              </div>
            @endif
            
            <!-- <span class="blurb-tagline">and won't take longer than a couple of seconds.</span> -->
            <form class="hallsform signup-form" method="post" action="{{ route('admin.editCou') }}">
              @csrf
              <input type="hidden" name="id" value="{{ $data['id'] }}">
              <label class="hallsLabel" for="signup-name">Name</label>
              <input value="{{ $data['name'] }}" class="hallsInput" id="signup-name" type="text" name="name" autocomplete="off" required/>
              <label class="hallsLabel" for="signup-email">Code</label>
              <input value="{{ $data['code'] }}" class="hallsInput" id="signup-email" type="number" name="code" autocomplete="off" min="100" max="999" required/>
              <label class="hallsLabel" for="signup-pw">Select Class</label>
              <select id="status" name="class" required>
                  <option>Select Class</option>
                  @foreach($classes as $class)
                <option value="{{ $class->name }}" {{ ($data['class'] == $class->name) ? 'selected' : '' }}>{{ $class->name }}</option>
              @endforeach
              </select><br><br>
              <label class="hallsLabel" for="status">Semester</label>
              <select id="status" name="semester" required>
                  <option>Select Semester</option>
                  <option value="First"  {{ ($data['semester'] == "First") ? 'selected' : '' }}>First</option>
                  <option value="Second"  {{ ($data['semester'] == "Second") ? 'selected' : '' }}>Second</option>
              </select> <br><br>
              <label class="hallsLabel" for="signup-pw">Course Lecturer</label>
              <select id="status" name="lecturer" required>
              <option>Select Course Lecturer</option>
              @foreach($lists as $lecturer)
                <option value="{{ $lecturer->name }}"  {{ ($data['lecturer'] == $lecturer->name) ? 'selected' : '' }}>{{ $lecturer->name }}</option>
              @endforeach
              </select><br><br>
              <label class="hallsLabel" for="signup-email">Periods</label>
              <input  value="{{ $data['periods'] }}" class="hallsInput" id="signup-email" type="number" name="creditHours" autocomplete="off" min="1" max="6" required/>
              <button class="btns btn-outline submit-btn"><span>Submit</span></button><br><br>
             
            </form>
            
          </div>
        </div>
    </div>
    
    </section>
  <script src="{{ URL::asset('js/dashboard.js') }}"></script>
  
</body>
</html>

