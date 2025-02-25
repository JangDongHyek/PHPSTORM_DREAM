<?
include_once "../../jl/JlConfig.php";

$jl_kakao = new JlKakao($_GET);

$token = $jl_kakao->getToken();
$user_response = $jl_kakao->getUser($token); // [id,connected_at,kakao_account]

/*
 * 카카오 고유값 id 10자리
 * $user = name, email, phone_number
 * 권한 신청 필수
 * phone_number +82 치환 선택
 */
$user = $user_response['kakao_account'];
// 변수명 공용화
$user['phone'] = $jl->formatPhoneNumber($user['phone_number']);
$user['primary'] = $user_response['id'];


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
        "sns_type" => "kakao"
    );

    $model->insert($data);

    $row = $model->where("sns_code",$user['primary'])->get();
}


$jl->setSession('ss_mb_id', $row['data'][0]['mb_id']);
$jl->setSession('ss_mb_key', md5($row['data'][0]['mb_datetime'] . $jl->getClientIP() . $_SERVER['HTTP_USER_AGENT']));

$jl->goURL($jl->URL);
?>