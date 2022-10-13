<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Admin Dashboard | UMAT </title>
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/timetable.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/halls.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/tabs.css'); }} ">
    <link rel="icon" href="{{ URL::asset('images/umat_logo.png') }}">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
@include('sweetalert::alert')
  <div class="sidebar active">
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
          <a href="{{ route('admin.generator')}}" class="active">
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
          <a href="{{ route('admin.courses')}}">
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
        <span class="dashboard">Generator</span>
      </div>
      <!-- <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div> -->
      <div class="profile-details">
        <img src="{{ URL::asset('storage/images/'.$LoggedUserInfo['profile_img']) }}" alt="">
        <span class="admin_name">{{ $LoggedUserInfo['name'] }}</span>
        <!-- <i class='bx bx-chevron-down' ></i> -->
      </div>
    </nav>
    <div class="home-content">
    <div class="addHallsContainer">
        <div class="main" role="main">
          <button class="popup-trigger btns" id="popup-trigger">
            <span>Generate Timetable  <i class='bx bx-loader bx-spin' ></i></span>
          </button><br><br><br>
          
        </div>
        
        <div class="overlay" id="overlay">
          <div class="overlay-background" id="overlay-background"></div>
          <div class="overlay-content" id="overlay-content">
            <div class="fa fa-times fa-lg overlay-close" id="overlay-close"></div>
            <h1 class="main-heading">Generate Timetable</h1>
            <!-- <span class="blurb-tagline">and won't take longer than a couple of seconds.</span> -->
            <form class="hallsform signup-form" method="post" action="{{ route('generateTimetable') }}">
              @csrf
              <label class="hallsLabel" for="title">Select Semester</label>
              <select id="status" name="semester" required>
                  <option value="">Please Select Semester</option>
                  <option value="First">First</option>
                  <option value="Second">Second</option>
              </select> <br><br>
              <!-- <label class="hallsLabel" for="title">Start time</label>
              <select id="status" name="title" required>
                  <option value="6:00">6:00</option>
                  <option value="7:00">7:00</option>
                  <option value="8:00">8:00</option>
              </select> <br><br> -->
              <!-- <label class="hallsLabel" for="title">Start time</label>
              <select id="status" name="title" required>
                  <option value="6:00">4:30</option>
                  <option value="7:00">5:30</option>
                  <option value="8:00">6:30</option>
                  <option value="8:00">7:30</option>
                  <option value="8:00">8:30</option>
              </select> <br><br> -->
              <button class="btns btn-outline submit-btn"><span>Generate</span></button>
            </form>
          </div>
        </div>
      </div>
 <br><br><br>
 <div class="download">
 <button id="btnExport" onclick="tablesToExcel(['tbl1','tbl2','tbl3','tbl4','tbl5'], ['Monday','Tuesday', 'Wednesday', 'Thursday', 'Friday'], 'FirstSemester.xls', 'Excel')"> <span>Download First Semester Timetable <i class='bx bxs-download'></i></span></button>&nbsp;
 <button id="btnExport" onclick="tablesToExcel(['tbl6','tbl7','tbl8','tbl9','tbl10'], ['Monday','Tuesday', 'Wednesday', 'Thursday', 'Friday'], 'SecondSemester.xls', 'Excel')"> <span>Download Second Semester Timetable <i class='bx bxs-download'></i></span></button>
 </div>
 <div class="download">
 
 </div>
<br />
<br />
 <section class="tabs">
    <ul class="nav">
      <li class="nav-item tab-item active" data-filter="one">
          <button  class="nav-link">
            Monday
          </button>
      </li>
      <li class="nav-item tab-item" data-filter="two">
          <button  class="nav-link">
            Tuesday
          </button>
      </li>
      <li class="nav-item tab-item" data-filter="three">
          <button  class="nav-link">
            Wednesday
          </button>
      </li>
      <li class="nav-item tab-item" data-filter="four">
          <button  class="nav-link">
            Thursday
          </button>
      </li>
      <li class="nav-item tab-item" data-filter="five">
          <button  class="nav-link">
            Friday
          </button>
      </li>
  </ul>
  </section>
    <h1>First Semester Timetable</h1>
    <!-- monday starts -->
<div class="filter-item one">  
<table class="table2excel myTimetable" id="tbl1"> 
  <thead>
    <tr>
      <th></th>
      @foreach($lecture_halls as $lecture_hall)
      <th>{{ $lecture_hall->name }}</th>
      @endforeach    
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>6:00 - 7:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>7:00 - 8:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>8:00 - 9:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "08:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>@endforeach 
    </tr>
    <tr>
      <td>9:00 - 10:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "09:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach   
    </tr>
    <tr>
      <td>10:00 - 11:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "10:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach 
    </tr>
    <tr>
      <td>11:00 - 12:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "11:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach 
    </tr>
      <tr>
      <td>12:00 - 12:30</td>
      <td colspan="{{ $hallsNo }}" class="break">Break</td>
      </tr>
      <tr>
      <td>12:30 - 1:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "12:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach      
    </tr>
    <tr>
      <td>1:30 - 2:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "13:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach       
    </tr>
    <tr>
      <td>2:30 - 3:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "14:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach       
    </tr>
    <tr>
      <td>3:30 - 4:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "15:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach       
    </tr>
    <tr>
      <td>4:30 - 5:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "16:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach    
    </tr>
    <tr>
      <td>5:30 - 6:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "17:0:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach     
    </tr>
   </tbody>
</table>
</div>
<!-- monday ends -->

<!-- tuesday starts -->
<div class="filter-item two">  
<table class="table2excel myTimetable" id="tbl2"> 
  <thead>
    <tr>
      <th></th>
      @foreach($lecture_halls as $lecture_hall)
      <th>{{ $lecture_hall->name }}</th>
      @endforeach    
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>6:00 - 7:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>7:00 - 8:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "07:00:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>8:00 - 9:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "08:00:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>9:00 - 10:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "09:00:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach 
    </tr>
    <tr>
      <td>10:00 - 11:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "10:00:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>11:00 - 12:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "11:00:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach
    </tr>
      <tr>
      <td>12:00 - 12:30</td>
      <td colspan="{{ $hallsNo }}" class="break">Break</td>
      </tr>
      <tr>
      <td>12:30 - 1:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "12:30:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach    
    </tr>
    <tr>
      <td>1:30 - 2:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "13:30:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach   
    </tr>
    <tr>
      <td>2:30 - 3:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "14:30:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach     
    </tr>
    <tr>
      <td>3:30 - 4:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "15:30:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach      
    </tr>
    <tr>
      <td>4:30 - 5:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "16:30:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach   
    </tr>
    <tr>
      <td>5:30 - 6:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentTuesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "17:30:00")<div class="subject">{{ $assign->course }}</div><div class="room">{{ $assign->lecturer }}</div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach   
    </tr>
   </tbody>
  </table>
</div>

<!-- tuesday ends -->

<!-- wednesday starts -->

<div class="filter-item three">  
<table class="table2excel myTimetable" id="tbl3"> 
  <thead>
    <tr>
      <th></th>
      @foreach($lecture_halls as $lecture_hall)
      <th>{{ $lecture_hall->name }}</th>
      @endforeach    
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>6:00 - 7:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>7:00 - 8:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "07:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>8:00 - 9:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "08:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>9:00 - 10:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "09:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>10:00 - 11:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "10:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>11:00 - 12:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "11:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach
    </tr>
      <tr>
      <td>12:00 - 12:30</td>
      <td colspan="{{ $hallsNo }}" class="break">Break</td>
      </tr>
      <tr>
      <td>12:30 - 1:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "12:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach   
    </tr>
    <tr>
      <td>1:30 - 2:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "13:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach     
    </tr>
    <tr>
      <td>2:30 - 3:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "14:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach      
    </tr>
    <tr>
      <td>3:30 - 4:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "15:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach  
    </tr>
    <tr>
      <td>4:30 - 5:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "16:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach 
    </tr>
    <tr>
      <td>5:30 - 6:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentWednesday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "17:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach
      </td>
      @endforeach  
    </tr>
   </tbody>
  </table>
</div>

<!-- wednesday ends -->

<!-- thursday starts -->

<div class="filter-item four">  
<table class="table2excel myTimetable" id="tbl4"> 
  <thead>
    <tr>
      <th></th>
      @foreach($lecture_halls as $lecture_hall)
      <th>{{ $lecture_hall->name }}</th>
      @endforeach    
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>6:00 - 7:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>7:00 - 8:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "07:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>8:00 - 9:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "08:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach 
    </tr>
    <tr>
      <td>9:00 - 10:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "09:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach  
    </tr>
    <tr>
      <td>10:00 - 11:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "10:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>11:00 - 12:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "11:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach 
    </tr>
      <tr>
      <td>12:00 - 12:30</td>
      <td colspan="{{ $hallsNo }}" class="break">Break</td>
      </tr>
      <tr>
      <td>12:30 - 1:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "12:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach    
    </tr>
    <tr>
      <td>1:30 - 2:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "13:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach 
    </tr>
    <tr>
      <td>2:30 - 3:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "14:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach     
    </tr>
    <tr>
      <td>3:30 - 4:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "15:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach      
    </tr>
    <tr>
      <td>4:30 - 5:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "16:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach   
    </tr>
    <tr>
      <td>5:30 - 6:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentThursday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "17:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>
      @endforeach   
    </tr>
   </tbody>
  </table>
</div>

<!-- thursday ends -->

<!-- friday starts -->

<div class="filter-item five">  
<table class="table2excel myTimetable" id="tbl5"> 
  <thead>
    <tr>
      <th></th>
      @foreach($lecture_halls as $lecture_hall)
      <th>{{ $lecture_hall->name }}</th>
      @endforeach    
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>6:00 - 7:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>7:00 - 8:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "07:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>8:00 - 9:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "08:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>9:00 - 10:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "09:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach   
    </tr>
    <tr>
      <td>10:00 - 11:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "10:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach
    </tr>
    <tr>
      <td>11:00 - 12:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "11:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach
    </tr>
      <tr>
      <td>12:00 - 12:30</td>
      <td colspan="{{ $hallsNo }}" class="break">Break</td>
      </tr>
      <tr>
      <td>12:30 - 1:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "12:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach   
    </tr>
    <tr>
      <td>1:30 - 2:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "13:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach   
    </tr>
    <tr>
      <td>2:30 - 3:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "14:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach   
    </tr>
    <tr>
      <td>3:30 - 4:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "15:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach      
    </tr>
    <tr>
      <td>4:30 - 5:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "16:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach   
    </tr>
    <tr>
      <td>5:30 - 6:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentFriday as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "17:30:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }} </div>@endif @endforeach</td>
      @endforeach    
    </tr>
   </tbody>
  </table>
</div>
<!-- first semester ends -->
<br><br><br>

<!-- second semester starts -->

<section class="tabs">
    <ul class="nav">
      <li class="nav-item tab-item active" data-filter="one">
          <button  class="nav-link">
            Monday
          </button>
      </li>
      <li class="nav-item tab-item" data-filter="two">
          <button  class="nav-link">
            Tuesday
          </button>
      </li>
      <li class="nav-item tab-item" data-filter="three">
          <button  class="nav-link">
            Wednesday
          </button>
      </li>
      <li class="nav-item tab-item" data-filter="four">
          <button  class="nav-link">
            Thursday
          </button>
      </li>
      <li class="nav-item tab-item" data-filter="five">
          <button  class="nav-link">
            Friday
          </button>
      </li>
  </ul>
  </section>
 
    <H1>Second Semester Timetable</H1>
    <!-- monday starts -->
<div class="filter-item one">  
<table class="table2excel myTimetable" id="tbl6"> 
  <thead>
    <tr>
      <th></th>
      @foreach($lecture_halls as $lecture_hall)
      <th>{{ $lecture_hall->name }}</th>
      @endforeach    
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>6:00 - 7:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
      @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>7:00 - 8:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
        <div>
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "07:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        </div>
        @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>8:00 - 9:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">@foreach($assignmentMonday2 as $assign)@if($lecture_hall->name == $assign->lecture_hall && $assign->time == "08:00:00")<div class="subject">{{ $assign->course }} </div><div class="room">{{ $assign->lecturer }} </div><div class="room">{{ $assign->class }}</div>@endif @endforeach</td>@endforeach 
    </tr>
    <tr>
      <td>9:00 - 10:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "09:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach   
    </tr>
    <tr>
      <td>10:00 - 11:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "10:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
    <tr>
      <td>11:00 - 12:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "11:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
      <tr>
      <td>12:00 - 12:30</td>
      <td colspan="{{ $hallsNo }}" class="break">Break</td>
      </tr>
      <tr>
      <td>12:30 - 1:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "12:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach      
    </tr>
    <tr>
      <td>1:30 - 2:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "13:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>2:30 - 3:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "14:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>3:30 - 4:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "15:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>4:30 - 5:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "16:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach    
    </tr>
    <tr>
      <td>5:30 - 6:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentMonday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "17:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach     
    </tr>
   </tbody>
</table>
</div>
<!-- monday ends -->

<!-- tuesday starts -->
<div class="filter-item two">  
<table class="table2excel myTimetable" id="tbl7"> 
  <thead>
    <tr>
      <th></th>
      @foreach($lecture_halls as $lecture_hall)
      <th>{{ $lecture_hall->name }}</th>
      @endforeach    
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>6:00 - 7:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>7:00 - 8:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "07:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>8:00 - 9:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "08:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
    <tr>
      <td>9:00 - 10:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "09:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach   
    </tr>
    <tr>
      <td>10:00 - 11:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "10:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
    <tr>
      <td>11:00 - 12:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "11:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
      <tr>
      <td>12:00 - 12:30</td>
      <td colspan="{{ $hallsNo }}" class="break">Break</td>
      </tr>
      <tr>
      <td>12:30 - 1:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "12:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach      
    </tr>
    <tr>
      <td>1:30 - 2:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "13:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>2:30 - 3:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "14:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>3:30 - 4:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "15:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>4:30 - 5:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "16:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach    
    </tr>
    <tr>
      <td>5:30 - 6:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentTuesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "17:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach     
    </tr>
   </tbody>
  </table>
</div>

<!-- tuesday ends -->

<!-- wednesday starts -->

<div class="filter-item three">  
<table class="table2excel myTimetable" id="tbl8"> 
  <thead>
    <tr>
      <th></th>
      @foreach($lecture_halls as $lecture_hall)
      <th>{{ $lecture_hall->name }}</th>
      @endforeach    
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>6:00 - 7:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>7:00 - 8:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "07:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>8:00 - 9:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "08:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
    <tr>
      <td>9:00 - 10:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "09:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach   
    </tr>
    <tr>
      <td>10:00 - 11:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "10:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
    <tr>
      <td>11:00 - 12:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "11:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
      <tr>
      <td>12:00 - 12:30</td>
      <td colspan="{{ $hallsNo }}" class="break">Break</td>
      </tr>
      <tr>
      <td>12:30 - 1:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "12:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach      
    </tr>
    <tr>
      <td>1:30 - 2:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "13:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>2:30 - 3:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "14:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>3:30 - 4:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "15:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>4:30 - 5:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "16:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach    
    </tr>
    <tr>
      <td>5:30 - 6:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentWednesday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "17:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach     
    </tr>
   </tbody>
  </table>
</div>

<!-- wednesday ends -->

<!-- thursday starts -->

<div class="filter-item four">  
<table class="table2excel myTimetable" id="tbl9"> 
  <thead>
    <tr>
      <th></th>
      @foreach($lecture_halls as $lecture_hall)
      <th>{{ $lecture_hall->name }}</th>
      @endforeach    
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>6:00 - 7:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>7:00 - 8:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "07:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>8:00 - 9:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "08:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
    <tr>
      <td>9:00 - 10:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "09:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach   
    </tr>
    <tr>
      <td>10:00 - 11:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "10:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
    <tr>
      <td>11:00 - 12:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "11:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
      <tr>
      <td>12:00 - 12:30</td>
      <td colspan="{{ $hallsNo }}" class="break">Break</td>
      </tr>
      <tr>
      <td>12:30 - 1:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "12:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach      
    </tr>
    <tr>
      <td>1:30 - 2:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "13:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>2:30 - 3:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "14:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>3:30 - 4:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "15:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>4:30 - 5:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "16:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach    
    </tr>
    <tr>
      <td>5:30 - 6:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentThursday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "17:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach     
    </tr>
   </tbody>
  </table>
</div>

<!-- thursday ends -->

<!-- friday starts -->

<div class="filter-item five">  
<table class="table2excel myTimetable" id="tbl10"> 
  <thead>
    <tr>
      <th></th>
      @foreach($lecture_halls as $lecture_hall)
      <th>{{ $lecture_hall->name }}</th>
      @endforeach    
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>6:00 - 7:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "06:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>7:00 - 8:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "07:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach
    </tr>
    <tr>
      <td>8:00 - 9:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "08:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
    <tr>
      <td>9:00 - 10:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "09:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach   
    </tr>
    <tr>
      <td>10:00 - 11:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "10:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
    <tr>
      <td>11:00 - 12:00</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "11:00:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach 
    </tr>
      <tr>
      <td>12:00 - 12:30</td>
      <td colspan="{{ $hallsNo }}" class="break">Break</td>
      </tr>
      <tr>
      <td>12:30 - 1:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "12:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach      
    </tr>
    <tr>
      <td>1:30 - 2:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "13:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>2:30 - 3:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "14:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>3:30 - 4:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "15:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach       
    </tr>
    <tr>
      <td>4:30 - 5:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "16:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach    
    </tr>
    <tr>
      <td>5:30 - 6:30</td>
      @foreach($lecture_halls as $lecture_hall)
      <td class="{{ $colors[array_rand($colors)] }}">
      @foreach($assignmentFriday2 as $assign)
          @if($lecture_hall->name == $assign->lecture_hall && $assign->time == "17:30:00")
          <div class="subject">{{ $assign->course }}</div>
          <div class="room">{{ $assign->lecturer }}</div>
          <div class="room">{{ $assign->class }}</div>
          @endif
        @endforeach
      </td>
      @endforeach     
    </tr>
   </tbody>
  </table>
</div>
      </section>
  <script src="{{ URL::asset('js/dashboard.js') }}"></script>
  <!-- <script src="{{ URL::asset('js/FileSaver.js') }}"></script>
  <script src="{{ URL::asset('js/tableexport.js') }}"></script> -->
  <script src="{{ URL::asset('js/tabs.js') }}"></script>
  <script src="{{ URL::asset('js/halls.js') }}"></script>
  <script src="{{ URL::asset('js/download.js') }}"></script>
</body>
<div class="se-pre-con"></div>
</html>
