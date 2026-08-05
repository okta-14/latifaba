<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin</title>

    <link rel="stylesheet" href="{{ asset('css/frontend/login.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

<div class="login-page">

    <div class="login-card">

        <div class="shape shape-top"></div>
        <div class="shape shape-bottom"></div>

        <div class="login-content">

            <div class="login-title">

                <h1>Hello There,</h1>

                <p>Welcome Back!</p>

            </div>

            @if(session('error'))
                <div class="error-box">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">

                @csrf

                <div class="input-group">

                    <i class="fas fa-user"></i>

                    <input
                        type="text"
                        name="username"
                        placeholder="Username"
                        value="{{ old('username') }}"
                        required>

                </div>

                <div class="input-group">

                    <i class="fas fa-lock"></i>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Password"
                        required>

                    <button type="button" class="toggle-password">

                        <i class="fas fa-eye" id="eye"></i>

                    </button>

                </div>

                <button type="submit" class="login-btn">

                    Sign In

                </button>

            </form>

        </div>

    </div>

</div>

<script>

const eye = document.getElementById("eye");
const password = document.getElementById("password");

eye.parentElement.onclick = function(){

    if(password.type==="password"){

        password.type="text";

        eye.classList.replace("fa-eye","fa-eye-slash");

    }else{

        password.type="password";

        eye.classList.replace("fa-eye-slash","fa-eye");

    }

}

</script>

</body>
</html>