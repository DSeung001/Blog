<?php

namespace App\Console\Commands\Member;

use App\Services\MemberService;
use Illuminate\Console\Command;

class InsertMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:insert {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Member 테이블에 신규 멤버를 추가합니다.';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle(MemberService $memberService)
    {
        $name = $this->argument('name');
        $this->info("\"".$memberService->insert($name)."\"이 추가되었습니다.");
        return Command::SUCCESS;
    }
}
