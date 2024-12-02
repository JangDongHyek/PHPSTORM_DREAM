<?php
include_once("../jl/JlConfig.php");

$response = array("message" => "");
$_method = $_POST["_method"];
$file_name = str_replace(".php","",basename(__FILE__));

try {
    $models = array();
    $table = $file_name;
    $models[$table] = new JlModel(array("table" => $table));

    $join_table = "";
    $get_tables = [];
    //array_push($get_tables,array("table"=> "exam", "get_key" => "exam_key" ));

    $file_use = false;
    $file = new JlFile("/jl/jl_resource/$table");

    switch (strtolower($_method)) {
        case "get":
        {
            $obj = $models[$table]->jsonDecode($_POST['obj']);

            //필터링
            $models[$table]->setFilter($obj);

            //join
            if ($join_table) {
                $models[$table]->join($join_table,"origin_key","join_key");
                // 조인 필터링
                //$models[$table]->where("join_column","value","AND",$join_table);
                //$models[$table]->between("join_column","start","end","AND",$join_table);
                //$models[$table]->in("join_column",array("value1","value2"),"AND",$join_table);
                //$models[$table]->like("join_column","value","AND",$join_table);
            }

            $object = $models[$table]->where($obj)->get(array(
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

            $response['data'] = $object['data'];
            $response['count'] = $object['count'];
            $response['filter'] = $obj;
            $response['success'] = true;
            break;
        }

        case "insert":
        {
            $obj = $models[$table]->jsonDecode($_POST['obj']);

            //$item = $models[$table]->where($obj)->get();
            //if($item['count']) $models[$table]->error("이미 신청한 상품입니다.");

            if($file_use) {
                foreach ($_FILES as $key => $file_data) {
                    $file_result = $file->bindGate($file_data);
                    $obj[$key] = $file_result;
                }
            }

            $response['idx'] = $models[$table]->insert($obj);
            $response['success'] = true;
            break;
        }
        case "update":
        {
            $obj = $models[$table]->jsonDecode($_POST['obj']);

            if($file_use) {
                //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
                $getData = $models[$table]->where($models[$table]->primary,$obj[$models[$table]->primary])->get()['data'][0];

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

            $models[$table]->update($obj);
            $response['success'] = true;
            break;
        }
        case "delete":
        {
            $obj = $models[$table]->jsonDecode($_POST['obj'],false);
            if($obj['primary']) $obj[$models[$table]->primary] = $obj['primary'];

            if($file_use) {
                $getData = $models[$table]->where($models[$table]->primary,$obj[$models[$table]->primary])->get()['data'][0];
                $file->deleteDirGate($getData['data_column']);
            }

            $data = $models[$table]->delete($obj);

            $response['success'] = true;
            break;
        }

        case "query":
        {
            $obj = $models[$table]->jsonDecode($_POST['obj'],false);

            $data = $models[$table]->query($obj['query']);
            $response['data'] = $data;
            $response['success'] = true;
            break;
        }

        case "where_delete" :
            $obj = $models[$table]->jsonDecode($_POST['obj'],false);
            $models[$table]->setFilter($obj);

            $models[$table]->where($obj)->whereDelete();
            $response['success'] = true;
            break;

        case "distinct" :
            $obj = $models[$table]->jsonDecode($_POST['obj'],false);
            $models[$table]->setFilter($obj);

            $object = $models[$table]->distinct($obj);

            $response['data'] = $object['data'];
            $response['sql'] = $object['sql'];
            $response['success'] = true;
            break;

        case "csv_insert" :

            break;

        //csv 파일 만들고 다운받는 처리
        case "csv" :
            $obj = $models[$table]->jsonDecode($_POST['obj']);

            //필터 가공
            $models[$table]->setFilter($obj);

            $object = $models[$table]->where($obj)->get();

            $header = [
                ['구분', '캐쉬백 신청일시', '신청인 성명',"신청인 휴대폰","신청인 고객사명","해피라이프 이용일자","이용인 성명"]
            ];
            $field = [
                "type","reg_date","mb_name","mb_hp","mb_company","use_date","use_name"
            ];
            $csv = new JlCsv($header,$field,$object);

            $csv->getCsv();
            die(); //return이 안되는 void메소드 echo로 파일출력값을 찍어내기때문에 바로 die처리

        default :
            $response['success'] = false;
            $response['message'] = "_method가 존재하지않습니다.";
    }

    echo json_encode($response);

} catch (Exception $e) {
    echo $e->getMessage();
}


?>