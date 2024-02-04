<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Common\Vars;


class SocialController extends Controller
{
    public function login(){
        return view('socials.login');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('posts.index');
    }

    public function redirect($provider) {
        // redirect 메소드 : 사용자를 OAuth 공급자의 페이지로 리디이렉션하는 작업 처리
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        try{        
            // user 메소드 : 유입되는 요청을 읽어들여 인증을 처리한 뒤에 공급자로부터 사용자 정보 조회
            $userInfo = Socialite::driver($provider)->stateless()->user();
        }catch(\Exception $e) {
            Log::error($e);
            return redirect()->route('posts.index');
        }

        // user 찾기
        $user = User::where([
            'email'=> $userInfo->getEmail(),
            'activated' => 'Y'
        ])->first();

        if(!$user){
            if($userInfo->getNickname()) {
                $name = $userInfo->getNickname();
            }else {
                
                $name = $userInfo->getName();
            }

            $user = User::create([
                'name' => $name,
                'email' => $userInfo->email,
                'remember_token' => $userInfo->token,
                'type' => 'mentee',
                'activated' => 'Y'
            ]);
        }
     
        // 추가 정보 수집 검사
        $query = DB::table('users')->where('email', '=', $userInfo->email)->first();
        $id = $query->id;
        $kind = $query->kind;

        if(isset($kind)) {
            Auth::login($user);
            return redirect()->route('posts.index');
        } else {
            $arrCatKind = Vars::$arrCatKind;
            return view('socials.additional', compact('id'));
        }
    }

    public function additional(){
        return view('socials.additional');
    }

    public function register(Request $request)
    {
        $validation = $request -> validate([
            'kind' => 'required',
            'age' => 'required'
        ]);

        $user = User::where('id', $request->input('id')) -> first();
        $user -> kind = $validation['kind'];
        $user -> age = $validation['age'];
        $user -> save();

        Auth::login($user);
        return redirect()->route('posts.index');
    }
}