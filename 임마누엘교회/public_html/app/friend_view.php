<?php
$pid = "friend_form";
include_once("./app_head.php");

?>
    <div id="friend" class="view">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./friend'"><i class="fa-solid fa-arrow-left"></i> 교우소식 목록</button>
        <div class="box_radius box_white table">
            <p><b class="icon icon_color">장례</b></p>
            <h6 class="txt_color">13교구 | 안드레 권사</h6>
            <p>기간 | 24.8.20 - 24.8.22 </p>
            <hr>
            <h6>안드레 권사 부친상</h6><!--제목-->
            <p>함께 기도 부탁드립니다</p><!--내용-->
            <hr>
            <p class="flex gap10">
                <b class="icon icon_line w100px">장소</b>주소지
                <button type="button" class="btn btn_gray btn_mini male-auto">복사</button>
            </p>
            <!-- * 카카오맵 - 지도퍼가기 -->
            <!-- 1. 지도 노드 -->
            <div id="daumRoughmapContainer1724213001735" class="root_daum_roughmap root_daum_roughmap_landing" style="width: 100%"></div>

            <!--
                2. 설치 스크립트
                * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
            -->
            <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

            <!-- 3. 실행 스크립트 -->
            <script charset="UTF-8">
                new daum.roughmap.Lander({
                    "timestamp" : "1724213001735",
                    "key" : "2kehb",
                    "mapHeight" : "200"
                }).render();
            </script>

            <p class="flex gap10">
                <b class="icon icon_line w100px">마음전할곳</b>은행 계좌번호 (예금주)
                <button type="button" class="btn btn_gray btn_mini male-auto">복사</button>
            </p>
        </div>
    </div>

<?php
include_once("./app_tail.php");
?>