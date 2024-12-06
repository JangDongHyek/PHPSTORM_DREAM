<?php
include_once("../class/Model.php");
include_once("../class/File.php");

$response = array("message" => "");
$_method = $_POST["_method"];

$model_config = array(
    "table" => "member_school",
    "primary" => "idx",
);

$model = new Model($model_config);

$join_table = "";
$join_table_delete = false; // true시 join테이블 데이터가 없으면 조회된 데이터 삭제

$file = new File("/data/member_school");

try {
    switch (strtolower($_method)) {
        case "get":
        {
            $filter = $model->jsonDecode($_POST['obj']);

            //필터 가공
            foreach ($filter as $key => $value) {
                if(strpos($key,"primary") !== false) $filter[$model->primary] = $value;
                if(strpos($key,"search_key") !== false) $column = $value;
                if(strpos($key,"search_value") !== false) $filter[$column] = $value;
            }

            $model->where($filter);
            $object = $model->get($filter["page"], $filter["limit"]);

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
            $obj = $model->jsonDecode($_POST['obj']);

            if ($_FILES["upfile"]) {
                $upfile = $file->bind($_FILES["upfile"]);
                $obj["upfile"] = $upfile;
            }

            $model->insert($obj);
            $response['success'] = true;
            break;
        }
        case "update":
        {
            $obj = $model->jsonDecode($_POST['obj']);

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
            $obj = $model->jsonDecode($_POST['obj']);

            $data = $model->delete($obj);
            $response['obj'] = $obj;
            $response['success'] = true;
            break;
        }

        case "deletes":
        {
            $arrays = $model->jsonDecode($_POST['arrays']);

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