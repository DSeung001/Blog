<?php

namespace Tests\Feature;

use App\Http\Traits\MemberTrait;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberTest extends TestCase
{
    use MemberTrait;

    // 이거 쓰면 테스트시 연결된 DB 초기화
    use RefreshDatabase;

    public function test_member_unique_check()
    {
        $memberNames = (new Member)->pluck('name')->toArray();
        $this->assertTrue(
            count($memberNames) == count(array_unique($memberNames))
        );
    }

    public function test_member_factory(){
        $count1 = (new Member)->all()->count();
        \Log::info($count1);
        Member::factory()->create();
        $count2 = (new Member)->all()->count();
        \Log::info($count2);
        $this->assertTrue($count1+1 == $count2);
    }

    public function test_member_draw(){
        Member::factory()->count(5)->create();
        $memberDraw = $this->getMemberDraw();
        $member = Member::where('name', '=', $memberDraw)->first();
        $this->assertTrue($member != null);
    }
}
