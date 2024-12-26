<?php
/**
 * 안심번호050 헬퍼
 */

use Config\Services;
// 공통 API
function callRegAuto050Api($post = [], $path = '', $method = 'POST'): array
{
    $client = Services::curlrequest();
    $host = REST050_BIZ_HOST . '/' . $path;

    try {
        // 기본 헤더 설정
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . REST050_BIZ_TOKEN,
        ];

        if ($method === 'GET') {
            $response = $client->get($host, [
                'headers' => $headers,
                'query' => $post,
                 'debug' => true,  // 디버그 모드 활성화 (디버깅시에만 확인, 설정시 화면에 노출됨)
                 'http_errors' => false
            ]);

        } else {
            $response = $client->post($host, [
                'headers' => $headers,
                'json' => $post
            ]);
        }

        $body = $response->getBody();

        if (isJsonString($body)) {
            return json_decode($body, true);

        } else {
            return ['resultCode' => '9991', 'resultMsg' => '서버와의 통신에 실패했습니다.<br>잠시 후 다시 시도해 주세요.'];
        }

    } catch (\Exception $e) {
        // 예외 발생 시 로그에 기록
        log_message('error', 'API 호출 중 오류 발생: ' . $e->getMessage());
        return ['resultCode' => '9992', 'resultMsg' => '서버와의 통신에 실패했습니다.<br>잠시 후 다시 시도해 주세요.'];
    }
}

// 서비스 조회
//https://050api-cbt.sejongtelecom.net:8443/050biz/v1/service/
function serviceCheck($vno = ''): array
{
    // vno를 URL 경로에 포함
    $path = '050biz/v1/service/' . $vno;

    // GET 요청으로 API 호출
    return callRegAuto050Api([], $path, 'GET');
}

// 050 CDR 조회
function cdrInquiry($sdate = '', $edate = '', $vno = ''): array
{
    $path = '050biz/v1/cdr';

    $param = [
        'sDate' => $sdate, // 조회 시작일
        'eDate' => $edate, // 조회 종료일
        'pageNum' => 1, // 페이지 번호
        'perPage' => 10, // 페이지당 갯수
        'order' => 'D'
    ];
    // $vno가 비어 있지 않으면 'callingNum' 추가
    if ($vno != '') {
        $param['callingNum'] = $vno; // 발신자
    }

    return callRegAuto050Api($param, $path, 'GET');
}
