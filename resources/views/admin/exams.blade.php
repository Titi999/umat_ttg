<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Admin Dashboard | UMAT </title>
    <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/halls.css'); }} ">
    <link rel="icon" href="{{ URL::asset('images/umat_logo.png') }}">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
          <a href="{{ route('home')}}" class="active">
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
          <a href="{{ route('admin.exams')}}"> 
          <i class='bx bx-pulse'></i>
            <span class="links_name">Exams</span>
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
  <section class="home-section" style="position:absolute ;">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Exams</span>
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
      <div class="main" role="main" style="min-height: 200px;">
        <button class="popup-trigger btns" id="popup-trigger" style="width: 250px;">
          <span>Generate Exams Timetable  <i class='bx bx-loader bx-spin' ></i></span>
        </button><br><br><br>
        
      </div>
      
        <div class="overlay" id="overlay">
          <div class="overlay-background" id="overlay-background"></div>
          <div class="overlay-content" id="overlay-content">
            <div class="fa fa-times fa-lg overlay-close" id="overlay-close"></div>
            <h1 class="main-heading">Generate Exams Timetable</h1>
            <!-- <span class="blurb-tagline">and won't take longer than a couple of seconds.</span> -->
            <form class="hallsform signup-form" method="post" action="{{ route('generateExams') }}">
              @csrf
              <label class="hallsLabel" for="title">Select Semester</label>
              <select id="status" name="semester" required>
                  <option value="">Please Select Semester</option>
                  <option value="First">First</option>
                  <option value="Second">Second</option>
              </select> <br><br>
              <label class="hallsLabel" for="title">Start Date</label>
              <input type="date" style="color: white;" name="startDate" required>
              <label class="hallsLabel" for="title">End Date</label>
              <input type="date" class="hallsInput" style="color: white;" name="endDate" required>
              <button class="btns btn-outline submit-btn"><span>Generate</span></button>
            </form>
          </div>
        </div>
      </div>  
      
      <div class="container">
  <div class="row row--top-40">
    <div class="col-md-12">
      <h2 class="row__title">Exams Schedule</h2>
    </div>
  </div>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="row row--top-20">
    <div class="col-md-12">
      <div class="table-container">
        <table id="myTable" class="table">
          <thead class="table__thead">
            <tr class="t_head">
              <!-- <th class="table__th"><input id="selectAll" type="checkbox" class="table__select-row"></th> -->
              <th class="table__th">Date</th>
              <th class="table__th">Course</th>
              <th class="table__th">Class</th>
              <th class="table__th">Lecturer</th>
              <th class="table__th">Room</th>
              <th class="table__th">Invigilator</th>
              <!-- <th class="table__th"></th> -->
            </tr>
          </thead>
          <tbody class="table__tbody">
          @foreach($examsList as $exam)
            <tr class="table-row">
              <!-- <td class="table-row__td">
                <input id="" type="checkbox" class="table__select-row">
              </td> -->
              <td class="table-row__td">
                <!-- <div class="table-row__img"></div> -->
                <div class="table-row__info">
                  <p class="table-row__name">{{ $exam->date }}</p>
                  <span class="table-row__small">{{ $exam->time }}</span>
                </div>
              </td>
              <td data-column="Policy" class="table-row__td">
                <div class="">
                  <p class="table-row__policy">{{ $exam->course }}</p>
                  <span class="table-row__small">{{ $exam->course_no }}</span>
                </div>                
              </td>
              <td data-column="Policy status" class="table-row__td">
                <p class="table-row__policy">{{ $exam->class }}</p>
              </td>
             
              <td  data-column="Status" class="table-row__td">
                <p class="table-row__policy">{{ $exam->lecturer }}</p>
              </td>
              <td  data-column="Status" class="table-row__td">
                <p class="table-row__policy">{{ $exam->hall }}</p>
              </td>
              <td  data-column="Status" class="table-row__td">
                <p class="table-row__policy">{{ $exam->invigilator }}</p>
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
  <script src="{{ URL::asset('js/tabs.js') }}"></script>
</body>
</html>

