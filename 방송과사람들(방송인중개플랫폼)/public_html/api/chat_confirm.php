<?php
// 그누보드의 초기화 파일을 포함합니다.
include_once('./_common.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = json_decode(file_get_contents("php://input"), true);

    $mbNo = isset($data['message']['mbNo']) ? $data['message']['mbNo'] : null;
    $mbRoom = isset($data['message']['mbRoom']) ? $data['message']['mbRoom'] : null;

    if($mbNo !== null && $mbRoom !== null){
        $sql = "UPDATE member_chat SET confirm = NULL WHERE room_idx = '{$mbRoom}' and sender_idx != '{$mbNo}'";
        $result = sql_query($sql);

        if ($result) {
            $response = [
                'status' => 'success',
                'message' => '업데이트가 성공적으로 완료되었습니다.',
                'mbNo' => $mbNo,
                'mbRoom' => $mbRoom
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => '업데이트 중 오류가 발생했습니다.'
            ];
        }
    }else {
        $response = [
            'status' => 'error',
            'message' => 'mbNo 또는 mbRoom 값이 유효하지 않습니다.'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
