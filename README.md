<h1>😹Catmento</h1>
<br>
<div align="center">
  <img width="40%" src="https://github.com/bokyeongkk/comento/assets/69511656/e9e68784-1c62-4029-b2df-ae47ccfd0d6e" alt="roobits">
</div>
<h3 align="center">고양이 멘토가 멘티들에게 익명 멘토링을 해주는 서비스</h3>
<br>

## ⚙️ Stacks
- PHP 8.2.12
- Laravel Framework 10.33.0
- MySQL/MariaDB 10.4.32
- VSCode
<br>

## 🔍 Pages
|메인|소셜로그인|
|:---:|:---:|
|<img width="100%" src="https://github.com/bokyeongkk/comento/assets/69511656/ebfb919e-d291-497a-bf82-487a6d066f6c"/>|<img width="100%" src="https://github.com/bokyeongkk/comento/assets/69511656/8ded6b42-7f4d-4e42-b0f9-df0c8a34671f"/>|
|**회원가입 추가정보 수집**|**질문 작성**|
|<img width="100%" src="https://github.com/bokyeongkk/comento/assets/69511656/1e7c65f8-4096-4183-ac0d-975c41a118aa"/>|<img width="100%" src="https://github.com/bokyeongkk/comento/assets/69511656/b109ee8d-8ac7-4097-8b30-fb3ab5645975"/>|
|**질문 상세**|**답변 상세**|
|<img width="100%" src="https://github.com/bokyeongkk/comento/assets/69511656/f995799a-fe74-44ed-bafd-30a285c66c2d"/>|<img width="100%" src="https://github.com/bokyeongkk/comento/assets/69511656/681ceba0-f9a2-46a1-b507-bb2c1d04a62c"/>|
<br>



## ✨ Features

### 질문 리스트 페이징 적용 - 6개
- 라라벨 페이지네이션(Pagination) 사용
  
```php
    $questions = DB::table('questions')
        ->join('users', 'questions.user_id', '=', 'users.id')
        ->select('questions.*', 'users.name as user_name', 'users.kind as user_kind')
        ->where('questions.activated', 'Y')
        ->latest()->paginate(6);
```

```html
    <div>
        {!! $questions->links() !!}
    </div>
```

### 답변 작성 조건
- 라라벨 인증(Auth) 기능 사용

```html
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
```

### 고양이 품종 정보, 질문 카테고리 확장성 고려
- 배열 변수 클래스 생성

```php
class Vars
{
    /**
     * 질문 카테고리
     *
     * @var array
     */
    public static $arrWorryCategory = Array(
        "caregiver" => "집사 고민", 
        "food"=> "사료 고민",
        "grooming"=> "그루밍"
    );
}
```

```html
<select class="form-select" aria-label="Default select example" name="category">
    <option selected>카테고리 선택하기</option>
    @foreach($arrWorryCategory as $key => $val)
    <option value="{{ $key }}">{{ $val }}</option>
    @endforeach 
</select>
```

  
