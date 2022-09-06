<!DOCTYPE html>
<html lang="en"></html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/login.css'); }} ">
    <link rel="icon" href="{{ URL::asset('images/umat_logo.png') }}">

    </head>

    <body>
        <div class="container">
            <div class="forms-container">
                <div class="signin-signup">
                    <form action="{{ route('auth.check') }}" class="sign-in-form" method="post">
                        @if(Session::get('fail'))
                        <div class="alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                        @endif
                        @csrf
                        <h2 class="title">Login</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" name="email" autocomplete="email" placeholder="email" required="yes">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" autocomplete="current-password" placeholder="Password" id="id_password" required="yes">
                            <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </div>

                        <input type="submit" value="Sign in" class="btn solid">

                        <!-- <div class="social-media">
                            <a class="icon-mode" onclick="toggleTheme('dark');"><i class="fas fa-moon"></i></a>
                            <a class="icon-mode" onclick="toggleTheme('light');"><i class="fas fa-sun"></i></a>
                        </div> -->
                        <!-- <p class="text-mode">Change theme</p> -->
                    </form>
                    <form action="{{ route('auth.save') }}" method="post" class="sign-up-form">
                        @if(Session::get('success'))
                        <div class="alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif

                        @if(Session::get('fail'))
                        <div class="alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                        @endif

                        @csrf
                        <h2 class="title">Register</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" name="name" autocomplete="username" placeholder="Username" required="yes" value="{{ old('name') }}">
                            <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" autocomplete="email" placeholder="Email" required="yes">
                            <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" autocomplete="current-password" placeholder="Password" id="id_reg" required="yes">
                            <i class="far fa-eye" id="toggleReg" style="cursor: pointer;"></i>
                            <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                        </div>

                        <label class="check">
                            <input type="checkbox" checked="checked">
                            <span class="checkmark">I accept the <a href="terms.html">terms and services</a></span>
                        </label>
                        <input type="submit" value="Create account" class="btn solid">

                    </form>
                </div>
            </div>
            <div class="panels-container">
                <div class="panel left-panel">
    
                
                    <div class="content">
                    <h3><img src="{{ URL::asset('images/umat_logo.png') }}" width="150"></h3>
                    <!-- <h3>You don't have an account?</h3> -->

                    <!-- <p>Create your account right now to follow people and like publications</p> -->
                    <p>Log In to Generate Timetables effectively and efficiently</p>
                    <!-- <button class="btn transparent" id="sign-up-btn">Register</button> -->
                    </div>
                    <img src="img/logo.svg" class="image" alt="">
                </div>
            

                <div class="panel right-panel">
                    <div class="content">
                        <h3>Already have an account?</h3>
                        <p>Login to see your notifications and post your favorite photos</p>
                        <button class="btn transparent" id="sign-in-btn">Sign in</button>
                    </div>
                    <img src="img/register.svg" class="image" alt="">
                </div>
            </div>

        </div>
        <script src="{{ URL::asset('js/login.js'); }}"></script>
    </body>
</html>