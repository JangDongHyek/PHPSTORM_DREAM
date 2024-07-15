<?php
//include_once("./common.php");
//include_once(G5_PATH . "/model/model.php");
//
//global $g5;
//try {
//    $db_config = array(
//        "hostname" => "localhost",
//        "username" => "yangsanfamily",
//        "password" => "uakpa5z^",
//        "database" => "yangsanfamily"
//    );
//
//    $model_config = array_merge($db_config,array(
//        "table" => "g5_menu",
//        "primary" => "me_id",
//    ));
//
//    $model = new Model($model_config);
//
//    $model->where("me_link","asd");
//
//    $model->group_start();
//    $model->between("me_target","2024-07-01","2024-07-02");
//    $model->or_like("me_link","2");
//    $model->group_end();
//
//
//
//    $result = $model->get_sql();
//
//    var_dump($result);
//}catch(Exception $e) {
//    echo $e->getMessage();
//}

?>