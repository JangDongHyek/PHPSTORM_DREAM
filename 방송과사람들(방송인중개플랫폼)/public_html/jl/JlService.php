<?php
//namespace App\Libraries;
require_once("Jl.php");
class JlService extends Jl{
    private $POST;
    private $FILES;

    private $obj;
    private $file_use = false;
    private $file_columns = array();

    private $model;
    private $session_model;
    private $jl_file;

    public function __construct($POST,$FILES)
    {
        parent::__construct(false);
        $this->obj = $this->jsonDecode($POST['obj']);
        if(!$this->obj['table']) $this->error("obj에 테이블이 없습니다.");

        if(isset($this->obj['file_columns'])) $this->file_columns = $this->jsonDecode($this->obj['file_columns']);
        if(isset($this->obj['file_use'])) $this->file_use = $this->obj['file_use'];

        if($POST['_method'] != "file") $this->model = new JlModel($this->obj);
        $this->jl_file = new JlFile("/jl/jl_resource/{$this->obj['table']}");

        $this->POST = $POST;
        $this->FILES = $FILES;

        $this->session_model = new JlModel("jl_session");

    }

    public function method() {
        $method = $this->POST['_method'];

        $token = $this->session_model->where(array("client_ip" => $this->getClientIP(),"name" => "token"))->get()['data'][0];

        if(!$this->obj['jl_token']) $this->error("잘못된 접근입니다.");
        if(!$token) $this->error("토큰 세션이 없습니다.");
        if($token['content'] != $this->obj['jl_token']) $this->error("토큰 값이 서로 다릅니다.");


        $response = array(
            "success" => false,
            "message" => "_method가 존재하지않습니다."
        );

        if($method == "get" || $method == "read") $response = $this->get();
        if($method == "insert" || $method == "create") $response = $this->insert();
        if($method == "update" || $method == "put") $response = $this->update();
        if($method == "delete" || $method == "remove") $response = $this->delete();
        if($method == "query") $response = $this->query();
        if($method == "where_delete" || $method == "wd") $response = $this->where_delete();
        if($method == "file") $response = $this->file();
        if($method == "distinct") $response = $this->distinct();

        $trace_list = array("insert","create","update","put","delete","remove","where_delete","wd");
        if(in_array($method,$trace_list)) {
            $result = $response['success'] ? '성공' : "실패";
            $this->sessionTrace("{$this->obj['table']} 테이블 $method 요청 {$result}");
        }
        if($method)

            return $response;
    }

    public function get() {
        $this->model->setFilter($this->obj);

        $join = null;
        $extensions = array();
        if(isset($this->obj['join'])) $join = $this->jsonDecode($this->obj['join']);
        if(isset($this->obj['extensions'])) $extensions = $this->jsonDecode($this->obj['extensions']);

        $getInfo = array(
            "page" => $this->obj['page'],
            "limit" => $this->obj['limit'],
            "sql" => true // true 시 쿼리문이 반환된다
        );

        if ($join) {
            $this->model->join($join['table'],$join['origin'],$join['join']);
            // 조인 필터링
            //$model->where("join_column","value","AND",$join_table);
            //$model->between("join_column","start","end","AND",$join_table);
            //$model->in("join_column",array("value1","value2"),"AND",$join_table);
            //$model->like("join_column","value","AND",$join_table);

            if($join['source']) $getInfo['source'] = $join['table'];
            if($join['select']) $getInfo['select'] = $join['select'];
        }

        $object = $this->model->where($this->obj)->get($getInfo);

        foreach($extensions as $info) {
            $info = $this->jsonDecode($info);
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

        $response['data'] = $object['data'];
        $response['count'] = $object['count'];
        $response['filter'] = $this->obj;
        $response['sql'] = $object['sql'];
        $response['success'] = true;

        return $response;
    }

    public function insert() {
        if($this->file_use) {
            foreach ($this->FILES as $key => $file_data) {
                $file_result = $this->jl_file->bindGate($file_data);
                $obj[$key] = $file_result;
            }
        }else{
            if(count($_FILES)) $this->error("파일을 사용하지않는데 첨부된 파일이 있습니다.");
        }



        $response['idx'] = $this->model->insert($this->obj);
        $response['success'] = true;

        return $response;
    }

    public function update() {
        if($this->file_use) {
            //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
            $getData = $this->model->where($this->model->primary,$this->obj[$this->model->primary])->get()['data'][0];

            foreach ($this->FILES as $key => $file_data) {
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
        $response['success'] = true;

        return $response;
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

        $response['success'] = true;

        return $response;
    }

    public function query() {
        $data = $this->model->query($this->obj['query']);
        $response['data'] = $data;
        $response['success'] = true;

        return $response;
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
        $response['success'] = true;

        return $response;
    }

    public function file() {
        foreach ($this->FILES as $key => $file_data) {
            $file_result = $this->jl_file->bindGate($file_data);
        }

        $response['file'] = $this->jsonDecode($file_result);
        $response['success'] = true;

        return $response;
    }

    public function distinct() {
        $this->model->setFilter($this->obj);

        $object = $this->model->where($this->obj)->distinct($this->obj);

        $response['data'] = $object['data'];
        $response['sql'] = $object['sql'];
        $response['success'] = true;

        return $response;
    }
}
?>