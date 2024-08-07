</div>

<? if ($footer_type == 1) { ?>
<? } else if ($footer_type == 2) { ?>
<div class="menuwrap">
    <nav id="menu">
        <!-- "메뉴목록 표시" -->
		
		<div class="list" style="min-height: 0px;border-top: 1px solid #ececec">
		  <table class="" border="0" width="100%">
			  	<colgroup>
					<col width="">			  
					<col width="70px">			  
			    </colgroup>				  
				  <tr>
					<th class=""><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_copy.svg" class="" style="max-height: 10px"></th>
					<td style="color:#74748B"><i class="fa-duotone fa-user"></i> <strong><?=$member['mb_name']?></strong> 님</td>
				  </tr>
		  </table>
		</div>
        <ul class="category_list">
           <? if($member['mb_type'] == CUSTOMER){ ?> 
                <li class=""><a href="<?=APP_URL?>/index2.php" class="link_sub_item">메인</a></li>
                <!--li class=""><a href="<?=G5_BBS_URL?>/content.php?co_id=privacy" class="link_sub_item">개인정보처리방침</a></li-->

                <li class=""><a class="link_sub_item" href="<?=G5_BBS_URL?>/register_form.php?w=u">내정보 수정</a></li>                
           <? }else{ ?>
                <li class=""><a href="<?=APP_URL?>" class="link_sub_item">메인</a></li>
                <li class=""><a href="<?=G5_BBS_URL?>/content.php?co_id=privacy" class="link_sub_item">개인정보처리방침</a></li>
<!--
                <li class=""><a class="link_sub_item">공지사항</a></li>
                <li class=""><a class="link_sub_item">고객센터 전화연결</a></li>                
-->
           <? } ?>                      
           <li class=""><a id="btn_logout" class="link_sub_item" href="<?=G5_BBS_URL?>/logout.php?type=app">로그아웃</a></li>
           <? if(IsTest){ ?>
               <li class="" style="margin-top: 50px;"><a class="link_sub_item" onclick="removeMember()">회원탈퇴 신청</a></li>
           <? } ?>
        </ul>            
    </nav>
</div>

<script>
    function removeMember(){
        
        swal({
            text: '회원 탈퇴 신청하시겠습니까?\n오제이씨 관리자 확인 후 탈퇴가 진행됩니다.',
            buttons: true
        }).then(async (result) => {
            if(!result) return;
            
            swal('탈퇴 신청되었습니다.\n오제이씨를 이용해주셔서 감사합니다.')
            .then(() => {
                location.href = `${g5_bbs_url}/logout.php?type=app`;
            });
        });
    }
    
document.addEventListener('DOMContentLoaded', function(){
    document.querySelector(".mobile-menu").addEventListener("click", function(e){
        if ( document.querySelector('.menuwrap').addClass('on') ){
            //메뉴닫힘
            document.querySelector('.menuwrap').removeClass('on');
        } else {
            //메뉴펼처짐
            document.querySelector('.menuwrap').addClass('on');
        }
    });
});
    
document.addEventListener('DOMContentLoaded', function(){
    document.querySelector(".mobile-menu").addEventListener("click", function(e){
        if ( document.querySelector('.menuwrap').addClass('on') ){
            //메뉴닫힘
            document.querySelector('.menuwrap').removeClass('on');
        } else {
            //메뉴펼처짐
            document.querySelector('.menuwrap').addClass('on');
        }
    });
});
    
document.addEventListener('DOMContentLoaded', function(){
    document.querySelector(".mobile-menu").addEventListener("click", function(e){
        if ( document.querySelector('.menuwrap').classList.contains('on') ){
            //메뉴닫힘
            document.querySelector('.menuwrap').classList.remove('on');
            document.querySelector('.mobile-menu i').classList.remove('fa-times')
            document.querySelector('.mobile-menu i').classList.add('fa-bars');
        } else {
            //메뉴펼침
            document.querySelector('.menuwrap').classList.add('on');
            document.querySelector('.mobile-menu i').classList.remove('fa-bars');
            document.querySelector('.mobile-menu i').classList.add('fa-times');
        }
    });
});
</script>
<!--div id="ft_menu">
	<ul>
    	<li <?php if($pid == "index") { echo "class='on'"; }?>>
            <a href="<?php echo G5_URL ?>/app/index.php">
            <i class="fa-light fa-house-chimney"></i><i class="fa-solid fa-house-chimney"></i><p>홈</p></a></li>
    	<li <?php if($pid == "") { echo "class='on'"; }?>>
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
            <i class="fa-light fa-bars"></i><i class="fa-solid fa-bars"></i><p>카테고리</p></a></li>
    	<li <?php if($pid == "" ) { echo "class='on'"; }?>>
            <a href="javascript:alert('준비중입니다.')">
            <i class="fa-light fa-message-dollar"></i><i class="fa-solid fa-message-dollar"></i><p>가격정보</p></a></li>
    	<li <?php if($pid == "" ) { echo "class='on'"; }?>>
            <a href="javascript:alert('준비중입니다.')">
            <i class="fa-light fa-clipboard-list"></i><i class="fa-solid fa-clipboard-list"></i><p>내 예약</p></a></li>
            
    	<li <?php if($pid == "mypage" ) { echo "class='on'"; }?>>
			<?php if ($is_member) {  ?>
            <a href="<?php echo G5_URL ?>/app/mypage.php"><i class="fa-light fa-square-user"></i><i class="fa-solid fa-square-user"></i><p>마이페이지</p></a>
            <?php } else {  ?>
            <a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa-light fa-square-user"></i><i class="fa-solid fa-square-user"></i><p>로그인</p></a>
            <?php }  ?>
        </li>
    </ul>
    <!-- Modal -->
    <!--div id="circle">
    <div class="modal fade" id="sch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <a href="<?php echo G5_URL ?>/app/sch_map.php"><i class="fa-regular fa-map-location-dot"></i><p>지도검색</p></a>
            <a href="<?php echo G5_URL ?>/app/sch_list.php"><i class="fa-regular fa-list-check"></i><p>목록검색</p></a>
          </div>
        </div>
      </div>
    </div>
    </div>
</div-->
<? } else { ?>
<? } ?>


<?php
require_once('../tail.sub.php');
?>