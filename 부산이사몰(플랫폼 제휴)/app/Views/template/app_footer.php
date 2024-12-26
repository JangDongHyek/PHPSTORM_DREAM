<?php if ($footer_type == 0) { ?>
<?php } else if ($footer_type == 1) { ?>
    <?php if ($pid != "app_index" && $pid != "app_ad") { ?>
        </div>
    </div>
    <?php } ?>
    <footer id="ft">
        <div class="inner">
            <div class="fnb dot_list">
                <ul class="flex ai-c">
                    <li><a href="<?=base_url()?>provision">사이트 이용약관</a></li>
                    <li><a href="<?=base_url()?>privacy" class="txt_color">개인정보처리방침</a></li>
                    <li><a href="<?=base_url()?>guideline">이사 계약시 유의사항</a></li>
                    <li><a href="<?=base_url()?>checklist">이사전 체크리스트</a></li>
                    <li><a href="<?=base_url()?>process">서비스 진행과정</a></li>
                </ul>
            </div>
            <div class="copy">
                <h1>부산이사몰(드림포원)</h1>
                <ul>
                    <li>대표전화 : <b>080-900-1212</b></li>
                    <li>주소 : 서울 구로구 디지털로31길 41 이앤씨벤처드림타워6차 901호</li>
                    <li>대표 : 김완준</li>
                    <li>사업자번호 : 605-25-83283</li>
                    <li>통신판매업신고번호 : 제 2015-부산연제-02587호</li>
                    <!--
                    <li>팩스 : 051-861-4104</li>-->
                    <!--<li>이메일 : knn2424@naver.com</li>-->
                </ul>
                <p>Copyright 2024. KNN24. All rights reserved.</p>
            </div>
        </div>
    </footer>
<?php } ?>

<?php include_once APPPATH."Views/template/app_modal.php" // 모달 ?>

<div id="gobtn">
    <a class="gohd" href="#hd"><i class="fa-regular fa-arrow-up"></i></a>
    <a class="goft" href="#ft"><i class="fa-regular fa-arrow-down"></i></a>
</div>
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
    if(!wcs_add) var wcs_add = {};
    wcs_add["wa"] = "2612194cb10aa";
    if(window.wcs) {
        wcs_do();
    }
</script>
</body>
</html>

<script>
    // 카톡브라우저 외부연결 호출
    const inAppDenyExec = (callback) => {
    if (document.readyState !== 'loading') {
    callback();
    } else {
    document.addEventListener('DOMContentLoaded', callback);
    }
    };
    inAppDenyExec(() => {
    // function copytoclipboard(val) {
    //     var t = document.createElement("textarea");
    //     document.body.appendChild(t);
    //     t.value = val;
    //     t.select();
    //     document.execCommand('copy');
    //     document.body.removeChild(t);
    // }

    // function inappbrowserout() {
    //     copytoclipboard(window.location.href);
    //     alert('URL주소가 복사되었습니다.\n\nSafari가 열리면 주소창을 길게 터치한 뒤, "붙여놓기 및 이동"를 누르면 정상적으로 이용하실 수 있습니다.');
    //     location.href = 'x-web-search://?';
    // }

    const userAgent = navigator.userAgent.toLowerCase();
    const targetUrl = location.href;

    if (userAgent.match(/kakaotalk/i)) {
    //카카오톡 외부브라우저로 호출
    location.href = 'kakaotalk://web/openExternal?url=' + encodeURIComponent(targetUrl);

    // html 삭제
    document.querySelector('#a4').remove();
    }
    });
</script>