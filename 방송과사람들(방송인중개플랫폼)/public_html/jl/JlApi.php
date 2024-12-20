<?php
include_once("../jl/JlConfig.php");

$response = array("message" => "");
$_method = $_POST["_method"];

try {
    $obj = $jl->jsonDecode($_POST['obj']);
    $table = $obj['table'];

    if(!$table) $jl->error("obj에 테이블이 없습니다.");
    $model = new JlModel(array("table" => $table));

    $join_table = "";
    $get_tables = [];
    //array_push($get_tables,array("table"=> "exam", "get_key" => "exam_key" ));

    $file_use = false;
    $file = new JlFile("/jl/jl_resource/$table");

    switch (strtolower($_method)) {
        case "get":
        {

            //필터링
            $model->setFilter($obj);

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
                    if(!$data[$info['get_key']]) continue;
                    $joinModel->where($joinModel->primary, $data[$info['get_key']]);
                    $join_data = $joinModel->get()['data'][0];

                    //Join시 변수명은 첫번째에 무조건 $로 진행 조인데이터일시 문제발생함 첫글자 $ 필드 삭제 처리는 jl.js에 있음
                    $object["data"][$index]["$".$info['table']] = $join_data;
                }
            }

            //불러들인 데이터에 임의값을 추가할떄 사용하는 로직
            //foreach ($object['data'] as $index => $data) {
            //    $object['data'][$index]['example'] = "example";
            //}

            $response['data'] = $object['data'];
            $response['count'] = $object['count'];
            $response['filter'] = $obj;
            $response['success'] = true;
            break;
        }

        case "insert":
        {
            //$item = $model->where($obj)->get();
            //if($item['count']) $model->error("이미 신청한 상품입니다.");

            if($file_use) {
                foreach ($_FILES as $key => $file_data) {
                    $file_result = $file->bindGate($file_data);
                    $obj[$key] = $file_result;
                }
            }

            $response['idx'] = $model->insert($obj);
            $response['success'] = true;
            break;
        }
        case "update":
        {
            if($file_use) {
                //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
                $getData = $model->where($model->primary,$obj[$model->primary])->get()['data'][0];

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
            }

            $model->update($obj);
            $response['success'] = true;
            break;
        }
        case "delete":
        {
            if($obj['primary']) $obj[$model->primary] = $obj['primary'];

            if($file_use) {
                $getData = $model->where($model->primary,$obj[$model->primary])->get()['data'][0];
                $file->deleteDirGate($getData['data_column']);
            }

            $data = $model->delete($obj);

            $response['success'] = true;
            break;
        }

        case "query":
        {
            $data = $model->query($obj['query']);
            $response['data'] = $data;
            $response['success'] = true;
            break;
        }

        case "where_delete" :
            $model->setFilter($obj);

            $model->where($obj)->whereDelete();
            $response['success'] = true;
            break;

        case "distinct" :
            $model->setFilter($obj);

            $object = $model->where($obj)->distinct($obj);

            $response['data'] = $object['data'];
            $response['sql'] = $object['sql'];
            $response['success'] = true;
            break;

        default :
            $response['success'] = false;
            $response['message'] = "_method가 존재하지않습니다.";
    }

    echo json_encode($response);

} catch (Exception $e) {
    echo $e->getMessage();
}


?>