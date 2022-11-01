<?php

namespace App\Console\Commands;

use App\Services\BackupService;
use Illuminate\Console\Command;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '현재 저장된 멤버에 대해 백업파일을 생성합니다.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(BackupService $backupService)
    {
        $this->info($backupService->backup());
        return Command::SUCCESS;
    }
}
