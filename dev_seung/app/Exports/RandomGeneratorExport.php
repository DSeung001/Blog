<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class RandomGeneratorExport implements FromCollection
{
    private $length, $count, $source;

    /**
    * @param $length int 문자길이
    * @param $count int 난수 개수
    * @param $source string 난수에 사용할 재료
    */
    public function __construct($length = 8, $count = 10, $source = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'){
        $this->length = $length;
        $this->count = $count;
        $this->source = $source;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // 대용량 데이터도 만들기 위해 제한을 임시로 풀었습니다.
        ini_set('max_execution_time', '300');
        ini_set('memory_limit','-1');

        $randomNumbers = [];
        $count = 0;

        // 중복이 없으면 통과
        while ($count != $this->count) {
            $randomNumbers = [];
            // $this->count와 이 메소드 내에 지역 변수 $count는 다릅니다.
            for ($index = 0; $index < $this->count; $index++) {
                $randomNumbers[] = $this->getRandomNumber();
            }
            $randomNumbers = array_unique($randomNumbers);
            $count = count($randomNumbers);
        }

        $result = [];
        // 번호 저장 제거
        foreach ($randomNumbers as $index => $randomNumber){
            $result[] = [$randomNumber];
        }
        return new Collection($result);
    }

    /**
     * 랜덤 난수 생성
     * @return string
     */
    public function getRandomNumber(){
        $result = '';
        for($index = 0; $index < $this->length; $index++){
            $result .= str_shuffle($this->source)[0];
        }
        return $result;
    }
}
