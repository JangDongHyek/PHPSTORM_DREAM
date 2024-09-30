<?php
namespace App\Libraries;

namespace App\Controllers\app;
use App\Controllers\BaseController;

use App\Libraries\Jl;
use App\Libraries\JlModel;
use App\Libraries\JlFile;

/*
 주의사항
 use Exception 을 하는순간 try catch 문 작동 안합니다.
 */

class BoardController extends BaseController
{
    public $models = [];
    public $jl_response = array("message" => ""); // BaseController 내 response 란 객체가 존재해 변수명 변경
    public $join_table = '';
    public $get_tables = [];

    public $table = "board";
    public $file_use = true;
    public $file;

    public function __construct() {
        $this->models[$this->table] = new JlModel(array("table" => $this->table));
        if($this->file_use) {
            $this->file = new JlFile("/jl/jl_resource/{$this->table}");
        }

        //array_push($this->get_tables,array("table"=> "exam", "get_key" => "exam_key" ));
    }

    public function method() {
        $_method = $this->request->getPost('_method');

        switch (strtolower($_method)) {
            case "get" : {
                $this->get();
                break;
            }
            case "insert" : {
                $this->insert();
                break;
            }
            case "update" : {
                $this->update();
                break;
            }
            case "delete" : {
                $this->delete();
                break;
            }
        }
    }

    public function get() {
        $obj = $this->models[$this->table]->jsonDecode($this->request->getPost('obj'));

        //필터링
        if($obj['primary']) $obj[$this->models[$this->table]->primary] = $obj['primary'];
        if($obj['search_key1'] && $obj['search_value1_1'] && $obj['search_value1_2'] == "") $this->models[$this->table]->where($obj['search_key1'],$obj['search_value1_1']);
        if($obj['search_key1'] && $obj['search_value1_1'] && $obj['search_value1_2']) $this->models[$this->table]->between($obj['search_key1'],$obj['search_value1_1'],$obj['search_value1_2']);
        if($obj['search_like_key1'] && $obj['search_like_value1']) $this->models[$this->table]->like($obj['search_like_key1'],$obj['search_like_value1']);
        if($obj['order_by_desc']) $this->models[$this->table]->orderBy($obj['order_by_desc'],"DESC");
        if($obj['order_by_asc']) $this->models[$this->table]->orderBy($obj['order_by_asc'],"ASC");
        if($obj['not_key1'] && $obj['not_value1']) $this->models[$this->table]->where($obj['not_key1'],$obj['not_value1'],"AND NOT");
        if($obj['in_key1'] && $obj['in_value1']) $this->models[$this->table]->in($obj['in_key1'],$this->models[$this->table]->jsonDecode($obj['in_value1']));

        //join
        if ($this->join_table) {
            $this->models[$this->table]->join($this->join_table,"origin_key","join_key");
            // 조인 필터링
            //$model->where("join_column","value","AND",$join_table);
            //$model->between("join_column","start","end","AND",$join_table);
            //$model->in("join_column",array("value1","value2"),"AND",$join_table);
            //$model->like("join_column","value","AND",$join_table);
        }

        $object = $this->models[$this->table]->where($obj)->get(array(
            "page" => $obj['page'],
            "limit" => $obj['limit'],
            //"source" => "joinTable",
            //"select" => "joinTable.SearchColumn AS alias",
            "sql" => true
        ));

        //getKey ex) 고유키로 필요한 테이블데이터를 조인대신 한번 더 조회해서 가져오는형식 속도는 join이랑 비슷하거나 빠름
        foreach($this->get_tables as $index => $info) {
            $joinModel = new JlModel(array(
                "table" => $info['table'],
            ));

            foreach ($object["data"] as $index => $data) {
                $joinModel->where($joinModel->primary, $data[$info['get_key']]);
                $join_data = $joinModel->get()['data'][0];

                //Join시 변수명은 무조건 대문자로 진행 데이터 업데이트시 문제발생함 대문자 필드 삭제 처리는 JS에 있음
                $object["data"][$index][strtoupper($info['table'])] = $join_data;
            }
        }

        $this->jl_response['data'] = $object['data'];
        $this->jl_response['count'] = $object['count'];
        $this->jl_response['filter'] = $object['filter'];
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function insert() {
        $obj = $this->models[$this->table]->jsonDecode($this->request->getPost('obj'));

        $session = session();
        $user = $session->get("user");
        if(!$user) $this->models[$this->table]->error('로그인이 필요한 기능입니다.');

        $obj['user_idx'] = $user['idx'];

        if($this->file_use) {
            foreach ($_FILES as $key => $file_data) {
                $file_result = $this->file->bindGate($file_data);
                $obj[$key] = $file_result;
            }
        }

        $this->models[$this->table]->insert($obj);
        $this->jl_response['obj'] = $obj;
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);



    }

    public function update() {
        $obj = $this->models[$this->table]->jsonDecode($this->request->getPost('obj'));

        if($this->file_use) {
            //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
            $getData = $this->models[$this->table]->where($this->models[$this->table]->primary,$obj[$this->models[$this->table]->primary])->get()['data'][0];

            foreach ($_FILES as $key => $file_data) {
                $file_result = $this->file->bindGate($file_data);
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


        $this->models[$this->table]->update($obj);
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function delete() {

    }

}