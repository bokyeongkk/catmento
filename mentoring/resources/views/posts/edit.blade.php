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

    <div style="margin-top: 60px; padding-left: 100px; padding-right: 100px;">
        <div style="margin-bottom: 20px;">
            <h4>고민이 있으신가요?</h4>
        </div>
        <form action="{{route('posts.update', $question)}}" method="post">
            @csrf
            @method('put')
            <div style="margin-top: 10px;">
                <select class="form-select" aria-label="Default select example" name="category" value="{{$question->category}}">
                    <option selected>카테고리 선택하기</option>
                    <option value="caregiver">집사 고민</option>
                    <option value="food">사료 고민</option>
                    <option value="grooming">그루밍</option>
                </select>
            </div>
            <div style="margin-top: 10px;">
                <label for="title" class="form-label">제목</label>
                <input type="text" name="title" class="form-control" id="name" autocomplete="off" maxlength='15' value="{{$question->name}}">
            </div>
            <div style="margin-top: 10px; ">
                <label for="content" class="form-label">내용</label>
                <textarea style="height: 150px; resize: none;" rows="10" cols="40" name="content" class="form-control" id="name" autocomplete="off">{{$question->content}}</textarea>
            </div>
            <div style="margin-top: 25px; text-align: center;">
                <button type="submit" class="btn btn-primary">등록하기</button>
                <a href="{{route("question.index")}}">
                    <button type="button" class="btn btn-primary">돌아가기</button>
                </a>
            <div>
        </form>
    </div>
</div>
@endsection