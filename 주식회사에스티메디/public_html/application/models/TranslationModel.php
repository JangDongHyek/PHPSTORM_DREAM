<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Google Cloud TranslateClient 사용
use Google\Cloud\Translate\V2\TranslateClient;

class TranslationModel extends CI_Model
{
    private $translate;

    public function __construct()
    {
        parent::__construct();

        // 서비스 계정 JSON 파일 경로 설정
        $keyFilePath = '/path/to/your-service-account-key.json';

        // TranslateClient 초기화
        $this->translate = new TranslateClient([
            'keyFilePath' => $keyFilePath
        ]);
    }

    // 번역 함수
    public function translateText($text, $targetLanguage = 'ko')
    {
        // 텍스트 번역
        $result = $this->translate->translate($text, [
            'target' => $targetLanguage
        ]);

        return $result['text'];
    }

}