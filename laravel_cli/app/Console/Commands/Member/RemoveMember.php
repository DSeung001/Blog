<?php

namespace App\Console\Commands\Member;

use App\Services\MemberService;
use Illuminate\Console\Command;

class RemoveMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '전체 멤버 중 원하는 멤버를 삭제합니다.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(MemberService $memberService)
    {
        $memberList = $memberService->list('name');
        $removeName = $this->choice(
          '누굴 삭제하겠습니까?',
            $memberList
        );
        $this->info($memberService->remove($removeName) ? "\"$removeName\"를 지웠습니다." :  "\"$removeName\"을 지우는데 실패했습니다..");
        return Command::SUCCESS;
    }
}
