@php
use App\Models\Course;
$courses = Course::all();
@endphp
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Admin Dashboard | UMAT </title>
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/halls.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/courses.css'); }} ">
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
        <span class="dashboard">Courses</span>
      </div>
      <div class="search-box">
        <input type="text"  id="myInput" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
      <img src="{{ URL::asset('storage/images/'.$LoggedUserInfo['profile_img']) }}" alt="">
        <span class="admin_name">{{ $LoggedUserInfo['name'] }}</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>
    <div class="home-content">
      <div class="addHallsContainer">
        <div class="main" role="main">
          <button class="popup-trigger btns" id="popup-trigger">
            <span>Add Course<i class="fa fa-plus-square-o"></i></span>
          </button>
        </div>
        <div class="overlay" id="overlay">
          <div class="overlay-background" id="overlay-background"></div>
          <div class="overlay-content" id="overlay-content">
            <div class="fa fa-times fa-lg overlay-close" id="overlay-close"></div>
            <h1 class="main-heading">Add Course</h1>
            <!-- <span class="blurb-tagline">and won't take longer than a couple of seconds.</span> -->
            <form class="hallsform signup-form" method="post" action="addCourse">
              @csrf
              <label class="hallsLabel" for="signup-name">Name</label>
              <input class="hallsInput" id="signup-name" type="text" name="name" autocomplete="off" required/>
              <label class="hallsLabel" for="signup-email">Code</label>
              <input class="hallsInput" id="signup-email" type="number" name="code" autocomplete="off" min="100" max="999" required/>
              <h4>Combined Course?</h4>
              <input type="checkbox" hidden="hidden" id="combined" onclick="validate()" value="No" name="combined">
              <label class="switch" for="combined"></label><br><br>
              <label class="hallsLabel" for="signup-pw">Select Class</label>
              <select id="status" name="class" required>
                  <option>Select Class</option>
                  @foreach($classes as $class)
                <option value="{{ $class->name }}">{{ $class->name }}</option>
              @endforeach
              </select>&nbsp;&nbsp;<select id="status" name="cclass" class="otherclass" style="display:none;">
                  <option>Select Another Class</option>
                  @foreach($classes as $class)
                <option value="{{ $class->name }}">{{ $class->name }}</option>
              @endforeach
              </select><br><br>
              <label class="hallsLabel" for="status">Semester</label>
              <select id="status" name="semester" required>
                  <option>Select Semester</option>
                  <option value="First">First</option>
                  <option value="Second">Second</option>
              </select> <br><br>
              <label class="hallsLabel" for="signup-pw">Course Lecturer</label>
              <select id="status" name="lecturer" required>
              <option>Select Course Lecturer</option>
              @foreach($lists as $lecturer)
                <option value="{{ $lecturer->name }}">{{ $lecturer->name }}</option>
              @endforeach
              </select><br><br>
              <label class="hallsLabel" for="signup-email">Periods</label>
              <input class="hallsInput" id="signup-email" type="number" name="creditHours" autocomplete="off" min="1" max="4" required/>
              <label class="hallsLabel LcombinedPeriods" for="signup-email" style="display:none;">Combined Periods</label>
              <input class="hallsInput combinedPeriods" id="signup-email" type="number" name="combinedPeriods" autocomplete="off" min="1" max="4" style="display:none;"/>
              <button class="btns btn-outline submit-btn"><span>Submit</span></button><br><br><br><br>
            </form>
          </div>
        </div>
      </div>
        <!-- <div class="treat-wrapper">
            <a class="treat-button">Add Lecture Hall <i class='bx bx-plus-medical'></i></a>
        </div> -->

        <div class="container">
  <div class="row row--top-40">
    <div class="col-md-12">
      <h2 class="row__title">List of Courses (7)</h2>
    </div>
  </div>
  <div class="row row--top-20">
    <div class="col-md-12">
      <div class="table-container">
        <table id="myTable" class="table">
          <thead class="table__thead">
            <tr class="t_head">
              <!-- <th class="table__th"><input id="selectAll" type="checkbox" class="table__select-row"></th> -->
              <th class="table__th">Name</th>
              <th class="table__th">Code / Class</th>
              <th class="table__th">Periods</th>
              <th class="table__th">Semester</th>
              <!-- <th class="table__th">Lecturer</th> -->
              <th class="table__th">Edit / Delete</th>
              <!-- <th class="table__th"></th> -->
            </tr>
          </thead>
          <tbody class="table__tbody">
            @foreach($courses as $course)
              <tr class="table-row table-row--chris">
                <!-- <td class="table-row__td">
                  <input id="" type="checkbox" class="table__select-row">
                </td> -->
                <td class="table-row__td">
                  <!-- <div class="table-row__img"></div> -->
                  <div class="table-row__info">
                    <p class="table-row__name">{{ $course->name }}</p>
                    <span class="table-row__small">{{ $course->lecturer }}</span>
                  </div>
                </td>
                <td data-column="Policy" class="table-row__td">
                  <div class="">
                    <p class="table-row__policy">{{ $course->code }}</p>
                    <span class="table-row__small">{{ $course->class }}{{ $course->year }}</span>
                  </div>                
                </td>
                <td data-column="Policy status" class="table-row__td">
                  <p class="table-row__p-status status">{{ $course->periods }}</p>
                </td>
                <!-- <td data-column="Destination" class="table-row__td">
                  Huston, US
                </td> -->
                <td  data-column="Status" class="table-row__td">
                  <p class="table-row__status status">{{ $course->semester }}</p>
                </td>
                <!-- <td data-column="Progress" class="table-row__td">
                  <p class="table-row__progress status--blue status">On Track</p>
                </td> -->
                </td>
                <td class="table-row__td" style="z-index: 100">
                <a href="editCourse/{{ $course->id }}">
                  <svg  version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve" data-toggle="tooltip" data-placement="bottom" title="Edit">
                      <g>	<g>		
                      <path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>	
                      </g></g><g>	<g>
                  <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>	</g></g><g>	<g>		<polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   " style="fill: rgb(1, 185, 209);"></polygon>	</g></g><g></g><g></g><g></g>
                      <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                  </svg>
                  </a>
                  <a href="deleteCourse/{{ $course->id }}">
                  <svg data-toggle="tooltip" data-placement="bottom" title="Delete" version="1.1" class="table-row__bin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                      <g>	<g>		<path d="M436,60h-90V45c0-24.813-20.187-45-45-45h-90c-24.813,0-45,20.187-45,45v15H76c-24.813,0-45,20.187-45,45v30    c0,8.284,6.716,15,15,15h16.183L88.57,470.945c0.003,0.043,0.007,0.086,0.011,0.129C90.703,494.406,109.97,512,133.396,512    h245.207c23.427,0,42.693-17.594,44.815-40.926c0.004-0.043,0.008-0.086,0.011-0.129L449.817,150H466c8.284,0,15-6.716,15-15v-30    C481,80.187,460.813,60,436,60z M196,45c0-8.271,6.729-15,15-15h90c8.271,0,15,6.729,15,15v15H196V45z M393.537,468.408    c-0.729,7.753-7.142,13.592-14.934,13.592H133.396c-7.792,0-14.204-5.839-14.934-13.592L92.284,150h327.432L393.537,468.408z     M451,120h-15H76H61v-15c0-8.271,6.729-15,15-15h105h150h105c8.271,0,15,6.729,15,15V120z" style="fill: rgb(158, 171, 180);"></path>	
                      </g></g><g>	<g>		<path d="M256,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C271,186.716,264.284,180,256,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		<path d="M346,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C361,186.716,354.284,180,346,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g>	<g>		
                      <path d="M166,180c-8.284,0-15,6.716-15,15v212c0,8.284,6.716,15,15,15s15-6.716,15-15V195C181,186.716,174.284,180,166,180z" style="fill: rgb(158, 171, 180);"></path>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                      <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                  </svg>    
                  </a>            
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>

    </div>
      </section>
  <script src="{{ URL::asset('js/dashboard.js') }}"></script>
  <script src="{{ URL::asset('js/halls.js') }}"></script>
  <script src="{{ URL::asset('js/search.js') }}"></script>
  <script src="{{ URL::asset('js/courses.js') }}"></script>
</body>
</html>

