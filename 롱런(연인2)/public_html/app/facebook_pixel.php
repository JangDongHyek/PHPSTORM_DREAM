<script>
    /*console.log('index');
    fbq('trackCustom', 'introPage', {
        content_name: '랜딩페이지 방문',
        value: '<?=$_SERVER['REMOTE_ADDR']?>',
    });*/

    function fbTagging(mode) {
        var event_name = "";
        var event_content = "";
        var url = "";

        switch (mode) {
            case 1 : // 회원가입완료
                event_name = "UserRegistered";
                event_content = "회원가입완료";
                url = g5_url + "/app/index.php";
                break;

            default:
                break;
            /*
            // 사길래
            case 1 :    // 랜딩 소개신청하기 버튼 (로그인)
                url += "/app/matching_list.php";
                event_name = "ClickIntroBtnRequest";
                event_content = "랜딩페이지 소개신청하기";
                break;
            case 2 :    // 랜딩 소개신청하기 버튼 (비로그인)
                url += "/app/register.php";
                event_name = "ClickIntroBtnRequest";
                event_content = "랜딩페이지 소개신청하기";
                break;
            case 3 :    // 랜딩 방문
                url = "";
                event_name = "introPage";
                event_content = "랜딩페이지 방문";
                break;
            case 4 :    // 오픈채팅
                url = "https://open.kakao.com/o/sayataFd";
                event_name = "ClickIntroBtnOpenChat";
                event_content = "랜딩페이지 오픈채팅";
                break;
            case 5 :    // 회원가입완료
                url = "";
                event_name = "memberJoin";
                event_content = "회원가입완료";
                break;
            default :
                url = "";
                break;
            */
        }

        // 태깅
        if (event_name != "") {
            console.log(event_name, event_content, url);
            //return false;
            fbq('trackCustom', event_name, {
                content_name: event_content,
                value: '<?=$_SERVER['REMOTE_ADDR']?>',
            });
        }

        if (url) {
            setTimeout(function () {
                location.href = url;
            }, 500);
        }
    }
</script>
