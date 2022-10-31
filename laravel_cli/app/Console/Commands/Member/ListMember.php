<?php

namespace App\Console\Commands\Member;

use App\Services\MemberService;
use Illuminate\Console\Command;

class ListMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '전체 멤버를 출력합니다.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(MemberService $memberService)
    {
        $this->table(
            ['ID', 'Name'],
            $memberService->list()
        );
        return Command::SUCCESS;
    }
}
