<h1>😹Catmento</h1>
<br>
<h3 align="center">고양이 멘토가 멘티들에게 익명 멘토링을 해주는 서비스</h3>
<br>

## ⚙️ Stacks
- PHP 8.2.12
- Laravel Framework 10.33.0
- MySQL/MariaDB 10.4.32
- VSCode
<br>

## 🔍 Pages
|메인게시판|소셜로그인|
|:---:|:---:|
|<img width="100%" src="https://github.com/bokyeongkk/catmento/assets/69511656/55cfa390-e700-4e0d-a3ae-e982a1e6925a"/>|<img width="100%" src="https://github.com/bokyeongkk/catmento/assets/69511656/d3b38062-f0f6-45fa-885c-41fda677c8b3"/>|
|**회원가입 추가정보 수집**|**질문 작성**|
|<img width="100%" src="https://github.com/bokyeongkk/catmento/assets/69511656/8b3a752c-007e-47b0-9d4a-9c52ee6214d7"/>|<img width="100%" src="https://github.com/bokyeongkk/catmento/assets/69511656/bc119efb-2cb9-4b10-83e6-76a05c1ec0a5"/>|
|**질문 상세**|**답변 상세**|
|<img width="100%" src="https://github.com/bokyeongkk/catmento/assets/69511656/d9242dd9-e175-497a-8c78-00c6123b8fc0"/>|<img width="100%" src="https://github.com/bokyeongkk/catmento/assets/69511656/453acd5c-83b5-4810-bf13-fa7728d901a2"/>|
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

  
