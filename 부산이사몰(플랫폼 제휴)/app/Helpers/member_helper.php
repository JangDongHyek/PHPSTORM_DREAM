<?php
/**
 * 회원정보 관련 헬퍼
 */

// 이름 유효성 검사
function isValidMemberName($name): bool
{
    if (!preg_match('/^[가-힣]+$/', $name)) {
        return false;
    }

    // 단독으로 사용된 한글 자음 또는 모음 체크
    // 단순한 자음 및 모음 유니코드 범위: ㄱ-ㅎ(3131-314E), ㅏ-ㅣ(314F-3163)
    if (preg_match('/[\x{3131}-\x{314E}\x{314F}-\x{3163}]/u', $name)) {
        return false;
    }

    return true;
}

// 닉네임 유효성 검사 (한글,영문,숫자만 가능)
function isValidNickname($nickname): bool
{
    if (!preg_match('/^[가-힣a-zA-Z0-9]+$/', $nickname)) {
        return false;
    }

    // 단독으로 사용된 한글 자음 또는 모음 체크
    // 단순한 자음 및 모음 유니코드 범위: ㄱ-ㅎ(3131-314E), ㅏ-ㅣ(314F-3163)
    if (preg_match('/[\x{3131}-\x{314E}\x{314F}-\x{3163}]/u', $nickname)) {
        return false;
    }

    return true;
}

// 아이디 유효성 검사 (영문,숫자,언더바, 4자리이상)
function isValidMemberId($id): bool
{
    return preg_match('/^[a-z0-9_]{4,}$/', $id) === 1;
}

// 소셜로그인 아이디생성
function createUserId($snsType = ''): string
{
    return $snsType . date('ymdhis') . getRandomString(4);
}