<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원가입결과 시작 { -->
<div id="reg_result" class="mbskin">
	
	<div id="result_box">
        <div class="name">
            <strong><?php echo get_text($mb['mb_name']); ?></strong>님의 ‘도운’ 회원가입에 진심으로 감사드립니다.<br>
        </div>
    
    
        <p>
            로그인하시면 도운빌딩에서 진행되는 클래스 신청이 가능하며, 대관 관련 비용을 확인 하실 수 있습니다.
        </p>
    
        <p>
            앞으로 나라셀라 도운빌딩에 많은 관심 부탁드리며 와인 복합문화공간으로서 도운에서 특별하고 새로운 와인 문화를 경험하실 수 있기를 기대합니다.
        </p>
        <p>
            아이디, 비밀번호 분실 시에는 회원가입 시 입력하신 이메일 주소를 이용하여 찾을 수 있습니다.
        </p>
	</div>
    
    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/" class="btn02">메인으로</a>
    </div>

</div>
<!-- } 회원가입결과 끝 -->

<script>

    $(document).ready(function() {
        sendAlimTalk();
    });

    function sendAlimTalk() {
        var mb_name = '<?=$mb['mb_name']?>';
        var mb_hp = '<?=$mb['mb_hp']?>';
        var templateCode = '0';
        
        mb_hp = mb_hp.replaceAll('-', '');

        $.ajax({
            url: '/~naracelllar/API/send_alim_talk.php',
            type: 'POST',
            //contentType: 'application/json',
            dataType: 'json',
            data: {
                mb_name: mb_name,
                mb_hp: mb_hp,
                templateCode: templateCode
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
    }

/*
    function sendAlimTalk(templateCode) {
        var mb_name = '<?=$mb['mb_name']?>';
        var mb_hp = '<?=$mb['mb_hp']?>';

        debugger;

        $.ajax({
            type: "POST",
            url: '/~naracelllar/API/send_alim_talk.php',
            data: {
                'mb_name': mb_name,
                'mb_hp': mb_hp,
                'templateCode': templateCode
            },//Have u tried this
            success: function (output) {
                debugger;
                alert(output);
            },
            error: function (request, status, error) {
                debugger;
                alert("Error: Could not delete");
            }
        });


    }

    */

</script>