<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailSendRequest;
use App\Mail\Email;
use App\Models\EmailHistory;
use Illuminate\Support\Facades\Mail;

class EmailHistoryController extends Controller
{
    private $emailHistory;

    // 의존성 주입
    public function __construct(EmailHistory $emailHistory)
    {
        $this->emailHistory = $emailHistory;
    }

    public function emailSend(EmailSendRequest $request){
        // 유효성 검사 오류시 422 상태 코드로 반환
        $validator = $request->safe()->all();

        // 이력 저장
        $emailHistory = $this->emailHistory->create(
            $validator
        );

        // 저장 성공시 이메일 발송
        if($emailHistory){
            Mail::to($validator['email'])->send(new Email($emailHistory));
            // 성공시 success section 으로 성공 문자 전달
            return redirect()->back()
                ->with([
                    'success' => '이메일을 성공적으로 발송했습니다.'
                ]);
        }
    }
}
