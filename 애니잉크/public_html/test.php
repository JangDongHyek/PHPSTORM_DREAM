<?php
//phpinfo();
//include_once("./common.php");
//
//$sql = "SELECT *
//FROM g5_write_new
//WHERE (
//SELECT COUNT( wr_id )
//FROM g5_write_as
//WHERE g5_write_as.wr_1 = g5_write_new.wr_id
//AND g5_write_as.wr_3
//BETWEEN DATE_SUB( CURDATE( ) , INTERVAL 1
//MONTH )
//AND CURDATE( )
//) =0
//ORDER BY `g5_write_new`.`wr_id` DESC
//LIMIT 20 OFFSET 0";
//
//$result = sql_query($sql);
//
//while ($row = sql_fetch_array($result))
//{
//    var_dump($row);
//    die();
//}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading Example</title>
    <style>
        /* 로딩 페이지 스타일 */
        #loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        #loading.hidden {
            display: none;
        }
        /* 메인 콘텐츠 숨김 */
        #content {
            display: none;
        }
    </style>
</head>
<body>
<!-- 로딩 페이지 -->
<div id="loading">
    <p>Loading...</p>
</div>
<? sleep(1);?>

<!-- 메인 콘텐츠 -->
<div id="content">
    <!-- PHP 데이터를 표시할 콘텐츠 -->
    <h1>MySQL 데이터 로딩 완료</h1>
    <p id="data"></p>
</div>

<script>
    // 로딩 숨기기 함수
    function hideLoading() {
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('content').style.display = 'block';
    }

    hideLoading();
</script>
</body>
</html>