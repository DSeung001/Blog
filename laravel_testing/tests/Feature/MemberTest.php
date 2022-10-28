<?php

namespace Tests\Feature;

use App\Http\Traits\MemberTrait;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberTest extends TestCase
{
    use MemberTrait;

    // 이거 쓰면 시작과 끝에 데이터베이스 초기화
    use RefreshDatabase;

    /**
     * Member 테이블에 중복 데이터가 있는 지 체크합니다.
     * @return void
     */
    public function test_member_unique_check()
    {
        $memberNames = (new Member)->pluck('name')->toArray();
        // 중복 제거한 결과와 중복 제거하지 않은 결과의 수가 같으면 성공입니다.
        $this->assertTrue(
            count($memberNames) == count(array_unique($memberNames))
        );
    }

    /**
     * Factory로 데이터가 잘 추가되는 지 체크합니다.
     * @return void
     */
    public function test_member_factory(){
        $count1 = (new Member)->all()->count();
        Member::factory()->create();
        $count2 = (new Member)->all()->count();
        // Factory 로 값이 성공적으로 추가되서 아래 조건식이 참이면 성공입니다.
        $this->assertTrue($count1+1 == $count2);
    }

    /**
     * 이게 테스트의 의미에 가장 부합하는 테스트로 실제 사용 중인 기능을 테스트합니다.
     * @return void
     */
    public function test_member_draw(){
        // 5개의 더미 데이터 생성 후
        Member::factory()->count(5)->create();
        // MemberTrait 로 만든 기능을 실행합니다.
        $memberDraw = $this->getMemberDraw();
        // 나온 결과가 members 테이블에 있는지 확인합니다
        $member = Member::where('name', '=', $memberDraw)->first();
        // 결과가 있으면 성공입니다.
        $this->assertTrue($member != null);
    }
}
