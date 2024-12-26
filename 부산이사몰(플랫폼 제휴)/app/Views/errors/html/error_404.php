<!DOCTYPE html>
<html lang="en">
<head>
    <link href="/css/all.min.css?<?=CSS_VER?>" rel="stylesheet" type="text/css" />
    <link href="/css/common.css?<?=CSS_VER?>" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <title>404 ERROR</title>
    <script>
        // 5초 후에 메인 페이지로 이동
        setTimeout(function() {
            window.location.href = "<?=base_url()?>";
        });
    </script>
</head>
<body class="error_wrap">
<div class="box">
    <!--<img src="/img/common/logo.png" style="width: 100px;margin-bottom: 50px">-->
    <h1>404 ERROR</h1>
    <p>
        존재하지 않는 페이지 입니다.<br>
        페이지의 주소를 잘못 입력하셨거나, <br>주소가 변경 또는 삭제되어 <br>요청하신 페이지를 찾을 수 없습니다.

        <br>
        <?php
        if (IS_PRIVATE) {
            print_r(current_url() ?? '');
        }
        $data = [
            'error' => '404',
            'url' => current_url(),
        ];
        log_message('debug', print_r($data, true));
        ?>
    </p>
    <br>
    <a class="btn btn_color" href="<?=base_url()?>">메인으로 이동</a>
</div>
<!--<div class="box_line">
    <h1>부산이사몰 리뉴얼 안내</h1>
    <p>더 나은 서비스와 사용자 경험을 제공하기 위해<br>
        홈페이지와 앱이 새롭게 리뉴얼되었습니다!<br>
        업데이트된 내용을 확인하려면 아래 버튼을 클릭하세요.</p>
    <div class="btn_wrap">
        <button onclick="location.href='https://play.google.com/store/apps/details?id=com.knn24form.knn24form'">안드로이드 다운로드</button>
        <button onclick="location.href='https://apps.apple.com/kr/app/%EB%B6%80%EC%82%B0%EC%9D%B4%EC%82%AC%EB%AA%B0/id6738668836'">IOS 다운로드</button>
    </div>
</div>-->


</body>
</html>
