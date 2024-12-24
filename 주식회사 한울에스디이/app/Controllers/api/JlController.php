<?php
namespace App\Controllers\api;

use App\Controllers\BaseController;
use App\Libraries\Jl;
use App\Libraries\JlModel;
use App\Libraries\JlFile;
class JlController extends BaseController
{
    public $jl_response = array("message" => ""); // BaseController 내 response 란 객체가 존재해 변수명 변경

    public $obj = "";
    public $table = "";
    public $model = null;

    public $join = null;
    public $extensions = [];

    public $file_use = false;
    public $jl_file;
    public $file_columns = [];

    public function __construct() {
        $jl = new Jl();

        $this->obj = $jl->jsonDecode($_POST['obj']);
        $this->table = $this->obj['table'];
        if(!$this->table) $jl->error("JlController : 테이블명이 없습니다.");
        $this->model = new JlModel(array("table" => $this->table));

        if(isset($this->obj['join'])) $this->join = $jl->jsonDecode($this->obj['join']);
        if(isset($this->obj['extensions'])) $this->extensions = $jl->jsonDecode($this->obj['extensions']);

        $this->file_use = $this->obj['file_use'];
        $this->jl_file = new JlFile("/jl/jl_resource/$this->table");
        if(isset($this->obj['file_columns'])) $this->file_columns = $jl->jsonDecode($this->obj['file_columns']);

    }

    public function method() {
        $_method = $_POST['_method'];

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

            case "query" : {
                $this->query();
                break;
            }

            case "where_delete" : {
                $this->where_delete();
                break;
            }

            case "distinct" : {
                $this->distinct();
                break;
            }

            default : {
                $this->error("method 설정이 안되어있습니다.");
                break;
            }
        }
    }

    public function get() {
        $this->model->setFilter($this->obj);

        $getInfo = array(
            "page" => $this->obj['page'],
            "limit" => $this->obj['limit'],
            "sql" => true // true 시 쿼리문이 반환된다
        );

        //join
        if ($this->join) {
            $this->model->join($this->join['table'],$this->join['origin'],$this->join['join']);
            // 조인 필터링
            //$model->where("join_column","value","AND",$join_table);
            //$model->between("join_column","start","end","AND",$join_table);
            //$model->in("join_column",array("value1","value2"),"AND",$join_table);
            //$model->like("join_column","value","AND",$join_table);

            if($this->join['source']) $getInfo['source'] = $this->join['table'];
            if($this->join['select']) $getInfo['select'] = $this->join['select'];
        }



        $object = $this->model->where($this->obj)->get($getInfo);

        //$extensions ex) 고유키로 필요한 테이블데이터를 조인대신 한번 더 조회해서 가져와 확장하는 형식 속도는 join이랑 비슷하거나 빠름
        foreach($this->extensions as $info) {
            $joinModel = new JlModel(array(
                "table" => $info['table'],
            ));

            foreach ($object["data"] as $index => $data) {
                if(!$data[$info['foreign']]) continue;
                $joinModel->where($joinModel->primary, $data[$info['foreign']]);
                $join_data = $joinModel->get()['data'][0];

                //$extensions은 변수명이 첫번째에 무조건 $로 진행 확장데이터일시 수정에 문제가 발생함 첫글자 $ 필드 삭제 처리는 jl.js에 있음
                $object["data"][$index]["$".$info['table']] = $join_data;
            }
        }

        $this->jl_response['data'] = $object['data'];
        $this->jl_response['count'] = $object['count'];
        $this->jl_response['filter'] = $this->obj;
        $this->jl_response['success'] = true;

        echo json_encode($this->jl_response);
    }

    public function insert() {
        if($this->file_use) {
            foreach ($_FILES as $key => $file_data) {
                $file_result = $this->jl_file->bindGate($file_data);
                $obj[$key] = $file_result;
            }
        }

        $this->jl_response['idx'] = $this->model->insert($this->obj);
        $this->jl_response['success'] = true;

        echo json_encode($this->jl_response);
    }

    public function update() {
        if($this->file_use) {
            //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
            $getData = $this->model->where($this->model->primary,$this->obj[$this->model->primary])->get()['data'][0];

            foreach ($_FILES as $key => $file_data) {
                $file_result = $this->jl_file->bindGate($file_data);
                if(!$file_result) continue;

                if(is_array($file_data['name'])) {
                    //바인드의 리턴값은 encode되서 오기때문에 decode
                    $file_result = json_decode($file_result, true);
                    $result = array_merge($getData[$key],$file_result);
                    //문자열로 저장되어야하기떄문에 encode
                    $this->obj[$key] = json_encode($result,JSON_UNESCAPED_UNICODE);
                }else {
                    $this->obj[$key] = $file_result;
                }
            }
        }

        $this->model->update($this->obj);
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function delete() {
        if($this->obj['primary']) $this->obj[$this->model->primary] = $this->obj['primary'];

        if($this->file_use) {
            $getData = $this->model->where($this->model->primary,$this->obj[$this->model->primary])->get()['data'][0];

            foreach ($this->file_columns as $column) {
                $this->jl_file->deleteDirGate($getData[$column]);
            }
        }

        $data = $this->model->delete($this->obj);

        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function query() {
        $data = $this->model->query($this->obj['query']);
        $this->jl_response['data'] = $data;
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function where_delete() {
        $this->model->setFilter($this->obj);

        $getData = $this->model->where($this->obj)->get();

        if($this->file_use) {
            foreach ($getData as $d) {
                foreach ($this->file_columns as $column) {
                    $this->jl_file->deleteDirGate($d[$column]);
                }
            }
        }

        $this->model->where($this->obj)->whereDelete();
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function distinct() {
        $this->model->setFilter($this->obj);

        $object = $this->model->where($this->obj)->distinct($this->obj);

        $this->jl_response['data'] = $object['data'];
        $this->jl_response['sql'] = $object['sql'];
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

}