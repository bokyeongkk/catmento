@extends('layouts.layout')

@section('content')
<div class="wrapper_content" style="background-color: #ffffff;">
    <div style="margin-top: 80px; padding-left: 100px; padding-right: 100px;">
        <hr>

        {{-- 질문 정보 (제목, 내용, 작성날짜, 품종정보) --}}
        <div>
            <h3>[{{$arrWorryCategory[$questions->category]}}] {{$questions->title}}</h3>
            <span style="color: #0174DF">
                {{$questions->user_name}} ({{$arrCatKind[$questions->user_kind]}})
            </span> 
        </div>

        <div style="text-align: right;">

            <span style="color: gray;">{{$questions->created_at}}</span> &nbsp;&nbsp;
            <a class="btn btn-outline-secondary" href="{{route("posts.edit", $questions->id)}}">수정</a>
            <form action="{{route('posts.delete', $questions->id)}}" method="post" style="display:inline-block;">
                @csrf
                <input onclick="return confirm('정말로 삭제하겠습니까?')" class="btn btn-outline-secondary" type="submit" value="삭제"/>
            </form>
        </div>

        <div class="border border-secondary border-2" style="height:130px; margin-top:10px; padding:10px;">
            {{$questions->content}}
        </div>

        <hr>

        {{-- 답변 작성 (비회원 접속 불가능) --}}
        {{-- 멘토 유저(고양이)만 작성, 답변이 3개 이상 달린 경우 작성 불가 --}}
        @auth()
        @if(Auth::user()->type=='mento' && $count<3)
            <div>
                <form method="post" action="{{route('answers.store')}}">
                    @csrf
                    <input type="hidden" name="question_id" value="{{$questions->id}}">
                    <textarea name="content" class="border border-primary border-1" style="width: 605px; height:70px; vertical-align:middle; resize: none;"></textarea>
                    <input type="submit" value="작성하기" class="btn btn-primary" style="height:70px; vertical-align:middle;">
                </form>
            </div>
        @endif
        @endauth

        <hr>

        {{--  답변 정보 (내용, 채택 여부, 날짜, 유저 정보(품종)) --}}
        <div class="">
            @foreach($answers as $answer)
                <div>
                    <div style="text-align: right;">
                        <span style="color: gray;">{{$answer->created_at}}</span> &nbsp;&nbsp;
                        <a class="btn btn-outline-primary" href="{{route("answers.update", $answer->id)}}">수정</a>
                        <!--
                        <form name="frm" action="{{route('answers.delete', $answer->id)}}" method="post" style="display:inline-block;">
                            @csrf
                            <input name="answer_id" type="hidden" value="{{$answer->id}}">                          
                        </form>
                        -->
                        <button value="{{$answer->id}}" class="del btn btn-outline-primary">삭제</button>         
                    </div>

                    {{-- 답변 채택 --}}
                    @if($answer->adoption=='Y')
                        <img src="/storage/image/cat_home.png" style="width:30px; height:30px; vertical-align:bottom;">
                        <b>채택된 답변</b>
                    @endif
                    @auth()
                    @if(Auth::user()->id==$questions->user_id)
                        <div>
                            @if($answer->adoption=='N')
                                <a style="color: #F7E600;" onclick="return confirm('이 답변을 채택하시겠어요?');"
                                href="{{route("answers.pick", $answer->id)}}"><b>마음에 드는 답변을 채택해주세요!</b></a>
                            @endif
                        </div>
                    @endif
                    @endauth
                    <div>
                        <span style="color: #0174DF">
                            {{$answer->user_name}} ({{$arrCatKind[$answer->user_kind]}})
                        </span>
                    </div>
                    <div style="color: gray;">
                        {{$answer->content}}
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>

    $(document).ready(function() {
        $('.del').on("click", function() {    
            //alert($(this).val());           
            let answer_id = $(this).val();

            $.ajax({
        	type : "GET",
            url : "/answers/delete/"+answer_id,
            success : function(response){
            	let message = response.message;

                if(message == 'N'){
                    alert("채택된 답변은 삭제하실 수 없습니다.");
                }else if(message == 'Y') {
                    alert('삭제 되었습니다.');
                }
            }
            })
        });
    });

</script>
@endsection