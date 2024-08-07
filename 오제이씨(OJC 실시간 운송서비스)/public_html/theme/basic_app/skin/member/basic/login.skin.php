<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css?v='.G5_CSS_VER.'">', 0);
?>
<style>
html, body{width:100%;background:#fff; overflow-y:hidden; overflow-x:hidden;background: url(../theme/basic_app/img/common/bg.png) center center no-repeat; background-size: cover}
	input[type=checkbox]:checked + label {color: #fff}
</style>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">

    <p><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_w.svg" class="icon"></p>
    <p><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_copy_w.svg" class="logo"></p>
    <p>운송 관리 시스템</p>

	  <ul class="tabs">
    <li class="tab-link current" data-tab="tab-1">고객사</li>
    <li class="tab-link" data-tab="tab-2">배송기사</li>
  </ul>
 
  <!--고객사 탭-->
  <div id="tab-1" class="tab-content current">
   <fieldset id="login_fs">
        <legend>회원로그인</legend>
        <label for="customer_id" class="login_id"><strong class="sound_only"> 필수</strong></label>
        <input type="text" id="customer_id" required class="frm_input required class-name" size="20" maxLength="20" placeholder="ID">
        <label for="customer_password" class="login_pw"><strong class="sound_only"> 필수</strong></label>
        <input type="password" id="customer_password" required class="frm_input required class-name" size="20" maxLength="20" placeholder="●●●●">
    </fieldset>    
    <input type="checkbox" id="customerAutoID" checked> <label for="customerAutoID" style="margin-right: 10px;"> 아이디 저장</label>
    <input type="checkbox" id="customerAutoLogin" checked> <label for="customerAutoLogin"> 로그인 유지</label>	
	<div class="button" onclick="customerLogin()">
		<input type="submit" value="로그인" class="btn_submit">
    </div>
    <button type="button" class="btn_signup" onclick="location.href='<?php echo G5_BBS_URL ?>/register_form.php'">아직 회원이 아니신가요?</button>        
  </div>
  
  <!--배송기사 탭-->
  <div id="tab-2" class="tab-content">    
      <fieldset id="login_fs">
          <legend>회원로그인</legend>
          <label for="driver_id" class="login_id"><strong class="sound_only"> 필수</strong></label>
          <input type="text" id="driver_id" required class="frm_input required class-name" size="20" maxLength="20" placeholder="ID">
          <label for="driver_password" class="login_pw"><strong class="sound_only"> 필수</strong></label>
          <input type="password" id="driver_password" required class="frm_input required class-name" size="20" maxLength="20" placeholder="●●●●">
      </fieldset>      
        <input type="checkbox" id="driverAutoID" checked> <label for="driverAutoID" style="margin-right: 10px;"> 아이디 저장</label>
        <input type="checkbox" id="driverAutoLogin" checked> <label for="driverAutoLogin"> 로그인 유지</label>        
      <div class="button" onclick="deliveryLogin()">
          <input type="submit" value="조회" class="btn_submit">
      </div>
  </div>
</div>

<script>
    
    function defaultSetup(){
        
        clearHistory(); /* 뒤로가기 막기 */  
        
        $('#customer_id').val(getCookie("customerAutoID"));
        $('#driver_id').val(getCookie("driverAutoID"));
    }
    
    // 고객사 로그인
    async function customerLogin(){
        let $customer_id = $('#customer_id'),
            $customer_password = $('#customer_password'),
            falseMsg = '',
            target = null;        
        
        if(!$customer_id.val()){
            falseMsg = '아이디를 입력해주세요.';
            target = $customer_id;
        }else if(!$customer_password.val()){
            falseMsg = '비밀번호를 입력해주세요.';
            target = $customer_password;
        }
        
        if(target != null){
            swal(falseMsg)
            .then(() => {
                target.focus();
            });            
            return;
        }
        
        const customerLoginRes = await postJson(getAjaxUrl('member'), {
            mode : 'customerLogin',
            mb_id : $customer_id.val(),
            mb_password : $customer_password.val(),
            auto_login : ($('#customerAutoLogin').is(':checked')? 'Y' : 'N')
        });

        if(!customerLoginRes.result){
            swal(customerLoginRes.msg);
            return false;
        }
        
        /* 고객사 아이디 저장 */        
        if($('#customerAutoID').is(':checked')){
            setCookie("customerAutoID", $customer_id.val(), 365);
        }else{
            deleteCookie("customerAutoID");
        }
        
        if($customer_id.val() == 'lets080' || $customer_id.val() == 'admin'){
            location.replace(`${rootUrl}/adm`);
        }else{
            location.replace(`${rootUrl}/app/index2.php`);
        }        
    }
    
    // 배송기사 로그인
    async function deliveryLogin(){
        let $driver_id = $('#driver_id'),
            $driver_password = $('#driver_password'),
            falseMsg = '',
            target = null;        
        
        if(!$driver_id.val()){
            falseMsg = '아이디를 입력해주세요.';
            target = $driver_id;
        }else if(!$driver_password.val()){
            falseMsg = '비밀번호를 입력해주세요.';
            target = $driver_password;
        }
        
        if(target != null){
            swal(falseMsg)
            .then(() => {
                target.focus();
            });            
            return;
        }
        
        const deliveryLoginRes = await postJson(getAjaxUrl('member'), {
            mode : 'deliveryLogin',
            mb_id : $driver_id.val(),
            mb_password : $driver_password.val(),
            auto_login : ($('#driverAutoLogin').is(':checked')? 'Y' : 'N')
        });

        if(!deliveryLoginRes.result){
            swal(deliveryLoginRes.msg);
            return false;
        }
        
        /* 기사 아이디 저장 */
        if($('#driverAutoID').is(':checked')){
            setCookie("driverAutoID", $driver_id.val(), 365);
        }else{
            deleteCookie("driverAutoID");
        }
                        
        location.replace(`${rootUrl}/app`);
    }    
    
    $(function(){
        
        // 고객사 ENTER 이벤트
        $('#customer_id, #customer_password').on('keyup', function(e){
            if(e.keyCode != 13) return false;
            
            customerLogin();
            return false;
        });
        
        // 배송기사 ENTER 이벤트
        $('#driver_id, #driver_password').on('keyup', function(e){
            if(e.keyCode != 13) return false;
            
            deliveryLogin();
            return false;
        });
        
        $('ul.tabs li').click(function(){
            let tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        });
        
        defaultSetup();           
    });
 
</script>
<!-- } 로그인 끝 -->
