<?php
phpinfo();
exit;
?>

set_time_limit(0);
include_once('./_common.php');

// 데이터베이스에서 주소 데이터를 가져옵니다.
$sql = "SELECT wr_id, wr_1 FROM g5_write_store ";
$result = sql_query($sql);

$addresses = [];
while ($row = sql_fetch_array($result)) {
    $addresses[] = ['id' => $row['wr_id'], 'address' => $row['wr_1']];
}

// 주소 데이터를 JSON 형식으로 반환합니다.
$addressesJson = json_encode($addresses);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Coordinates</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=41982c9bef00b4da7a700cd6f86deef4&libraries=services"></script>
</head>
<body>
<script>
    $(document).ready(function() {
        // PHP에서 전달된 주소 데이터를 파싱합니다.
        var addresses = <?php echo $addressesJson; ?>;
        var geocoder = new daum.maps.services.Geocoder();

        function sendRequestWithDelay(index) {
            if (index >= addresses.length) {
                return; // 모든 요청이 완료됨
            }

            var item = addresses[index];

            geocoder.addressSearch(item.address, function(result, status) {
                if (status === daum.maps.services.Status.OK) {
                    var coords = {
                        id: item.id,
                        lat: result[0].y,
                        lng: result[0].x
                    };

                    // 서버로 좌표를 전송합니다.
                    $.ajax({
                        url: '<?=G5_URL?>/test2.php', // 실제 좌표 업데이트를 처리할 별도의 PHP 파일
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(coords),
                        success: function(response) {
                            console.log(response);
                            // 다음 요청을 1초 후에 보냅니다.
                            setTimeout(function() {
                                sendRequestWithDelay(index + 1);
                            }, 1000);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            // 에러 발생 시에도 다음 요청을 1초 후에 보냅니다.
                            setTimeout(function() {
                                sendRequestWithDelay(index + 1);
                            }, 1000);
                        }
                    });
                } else {
                    // 주소 검색 실패 시에도 다음 요청을 1초 후에 보냅니다.
                    setTimeout(function() {
                        sendRequestWithDelay(index + 1);
                    }, 1000);
                }
            });
        }

        // 첫 번째 요청을 시작합니다.
        sendRequestWithDelay(0);
    });
</script>
</body>
</html>