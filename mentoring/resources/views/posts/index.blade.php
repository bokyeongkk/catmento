@extends('layouts.layout')

@section('content')
<div class="wrapper_content" style="background-color: #ffffff;">
    <div style="margin-top: 50px; height: 320px; text-align: center;" >
    <table class="table table-striped table-hover" style="table-layout:fixed;">
        <colgroup>
            <col width="8%"/>
            <col width="25%"/>
            <col width="30%"/>
            <col width="20%"/>
            <col width="17%"/>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">번호</th>
            <th scope="col">제목</th>
            <th scope="col">내용</th>
            <th scope="col">작성날짜</th>
            <th scope="col">품종</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($questions as $key => $question)
            <tr>
                <td scope="row">{{$key+1 + (($questions->currentPage()-1) * 6)}}</td>
                <td>{{$question->title}}</td>
                <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                    <a style="color: black; text-decoration: none;" href="{{route("posts.show", $question->id)}}">{{$question->content}}</a>
                </td>
                <td>{{$question->created_at}}</td>
                <td>{{$arrCatKind[$question->user_kind]}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>

    {{-- 질문 등록 (비회원 접속 불가능) --}}
    @auth()
    <div style="margin: 10px; text-align: left;">
        <a href="{{route("posts.write")}}">
            <button type="button" class="btn btn-outline-primary">고민나누기</button>
        </a>
    </div>
    @endauth

    <div style="margin: 10px;">
        {{-- Laravel Pagination --}}
        {!! $questions->links() !!}
    </div>
</div>
@endsection