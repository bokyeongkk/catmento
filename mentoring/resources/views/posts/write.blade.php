@extends('layouts.layout')

@section('content')
<div class="wrapper_content" style="background-color: #ffffff;">
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

    <div style="margin-top: 70px; padding-left: 100px; padding-right: 100px;">
        <hr>
        <div style="margin-top: 20px; margin-bottom: 20px;">
            <h4>멘토링이 필요하신가요?</h4>
        </div>
        <form action="{{route('posts.store')}}" method="post">
            @csrf
            <div style="margin-top: 10px;">
                <select class="form-select" aria-label="Default select example" name="category">
                    <option selected>카테고리 선택하기</option>
                    @foreach($arrWorryCategory as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach 
                </select>
            </div>
            <div style="margin-top: 10px;">
                <label for="title" class="form-label">제목</label>
                <input type="text" name="title" class="form-control" id="name" autocomplete="off" maxlength='15'>
            </div>
            <div style="margin-top: 10px; ">
                <label for="content" class="form-label">내용</label>
                <textarea style="height: 150px; resize: none;" rows="10" cols="40" name="content" class="form-control" id="name" autocomplete="off"></textarea>
            </div>
            <div style="margin-top: 25px; text-align: center;">
                <button type="submit" class="btn btn-primary">등록하기</button>
            <div>
        </form>
        <hr>
    </div>
</div>
@endsection