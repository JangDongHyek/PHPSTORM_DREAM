<?php
//namespace App\Libraries;
require_once("Jl.php");
class JlService extends Jl{
    private $POST;
    private $FILES;
    private $SESSION;

    private $obj;
    private $file_use = false;
    private $file_columns = array();

    private $model;
    private $session_model;
    private $jl_file;

    public function __construct($POST,$FILES,$SESSION)
    {
        parent::__construct(false);
        $this->obj = $this->jsonDecode($POST['obj']);

        $values = array("file","file_save","file_exists","captcha_image","captcha_check");
        if(!in_array($POST['_method'], $values)) {
            if(!$this->obj['table']) $this->error("obj에 테이블이 없습니다.");
        }

        if(isset($this->obj['file_columns'])) $this->file_columns = $this->jsonDecode($this->obj['file_columns']);
        if(isset($this->obj['file_use'])) $this->file_use = $this->obj['file_use'];

        if(!in_array($POST['_method'], $values)) $this->model = new JlModel($this->obj);
        $this->jl_file = new JlFile("/jl/jl_resource/{$this->obj['table']}");

        $this->POST = $POST;
        $this->FILES = $FILES;
        $this->SESSION = $SESSION;

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
        if($method == "file" || $method == "file_save") $response = $this->fileSave();
        if($method == "file_exists") $response = $this->fileExists();
        if($method == "distinct") $response = $this->distinct();
        if($method == "captcha_image") $response = $this->captchaImage();
        if($method == "captcha_check") $response = $this->captchaCheck();

        $trace_list = array("insert","create","update","put","delete","remove","where_delete","wd");
        if(in_array($method,$trace_list) && $response['trace']) {
            $object = array(
                "method" => $method,
                "response" => $response,
                "sessions" => $this->SESSION
            );
            $this->sessionTrace($object);
        }

        return $response;
    }

    public function get() {
        $join = null;
        $extensions = array();
        $relations = array();
        if(isset($this->obj['join'])) $join = $this->jsonDecode($this->obj['join']);
        if(isset($this->obj['extensions'])) $extensions = $this->jsonDecode($this->obj['extensions']);
        if(isset($this->obj['relations'])) $relations = $this->jsonDecode($this->obj['relations']);

        $getInfo = array(
            "page" => $this->obj['page'],
            "limit" => $this->obj['limit'],
            "sql" => true // true 시 쿼리문이 반환된다
        );

        if ($join) {
            $this->model->join($join['table'],$join['origin'],$join['join'],$join['type']);
            // 조인 필터링
            //$model->where("join_column","value","AND",$join_table);
            //$model->between("join_column","start","end","AND",$join_table);
            //$model->in("join_column",array("value1","value2"),"AND",$join_table);
            //$model->like("join_column","value","AND",$join_table);

            if($join['source']) $getInfo['source'] = $join['table'];
            if($join['select']) $getInfo['select'] = $this->jsonDecode($join['select']);

            if($join['group_by']) {
                $groups = $this->jsonDecode($join['group_by'],false);
                foreach ($groups as $group) {
                    $this->model->groupBy($group['group'],$group['aggregate'],$group['as'],$group['type']);
                }
            }
        }

        $this->model->setFilter($this->obj);


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
                if($info['as']) {
                    $object["data"][$index]["$".$info['as']] = $join_data;
                }else {
                    $object["data"][$index]["$".$info['table']] = $join_data;
                }
            }
        }

        foreach($relations as $info) {
            $info = $this->jsonDecode($info);
            $joinModel = new JlModel(array(
                "table" => $info['table'],
            ));

            foreach ($object["data"] as $index => $data) {
                if(!$info['foreign']) continue;
                if($info['filter']) {
                    $info_filter = $this->jsonDecode($info['filter']);
                    $joinModel->setFilter($info_filter);
                }
                $joinModel->where($info['foreign'],$data[$this->model->primary]);

                if($info['type'] == 'count') $join_data = $joinModel->count();
                else $join_data = $joinModel->get()['data'];


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
        $checked = $this->iuCheck();

        if(!$checked) {
            return array("success" => true, "message" => "checked 로 인한 sql 패스","trace" => false);
        }

        if($this->file_use) {
            foreach ($this->FILES as $key => $file_data) {
                $file_result = $this->jl_file->bindGate($file_data);
                $this->obj[$key] = $file_result;
            }
        }else{
            if(count($_FILES)) $this->error("파일을 사용하지않는데 첨부된 파일이 있습니다.");
        }

        $response = $this->model->insert($this->obj);

        $response['success'] = true;
        $response['trace'] = true;

        return $response;
    }

    public function update() {
        $checked = $this->iuCheck();

        if(!$checked) {
            return array("success" => true, "message" => "checked 로 인한 sql 패스","trace" => false);
        }

        if($this->file_use) {
            //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
            //$getData = $this->model->where($this->model->primary,$this->obj[$this->model->primary])->get()['data'][0];

            foreach ($this->FILES as $key => $file_data) {
                $objKeyValue = $this->jsonDecode($this->obj[$key],false);

                $file_result = $this->jl_file->bindGate($file_data);
                if(!$file_result) continue;

                if(is_array($file_data['name'])) {
                    //바인드의 리턴값은 encode되서 오기때문에 decode
                    $file_result = json_decode($file_result, true);
                    $result = array_merge($objKeyValue,$file_result);
                    //문자열로 저장되어야하기떄문에 encode
                    $this->obj[$key] = json_encode($result,JSON_UNESCAPED_UNICODE);
                }else {
                    $this->obj[$key] = $file_result;
                }
            }
        }

        $response = $this->model->update($this->obj);
        $response['success'] = true;
        $response['trace'] = true;

        return $response;
    }

    public function delete() {
        $this->model->setFilter($this->obj);
        $getData = $this->model->where($this->obj)->get()['data'][0];

        if($this->file_use) {

            foreach ($this->file_columns as $column) {
                $this->jl_file->deleteDirGate($getData[$column]);
            }
        }

        $data = $this->model->delete($this->obj);

        $response['data'] = $getData;
        $response['success'] = true;
        $response['trace'] = true;

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

        $response['data'] = $getData;
        $response['success'] = true;
        $response['trace'] = true;

        return $response;
    }

    public function fileSave() {
        foreach ($this->FILES as $key => $file_data) {
            $file_result = $this->jl_file->bindGate($file_data);
        }

        $response['file'] = $this->jsonDecode($file_result);
        $response['success'] = true;

        return $response;
    }

    public function fileExists() {
        $response['exists'] = $this->isFileExists($this->obj['src']);
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

    //insert 나 update 하기전 조건 체크
    public function iuCheck() {
        //조건에 해당하는 데이터가있으면 error를 반환
        if(isset($this->obj['exists'])) {
            $exists = $this->jsonDecode($this->obj['exists']);
            foreach ($exists as $filter) {
                $filter = $this->jsonDecode($filter);
                $this->model->setFilter($filter);
                $search = $this->model->get();
                if($search['count']) $this->error($filter['message']);
            }
        }

        if(isset($this->obj['hashes'])) {
            $hashes = $this->jsonDecode($this->obj['hashes']);
            foreach ($hashes as $hash) {
                $hash = $this->jsonDecode($hash);
                if($this->obj[$hash['key']]) $this->obj[$hash['convert']] = password_hash($this->obj[$hash['key']],PASSWORD_DEFAULT);
            }
        }

        if(isset($this->obj['session_exists'])) {
            $session_exists = $this->jsonDecode($this->obj['session_exists']);
            foreach ($session_exists as $s_exists) {
                $s_exists = $this->jsonDecode($s_exists);
                $this->session_model->where("content",$s_exists['content']);
                $this->session_model->where('client_ip',$this->getClientIP());
                $this->session_model->where('status','active');
                $row = $this->session_model->get();

                if($row['count']) {
                    if($s_exists['exit_type'] == 'error') $this->error("iuCheck() : {$s_exists['content']} 세션이 존재합니다.");
                    else if($s_exists['exit_type'] == 'stop') return false;
                }
            }
        }

        if(isset($this->obj['session_insert'])) {
            $session_insert = $this->jsonDecode($this->obj['session_insert']);
            foreach ($session_insert as $insert) {
                $insert = $this->jsonDecode($insert);
                $this->session_model->where("content",$insert['content']);
                $this->session_model->where('client_ip',$this->getClientIP());
                $this->session_model->where('status','active');
                $row = $this->session_model->get();

                if(!$row['count']) {
                    $agent = $this->getUserAgent();

                    $this->session_model->insert(array(
                        "client_ip" => $this->getClientIP(),
                        "name" => "session",
                        "status" => "active",
                        "content" => $insert['content'],
                        "user_agent" => $agent['user_agent'],
                        "browser" => $agent['browser'],
                        "browser_version" => $agent['browser_version'],
                        "platform" => $agent['platform'],
                        "is_mobile" => $agent['is_mobile'],
                        "in_app_browser" => $agent['in_app_browser'],
                        "delete_date" => $this->getTime(4),
                    ));
                }
            }
        }

        return true;
    }

    public function captchaCheck() {
        if($this->obj['captcha_code'] == $_SESSION['jl_captcha']) {
            return [
                'success' => true
            ];
        }else {
            return [
                'success' => false,
                'message' => "자동등록방지가 정확하지않습니다."
            ];
        }
    }

    public function captchaImage() {
        // 문자 유형 선택
        $char_pool = [
            "number" => "0123456789",
            "eng" => "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz",
            "number_eng" => "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"
        ];

        // 랜덤 문자열 생성
        $char_list = $char_pool[JL_CAPTCHAR_PATTERN];
        $captcha_text = "";
        for ($i = 0; $i < 6; $i++) {
            $captcha_text .= $char_list[rand(0, strlen($char_list) - 1)];
        }
        $_SESSION['jl_captcha'] = $captcha_text;

        $width = 150;
        $height = 50;
        $image = imagecreatetruecolor($width, $height);

        $background_color = imagecolorallocate($image, 255, 255, 255); // 흰색 배경
        $text_color = imagecolorallocate($image, 0, 0, 0); // 검은색 텍스트
        $noise_color = imagecolorallocate($image, 100, 100, 100); // 노이즈 색상

        // 배경 색상 채우기
        imagefilledrectangle($image, 0, 0, $width, $height, $background_color);

        // 랜덤 노이즈 추가 (점, 선)
        for ($i = 0; $i < 300; $i++) {
            imagesetpixel($image, rand(0, $width), rand(0, $height), $noise_color);
        }
        for ($i = 0; $i < 10; $i++) {
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $noise_color);
        }

        // 폰트 설정
        $font = $this->ROOT . "/jl/font/" . JL_FONT;
        $use_ttf = file_exists($font); // 폰트 파일 존재 여부 확인


        // 개별 문자 랜덤 배치 (폰트 유무에 따라 다르게 처리)
        $x = 15;
        for ($i = 0; $i < strlen($captcha_text); $i++) {
            $angle = rand(-30, 30); // 랜덤 회전
            $y = rand(30, 40); // Y축 위치 랜덤 조정

            if ($use_ttf) {
                // TTF 폰트가 있을 경우
                imagettftext($image, JL_FONTSIZE, $angle, $x, $y, $text_color, $font, $captcha_text[$i]);
            } else {
                // 기본 GD 라이브러리 폰트 사용 < 기본 폰트시 글자크기 변경 불가능
                imagestring($image, 5, $x, 15, $captcha_text[$i], $text_color);
            }

            $x += JL_FONTSIZE - 5; // 글자 크기에 따라 간격 조정
        }

        // 왜곡 효과 적용
        $distorted_image = imagecreatetruecolor($width, $height);
        imagefilledrectangle($distorted_image, 0, 0, $width, $height, $background_color);

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $newX = (int)($x + sin($y / 10) * 5); // X축 왜곡
                $newY = (int)($y + cos($x / 10) * 5); // Y축 왜곡
                if ($newX >= 0 && $newX < $width && $newY >= 0 && $newY < $height) {
                    imagesetpixel($distorted_image, $newX, $newY, imagecolorat($image, $x, $y));
                }
            }
        }

        //폴더 생성
        $dir = $this->RESOURCE.'/captcha/';
        if(!is_dir($dir)) {
            mkdir($dir, 0777);
            chmod($dir, 0777);
        }
        $captcha_filename = "captcha_" . time() . ".png";
        $captcha_path = $dir . $captcha_filename;
        imagepng($distorted_image, $captcha_path);

        imagedestroy($image);
        imagedestroy($distorted_image);

        // 5분지난 파일 삭제
        $captcha_files = glob($dir . "captcha_*.png"); // 기존 CAPTCHA 파일 찾기
        foreach ($captcha_files as $file) {
            if (filemtime($file) < time() - 300) { // 300초 = 5분
                unlink($file);
            }
        }

        // 응답 반환
        return [
            "success" => true,
            "src" => $this->URL . "/jl/jl_resource/captcha/" . $captcha_filename
        ];
    }
}
?>