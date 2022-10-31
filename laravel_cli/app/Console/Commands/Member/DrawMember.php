<?php

namespace App\Console\Commands\Member;

use App\Services\MemberService;
use Illuminate\Console\Command;

class DrawMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:draw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '멤버를 추첨합니다.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(MemberService $memberService)
    {
        $this->info("\"".$memberService->draw()."\"가 당첨되었습니다.");
        return Command::SUCCESS;
    }
}
