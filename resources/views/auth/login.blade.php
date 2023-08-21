<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url("backend/assets/vendor/bootstrap/css/bootstrap.min.css")}}">
    <link href="{{ url("backend/assets/vendor/fonts/circular-std/style.css")}}"  rel="stylesheet">
    <link rel="stylesheet" href="{{ url("backend/assets/libs/css/style.css")}}">
    <link rel="stylesheet" href="{{ url("backend/assets/vendor/fonts/fontawesome/css/fontawesome-all.css")}}">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 41px;
    }
    </style>
</head>

<body>

    
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center">
              
                <img src="" alt="logo" height="150" width="160">
            
            <span class="splash-description">Please enter your user information.</span>
            <span class="splash-description">To enter</span>
            <span class="splash-description">Name</span>
          
            </div>
            <div class="card-body">
            
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"  id="username" type="text" placeholder="Email Address" autocomplete="off">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Password" autocomplete="off">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
          
        </div>
    </div>
    
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="{{ url("backend/assets/vendor/jquery/jquery-3.3.1.min.js")}}"></script>
    <script src="{{ url("backend/assets/vendor/bootstrap/js/bootstrap.bundle.js")}}"></script>
</body>
 
</html>