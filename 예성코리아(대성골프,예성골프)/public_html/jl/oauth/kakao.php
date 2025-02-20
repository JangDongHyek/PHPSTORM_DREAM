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
$user['phone_number'] = $jl->formatPhoneNumber($user['phone_number']);

//예외 로직 시작
$model = new JlModel("g5_member");

$response = $model->where("mb_id","jl_k_".$user_response['id'])->get();
if(!$response['count']) {
    $row = array(
        "mb_id" => "jl_k_".$user_response['id'],
        "mb_password" => $jl->encrypt($user_response['id']),
        "mb_name" => $user['name'],
        "mb_email" => $user['email'],
        "mb_level" => 2,
        "mb_hp" => $user['phone_number'],
        "mb_datetime" => "now()",
    );

    $model->insert($row);

    $response = $model->where("mb_id","jl_k_".$user_response['id'])->get();
}


$jl->setSession('ss_mb_id', "jl_k_".$user_response['id']);
$jl->setSession('ss_mb_key', md5($response['data'][0]['mb_datetime'] . $jl->getClientIP() . $_SERVER['HTTP_USER_AGENT']));

$jl->goURL($jl->URL);
?>