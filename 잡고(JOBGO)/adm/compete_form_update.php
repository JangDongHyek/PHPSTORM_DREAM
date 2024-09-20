<?
include_once('./_common.php');
include_once("../jl/JlConfig.php");

try{
    $model = new JlModel(array(
        "table" => "compete",
        "primary" => "idx",
        "autoincrement" => true,
        "empty" => false
    ));

    $file = new JlFile("/jl/jl_resource/compete");

    if(!$_POST["w"]) {
        $obj = $_POST;
        $obj['prize'] = $model->jsonDecode($obj['prize'],false);
        $obj['content'] = str_replace('\\', '', $obj['content']);
        $obj['reference'] = str_replace('\\', '', $obj['reference']);

        $obj['prize'] = json_encode($obj['prize'], JSON_UNESCAPED_UNICODE);
        foreach ($_FILES as $key => $file_data) {
            $file_result = $file->bindGate($file_data);
            $obj[$key] = $file_result;
        }

        $model->insert($obj);

        goto_url($jl->URL."/adm/compete_list.php");

    }else {
        $obj = $_POST;
        $obj['prize'] = $model->jsonDecode($obj['prize'],false);
        $obj['prize'] = json_encode($obj['prize'], JSON_UNESCAPED_UNICODE);
        $obj['content'] = str_replace('\\', '', $obj['content']);
        $obj['reference'] = str_replace('\\', '', $obj['reference']);

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

        goto_url($jl->URL."/adm/compete_list.php");

    }
}catch (Exception $e) {

}
?>