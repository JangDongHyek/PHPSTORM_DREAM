<?
require_once(dirname(__FILE__) . "/../Jl.php");
class JlKakao extends Jl{
    private $client_id = "";
    private $code = "";


    public function __construct($GET){
        parent::__construct(false);
        if(JL_KAKAO_CLIENT_ID == "") $this->error("Jl_KAKAO_CLIENT_ID 값이 없습니다.");
        $this->client_id = JL_KAKAO_CLIENT_ID;
        $this->code = $GET['code'];
    }

    public function createHref() {
        $url = "https://kauth.kakao.com/oauth/authorize?client_id={$this->client_id}&redirect_uri={$this->redirectUri()}";
        $url .= "&response_type=code";

        return $url;
    }

    public function redirectUri() {
        return "{$this->URL}/jl/oauth/kakao.php";
    }

    public function  getToken() {
        if(!$this->code) $this->error("code 가 존재하지않습니다.");

        $data = array(
            "grant_type" => "authorization_code",
            "client_id" => $this->client_id,
            "redirect_uri" => $this->redirectUri(),
            "code" => $this->code
        );

        $options = array(
            "data" => $data,
            "http_build" => true,
            "content_type" => "content-type: application/x-www-form-urlencoded",

        );

        return $this->curlRequest("https://kauth.kakao.com/oauth/token","POST",$options);
    }

    public function getUser($token) {
        $options = array(
            "content_type" => "content-type: application/x-www-form-urlencoded",
            "authorization" => "Authorization: Bearer {$token['access_token']}"
        );

        return $this->curlRequest("https://kapi.kakao.com/v2/user/me","POST",$options);
    }
}
?>