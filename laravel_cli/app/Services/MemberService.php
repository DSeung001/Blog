<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Arr;

class MemberService
{
    private Member $member;

    public function __construct(Member $member){
        $this->member = $member;
    }

    /**
     * 임의로 멤버로를 추가하거나, 랜덤으로 멤버를 추가합니다.
     * @param $name
     * @return string
     */
    public function insert($name = null){
        if (isset($name)) {
            $this->member->create(['name' => $name]);
        } else {
            $name = fake()->name();
            $this->member->create(['name' => $name]);
        }
        return $name;
    }

    /**
     * 멤버 리스트(ID, 이름)를 가져옵니다, 옵션에 따라 이름만 가져올 수 있습니다.
     * @param $option
     * @return array
     */
    public function list($option = null){
        if(isset($option) && $option == 'name'){
            return $this->member->pluck('name')->toArray();
        }
        return $this->member->all(['id', 'name'])->toArray();
    }

    /**
     * 파라미터로 넘어온 이름을 가진 멤버가 있는 지 확인합니다.
     * @param $name
     * @return bool
     */
    public function check($name){
        return $this->member->where("name", $name)->first() !== null;
    }

    /**
     * 현재 저장된 멤버 중에서 무작위 한명을 추첨합니다.
     * @return string
     */
    public function draw(){
        return Arr::random($this->member->pluck('name')->toArray());
    }

    /**
     * 선택한 이름을 가진 멤버를 삭제합니다.
     * @param $name
     * @return bool
     */
    public function remove($name){
        return $this->member->where(['name' => $name])->delete();
    }
}
