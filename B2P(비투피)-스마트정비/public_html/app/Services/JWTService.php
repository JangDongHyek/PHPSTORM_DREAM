<?php

namespace App\Services;

use Firebase\JWT\JWT;

class JWTService {
    public static function initGmAcJWT($api_type = "") {
        // 키와 기타 JWT 관련 정보 설정
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;  // jwt 유효 시간 설정 (예: 1시간)
        $issuer = 'www.esmplus.com';

        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
            'kid' => 'b2pcorp' // ESM+ 마스터ID
        ];

        $ssi = 'A:b2pcorp,G:b2pcorp';
        if($api_type == GM){
            $ssi = 'G:b2pcorp';
        } else if($api_type == AC){
            $ssi = 'A:b2pcorp';
        }

        $payload = [
            'iss' => $issuer,
            'sub' => 'sell',
            'aud' => 'sa.esmplus.com',
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'ssi' => $ssi
        ];

        // JWT 토큰 생성 후 리턴
        return JWT::encode($payload, GMAC_KEY, 'HS256', $header['kid']);
    }
}
