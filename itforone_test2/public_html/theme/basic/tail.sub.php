<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<script>
    const useFcm = true;

    $(document).ready(function(){
        chkLogin();
        endSplash();
        getFcm();
    });

    /*
        ===========================
        웹에서 앱으로 요청 시작
        ===========================
     */

    // 앱으로 아이디를 넘겨줌
    function chkLogin() {
        const os = getDeviceModel();
        const mb_id = "<?=$member['mb_id']?>" || "";
        try {
            if (os === "android") {
                window.dreamforone.setLogin(mb_id);
                //window.dreamforone.showLeftMenu(false);
            } else if (os === "ios") {
                window.webkit.messageHandlers.setLogin.postMessage(mb_id);
            }
        } catch (error) {
            console.error(error);
        }
    }

    // 스플래시 이미지 제거
    function endSplash() {
        const os = getDeviceModel();
        try {
            if (os === "android") {
                window.dreamforone.endSplash();
            } else if (os === "ios") {
                //window.webkit.messageHandlers.endSplash.postMessage(mb_id);
            }
        } catch (error) {
            console.error(error);
        }
    }

    // 앱에서 위치정보를 가져 오도록 요청 ( setAppPosition 으로 반환 )
    function getAppPosition() {
        const os = getDeviceModel();
        try {
            if (os === "android") {
                window.dreamforone.getAppPosition();
            } else if (os === "ios") {
                //window.webkit.messageHandlers.getAppPosition.postMessage(mb_id);
            }
        } catch (error) {
            console.error(error);
        }
    }

    // 앱에서 FCM토큰을 가져 오도록 요청 ( setFcm 으로 반환 )
    function getFcm() {
        if(useFcm){
            const os = getDeviceModel();
            const mb_id = "<?=$member['mb_id']?>" || "";
            try {
                if (os === "android") {
                    window.dreamforone.getFcm(mb_id);
                    //window.dreamforone.showLeftMenu(false);
                } else if (os === "ios") {
                    window.webkit.messageHandlers.getFcm.postMessage(mb_id);
                }
            } catch (error) {
                console.error(error);
            }
        }

    }

    /*
        ==================
        웹에서 앱으로 요청 끝
        ==================
    */


    /*
        ===========================
        앱에서 웹으로 요청 시작
        ===========================
    */

    // FCM 토큰을 받아서 db에 저장
    function setFcm(token){
        const os = getDeviceModel();
        const mb_id = "<?=$member['mb_id']?>" || "";
        $.post("<?=G5_URL?>/fcm/fcmInsert.php",{"mb_id":mb_id, "token":token, "os":os}, function(data){
        });
    }

    // 위치정보를 받아옴
    function setAppPosition(lat, lng) {
        try {
            setMapLatLng(lat, lng);
        } catch (error) {
        }
    }

    // 뒤로가기 눌렀을때 작동
   function onBackPage(){
       const os = getDeviceModel();
       let returnObj = {"type": "goBack", "url": ""};
       // 앱이 아니면 리턴 평범하게 뒤로가기
       if("<?=$is_app?>" == false) {
           //history.back();
           return JSON.stringify(returnObj);
       }

       // 메뉴창이 열려있다면
       if($("#left_menu").hasClass("open")){
           $("#left_menu").removeClass("open");
           if(os == "android"){
               try {
                   returnObj.type = "stop";
                   return returnObj;
               } catch (error) {
                   console.error(error);
               }
           }
       }

       let parameter = $(location).attr('search');
       let pathname = $(location).attr('pathname');
       let href = $(location).attr('href');

       // 메인으로 가야하는 url
       if(isMainUrl(href)){
           returnObj.type = "goUrl";
           returnObj.url = "<?=G5_URL?>";
           return JSON.stringify(returnObj);
       }

       // 종료해야하는 url
       if(isEndUrl(href)){
           returnObj.type = "end";
           return JSON.stringify(returnObj);
       }

       return JSON.stringify(returnObj);
    }

    /*
        ===========================
        앱에서 웹으로 요청 끝
        ===========================
    */


    function getDeviceModel() {
        const userAgent = navigator.userAgent.toLowerCase();
        const isMobile = /iphone|ipad|ipod|android/.test(userAgent);

        if (!isMobile) return "web";
        if (/android/.test(userAgent)) return "android";
        if (/iphone|ipad|ipod/.test(userAgent)) return "ios";

        return "other";
    }

    function isMainUrl(url) {
        let urlArr = url.split("?");
        let baseUrl = (urlArr.length > 0) ? urlArr[0] : url;

        let domain = "<?=G5_URL?>";
        let parameters = ["/app/saramin_list01.php","/app/saramin_list02.php"];
        let suffixes = ["", "#", "/", "/#"];

        for(let i = 0; i < parameters.length; i++) {
            for(let j = 0; j < suffixes.length; j++) {
                if(baseUrl === domain + parameters[i] + suffixes[j]) {
                    return true;
                }
            }
        }

        return false;
    }

    function isEndUrl(url) {
        let urlArr = url.split("?");
        let baseUrl = (urlArr.length > 0) ? urlArr[0] : url;

        let domain = "<?=G5_URL?>";
        let parameters = ["", "/app", "/app/login.php", "/app/index.php", "/bbs/login.php", "/app/red_map.php", "/app/shop_list.php"
                            , "/app/partner_map.php", "/app/user_list01.php"];
        let suffixes = ["", "#", "/", "/#"];

        for(let i = 0; i < parameters.length; i++) {
            for(let j = 0; j < suffixes.length; j++) {
                if(baseUrl === domain + parameters[i] + suffixes[j]) {
                    return true;
                }
            }
        }

        return false;
    }

</script>

<?php if ($is_admin == 'super') {  ?><!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> --><?php }  ?>

<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->

</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>