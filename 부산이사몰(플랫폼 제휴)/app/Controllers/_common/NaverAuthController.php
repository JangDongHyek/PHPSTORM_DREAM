<?php

namespace App\Controllers\_common;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

class NaverAuthController extends Controller
{
    protected string $loginUrl;
    protected string $callbackURI;
    protected string $tokenCallbackURI;

    public function __construct()
    {
        $this->loginUrl = base_url() . 'login';
        // 로그인 콜백 uri (네아로 API 설정값)
        $this->callbackURI = base_url() . 'api/loginCallback/naver';
        // 접속토큰 콜백 uri
        $this->tokenCallbackURI = base_url() . 'tokenCallback/naver';
    }

    // 1 네이버 로그인 요청
    public function naverLogin(): RedirectResponse
    {

        $session = session();
        $get = $this->request->getGet();

        // 로그인 후 이동할 페이지
        $session->set('login_referrer', $get['ref'] ?? '');

        // 사이트간 위조방지 체크용
        $state = bin2hex(random_bytes(8));
        $session->set('oauth_state', $state);

        $param = http_build_query([
            'response_type' => 'code',
            'client_id' => NAVER_CLIENT_ID,
            'redirect_uri' => $this->callbackURI,
            'state' => $state,
        ]);

        return redirect()->to('https://nid.naver.com/oauth2.0/authorize?' . $param);
    }

    // 2 네이버 로그인 콜백
    public function loginCallback()
    {
        $get = $this->request->getGet();
        $code = $get['code'] ?? ''; // 네이버 인증성공시 인증코드 (1회성)
        $state = $get['state'] ?? '';
        $error = $get['error'] ?? '';

        // 연동 취소시
        if ($error == 'access_denied') {
            return redirect()->to(base_url('/login'));
        }

        $sessionState = session()->get('oauth_state');
        session()->remove('oauth_state');

        // 사이트간 위조방지 체크 실패
        if ($sessionState != $state) {
            session()->remove('oauth_state');
            $message = '네이버 로그인에 실패했어요.<br>잠시 후 다시 시도해 주세요.<br>(토큰 불일치)';
            return (new ErrorController())->errorMessage($message, $this->loginUrl);
        }

        return $this->getNaverAccessToken($code, $state);
    }

    // 3. 접속토큰 발급요청
    private function getNaverAccessToken($code, $state)
    {
        $client = Service('curlrequest');
        $host = 'https://nid.naver.com/oauth2.0/token';

        $data = [
            'grant_type' => 'authorization_code', // 발급
            'client_id' => NAVER_CLIENT_ID,
            'client_secret' => NAVER_SECRET,
            'redirect_uri' => $this->tokenCallbackURI,
            'code' => $code,
            'state' => $state,
        ];

        try {
            $client->timeout = 60;
            $response = $client->post($host, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => $data,
            ]);

            // API 응답
            $body = $response->getBody();
            $response = (isJsonString($body)) ? json_decode($body, true) : $body;
        } catch (\Exception $e) {
            $logMessage = sprintf(
                "Exception: %s in %s:%d\nStack trace:\n%s",
                $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString()
            );
            $response = $logMessage;
        }

        write_server_log(['auth' => 'naver 접속토큰요청', 'response' => $response], 'login-auth');

        if (empty($response['access_token'])) {
            $message = '네이버 로그인에 실패했어요.<br>잠시 후 다시 시도해 주세요.<br>(엑세스 토큰 에러)';
            return (new ErrorController())->errorMessage($message, $this->loginUrl);

        } else {
            return $this->getProfile($response['access_token']);
        }

    }

    // 4 프로필 API 호출 (사용자 고르인 정보 획득)
    protected function getProfile($accessToken)
    {
        $client = Service('curlrequest');
        $host = 'https://openapi.naver.com/v1/nid/me';

        try {
            $client->timeout = 60;
            $response = $client->post($host, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            // API 응답
            $body = $response->getBody();
            $response = (isJsonString($body)) ? json_decode($body, true) : $body;

        } catch (\Exception $e) {
            $logMessage = sprintf(
                "Exception: %s in %s:%d\nStack trace:\n%s",
                $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString()
            );
            $response = $logMessage;
        }

        write_server_log(['auth' => 'naver 프로필', 'response' => $response], 'login-auth');

        // $response['resultcode'] == '00' 성공
        $nid = $response['response']['id'] ?? ''; // 동일인 식별정보 (네이버 고유값)
        $gender = $response['response']['gender'] ?? ''; // 성별 (F,M, U:확인불가)

        if (empty($nid)) {
            $message = '네이버 로그인에 실패했어요.<br>잠시 후 다시 시도해 주세요.<br>(프로필 조회 실패)';
            return (new ErrorController())->errorMessage($message, $this->loginUrl);

        } else {
            // 로그인 or 회원가입이동 처리
            $etc = ['gender' => $gender];
            return (new AccountController())->handleSocialLogin('N', $nid, $etc, $response['response']);
        }
    }

}