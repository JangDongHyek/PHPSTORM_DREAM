<?php
include_once("../jl/JlConfig.php");

$response = array("message" => "");
$_method = $_POST["_method"];
$file_name = str_replace(".php","",basename(__FILE__));

try {
    $model = new JlModel(array(
        "table" => $file_name,
        "primary" => "idx",
        "autoincrement" => true,
        "empty" => false
    ));

    $join_table = "";
    $join_table_delete = false; // true시 join테이블 데이터가 없으면 조회된 데이터 삭제

    //$file = new JlFile("/data/example");

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

            $object = $model->where($obj)->get(array(
                "page" => $obj['page'],
                "limit" => $obj['limit']
            ));

            if ($join_table) {
                $deletes = array();
                $joinModel = new JlModel(array(
                    "table" => $join_table,
                    "primary" => "idx"
                ));

                foreach ($object["data"] as $index => $data) {
                    $joinModel->where($joinModel->primary, $data["example_idx"]);
                    $join_data = $joinModel->get()['data'][0];

                    //Join시 변수명은 무조건 대문자로 진행 데이터 업데이트시 문제발생함
                    $object["data"][$index][strtoupper($join_table)] = $join_data;

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

            $response['data'] = $object['data'];
            $response['count'] = $object['count'];
            $response['filter'] = $obj;
            $response['success'] = true;
            break;
        }

        case "insert":
        {
            $compete_model = new JlModel(array(
                "table" => "compete",
                "primary" => "idx",
                "autoincrement" => true,
                "empty" => false
            ));

            $obj = $model->jsonDecode($_POST['obj']);

            $compete = $compete_model->where("idx",$obj['compete_idx'])->get()['data'][0];

            $data = $model->where($obj)->get();

            if($data['count']) {
                $model->delete($data['data'][0]);

                $compete['likes'] = $compete['likes'] - 1;
            }else {
                $model->insert($obj);

                $compete['likes'] = $compete['likes'] + 1;
            }

            $compete_model->update($compete);

            $response['success'] = true;
            break;
        }
        case "update":
        {
            $obj = $model->jsonDecode($_POST['obj']);

            //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
            $getData = $model->where($model->primary,$obj[$model->primary])->get()['data'][0];

            foreach ($_FILES as $key => $file_data) {
                $file_result = $file->bindGate($file_data);

                //bindGate() 리턴값은 encode되서 오기때문에 decode
                $file_result = json_decode($file_result, true);

                //데이터의 값은 encode되어있기떄문에 decode
                //$org_data = $model->jsonDecode($getData[$key],false);
                //$result = array_merge($org_data,$file_result);

                $result = array_merge($getData[$key],$file_result);

                //문자열로 저장되어야하기떄문에 encode
                $obj[$key] = json_encode($result,JSON_UNESCAPED_UNICODE);
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

        //csv 파일 만들고 다운받는 처리
        case "csv" :
            $obj = $model->jsonDecode($_POST['obj']);

            //필터 가공
            foreach ($obj as $key => $value) {
                if(strpos($key,"primary") !== false) $obj[$model->primary] = $value;
                if(strpos($key,"order_by_desc") !== false) $model->order_by($obj['order_by_desc'],"DESC");
                if(strpos($key,"order_by_asc") !== false) $model->order_by($obj['order_by_desc'],"ASC");
            }
            if($obj['search_key'] && $obj['search_value']) $model->like($obj['search_key'],$obj['search_value']);

            $object = $model->where($obj)->get();

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

}


?>