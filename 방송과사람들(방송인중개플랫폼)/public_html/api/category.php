<?php
include_once("../model/NewModel.php");
//include_once("../class/file.php");

$response = array("message" => "");
$_method = $_POST["_method"];

$db_config = array(
    "hostname" => "localhost",
    "username" => "broadcast",
    "password" => "c3gq%qyc",
    "database" => "broadcast"
);

$model_config = array_merge($db_config,array(
    "table" => "category",
    "primary" => "idx",
));
$model = new Model($model_config);

$join_table = "";
$join_table_delete = false; // true시 join테이블 데이터가 없으면 조회된 데이터 삭제

//$file = new File("/data/example");

try {
    switch (strtolower($_method)) {
        case "get":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $filter = str_replace('\\', '', $_POST['filter']);
            $filter = json_decode($filter, true);

            //필터 가공
            foreach ($filter as $key => $value) {
                if(strpos($key,"primary") !== false) $filter[$model->primary] = $value;
                if(strpos($key,"search_key") !== false) $column = $value;
                if(strpos($key,"search_value") !== false) $filter[$column] = $value;
            }

            $model->where($filter);
            $model->order_by("priority","ASC");
            $object = $model->get($filter["page"], $filter["limit"]);

            foreach ($object["data"] as $index => $data) {
                $model->reset();
                $model->where("parent_idx" , $data['idx']);
                $model->order_by("priority","ASC");
                $childs = $model->get();

                $object["data"][$index]["childs"] = $childs['data'];
            }

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

            $response['response'] = $object;
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

            $model->where("parent_idx",$_POST["primary"]);
            $data = $model->sqlDelete();

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