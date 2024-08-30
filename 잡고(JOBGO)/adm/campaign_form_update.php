<?php
include_once('./_common.php');
include_once("../jl/JlConfig.php");
try {
    $model = new JlModel(array(
        "table" => "campaign",
        "primary" => "idx",
        "autoincrement" => true,
        "empty" => false
    ));

    $file = new JlFile("/data/campaign");

    if(!$_POST["w"]) {
        $obj = $_POST;
        foreach ($_FILES as $key => $file_data) {
            $file_result = $file->bindGate($file_data);
            $obj[$key] = $file_result;
        }

        $model->insert($obj);
    }else {
        $obj = $_POST;

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

        $model->update($obj);
    }

    goto_url($jl->URL."/adm/campaign_list.php");

}catch(Exception $e){

}
//var_dump(array("aa" => "sd"));
//echo "<br>-------------------------------------------<br>";
//var_dump($_POST);
//echo "<br>-------------------------------------------<br>";
//
//var_dump($_FILES);
?>