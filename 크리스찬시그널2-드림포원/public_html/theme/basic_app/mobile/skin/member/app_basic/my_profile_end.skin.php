<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>



<!--프로필(작성완료)-->
<div id="my_profile" class="end">
    
    <!--작성 폼 시작--> 
    <div class="the_end">
    	<h1><img src="<?php echo G5_THEME_IMG_URL ?>/app/logo_st.png" class="logo"></h1>
        <div class="com">"정성이 담긴 프로필 작성에<br />진심으로 감사드립니다."</div>
        <div class="scom">프로필 심사 제출 후 심사가 완료되면<br />크리스찬시그널의 <strong>모든 컨텐츠 이용</strong>이 가능합니다.<br />조금만 기다려주세요.^^</div>
        <div class="top">
        	<strong>프로필 심사기간 : 2~3일 소요</strong>
            <div>* 심사 보류시 시간이 더 소요될 수 있습니다.</div>
        </div>
        
    <!--심사 제출하기--> 
    <div class="subm">
        <?php if($mb['mb_approval_request'] == 'N') { ?>
            <a class="profile" href="javascript:void(0);" onclick="profile_submit();">프로필 심사 제출하기</a>
        <?php } else { ?>
            <a class="profile">프로필 심사 중</a>
            <a style="margin: 6px 0;" onclick="location.replace(g5_url);">메인으로 가기</a>
        <?php } ?>
    </div>
    </div><!--the_end-->
    
    
</div><!--my_profile-->
<!--프로필(작성완료)-->

<script>
    function profile_submit() {
        $.ajax({
            url : g5_bbs_url + "/ajax.profile_approval_request.php",
            data: {
                mb_id : '<?=$mb_id?>',
            },
            type: 'POST',
            success : function(data) {
                if(data) {
                    swal('프로필 심사 제출이 완료되었습니다.')
                    .then(()=>{
                        location.reload();
                        $('.subm a .profile').text('프로필 심사 중');
                        $('.subm a .profile').attr('onclick', '');
                    });
                }
            }
        });
    }
</script>