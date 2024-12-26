<?php
/**
 * 암호화 헬퍼
 * 암호화 키는 Config/Encryption.php 변수 $key 에서 설정
 */

use Config\Services;

if (!function_exists('encryptData')) {
    function encryptData($data, $isCompress = false)
    {
        $encrypter = service('encrypter');

        // if ($isCompress) $data = gzcompress($data);

        $encryptedData = $encrypter->encrypt($data);
        return base64_encode($encryptedData);
    }
}

if (!function_exists('decryptData')) {
    function decryptData($data)
    {
        $encrypter = Services::encrypter();
        $decodedData = base64_decode($data);
        return $encrypter->decrypt($decodedData);
    }
}
