<?php
include_once("./common.php");
include_once(G5_PATH . "/model/model.php");

global $g5;
try {
    $db_config = array(
        "hostname" => "localhost",
        "username" => "yangsanfamily",
        "password" => "uakpa5z^",
        "database" => "yangsanfamily"
    );

    $model_config = array_merge($db_config,array(
        "table" => "g5_menu",
        "primary" => "me_id",
    ));

    $model = new Model($model_config);

    //$model->where("bg_id","asd");
    $model->like("me_link","notice");

    $model->order_by("me_id","ASC");
    $result = $model->get_sql();

    var_dump($result);
}catch(Exception $e) {
    echo $e->getMessage();
}


?>