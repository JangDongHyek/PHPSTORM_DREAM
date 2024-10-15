<?
include_once('./_common.php');
include_once("../jl/JlConfig.php");

function replaceJsonValueQuotes($jsonString) {
    // 정규식을 사용하여 배열 [{}] 형식에서도 키에 해당하는 따옴표는 건드리지 않고 값에 있는 따옴표만 처리
    // (?<=:)는 콜론(:)이 앞에 있어야 한다는 의미로, 키와 값을 구분
    // (?<!\\\\)는 역슬래시로 이스케이프되지 않은 따옴표만 찾는다는 의미
    $pattern = '/(?<=:)(\s*)"([^"]*?)(?<!\\\\)"(\s*)([,}])/';

    // 배열 [{}] 구조를 포함하여 값에 있는 따옴표만 찾아서 변형
    $result = preg_replace_callback($pattern, function($matches) {
        // 변환된 값을 return
        return $matches[1] . '"' . str_replace('\"', '"', $matches[2]) . '"' . $matches[3] . $matches[4];
    }, $jsonString);

    return $result;
}

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