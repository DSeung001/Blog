<?php

namespace Database\Seeders;

use App\Models\Code;
use Illuminate\Database\Seeder;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 테이블 초기화
        Code::truncate();

        // 읽을 파일 명
        $fileName = "random_number_2022-09-07.csv";
        $csvFile = fopen(base_path("database/csv/$fileName"), "r");
        // ','를 기준으로 데이터 분리
        while (($data = fgetcsv($csvFile, null, ",")) != false) {
            // 분리한 데이터로 데이터 저장
            Code::create([
                "code" => $data[0],
                "used" => "N"
            ]);
        }
        fclose($csvFile);
    }
}
