<?php
//phpinfo();
function formatPhoneNumber($phone) {
    // 숫자만 남기기 (+, -, 공백 등 제거)
    $phone = preg_replace('/[^0-9]/', '', $phone);

    // +82 국가 코드 처리
    if (preg_match('/^82(10|1[1-9])/', $phone)) {
        $phone = '0' . substr($phone, 2); // 8210XXXXYYYY -> 010XXXXYYYY
    }

    // 010-XXXX-XXXX 형식으로 변환 (010, 011, 016, 017, 018, 019 지원)
    if (preg_match('/^(01[016789])(\d{4})(\d{4})$/', $phone, $matches)) {
        return $matches[1] . '-' . $matches[2] . '-' . $matches[3];
    }

    return $phone; // 변환되지 않는 경우 원본 유지
}

//echo formatPhoneNumber('821099098517');
?>