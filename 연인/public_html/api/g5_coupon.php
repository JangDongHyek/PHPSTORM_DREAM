<?php
include_once('../common.php');
include_once(G5_PATH."/model/model2.php");

$file = false;
if($file) {
    include_once(G5_PATH."/class/file.php");
    $file = new File("/data/g5_coupon");
}

$response = array( "message" => "" );
$_method = $_POST["_method"];

$model = new Model(array(
    "table" => "g5_coupon",
    "primary" => "idx",
    "autoincrement" => true
));


try {
    switch (strtolower($_method)) {
        case "count":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $filter = str_replace('\\','',$_POST['filter']);
            $filter = json_decode($filter,true);
            $filter[$filter[search_key]] = $filter[search_value];

            $gets_config = array(
                "like" => false,
                "order_by" => "idx",
                "sort" => "desc",
                "add_query" => "AND use_date = '0000-00-00 00:00:00'",
                "all_search" => json_decode($filter["all_search"])
            );
            $object = $model->count($filter,$gets_config);

            $response['datas'] = $object;
            $response['filter'] = $filter;
            $response['success'] = true;
            break;
        }
        case "gets":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $filter = str_replace('\\','',$_POST['filter']);
            $filter = json_decode($filter,true);
            $filter[$filter[search_key]] = $filter[search_value];

            $gets_config = array(
                "like" => false,
                "order_by" => "idx",
                "sort" => "desc",
                "add_query" => "",
                "all_search" => json_decode($filter["all_search"])
            );
            $object = $model->gets($filter,$gets_config);

            // 연관테이블 필요시 주석해제
//             $deletes = array();
//             $joinModel = new Model(array(
//                 "table" => "join_table",
//                 "primary" => ""
//             ));

//             foreach($object["datas"] as $index => $data) {
//                 $join_data = $joinModel->get(array(
//                     $joinModel->priary => $data["class_idx"]
//                 ),array(
//                     "like" => false,
//                     add_query => ""
//                 ));
//                 if($join_data) $object["datas"][$index]["join_table"] = $join_data;
//                 else array_push($deletes,$index);
//             }

//            foreach($deletes as $index) {
//                unset($object["datas"][$index]);
//                $object["count"]--;
//            }

            $response['datas'] = $object;
            $response['filter'] = $filter;
            $response['success'] = true;
            break;
        }

        case "get":
        {
            $filter = array(
                $model->primary => $_POST["primary"]
            );

            $gets_config = array(
                "like" => false,
                "add_qeury" => "",
                "order_by" => "c_date",
                "sort" => "desc"
            );

            $data = $model->get($filter,$gets_config);

            $response['data'] = $data;
            $response['success'] = true;
            break;
        }

        case "post":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $obj = str_replace('\\','',$_POST['obj']);
            $obj = json_decode($obj,true);

            // PHP 버전에 따라 decode가 다르게 먹히므로 PHP단에서 Object,Array,Boolean encode처리
            foreach($obj as $key => $value) {
                if(is_array($obj[$key])) $obj[$key] = json_encode($obj[$key],JSON_UNESCAPED_UNICODE);
            }



            if($_FILES["upfile"]) {
                $upfile = $file->bind($_FILES["upfile"]);
                $obj["file"] = $upfile;
            }

            $model->post($obj);
            $response['success'] = true;
            break;
        }
        case "put":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $obj = str_replace('\\','',$_POST['obj']);
            $obj = json_decode($obj,true);

            // PHP 버전에 따라 decode가 다르게 먹히므로 PHP단에서 Object,Array,Boolean encode처리
            foreach($obj as $key => $value) {
                if(is_array($obj[$key])) $obj[$key] = json_encode($obj[$key],JSON_UNESCAPED_UNICODE);
            }



            if($_FILES["upfile"]) {
                $upfile = $file->bind($_FILES["upfile"]);
                $obj["file"] = $upfile;
            }

            $model->put($obj);
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
            $arrays = str_replace('\\','',$_POST['arrays']);
            $arrays = json_decode($arrays,true);

            foreach($arrays as $primary) {
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