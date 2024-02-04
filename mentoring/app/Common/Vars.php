<?php
namespace App\Common;

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

    /**
     * 고양이 품종
     *
     * @var array
     */
    public static $arrCatKind = array(
        "munchkin"=> "먼치킨",
        "korean shorthair" => "코리안 숏헤어", 
        "russian blue"=> "러시안 블루",
        "persian"=> "페르시안",
        "ragdoll"=> "랙돌",
        "american shorthair"=> "아메리칸 숏헤어",
        "devon rex"=> "데본 렉스",
        "etc"=> "기타"
    );

}

?>