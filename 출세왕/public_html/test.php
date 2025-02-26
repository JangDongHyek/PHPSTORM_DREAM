<?
phpinfo();
//include_once("./jl/JlConfig.php");

//if($jl->DEV && $_GET['id']) {
//    $model = new JlModel("g5_member");
//
//    $result = $model->where("mb_id",$_GET['id'])->get();
//    if($result['count']) {
//        $user = $result['data'][0];
//
//        $jl->setSession('ss_mb_id', $_GET['id']);
//        $jl->setSession('ss_mb_key', md5($user['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
//    }else {
//        $jl->error("데이터없음");
//    }
//}
?>