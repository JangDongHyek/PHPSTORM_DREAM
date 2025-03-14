<?php
include_once("../class/Model.php");
include_once("../class/File.php");

$response = array("message" => "");
$_method = $_POST["_method"];

$model_config = array(
    "table" => "member_product",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
);


try {
    $model = new Model($model_config);

    $join_table = "category";
    $join_table_delete = false; // true시 join테이블 데이터가 없으면 조회된 데이터 삭제

    $file = new File("/data/member_product");

    switch (strtolower($_method)) {
        case "get":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            //필터 가공
            foreach ($obj as $key => $value) {
                if(strpos($key,"primary") !== false) $obj[$model->primary] = $value;
                if(strpos($key,"search_key") !== false) $column = $value;
                if(strpos($key,"search_value") !== false) $obj[$column] = $value;
                if(strpos($key,"order_by_desc") !== false) $model->order_by($obj['order_by_desc'],"DESC");
                if(strpos($key,"order_by_asc") !== false) $model->order_by($obj['order_by_desc'],"ASC");
            }

            if($obj["not_key"] && $obj['not_value']) {
                $model->not = true;
                $model->where($obj['not_key'],$obj['not_value']);
                $model->not = false;
            }

            if($obj['in_key1'] && $obj['in_value1']) {
                $arrays = $model->jsonDecode($obj['in_value1']);
                $model->in($obj['in_key1'],$model->jsonDecode($obj['in_value1']));
                $response['sql'] = $model->getSql();
            }

            if($obj['group_ors']) {
                $groups = $model->jsonDecode($obj['group_ors']);
                $model->group_start();
                foreach ($groups as $g)
                $model->or_where("idx",$g);
                $model->group_end();
            }

            if($obj["parent_idx"]) {
                unset($obj['category_idx']);
                $joinModel = new Model(array(
                    "table" => $join_table,
                    "primary" => "idx"
                ));
                $joinModel->where("parent_idx", $obj["parent_idx"]);
                $join_data = $joinModel->get()['data'];

                $model->group_start();
                foreach($join_data as $index => $data) {
                    $model->or_where("category_idx",$data["idx"]);
                }
                $model->group_end();

                $response['sql'] = $model->getSql();

                $joinModel = null; // 메모리해제
            }

            $model->where($obj);
            $object = $model->get($obj["page"], $obj["limit"]);

            if ($join_table) {
                $deletes = array();
                $joinModel = new Model(array(
                    "table" => $join_table,
                    "primary" => "idx"
                ));

                $joinModel2 = new Model(array(
                    "table" => "g5_member",
                    "primary" => "mb_no"
                ));

                foreach ($object["data"] as $index => $data) {
                    $joinModel->where($joinModel->primary, $data["category_idx"]);
                    $join_data = $joinModel->get();

                    $joinModel2->where($joinModel2->primary, $data["member_idx"]);
                    $join_data2 = $joinModel2->get()['data'][0];

                    $object["data"][$index][strtoupper($join_table)] = $join_data;
                    $object["data"][$index]['MEMBER'] = $join_data2;

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

            $response['$groups'] = $groups;

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
            $response['success'] = true;
            break;
        }
        case "update":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
            $model->where($model->primary,$obj[$model->primary]);
            $getData = $model->get()['data'][0];

            foreach ($_FILES as $key => $file_data) {
                $file_result = $file->bindGate($file_data);
                if(!$file_result) continue;

                if(is_array($file_data['name'])) {
                    //바인드의 리턴값은 encode되서 오기때문에 decode
                    $file_result = json_decode($file_result, true);
                    $result = array_merge($getData[$key],$file_result);
                    //문자열로 저장되어야하기떄문에 encode
                    $obj[$key] = json_encode($result,JSON_UNESCAPED_UNICODE);
                }else {
                    $obj[$key] = $file_result;
                }
            }

            $model->update($obj);
            $response['success'] = true;
            break;
        }
        case "delete":
        {
            $obj = $model->jsonDecode($_POST['obj'],false);

            //$file->deleteDirGate($obj['data_column']);
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

        case "query" :
        {
            $obj = $model->jsonDecode($_POST['obj'],false);

            $data = $model->query($obj['query']);
            break;
        }
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

echo json_encode($response);

?>