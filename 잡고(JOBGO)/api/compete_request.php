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

    $compete_model = new JlModel(array("table" => "compete"));

    $join_table = "";
    $get_tables = [];
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
                //"sql" => "getSql String"
            ));

            //getKey ex) 고유키로 필요한 테이블데이터를 조인대신 한번 더 조회해서 가져오는형식 속도는 join이랑 비슷하거나 빠름
            foreach($get_tables as $index => $info) {
                $joinModel = new JlModel(array(
                    "table" => $info['table'],
                ));

                foreach ($object["data"] as $index => $data) {
                    $joinModel->where($joinModel->primary, $data[$info['get_key']]);
                    $join_data = $joinModel->get()['data'][0];

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

            $compete = $compete_model->where("idx",$obj['compete_idx'])->get()['data'][0];

            $start_date = DateTime::createFromFormat('Y-m-d', explode(" ",$compete['start_date'])[0]);
            $end_date = DateTime::createFromFormat('Y-m-d', explode(" ",$compete['end_date'])[0]);

            $current_date = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));



            if($current_date < $start_date) $model->error("아직 모집 기간 전입니다.");
            if($start_date < $current_date) $model->error("모집 기간이 지났습니다.");

            $model->where("user_idx",$obj['user_idx']);
            $data = $model->where("compete_idx",$obj['compete_idx'])->get();

            if($data['count']) $model->error("이미 신청 되었습니다. 공모전 관리에서 확인 해주세요.");



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

        case "update2":
        {
            $obj = $model->jsonDecode($_POST['obj']);
            $users = $model->jsonDecode($obj['users'],false);

            $compete = $compete_model->where("idx",$obj['compete_idx'])->get()['data'][0];

            $msg = "";
            foreach($compete['prize'] as $p) {
                $count = $model->where("status",$p['rank'])->where("compete_idx",$compete['idx'])->count();
                //$count = $model->where("status",$p['rank'])->getSql(array("count" => true));
                //$msg .= $p['rank']."/".$count."\n";
                //$msg .= $count."\n";
                foreach ($users as $index => $u) {
                    if($p['rank'] == $u['status']) {
                        $count += 1;
                    }
                }
                if((int)$p['people'] < $count) $model->error("{$p['rank']}등은 {$p['people']}명까지 가능합니다.");
            }

            //$model->error($msg);
            foreach ($users as $index => $i) {
                $model->update($i);
            }

            $response['success'] = true;

            break;
        }

        case "delete":
        {
            $obj = $model->jsonDecode($_POST['obj'],false);

            if($file_use) {
                $getData = $model->where($model->primary,$obj[$model->primary])->get()['data'][0];
                $file->deleteDirGate($getData['compete_file']);
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