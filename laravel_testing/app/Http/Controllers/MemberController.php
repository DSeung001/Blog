<?php

namespace App\Http\Controllers;

use App\Http\Traits\MemberTrait;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MemberController extends Controller
{
    use MemberTrait;

    private Member $member;

    public function __construct(Member $member){
        $this->member = $member;
    }

    public function index(){
        return view('index')->with('list', $this->member->all());
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required'
        ]);
        $this->member->create($validated);
        return redirect('/');
    }

    public function draw(){
        return view('draw')->with('member', $this->getMemberDraw());
    }
}
