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
        $randomNumbers = [];
        for($index = 1; $index <= $this->count; $index++){
            $randomNumbers[] = [$index, $this->getRandomNumber()];
        }
        return new Collection($randomNumbers);
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
