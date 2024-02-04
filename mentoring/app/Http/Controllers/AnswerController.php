<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{
    private $answer;

    public function __construct(answer $answer){
        $this->answer = $answer;
    }

    /**
     *  답변 등록
     */
    public function store(Request $request)
    {
        $request = $request->validate([
            'question_id' => 'required',
            'content' => 'required|max:255'
        ]);

        Answer::create([
            'user_id' => Auth::user()->id,
            'question_id' => request()->question_id,
            'content' => request()->content,
            'adoption' => 'N',
            'activated' => 'Y'
        ]);
            
        return redirect()->back();
    }

    /**
     *  답변 채택
     */
    public function pick(Answer $answer){

        $query = DB::table('answers')
                ->where('id', $answer->id)
                ->update(['adoption' => 'Y']);

        return redirect()->back();
    }

    /**
     *  답변 수정
     */
    public function update(Answer $answer){

    }

    /**
     *  답변 삭제
     */
    public function delete(Answer $answer){

        // 채택 여부 확인
        $query = DB::table('answers')->where('id', '=', $answer->id)->first();
        $adoption = $query->adoption;

        Log::info("adoption : ".$adoption);

        // 답변이 채택된 경우 삭제 불가
        if($adoption=='Y'){
            $message = "N";
        }else {
            $message = "Y";

            $query = DB::table('answers')
                ->where('id', $answer->id)
                ->update(['activated' => 'N']);
        }

        Log::info("message : ".$message);

        return response()
            ->json(['message' => $message]);
    }

}
