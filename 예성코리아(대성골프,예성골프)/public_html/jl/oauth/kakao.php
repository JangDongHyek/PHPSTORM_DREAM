<?
include_once "../../jl/JlConfig.php";

$jl_kakao = new JlKakao($_GET);

$token = $jl_kakao->getToken();
$user = $jl_kakao->getUser($token);

var_dump($token);
echo "<br>";
var_dump($user);
?>