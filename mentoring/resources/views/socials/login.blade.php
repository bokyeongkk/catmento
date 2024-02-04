@extends('layouts.layout')

@section('content')
<div class="wrapper_content">
    <div style="padding-top: 100px; text-align: center;">
        <div style="margin: 15px;">
            <a href="/auth/kakao/redirect">
                <img style="width:220px; height:50px;" src="/storage/image/kakao_login_narrow_btn.png" style="">
            </a>
        </div>
        <div style="margin: 15px;">
            <a href="#">
                <img style="width:220px; height:50px;" src="/storage/image/naver_login_narrow_btn.png" style="">
            </a>
        </div>
        <div style="margin: 15px;">
            <a href="#">
                <img style="width:220px; height:50px;" src="/storage/image/google_login_narrow_btn.png" style="">
            </a>
        </div>
        <div style="margin: 15px;">
            <a href="#">
                <img style="width:220px; height:50px;" src="/storage/image/facebook_login_narrow_btn.png" style="">
            </a>
        </div>
    </div>
</div>
@endsection
