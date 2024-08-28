<?php
class KakaoLogin{

    public $client_id = "";
    public $redirect_uri = "";

    function __construct($param){
        $this->redirect_uri = $param['redirect_uri'];
        $this->client_id = $param['client_id'];
    }

    function getAccessToken($code){
        $curl = curl_init();

        $param = array(
            "grant_type" => "authorization_code",
            "client_id" => $this->client_id,
            "redirect_uri" => $this->redirect_uri,
            "code" => $code
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
            //echo $response."<br><br>";
            return json_decode($response, true);
        }
    }

    function getUserMe($access_token){
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
                "Authorization: Bearer {$access_token}",
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
            //echo $response."<br><br>";
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
