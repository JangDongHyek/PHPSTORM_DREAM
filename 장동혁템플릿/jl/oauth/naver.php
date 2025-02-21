<?
include_once "../../jl/JlConfig.php";

$jl_naver = new JlNaver($_GET);

$token = $jl_naver->getToken();
$user_response = $jl_naver->getUser($token);

/*
 * 네이버 고유값 id 43자리 추측이지만 아마 맥스멈 50자리일듯함
 * $user = name, email, mobile
 * 권한 신청 필요없으나 검수를통과해야 실사용가능
 */
$user = $user_response['response'];
// 변수명 공용화
$user['phone'] = $user['mobile'];
$user['primary'] = $user['id'];

//공통 로직 시작
$model = new JlModel("g5_member");
$row = $model->where("sns_code",$user['primary'])->get();

if(!$row['count']) {
    $data = array(
        "mb_id" => $jl->generateUniqueId(),
        "mb_password" => $jl->encrypt($jl->generateUniqueId()),
        "mb_name" => $user['name'],
        "mb_email" => $user['email'],
        "mb_level" => 2,
        "mb_hp" => $user['phone'],
        "mb_datetime" => "now()",
        "sns_code" => $user['primary'],
    );

    $model->insert($data);

    $row = $model->where("sns_code",$user['primary'])->get();
}


$jl->setSession('ss_mb_id', $row['data'][0]['mb_id']);
$jl->setSession('ss_mb_key', md5($row['data'][0]['mb_datetime'] . $jl->getClientIP() . $_SERVER['HTTP_USER_AGENT']));

$jl->goURL($jl->URL);
?>