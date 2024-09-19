<?php
include_once("../jl/JlConfig.php");

$response = array("message" => "");
$_method = $_POST["_method"];
$file_name = str_replace(".php","",basename(__FILE__));

try {
    $model = new JlModel(array("table" => $file_name));

    $join_table = "";
    $get_tables = array();
    //array_push($get_tables,array("table"=> "exam", "get_key" => "exam_key" ));

    $file_use = true;
    $file = new JlFile("/jl/jl_resource/$file_name");

    switch (strtolower($_method)) {
        case "get":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            //필터링
            if($obj['primary']) $obj[$model->primary] = $obj['primary'];
            if($obj['search_key1'] && $obj['search_value1_1'] && $obj['search_value1_2'] == "") $model->where($obj['search_key1'],$obj['search_value1_1']);
            if($obj['search_key1'] && $obj['search_value1_1'] && $obj['search_value1_2']) $model->between($obj['search_key1'],$obj['search_value1_1'],$obj['search_value1_2']);
            if($obj['search_like_key1'] && $obj['search_like_value1']) $model->like($obj['search_like_key1'],$obj['search_like_value1']);
            if($obj['order_by_desc']) $model->orderBy($obj['order_by_desc'],"DESC");
            if($obj['order_by_asc']) $model->orderBy($obj['order_by_asc'],"ASC");
            if($obj['not_key1'] && $obj['not_value1']) $model->where($obj['not_key1'],$obj['not_value1'],"AND NOT");
            if($obj['in_key1'] && $obj['in_value1']) $model->in($obj['in_key1'],$model->jsonDecode($obj['in_value1']));

            //join
            if ($join_table) {
                $model->join($join_table,"origin_key","join_key");
                // 조인 필터링
                //$model->where("join_column","value","AND",$join_table);
                //$model->between("join_column","start","end","AND",$join_table);
                //$model->in("join_column",array("value1","value2"),"AND",$join_table);
                //$model->like("join_column","value","AND",$join_table);
            }

            $object = $model->where($obj)->get(array(
                "page" => $obj['page'],
                "limit" => $obj['limit'],
                //"source" => "joinTable",
                //"select" => "joinTable.SearchColumn AS alias",
                "sql" => true
            ));

            //getKey ex) 고유키로 필요한 테이블데이터를 조인대신 한번 더 조회해서 가져오는형식 속도는 join이랑 비슷하거나 빠름
            foreach($get_tables as $index => $info) {
                $joinModel = new JlModel(array(
                    "table" => $info['table'],
                ));

                foreach ($object["data"] as $index => $data) {
                    $joinModel->where($joinModel->primary, $data[$info['get_key']]);
                    $join_data = $joinModel->get();
                    $join_data = $join_data['data'][0];

                    //Join시 변수명은 무조건 대문자로 진행 데이터 업데이트시 문제발생함 대문자 필드 삭제 처리는 JS에 있음
                    $object["data"][$index][strtoupper($join_table)] = $join_data;
                }
            }

            $response['data'] = $object['data'];
            $response['count'] = $object['count'];
            $response['filter'] = $obj;
            $response['success'] = true;
            break;
        }

        case "insert":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            if($file_use) {
                foreach ($_FILES as $key => $file_data) {
                    $file_result = $file->bindGate($file_data);
                    $obj[$key] = $file_result;
                }
            }

            $model->insert($obj);
            $response['success'] = true;
            break;
        }
        case "update":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            if($file_use) {
                //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
                $getData = $model->where($model->primary,$obj[$model->primary])->get();
                $getData = $getData['data'][0];

                foreach ($_FILES as $key => $file_data) {
                    $file_result = $file->bindGate($file_data);
                    if(!$file_result) continue;

                    if(is_array($file_data['name'])) {
                        //바인드의 리턴값은 encode되서 오기때문에 decode
                        $file_result = json_decode($file_result, true);
                        $result = array_merge($getData[$key],$file_result);
                        //문자열로 저장되어야하기떄문에 encode
                        $obj[$key] = json_encode($result);
                    }else {
                        $obj[$key] = $file_result;
                    }
                }
            }

            $model->update($obj);
            $response['success'] = true;
            break;
        }
        case "delete_thumb":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            $getData = $model->where($model->primary,$obj[$model->primary])->get();
            $getData = $getData['data'][0];

            unset($getData['upfiles'][$obj['thumb_idx']]);

            $model->update($getData);
            $response['success'] = true;
            break;
        }
        case "delete":
        {
            $obj = $model->jsonDecode($_POST['obj'],false);

            if($file_use) {
                $getData = $model->where($model->primary,$obj[$model->primary])->get();
                $getData = $getData['data'][0];
                $file->deleteDirGate($getData['data_column']);
            }

            $data = $model->delete($obj);

            $response['success'] = true;
            break;
        }

        case "where_delete" :
            $obj = $model->jsonDecode($_POST['obj'],false);

            $model->where($obj)->whereDelete();
            break;

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

    echo json_encode($response);

} catch (Exception $e) {

}


?>