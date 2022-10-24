<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailSendRequest;
use App\Mail\Email;
use App\Models\EmailHistory;
use Illuminate\Support\Facades\Mail;

class EmailHistoryController extends Controller
{
    private $emailHistory;

    public function __construct(EmailHistory $emailHistory)
    {
        $this->emailHistory = $emailHistory;
    }

    public function emailSend(EmailSendRequest $request){

        // 유효성 검사 오류시 422 상태 코드로 반환
        $validator = $request->safe()->all();

        $emailHistory = $this->emailHistory->create(
            $validator
        );

        if($emailHistory){
            Mail::to($validator['email'])->send(new Email($emailHistory));
            return redirect()->back()
                ->with([
                    'success' => '이메일을 성공적으로 발송했습니다.'
                ]);
        }
    }
}
