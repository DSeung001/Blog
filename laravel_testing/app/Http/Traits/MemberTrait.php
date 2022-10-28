<?php

namespace App\Http\Traits;

use App\Models\Member;
use Illuminate\Support\Arr;

trait MemberTrait {

    public  function getMemberDraw(){
        return Arr::random(Member::pluck('name')->toArray());
    }
}
