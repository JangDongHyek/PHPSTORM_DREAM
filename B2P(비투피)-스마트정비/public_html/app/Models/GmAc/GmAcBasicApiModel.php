<?php

namespace App\Models\GmAc;

use App\Services\JWTService;
use CodeIgniter\Model;
use Config\Services;

class GmAcBasicApiModel extends Model {

    // 지마켓 헤더 생성
    protected function creatHeader($api_type){
        $headers = [];
        if($api_type == GMAC || $api_type == GM || $api_type == AC){
            $headers['Authorization'] = 'Bearer ' .  JWTService::initGmAcJWT($api_type);
        }
        return $headers;
    }

    /**
     * 주어진 데이터를 기반으로 API 호출을 수행합니다.
     *
     * @param array $data {
     *     @type string 'api_url'    호출할 URL.
     *     @type string 'api_method' 사용할 HTTP 메소드 (예: GET, POST).
     *     @type string 'api_type'   헤더를 결정할 API 타입 (예: 모두 GMAC, 지마켓만 GM, 옥션만 AC).
     *     @type array  'api_data'   선택 사항. 요청과 함께 전송할 데이터.
     * }
     *
     * @return array {
     *     @type string 'body'      응답 본문.
     *     @type int    'code'      HTTP 상태 코드.
     * }
     */
    public function callApi($data){
        $curl = curl_init();

        // HTTP 헤더 설정
        $headers = $this->creatHeader($data['api_type']);
        $headerArray = [];

        if (!empty($data['api_data'])) {
            $headerArray[] = 'Content-Type: application/json';
        }

        foreach ($headers as $key => $value) {
            $headerArray[] = $key . ': ' . $value;
        }

        $options = [
            CURLOPT_URL => $data['api_url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => $data['api_method'],
            CURLOPT_HTTPHEADER => $headerArray
        ];

        if (!empty($data['api_data'])) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data['api_data']);
        }

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        // 결과를 객체나 배열로 반환
        return [
            'header' => $headerArray,
            'api_data'=>$data,
            'body' => $response,
            'code' => $statusCode
        ];
    }

    /**
     * 지정된 필드에 따라 API 데이터를 생성합니다.
     *
     * 이 함수는 연관 배열($data)과 필드 배열($fields)을 입력받아,
     * $fields에 정의된 키에 해당하는 값을 $data에서 찾아 $api_data 배열에 채웁니다.
     *
     * @param array $data 입력 데이터 배열
     * @param array $fields 추출할 필드 배열
     * @return array 지정된 필드로 채워진 API 데이터 배열
     */
    function createApiData(array $data, array $fields)
    {
        $api_data = [];

        foreach ($fields as $key) {
            if (isset($data[$key])) { // $data에 해당 키가 존재하는지 확인
                $api_data[$key] = $data[$key];
            }
        }

        return $api_data;
    }


}
