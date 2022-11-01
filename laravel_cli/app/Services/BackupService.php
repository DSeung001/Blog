<?php

namespace App\Services;

use Carbon\Carbon;

class BackupService
{
    public function backup(){
        $filePath = storage_path()."/app/backup/".Carbon::now()->format("Ymd-His")."-tables.sql";
        $user = env("DB_USERNAME");
        $password = env("DB_PASSWORD");
        $host = env("DB_HOST");
        $database = env("DB_DATABASE");

        /*
         * 아래 두 $command 변수를 순서대로 1번 2번이라고 칭하겠습니다.
         * */
//         $command = "mysqldump -u $user -p$password --host $host $database > $filePath";
        $command = "mysqldump --login-path=$user --host $host $database > $filePath";

        $output = null;
        exec($command, $output, $error);

        // exec 를 통해 에러가 발생하면 $error 변수에 에러코드가 담깁니다.
        if (isset($error) && $error > 0) {
            return "다음 에러코드가 발생했습니다, ERROR CODE : ".$error;
        }

        return $filePath."에 성공적으로 저장되었습니다.";
    }
}
