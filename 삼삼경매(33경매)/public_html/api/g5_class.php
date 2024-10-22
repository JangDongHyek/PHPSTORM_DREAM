<?php
include_once('../common.php');
include_once(G5_PATH."/model/model.php");
include_once(G5_PATH."/class/file.php");

$response = array( "message" => "" );
$_method = $_POST["_method"];

$model = new Model("g5_class","_idx",false);
$g5_class_requestM = new Model("g5_class_request","_idx",false);
$file = new File("/data/g5_class");
try {
    switch (strtolower($_method)) {
        case "gets":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $filter = str_replace('\\','',$_POST['filter']);
            $filter = json_decode($filter,true);

            $filter[$filter[search_key]] = $filter[search_value];

            $object = $model->gets($filter,true);

            foreach($object["datas"] as $index => $data) {
                $object["datas"][$index]["counts"] = $g5_class_requestM->count(array("class_idx" => $data["_idx"]));
            }

            $response['datas'] = $object;
            $response['filter'] = $filter;
            $response['success'] = true;
            break;
        }

        case "gets2":
            {
                // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
                $filter = str_replace('\\','',$_POST['filter']);
                $filter = json_decode($filter,true);
    
                $filter[$filter[search_key]] = $filter[search_value];

                $sql = "";
                if($filter["all_search"]) {
                    $sql = " AND (subject LIKE '%{$filter['all_search']}%' OR teacher LIKE '%{$filter['all_search']}%')";
                }
    
                $object = $model->gets($filter,true,$sql);
    
                foreach($object["datas"] as $index => $data) {
                    $object["datas"][$index]["counts"] = $g5_class_requestM->count(array("class_idx" => $data["_idx"]));
                }
                
                $response['sql'] = $sql;
                $response['datas'] = $object;
                $response['filter'] = $filter;
                $response['success'] = true;
                break;
            }

        case "get":
        {
            $data = $model->get(array(
                "_idx" => $_POST["_idx"]
            ));
            
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
            $response['success'] = true;
            break;
        }

        case "deletes":
        {
            // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
            $arrays = str_replace('\\','',$_POST['arrays']);
            $arrays = json_decode($arrays,true);

            foreach($arrays as $_idx) {
                $model->delete(array(
                    "_idx" => $_idx
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