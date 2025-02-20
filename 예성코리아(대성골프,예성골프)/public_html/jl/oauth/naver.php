<?
include_once "../../jl/JlConfig.php";

$jl_naver = new JlNaver($_GET);

$token = $jl_naver->getToken();
//$user = $jl_naver->getUser($token);

var_dump($token);
echo "<br>";
//var_dump($user);
?>