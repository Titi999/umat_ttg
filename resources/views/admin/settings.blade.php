<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title> Admin Dashboard | UMAT </title>
        <link rel="stylesheet" href="{{ URL::asset('css/dashboard.css'); }} ">
        <link rel="stylesheet" href="{{ URL::asset('css/settings.css'); }} ">
        <link rel="icon" href="{{ URL::asset('images/umat_logo.png') }}">
        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
                <a href="{{ route('admin.settings')}}" class="active">
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
                    <span class="dashboard">Settings</span>
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
            <div class="home-content">
            <section class="py-5 my-5" id="settingsContainer">
		<div class="container">
			<div class="bg-white shadow rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
							<img src="{{ URL::asset('storage/images/'.$LoggedUserInfo['profile_img']) }}" alt="Image" class="shadow">
						</div>
						<h4 class="text-center">{{ $LoggedUserInfo['name'] }}</h4>
					</div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-user text-center mr-1"></i> 
							Account
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Password
						</a>
						 <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab" aria-controls="security" aria-selected="false">
							<i class="fa fa-file-image-o text-center mr-1"></i> 
							Profile Image
						</a>
                        <!--
						<a class="nav-link" id="application-tab" data-toggle="pill" href="#application" role="tab" aria-controls="application" aria-selected="false">
							<i class="fa fa-tv text-center mr-1"></i> 
							Application
						</a>
						<a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab" aria-controls="notification" aria-selected="false">
							<i class="fa fa-bell text-center mr-1"></i> 
							Notification
						</a> -->
					</div>
				</div>
				<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
						<h3 class="mb-4">Account Settings</h3>
                        @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{$error}}</p>
                                @endforeach
                            @endif   
                        <form action="{{ route('updateUser') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $LoggedUserInfo['id'] }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="username" class="form-control" value="{{ $LoggedUserInfo['name'] }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" value="{{ $LoggedUserInfo['email'] }}">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" id="updateBtn">Update</button>
                            </div>
                        </form>
					</div>
					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<h3 class="mb-4">Password Settings</h3>
                        @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{$error}}</p>
                                @endforeach
                            @endif   
                        <form action="{{ route('updatePassword') }}" method="post">
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                <input type="hidden" name="id" value="{{ $LoggedUserInfo['id'] }}">
                                    <div class="form-group">
                                        <label>Old password</label>
                                        <input type="password" name="oldPassword" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>New password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm new password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" id="updateBtn">Update</button>
                            </div>
                        </form>
					</div>
					 <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
						<h3 class="mb-4">Profile Image Settings</h3>
                        <form action="{{ route('updateProfileImg') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $LoggedUserInfo['id'] }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Image</label>
                                        <input type="file" accept="image/*" name="profileImage" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" id="updateBtn">Update</button>
                            </div>
                        </form>
					</div>
                    <!--
					<div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application-tab">
						<h3 class="mb-4">Application Settings</h3>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="app-check">
										<label class="form-check-label" for="app-check">
										App check
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="defaultCheck2" >
										<label class="form-check-label" for="defaultCheck2">
										Lorem ipsum dolor sit.
										</label>
									</div>
								</div>
							</div>
						</div>
						<div>
							<button class="btn btn-primary">Update</button>
							<button class="btn btn-light">Cancel</button>
						</div>
					</div>
					<div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
						<h3 class="mb-4">Notification Settings</h3>
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="notification1">
								<label class="form-check-label" for="notification1">
									Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum accusantium accusamus, neque cupiditate quis
								</label>
							</div>
						</div>
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="notification2" >
								<label class="form-check-label" for="notification2">
									hic nesciunt repellat perferendis voluptatum totam porro eligendi.
								</label>
							</div>
						</div>
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="notification3" >
								<label class="form-check-label" for="notification3">
									commodi fugiat molestiae tempora corporis. Sed dignissimos suscipit
								</label>
							</div>
						</div>
						<div>
							<button class="btn btn-primary">Update</button>
							<button class="btn btn-light">Cancel</button>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</section>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="{{ URL::asset('js/dashboard.js') }}"></script>
    </body>
</html>

