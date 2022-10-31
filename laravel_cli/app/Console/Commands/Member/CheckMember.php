<?php

namespace App\Console\Commands\Member;

use App\Services\MemberService;
use Illuminate\Console\Command;

class CheckMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:check {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '입력한 멤버가 있는 지 확인합니다.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(MemberService $memberService)
    {
        $name = $this->argument('name');
        $this->info($memberService->check($name) ? "\"$name\"은 존재합니다." :  "\"$name\"은 존재하지 않습니다.");
        return Command::SUCCESS;
    }
}
