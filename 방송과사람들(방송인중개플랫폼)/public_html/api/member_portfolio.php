<?php
include_once("../class/Model.php");
include_once("../class/File.php");

$response = array("message" => "");
$_method = $_POST["_method"];

$model_config = array(
    "table" => "member_portfolio",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
);


try {
    $model = new Model($model_config);

    $join_table = "";
    $join_table_delete = false; // true시 join테이블 데이터가 없으면 조회된 데이터 삭제

    $file = new File("/data/member_portfolio");

    switch (strtolower($_method)) {
        case "get":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            //필터 가공
            foreach ($obj as $key => $value) {
                if(strpos($key,"primary") !== false) $obj[$model->primary] = $value;
                if(strpos($key,"search_key") !== false) $column = $value;
                if(strpos($key,"search_value") !== false) $obj[$column] = $value;
            }

            $model->where($obj);
            $object = $model->get($obj["page"], $obj["limit"]);

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
            $response['filter'] = $obj;
            $response['success'] = true;
            break;
        }

        case "insert":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            foreach ($_FILES as $key => $file_data) {
                $file_result = $file->bindGate($file_data);
                $obj[$key] = $file_result;
            }

            $model->insert($obj);

            $response['file'] = $_FILES;
            $response['obj'] = $obj;
            $response['success'] = true;
            break;
        }
        case "update":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            foreach ($_FILES as $key => $file_data) {
                $file_result = $file->bindGate($file_data);
                $obj[$key] = $file_result;
            }

            $model->update($obj);
            $response['success'] = true;
            break;
        }
        case "delete":
        {
            $obj = $model->jsonDecode($_POST['obj']);
            $data = $model->delete($obj);

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