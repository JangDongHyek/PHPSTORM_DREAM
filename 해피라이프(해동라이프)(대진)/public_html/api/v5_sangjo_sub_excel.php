<?php

include_once("../jl/JlModel.php");

function isDate($date) {
    return (bool)strtotime($date);
}

$model_config = array(
    "table" => "v5_sangjo_sub",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
);

$model = new JlModel($model_config);

$obj = $model->jsonDecode($_POST['obj']);
//필터 가공
foreach ($obj as $key => $value) {
    if(strpos($key,"primary") !== false) $obj[$model->primary] = $value;
    if(strpos($key,"order_by_desc") !== false) $model->order_by($obj['order_by_desc'],"DESC");
    if(strpos($key,"order_by_asc") !== false) $model->order_by($obj['order_by_desc'],"ASC");
}

if($obj['search_key'] && $obj['search_value']) $model->like($obj['search_key'],$obj['search_value']);

$model->where($obj);
$object = $model->get();
// CSV 파일에 기록할 데이터 배열
$data = [
    ['구분', '캐쉬백 신청일시', '신청인 성명',"신청인 휴대폰","신청인 고객사명","해피라이프 이용일자","이용인 성명"]
];


// CSV 파일 이름
$filename = 'example.csv';

// CSV 파일 생성
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);
$output = fopen('php://output', 'w');

// 데이터 배열을 CSV 형식으로 출력
foreach ($data as $row) {
    fputcsv($output, $row);
}

foreach ($object['data'] as $index => $row) {
    $array = [
        $row['type'],
        "\t".$row['reg_date'],
        $row['mb_name'],
        $row['mb_hp'],
        $row['mb_company'],
        "\t".$row['use_date'],
        $row['use_name']
    ];
    fputcsv($output, $array);
}

// 파일 핸들 닫기
fclose($output);
exit();
?>