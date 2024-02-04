<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Common\Vars;

class PostController extends Controller
{
    private $question;
    private $answer;

    public function __construct(question $question, answer $answer){
        $this->question = $question;
        $this->answer = $answer;
    }

    /**
     *  목록 페이지
     */
    public function index(){

        $questions = DB::table('questions')
            ->join('users', 'questions.user_id', '=', 'users.id')
            ->select('questions.*', 'users.name as user_name', 'users.kind as user_kind')
            ->where('questions.activated', 'Y')
            ->latest()->paginate(6);

        $arrCatKind = Vars::$arrCatKind;

        return view('posts.index', compact('questions', 'arrCatKind'));
    }

    /**
     *  상세 페이지
     */
    public function show(Question $question){

        $questions = DB::table('questions')
            ->join('users', 'questions.user_id', '=', 'users.id')
            ->select('questions.*', 'users.name as user_name', 'users.kind as user_kind')
            ->where([['questions.activated', 'Y'],['questions.id', $question->id]])
            ->first();    

        $answers = DB::table('answers')
            ->join('users', 'answers.user_id', '=', 'users.id')
            ->select('answers.*', 'users.name as user_name', 'users.kind as user_kind')
            ->where([['answers.activated', 'Y'],['question_id', $question->id]])
            ->orderBy('id', 'desc')
            ->get();

        $count = DB::table('answers')
            ->join('users', 'answers.user_id', '=', 'users.id')
            ->select('answers.*')
            ->where([['answers.activated', 'Y'],['question_id', $question->id]])
            ->count();

        $arrWorryCategory = Vars::$arrWorryCategory;
        $arrCatKind = Vars::$arrCatKind;
    
        return view('posts.show', compact('questions', 'answers', 'count', 
                                            'arrWorryCategory', 'arrCatKind'));
    }

    /**
     *  질문 작성
     */
    public function write(){
        $arrWorryCategory = Vars::$arrWorryCategory;
        return view('posts.write', compact('arrWorryCategory'));
    }

    /**
     *  질문 등록
     */
    public function store(Request $request){
        $request = $request->validate([
            'title' => 'required',
            'content' => 'required|max:255',
            'category' => 'required'
        ]);

        Question::create([
            'user_id' => Auth::user()->id,
            'title' => request()->title,
            'content' => request()->content,
            'category' => request()->category,
            'activated' => 'Y'
        ]);

        return redirect()->route('posts.index');
    }

    /**
     *  질문 수정
     */
    public function edit(Question $question){
        return view('posts.edit', compact('question'));
    }

    public function update(Request $request, Question $question){
        $request = $request->validate([
            'category' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);
    
        $question->update($request);
        return redirect()->route('questions.index', $question);
    }

    /**
     *  질문 삭제
     */
    public function destroy(Question $question){
        $query = DB::table('questions')
                    ->where('id', $question->id)
                    ->update(['activated' => 'N']);

        return redirect()->route('posts.index');
    }
}
