<?php
include_once('../common.php');
include_once(G5_PATH . "/model/model.php");

$file = false;
if ($file) {
    include_once(G5_PATH . "/class/file.php");
    $file = new File("/data/example");
}

$response = array("message" => "");
$_method = $_POST["_method"];

global $g5;
$model = new Model(array(
    "db" => G5_MYSQL_DB,
    "connect" => $g5['connect_db'],
    "table" => "example",
    "primary" => "idx",
    "autoincrement" => true
));

$join_table = "";
$join_table_delete = false; // true시 join테이블 데이터가 없으면 조회된 데이터 삭제
try {
    switch (strtolower($_method)) {
        case "get":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $filters = str_replace('\\', '', $_POST['filter']);
            $filters = json_decode($filters, true);

            //필터 가공
            $filter = array();
            foreach ($filters as $key => $value) {
                if(strpos($key,"search_key") !== false) $column = $key;
                if(strpos($key,"search_value") !== false) $filter[$column] = $value;
            }

            $model->where($filter);
            $object = $model->get($filters["page"], $filters["limit"]);
            
            if ($join_table) {
                $deletes = array();
                $joinModel = new Model(array(
                    "table" => $join_table,
                    "primary" => "idx"
                ));

                foreach ($object["data"] as $index => $data) {
                    $joinModel->where($joinModel->priary, $data["example_idx"]);
                    $join_data = $joinModel->get();

                    $object["data"][$index][$join_table] = $join_data;

                    if ($join_table_delete) {
                        if (!$join_data) array_push($deletes, $index);
                    }


                }

                if ($join_table_delete) {
                    foreach ($deletes as $index) {
                        unset($object["data"][$index]);
                        $object["count"]--;
                    }
                }
            }

            $response['data'] = $object;
            $response['filter'] = $filter;
            $response['success'] = true;
            break;
        }

        case "insert":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $obj = str_replace('\\', '', $_POST['obj']);
            $obj = json_decode($obj, true);

            // PHP 버전에 따라 decode가 다르게 먹히므로 PHP단에서 Object,Array,Boolean encode처리
            foreach ($obj as $key => $value) {
                if (is_array($obj[$key])) $obj[$key] = json_encode($obj[$key], JSON_UNESCAPED_UNICODE);
            }


            if ($_FILES["upfile"]) {
                $upfile = $file->bind($_FILES["upfile"]);
                $obj["column"] = $upfile;
            }

            $model->insert($obj);
            $response['success'] = true;
            break;
        }
        case "update":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $obj = str_replace('\\', '', $_POST['obj']);
            $obj = json_decode($obj, true);

            // PHP 버전에 따라 decode가 다르게 먹히므로 PHP단에서 Object,Array,Boolean encode처리
            foreach ($obj as $key => $value) {
                if (is_array($obj[$key])) $obj[$key] = json_encode($obj[$key], JSON_UNESCAPED_UNICODE);
            }


            if ($_FILES["upfile"]) {
                $upfile = $file->bind($_FILES["upfile"]);
                $obj["column"] = $upfile;
            }

            $model->update($obj);
            $response['success'] = true;
            break;
        }
        case "delete":
        {
            $data = $model->delete(array(
                $model->primary => $_POST["primary"]
            ));
            $response['success'] = true;
            break;
        }

        case "deletes":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $arrays = str_replace('\\', '', $_POST['arrays']);
            $arrays = json_decode($arrays, true);

            foreach ($arrays as $primary) {
                $model->delete(array(
                    $model->primary => $primary
                ));
            }

            $response['arrays'] = $arrays;
            $response['success'] = true;
            break;
        }
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

echo json_encode($response);

?>