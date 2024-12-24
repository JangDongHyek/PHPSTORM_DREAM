<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$mb_type) $mb_type = $member['mb_type'];
if(!$mb_type) $mb_type = "일반";

if(!$mb_sns_type) $mb_sns_type = $member['mb_sns_type'];

if($mb_email) $member['mb_email'] = $mb_email;
if($mb_nickname) $member['mb_nick'] = $mb_nickname;
if($mb_profile) $member['mb_profile'] = $mb_profile;
if($mb_sns_type) $member['mb_sns_type'] = $mb_sns_type;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>
<link rel="stylesheet" href="<?php echo $member_skin_url;?>/style.css">
<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
        <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="url" value="<?php echo $urlencode ?>">
        <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
        <input type="hidden" name="cert_no" value="">
        <input type="hidden" name="mb_cert_no" id="mb_cert_no" value="">
        <input type="hidden" name="mb_cert_yes" id="mb_cert_yes" value="<?php echo $w=="u"?"1":"";?>">
        <input type="hidden" name="mb_id" id="reg_mb_id" value="<?php echo $member['mb_id'];?>">
        <input type="hidden" name="age" id="reg_age" value="<?php echo $member['age']?$member['age']:"30";?>">
        <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면 ?>
            <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
        <?php } ?>
        <?php if($w=="") { ?>

            <article class="box-article">
                <div class="box-body" style="margin-bottom:0;">
                    <div class="box-contitle">
                        회원가입정보 입력
                    </div>
                    <div class="notice-box">
                        <ul>
                            <li><span>1</span>추천인이 없으시면   없음 버튼터치하세요.</li>
                            <li><span>2</span>가입신청 버튼 누른후</li>
                            <li><span>3</span>회원가입을 축하합니다. </li>
                        </ul>
                    </div>

                    <div class="box-content box-bottom clearfix" style="border:none;">
                        <dl style="padding:0 0 5px 0">
                            <input type="tel" name="mb_id" id="mb_id" value="<?php echo $member['mb_id']?>" class="frm_input" style="width:<?php if($w=="") echo "calc(100% - 120px)"; else echo "100%;"?>" placeholder="본인ID : 01012345678" required onkeyup="this.value = number_only(this.value)">
                            <input type="button" class="btn btn-danger" value="인증번호 발송" onclick="setRec();" style="width:115px; height:38px; float:right; <?php if($w!="") echo "display:none;";?>">
                        </dl>


                        <dl id="set_rec" style="padding:0 0 5px 0; display:none;">
                            <input type="tel" name="mb_cert" id="mb_cert" value="" class="frm_input" style="width:calc(100% - 60px)" placeholder="인증번호 입력" onkeyup="this.value = number_only(this.value)">
                            <input type="button" class="btn btn-danger" value="인증" style="width:55px; height:38px; float:right;" onclick="setCert()">
                        </dl>
                        <dl id="stx_rec" style="padding:0 0 5px 0; display:;">
                        </dl>
                        <dl style="padding:0 0 5px 0">
                            <input type="text" name="mb_name" id="mb_name" value="<?php echo $member['mb_name'];?>" class="frm_input" style="width:100%;" placeholder="성명 홍길동" required>
                        </dl>
                        <dl style="padding:0 0 5px 0">
                            <input type="password" name="mb_password" id="mb_password" value="" class="frm_input" style="width:100%;" placeholder="임시비밀번호 1234 변경하세요">
                        </dl>
                        <dl style="padding:0 0 5px 0">
                            <input type="tel" name="mb_recommend" id="reg_mb_recommend" class="frm_input" placeholder="추천인 폰번호(입력하면 자동완성검색이 됩니다)" value="<?=$rcmmid?>" style="width:calc(100% - 60px)">
                            <!--<input type="button" class="btn btn-danger" value="없음" onclick="$('#reg_mb_recommend').val('없음');" style="width:55px; height:38px; float:right;">-->
                        </dl>
                        <dl id="recommend-list">

                        </dl>
                        ※ 회원가입 10,000 포인트 적립

                    </div>
                </div>
            </article>

            <article class="box-article">
                <!--
			<div class="box-body" style="margin-bottom:0;">
				<div class="box-contitle">
					위치기반 동의
				</div>
				<div class="box-content box-bottom clearfix" style="border:none;">
					<dl style="border:1px solid #EDEDED; padding:10px; height:150px; overflow-y:auto; ">
						<?php echo nl2br($config['cf_privacy']);?>
					</dl>
				</div>
				<div style="padding-top:10px;">
					<label for="reg_agree2"><input type="checkbox" id="reg_agree2" value="1" style="margin-top:0;"> 위치기반의 내용에 대해 동의합니다.</label>
				</div>
			</div>-->

                <div class="box-body" style="margin-bottom:0;">
                    <div class="box-contitle">
                        이용정책동의
                    </div>
                    <div class="box-content box-bottom clearfix" style="border:none;">
                        <dl style="border:1px solid #EDEDED; padding:10px; height:150px; overflow-y:auto; ">
                            <?php echo nl2br($config['cf_stipulation']);?>
                        </dl>
                    </div>
                    <div style="padding-top:10px;">
                        <label for="reg_agree"><input type="checkbox" id="reg_agree" value="1" style="margin-top:0;"> 이용정책의 내용에 대해 동의합니다.</label>
                    </div>



                    <div class="box-contitle">
                        개인정보처리방침안내
                    </div>
                    <div class="box-content box-bottom clearfix" style="border:none;">
                        <dl style="border:1px solid #EDEDED; padding:10px; height:150px; overflow-y:auto; ">
                            <?php echo nl2br($config['cf_privacy']);?>
                        </dl>
                    </div>
                    <div style="padding-top:10px;">
                        <label for="agree21"><input type="checkbox" id="agree21" value="1" style="margin-top:0;"> 개인정보처리방침안내의 내용에 동의합니다.</label>
                    </div>



            </article>

        <?php }else{ ?>
            <input type="hidden" name="mb_nick" id="mb_nick" value="<?php echo $member['mb_nick'];?>">
            <article class="box-article">
                <div class="box-body" style="margin-bottom:0;">
                    <div class="box-contitle">
                        프로필 <?php echo $w?"수정":"등록" ?>
                    </div>
                    <div class="box-content box-bottom clearfix" style="border:none;">
                        <dl id="thumb_preview" style="padding: 0 0 5px 0;">
                            <img src="<?php echo $member['mb_profile'];?>" alt=""><br/>
                        </dl>
                        <dl>
                            <label for="reg_mb_icon">회원아이콘</label>
                            <input type="file" name="mb_icon" id="reg_mb_icon" accept="image/*" onchange="getPreview(this)" class="frm_input" style="width:100%;"/>
                            <?php if ($w == 'u' && $member['mb_profile']) {  ?>
                                <input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon">
                                <label for="del_mb_icon" style="display:inline-block;">삭제</label>
                            <?php }  ?>
                        </dl>
                    </div>
                </div>
            </article>
        <?php } ?>

        <input type="submit" class="btn btn-primary btn-large" value="<?php echo $w==''?'가입신청':'정보수정'; ?>" accesskey="s" style="position:absolute; bottom:0; left:0; width:100%; height:auto; text-align:center;">
        </article>

    </form>
</div>

<script>
    var isRecommend=false;
    //추천인 번호 조회하기
    $(function(){

        $("#reg_mb_recommend").bind("keyup",function(){
            var mb_id=$(this).val();
            $.ajax({
                url:"./ajax.recommend.list.php",
                data:{"mb_id":mb_id},
                dataType:"html",
                type:"POST",
                success:function(data){
                    if(mb_id!=""){
                        $("#recommend-list").html(data);
                    }else{
                        $("#recommend-list").html("");
                        isRecommend=false;
                    }
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        });
        $("#reg_mb_recommend").bind("blur",function(){
            if($("#recommend-list").html()!=""){
                isRecommend=false;
            }
        });
    });
    //추천인 번호를 선택했을 때
    function recommendChoice(mb_id){
        isRecommend=true;
        $("#reg_mb_recommend").val(mb_id);
        $("#recommend-list").html("");
    }
    function setRec(){
        if(!$("#mb_id").val()){
            $("#stx_rec").css("display", "").html("아이디를 입력해주세요.");
            return false;
        }else{
            if($("#mb_id").val().length<11){
                alert("자릿수가 맞지 않습니다.");
                return false;
            }
            if($("#mb_id").val().substring(0,3)!="010"){
                alert("올바른 휴대폰 번호가 아닙니다.");
                return false;
            }
        }

        var mb_hp = $("#mb_id").val();
        $.post(g5_bbs_url + "/ajax.hp_check.php",{ "mb_hp":mb_hp }, function (result){
            if(result.status == "false"){
                $("#stx_rec").html("이미 회원가입한 회원입니다.");
                return false;
            }

            $("#mb_cert_no").val(result.cret);
            $("#set_rec").slideDown(300);

            //$("#mb_cert").val(result.cret);
            //setTimeout("autoCert('"+result.cret+"')","10000");
        }, "json");
    }

    function autoCert(cret){
        $("#mb_cert").val(cret);
    }

    var isInjung=false;
    function setCert(){
        if($("#mb_cert").val() != $("#mb_cert_no").val()){
            $("#stx_rec").html("<font color=red>인증번호가 틀렸습니다.</font>");
            isInjung=false;
        }else{
            $("#stx_rec").html("<font color=blue>인증이 완료 되었습니다.</font>");
            $("#mb_cert_yes").val("1");
            isInjung=true;
        }
    }

    /*
    $("#mb_id").on("change", function (e){
        $("#stx_rec").html("회원정보가 변경되었습니다. 다시 인증해주세요.");
        $("#mb_cert_yes").val("");
    });

    $(".c").click(function(){
        $(".c_on").addClass("c").removeClass("c_on");
        $(this).addClass("c_on").removeClass("c");
        $("#reg_age").val($(this).val());
    });
    */
    // submit 최종 폼체크
    function fregisterform_submit(f)
    {
        <?php if($w==""){ ?>
        if(isInjung==false){
            alert("인증번호를 확인하지 않았거나 또는 인증번호가 맞지 않습니다.");
            return false;
        }
        if($("#reg_agree").prop("checked") == false){
            alert("이용청잭약관에 대해 동의해주세요.");
            return false;
        }
        if($("#agree21").prop("checked")==false){
            alert("개인정보취급방침을 동의하십시오");
            return false;
        }


        if(isRecommend==false){
            if(confirm("추천인 번호가 없습니다. 그래도 가입하시겠습니까?")){
                $("#reg_mb_recommend").val("");
            }else{
                return false;
            }
        }


        <?php } ?>
        return true;
    }

    function getPreview(v) {
        var _target = $('#thumb_preview');

        if (v.files && v.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                _target.css('display', '');
                _target.html('<img src="' + e.target.result + '" border="0" alt="" />');
                fileCheck(document.fregisterform.mb_icon);
            }
            reader.readAsDataURL(v.files[0]);
        }
    }
    /* 업로드 체크 */
    function fileCheck( file ){
        // 사이즈체크
        var maxSize  = <?php echo $config['cf_member_icon_size'] ?>;
        var fileSize = 0;

        // 브라우저 확인
        var browser=navigator.appName;

        // 익스플로러일 경우
        if (browser=="Microsoft Internet Explorer"){
            var oas = new ActiveXObject("Scripting.FileSystemObject");
            fileSize = oas.getFile( file.value ).size;

            // 익스플로러가 아닐경우
        }else{
            fileSize = file.files[0].size;
        }


        //alert("파일사이즈 : "+ fileSize +", 최대파일사이즈 : 5MB");

        if(fileSize > maxSize)
        {
            alert("첨부파일 사이즈는 10MB 이내로 등록 가능합니다.");
            return;
        }
    }

    function number_only(num) {
        isInjung=false;
        num = num + "";
        num = num.replace(/[^0-9]/gi, "");

        if(isNaN(num)) return "";

        return num ;
    }
</script>