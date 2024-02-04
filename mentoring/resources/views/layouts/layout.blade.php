<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <!--
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- Jquery CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <title>CatMento</title>

    <!-- Css Style -->
    <!--<link rel="stylesheet" href="css/app.css">-->
    <!--<link rel="stylesheet" href="{{ asset('css/app.css') }}" />-->

    <!-- Font Style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
</head>
<body>

<style>
    body {
        font-family: 'Noto Sans KR', sans-serif;
        background-color: #0174DF;
    }

    .body_wrapper{
        display: flex;
        justify-content : center;
        width: 100vw;
    }
    .wrapper{
        width: 70vw;
        background-color: #ffffff;
        height: 100vh;
    }

    a {
        text-decoration: none;
    }
    

</style>

<div class="body_wrapper">
    <div class="wrapper">
        @guest()
            <div style="margin: 10px; text-align: right;">
                <a style="color: gray;" href="{{route("login")}}">
                    회원가입/로그인
                </a>
            </div>
        @endguest
        @auth()
            <div style="margin: 10px; text-align: right;">
                <img src="/storage/image/cat.png" style="width:30px; height:30px; vertical-align:top;">
                <a style="display: inline-block; vertical-align:middle; color: gray;" href="#">{{Auth::user()->name}} 님</a>
                <form style="display: inline-block;" method="post" action="/auth/logout">
                    @csrf
                    <input type="submit" class="btn btn-light" value="로그아웃">
                </form>
            </div>
        @endauth
        <div style="margin: 50px ;">
            <div style="float:left; width: 40%; height:55px; text-align: right;">
                <img src="/storage/image/comento.jpg" style="width:50px; height:50px; vertical-align:bottom;">
            </div>
            <div style="float:left; height:55px; margin-left:10px;">
                <a style="vertical-align:top; font-size: 40px; color: #0174DF" href="{{route("posts.index")}}">Catmento</a>
            </div>
        </div>
        <div style="clear:both;"></div>
        @yield('content')
        @yield('javascript')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>