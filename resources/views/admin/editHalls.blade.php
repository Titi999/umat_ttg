@php
use App\Models\Halls;
$lists = Halls::all();
@endphp
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
          <a href="{{ route('admin.halls')}}" class="active">
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
        <span class="dashboard">Lecture Halls</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
        <img src="{{ URL::asset('images/pic-person-01.jpg') }}" alt="">
        <span class="admin_name">{{ $LoggedUserInfo['name'] }}</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>
    <div class="home-content">
      <div class="addHallsContainer">
          <div class="overlay-content" id="overlay-content">
            <h1 class="main-heading">Edit Lecture Hall</h1>
            <h3 class="blurb">Fill the form to add a lecture hall</h3>
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
            <form class="hallsform signup-form" action="{{ route('admin.edit') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $data['id'] }}">
              <label class="hallsLabel" for="signup-name">Name</label>
              <input value="{{ $data['name'] }}" class="hallsInput" id="signup-name" type="text" name="name" autocomplete="off" required/>
              <label class="hallsLabel" for="department">Department</label>
              <select id="status" name="department">
                  <option value="Computer Science and Engineering" {{ ($data['department'] == "Computer Science and Engineering") ? 'selected' : '' }}>Computer Science and Engineering</option>
                  <option value="Mining Engineering" {{ ($data['department'] == "Mining Engineering") ? 'selected' : '' }}>Mining Engineering</option>
                  <option value="Mineral Engineering" {{ ($data['department'] == "Mineral Engineering") ? 'selected' : '' }}>Mineral Engineering</option>
                  <option value="Geomatic Engineering" {{ ($data['department'] == "Geomatic Engineering") ? 'selected' : '' }}>Geomatic Engineering</option>
                  <option value="Mathematics" {{ ($data['department'] == "Mathematics") ? 'selected' : '' }}>Mathematics</option>
                  <option value="Environment Studies" {{ ($data['department'] == "Environment Studies") ? 'selected' : '' }}>Environment Studies</option>
                  <option value="Petroleum Engineering" {{ ($data['department'] == "Petroleum Engineering") ? 'selected' : '' }}>Petroleum Engineering</option>
                  <option value="General" {{ ($data['department'] == "General") ? 'selected' : '' }}>General</option>
              </select>
              <br><br>
              <label class="hallsLabel" for="signup-email">Capacity</label>
              <input value="{{ $data['capacity'] }}" class="hallsInput" id="signup-email" type="number" name="capacity" autocomplete="off" required/>
              <span style="color:red">@error('capacity'){{ $message }} @enderror</span>
              <label class="hallsLabel" for="signup-pw">Amenities</label>
              <select id="status" name="amenities">
                  <option value="Projector Only" {{ ($data['amenities'] == "Projector Only") ? 'selected' : '' }}>Projector Only</option>
                  <option value="Projector and Wifi" {{ ($data['amenities'] == "Projector and Wifi") ? 'selected' : '' }}>Projector and Wifi</option>
              </select>
              <br><br>
              <label class="hallsLabel" for="status">Status</label>
              <select id="status" name="status">
                  <option value="Active" {{ ($data['status'] == "Active") ? 'selected' : '' }}>Active</option>
                  <option value="Unavailable" {{ ($data['status'] == "Unavailable") ? 'selected' : '' }}>Unavailable</option>
              </select>
              <br><br>
              <button class="btns btn-outline submit-btn"><span>Submit</span></button>
            </form>
          </div>
        </div>
    </div>
    
    </section>
  <script src="{{ URL::asset('js/dashboard.js') }}"></script>
  
</body>
</html>

