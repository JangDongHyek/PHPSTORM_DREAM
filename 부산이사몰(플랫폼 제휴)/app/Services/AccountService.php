<?php

namespace App\Services;

use App\Models\MemberModel;
use Config\Services;

class AccountService
{
    //회원가입 유효성 검사
    public function validateMemberInfo($type, $arg1 = '', $arg2 = ''): string
    {
        switch ($type) {
            case 'duplicateId' :
                if ((new MemberModel())->checkDuplicateId($arg1) != 0) return '이미 등록된 아이디 입니다.';
                break;
        }

        return '';
    }

    //로그인시 회원정보 검사
    public function validateLogin($member = [], $password = null): string
    {
        // 1 탈퇴(삭제) 체크 TODO: 소셜로그인의 탈퇴 정의 필요
        if (!empty($member['left_at'])) {
            return '탈퇴 된 아이디 입니다.';
        }

        if ($member['state'] === 'W') {
            return '승인 대기 상태 입니다.';
        } elseif ($member['state'] === 'H') {
            return '승인 보류 상태 입니다.';
        } elseif ($member['state'] === 'S') {
            return '탈퇴 된 아이디 입니다.';
        }

        // 2 비밀번호 체크 (소설 로그인 아니면)
        if (!empty($password)) {
            $isPasswordValid = password_verify($password, $member['mb_password']);
            if (!$isPasswordValid) {
                return '아이디 또는 비밀번호를 잘못 입력했습니다.';
            }
        }
        return '';
    }

    //회원세션생성 & 로그인일자 업데이트
    public function createMemberSession($id = "", $log = true, $return = false)
    {
        $member = (new MemberModel())->getMemberById($id);

        // 회원정보 세션생성
        session()->set('member', $member);

        if ($return) return $member;
    }
}