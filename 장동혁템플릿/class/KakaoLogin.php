<?php
class KakaoLogin{

    public $client_id = "";     // 카카오 앱 REST API 키
    public $redirect_uri = "";  // 카카오 앱에 설정된 redirect_uri
    public $code = "";          // 카카오에 반환되는 code
    public $access_token = "";  // getToken함수로 가져오는 토큰값

    /*
     세션이 통일이 안될때 www 도메인 차이일수도있으니 주의!
    카카오앱 리다이렉트에 www를 허용이안되도 www으로 작업해도 상관없으니 기본이 www면 www붙여서 작업할것!
     */
    function error($msg) {
        echo $msg;
        throw new \Exception($msg);
    }

    function __construct($param){
        if($param['code'] == "") $this->error("code 값이 존재하지 않습니다.");
        $this->code = $param['code'];
        if($param['redirect_uri'] == "") $this->error("redirect_uri 값이 존재하지 않습니다.");
        $this->redirect_uri = $param['redirect_uri'];
        if($param['client_id'] == "") $this->error("client_id 값이 존재하지 않습니다.");
        $this->client_id = $param['client_id'];

        $this->getToken();
    }

    function getToken(){
        $curl = curl_init();

        $param = array(
            "grant_type" => "authorization_code",
            "client_id" => $this->client_id,
            "redirect_uri" => $this->redirect_uri,
            "code" => $this->code
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://kauth.kakao.com/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($param),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("cURL Error #:" . $err);
        } else {
            $result = json_decode($response, true);
            $this->access_token = $result['access_token'];
        }
    }

    function getUser(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://kapi.kakao.com/v2/user/me",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer {$this->access_token}",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("cURL Error #:" . $err);
        } else {
            echo $response."<br><br>";
            return json_decode($response, true);
        }
    }

    function postLogout($access_token){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://kapi.kakao.com/v1/user/logout",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer {$access_token}",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("cURL Error #:" . $err);
        } else {
            return json_encode($response, true);
        }
    }
}
?>
