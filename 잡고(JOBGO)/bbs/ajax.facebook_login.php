<?php
include_once('./_common.php');
include_once('./_head.sub.php');
?>

<!--<a onclick="fnFbCustomLogout();">로그아웃</a>-->
<form id="formdata" name="formdata" method="post" action="<?=G5_BBS_URL?>/register_form.php">
    <input type="hidden" id="mb_name" name="mb_name">
    <input type="hidden" id="email" name="email">
    <input type="hidden" id="certify" name="certify">
    <input type="hidden" id="sns" name="sns" value="facebook">
</form>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
    $(function() {
        window.fbAsyncInit = function() {
            FB.init({
                appId      : <?=$app_id?>, // 내 앱 ID를 입력한다.
                cookie     : true,
                xfbml      : true,
                version    : 'v11.0'
            });
            FB.AppEvents.logPageView();
        };

        setTimeout(function(){ // FB.init() 함수보다 먼저 동작하여 setTimeout 적용
            fnFbCustomLogin();
            //fnFbCustomLogout();
        },1000);
    });

    function statusChangeCallback(res){
        statusChangeCallback(response);
    }

    function fnFbCustomLogin(){
        FB.login(function(response) {
            //alert(response.status);
            //alert('login');
            if (response.status === 'connected') {
                FB.api('/me', 'get', {fields: 'email, name'}, function(r) {
                    console.log('email', r.email);
                    console.log('name', r.name);
                    console.log('id', r.id);
                    console.log(r);

                    $('#email').val(r.id);
                    $('#mb_name').val(r.name);
                    $('#certify').val('facebook');
                });

                setTimeout(function(){
                    $('#formdata').submit(); // 회원가입 폼으로 넘김
                }, 1000);
            }
        }, {scope: 'public_profile'}); // 이메일 받아오기 위해서 scope (앱에서 사용할 권한 목록) 추가 필요
    }

    function fnFbCustomLogout() {
        //alert('logout');
        FB.getLoginStatus(function(response) {
            if(response.status === 'connected') {
                FB.logout(function(response) {
                    swal('로그아웃');
                    location.href = g5_url;
                });
            }
        });
    }
</script>