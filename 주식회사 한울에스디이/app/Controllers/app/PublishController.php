<?php

namespace App\Controllers\app;

use App\Controllers\BaseController;

class PublishController extends BaseController
{
    /**
     * 퍼블리싱 컨트롤러
     *
     */

    // 메인
    public function index(): string
    {
        $data = [
            'pid' => 'index',
        ];

        return render('app/index', $data);
    }

    // 로그인
    public function login(): string
    {
        $data = [
            'pid' => 'login',
        ];

        return render('/login', $data);
    }

    // 회원가입
    public function signUp(): string
    {
        $data = [
            'pid' => 'sign_up',
        ];

        return render('app/sign_up', $data);
    }

    // 아이디비밀번호 찾기
    public function findPw(): string
    {
        $data = [
            'pid' => 'find_pw',
        ];

        return render('app/find_pw', $data);
    }

    // 내정보 관리
    public function mypage(): string
    {
        $data = [
            'pid' => 'mypage',
        ];

        return render('app/mypage', $data);
    }

    // 프로젝트 관리
    public function project(): string
    {
        $data = [
            'pid' => 'project',
        ];

        return render('app/project', $data);
    }

    // 회사 공개 프로젝트
    public function publicProject(): string
    {
        $data = [
            'pid' => 'public_project',
        ];

        return render('app/public_project', $data);
    }

    // 직원관리
    public function employee(): string
    {
        $data = [
            'pid' => 'employee',
        ];

        return render('app/employee', $data);
    }


    // 종합공정
    public function overall(): string
    {
        $data = [
            'pid' => 'overall',
        ];

        return render('app/overall', $data);
    }

    // 작업관리 > 계획공정표
    public function schedule(): string
    {
        $data = [
            'pid' => 'schedule',
        ];

        return render('app/schedule', $data);
    }

    // 작업관리 > 계획공정표 테스트
    public function scheduleTest(): string
    {
        $data = [
            'pid' => 'schedule',
        ];

        return render('app/schedule_test', $data);
    }

    // 작업관리 > 주간공정표
    public function scheduleWeekly(): string
    {
        $data = [
            'pid' => 'schedule_weekly',
        ];

        return render('app/schedule_weekly', $data);
    }

    // 작업관리 > 금주작업
    public function weekTask(): string
    {
        $data = [
            'pid' => 'week_task',
        ];

        return render('app/week_task', $data);
    }

    // 기성관리
    public function payment(): string
    {
        $data = [
            'pid' => 'payment',
        ];

        return render('app/payment', $data);
    }

    // 내역관리 > 수량산출서
    public function record(): string
    {
        $data = [
            'pid' => 'record',
        ];

        return render('app/record', $data);
    }

    // 내역관리 > 내역서
    public function invoice(): string
    {
        $data = [
            'pid' => 'invoice',
        ];

        return render('app/invoice', $data);
    }

    // 내역관리 > 단가목록표
    public function priceList(): string
    {
        $data = [
            'pid' => 'price_list',
        ];

        return render('app/price_list', $data);
    }

    // 계정관리
    public function account(): string
    {
        $data = [
            'pid' => 'account',
        ];

        return render('app/account', $data);
    }

    // 파일함
    public function filebox(): string
    {
        $data = [
            'pid' => 'filebox',
        ];

        return render('app/filebox', $data);
    }

}