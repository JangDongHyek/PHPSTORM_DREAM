<?php

namespace App\Controllers\_common;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

class KakaoAuthController extends Controller
{
    protected string $loginUrl;
    protected string $callbackURI;

    public function __construct()
    {
        $this->loginUrl = base_url().'login';
        // 로그인 콜백 uri (카카오 API 설정값)
        $this->callbackURI = base_url() . 'api/loginCallback/kakao';
    }

    // 1 카카오 로그인 요청
    public function kakaoLogin(): RedirectResponse
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
            'client_id' => KAKAO_CLIENT_ID, // 카카오 REST API 키
            'redirect_uri' => $this->callbackURI,
            'state' => $state,
        ]);

        return redirect()->to('https://kauth.kakao.com/oauth/authorize?' . $param);
    }

    // 2 카카오 로그인 콜백
    public function loginCallback()
    {
        $get = $this->request->getGet();
        $code = $get['code'] ?? ''; // 카카오 인증 성공시 인증코드 (1회성)
        $state = $get['state'] ?? '';
        $error = $get['error'] ?? '';

        // 연동 취소시
        if ($error == 'access_denied'){
            return redirect()->to(base_url('/login'));
        }

        $sessionState = session()->get('oauth_state');
        session()->remove('oauth_state');

        // 사이트간 위조방지 체크 실패
        if ($sessionState != $state) {
            session()->remove('oauth_state');
            $message = '카카오 로그인에 실패했어요.<br>잠시 후 다시 시도해 주세요.<br>(토큰 불일치)';
            return (new ErrorController())->errorMessage($message, $this->loginUrl);
        }

        return $this->getKakaoAccessToken($code, $state);
    }

    // 3 접속 토큰 발급요청
    private function getKakaoAccessToken($code, $state)
    {
        $client = service('curlrequest');
        $host = 'https://kauth.kakao.com/oauth/token';

        $data = [
            'grant_type' => 'authorization_code', // 발급
            'client_id' => KAKAO_CLIENT_ID,
            'redirect_uri' => $this->callbackURI,
            'code' => $code,
            'client_secret' => KAKAO_CLIENT_SECRET, // 필요시 설정
        ];

        try {
            $client->timeout = 60;$response = $client->post($host, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => $data,
            ]);

            // API 응답
            $body = $response->getBody();
            $response = (isJsonString($body)) ? json_decode($body, true) : $body;
        } catch (\Exception $e){
            $logMessage = sprintf(
                "Exception: %s in %s:%d\nStack trace:\n%s",
                $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString()
            );
            $response = $logMessage;
        }

        write_server_log(['auth' => '카카오 접속토큰요청', 'response' => $response], 'login-auth');

        if (empty($response['access_token'])) {
            $message = '카카오 로그인에 실패했어요.<br>잠시 후 다시 시도해 주세요.<br>(엑세스 토큰 에러)';
            return (new ErrorController())->errorMessage($message, $this->loginUrl);
        } else {
            return $this->getProfile($response['access_token']);
        }
    }

    // 4 프로필 API 호출 (사용자 고유 정보 획득)
    protected function getProfile($accessToken)
    {
        $client = service('curlrequest');
        $host = 'https://kapi.kakao.com/v2/user/me';

        try {
            $client->timeout = 60;
            $response = $client->get($host, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            // API 응답
            $body = $response->getBody();
            $response = (isJsonString($body)) ? json_decode($body, true) : $body;
        }catch (\Exception $e){
            $logMessage = sprintf(
                "Exception: %s in %s:%d\nStack trace:\n%s",
                $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString()
            );
            $response = $logMessage;
        }

        write_server_log(['auth' => '카카오 프로필', 'response' => $response], 'login-auth');

        // $response['id'] 사용자 고유 ID
        $kakaoId = $response['id'] ?? ''; // 카카오 고유값
        $gender = $response['kakao_account']['gender'] ?? ''; // 성별

        if (empty($kakaoId)) {
            $message = '카카오 로그인에 실패했어요.<br>잠시 후 다시 시도해 주세요.<br>(프로필 조회 실패)';
            return (new ErrorController())->errorMessage($message, $this->loginUrl);
        } else {
            // 로그인 or 회원가입 이동 처리
            $etc = ['gender' => $gender];
            return (new AccountController())->handleSocialLogin('K', $kakaoId, $etc, $response['kakao_account']);
        }
    }

}