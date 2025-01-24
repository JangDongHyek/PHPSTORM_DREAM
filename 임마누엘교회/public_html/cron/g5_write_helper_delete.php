<?php
include_once "../jl/JlConfig.php";

$model = new JlModel("g5_write_helper");

$data = $model->addSql(" AND DATE(wr_10) < CURDATE()")->whereDelete();

$jl->log("g5_write_helper_crontab");
?>