<?php

include_once("../jl/JlModel.php");

$model_config = array(
    "table" => "g5_use",
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
if($obj['sdate'] && $obj['edate']) $model->between("insert_date",$obj['sdate'],$obj['edate']);

$model->where($obj);
$object = $model->get();
// CSV 파일에 기록할 데이터 배열
$data = [
    ['날짜', '구분', '성명',"연락처","고객사명","비고"]
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
        $row['insert_date'],
        $row['type'],
        $row['name'],
        $row['phone'],
        $row['company'],
        $row['content']
    ];
    fputcsv($output, $array);
}

// 파일 핸들 닫기
fclose($output);
exit();
?>