<?
require_once(dirname(__FILE__) . "/../Jl.php");
class JlNaver extends Jl {
    private $client_id = "";
    private $client_secret = "";
    private $code = "";
    private $state = "";

    public function __construct($GET){
        parent::__construct(false);
        if(JL_NAVER_CLIENT_ID == "") $this->error("Jl_KAKAO_CLIENT_ID 값이 없습니다.");
        $this->client_id = JL_NAVER_CLIENT_ID;
        $this->client_secret = JL_NAVER_CLIENT_SECRET;
        $this->code = $GET['code'];
        $this->state = $GET['state'];
    }

    public function createHref() {
        $url = "https://nid.naver.com/oauth2.0/authorize?client_id={$this->client_id}&redirect_uri={$this->redirectUri()}";
        $url .= "&response_type=code";

        return $url;
    }

    public function redirectUri() {
        return "{$this->URL}/jl/oauth/naver.php";
    }

    public function  getToken() {
        if(!$this->code) $this->error("code 가 존재하지않습니다.");

        $data = array(
            "grant_type" => "authorization_code",
            "client_id" => $this->client_id,
            "client_secret" => $this->client_secret,
            "redirect_uri" => $this->redirectUri(),
            "code" => $this->code
        );

        $options = array(
            "data" => $data,
            "http_build" => true,
            "content_type" => "content-type: application/x-www-form-urlencoded",

        );

        return $this->curlRequest("https://nid.naver.com/oauth2.0/token","POST",$options);
    }

    public function getUser($token) {
        $options = array(
            "content_type" => "content-type: application/x-www-form-urlencoded",
            "authorization" => "Authorization: Bearer {$token['access_token']}"
        );

        return $this->curlRequest("https://openapi.naver.com/v1/nid/me","POST",$options);
    }
}
?>