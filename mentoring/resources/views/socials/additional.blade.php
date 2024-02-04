@extends('layouts.layout')

@section('content')
<div class="content_wrapper">
    {{-- 유효성 검사 --}}
    @if ($errors->any())
        <div class="alert alert-warning" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="margin-top: 120px; padding-left: 250px; padding-right: 250px; text-align: center;">
        <div style="margin-bottom: 20px;">
            <b>멘토링을 위한 추가 정보를 입력해주세요</b>
        </div>
        <form action="{{route('socials.register')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <div style="margin-top: 10px;">
                <select class="form-select" aria-label="Default select example" name="kind">
                    <option selected>품종</option>
                    @foreach($arrCatKind as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach 
                </select>
            </div>
            <div style="margin-top: 10px;">
                <select class="form-select" aria-label="Default select example" name="age">
                    <option selected>나이</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                </select>
            </div>
            <div style="margin-top: 25px; text-align: center;">
                <button type="submit" class="btn btn-primary">등록하기</button>
            <div>
        </form>
    </div>
</div>
@endsection