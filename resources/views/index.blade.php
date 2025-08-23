<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Dashboard IKU</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @vite('resources/css/app.css')
    <style>
        .input-field {
            position: relative;
        }

        .input-field i {
            position: absolute;
            left: 10px;
            top: 61%;
            transform: translateY(-50%);
            color: #ccc;
        }

        .input {
            width: 100%;
            padding-left: 40px;
        }

        .label {
            left: 40px;
        }
    </style>
</head>

<body>
    @if (!empty(session('error')))
        <script>
            swal("{{ Session::get('error.title') }}", "{{ Session::get('error.message') }}", "error", {
                button: true,
                button: "coba lagi",
            })
        </script>
    @endif
    @if (session('logout_success') && !Cookie::has('remember_web_'))
        <script>
            swal("Success logout", "{{ session('logout_success') }}", "success");
        </script>
    @endif
    <div class="main-bg m-0 p-0 w-full h-[100vh] absolute">
        <img src="{{ asset('assets/auth/BPS.jpg') }}" alt="BPS image"
            class= "object-cover w-full h-full filter brightness-50">
    </div>
    <div class="w-[100%] h-[100vh] flex justify-center items-center relative">
        <form action="{{ url('login_post') }}" method="post"
            class="form-control m-[20px] bg-[#fff] md:w-[70%] lg:w-[30%] flex justify-center flex-col gap-3 p-6 rounded-lg shadow-lg">
            {{ csrf_field() }}
            <div class="img-logo w-[80%] text-center">
                <img src="{{ asset('assets/auth/logo-auth.png') }}" alt="BPS logo image">
            </div>
            <div class="input-field relative w-full">
                <i class="fas fa-user"></i>
                <input required class="input" type="email" value="{{ old('email') }}" name="email" />
                <label
                    class="label absolute top-6 left-4 text-[#ccc] transition-all duration-300 ease-in-out pointer-events-none z-2"
                    for="input">Email</label>
            </div>
            <div class="input-field relative w-full">
                <i class="fas fa-lock"></i>
                <input required class="input" type="password" name="password" />
                <label
                    class="label absolute top-6 left-4 text-[#ccc] transition-all duration-300 ease-in-out pointer-events-none z-2"
                    for="input">Password</label>
            </div>
            <button type="submit" id="submit"
                class="submit-btn mt-8 h-11 bg-primary-600 rounded-lg border-none outline-none text-white text-lg font-medium shadow-lg transition-all duration-300 ease-in-out cursor-pointer ">Masuk</button>
        </form>
    </div>
</body>

</html>
