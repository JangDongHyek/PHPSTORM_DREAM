<?
include_once "../jl/JlConfig.php";

$model = new JlModel("g5_write_lost");

// 찾았고 삭제가 안된 일주일 지난 데이터
$model->where("wr_14","true");
$model->where("wr_15","false");
$model->addSql(" AND DATEDIFF(now(), wr_datetime) >= 7");
$data = $model->get()['data'];

foreach ($data as $item) {
    //var_dump($item);
    $item['wr_15'] = true;
    $model->update($item);
}

// 못찾았고 삭제가 안된 30일 지난 데이터
$model->where("wr_14","false");
$model->where("wr_15","false");
$model->addSql(" AND DATEDIFF(now(), wr_datetime) >= 30");
$data = $model->get()['data'];

foreach ($data as $item) {
    //var_dump($item);
    $item['wr_15'] = true;
    $model->update($item);
}

$jl->log("g5_write_lost_crontab");
?>