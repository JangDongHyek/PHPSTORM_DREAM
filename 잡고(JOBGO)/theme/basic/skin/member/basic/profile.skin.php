<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<style>
body{background: #f5f5f5;}
.box-article .box-body dd input {
	background: #f3f6fc !important;
}
.box-article .box-body dd input {
	background: #fff !important;
	border: 1px solid #e6e6e6;
	border-radius: 0 !important;
}
.box-article .box-body dd textarea {
	background: #fff !important;
	border: 1px solid #e6e6e6;
	border-radius: 0 !important;
	width:100%;
	padding:20px;
}
#profile section{ padding:30px 0}
.mem_info{ border:0}
.mem_info p.name{ margin:30px 0 15px}
</style>


<!-- 프로필 관리 -->
<article id="profile" class="new_win mbskin_profile">

                        <section class="mem_info">
                              <!--사진--> 
                              <div class="myimg">   
                                    <a href="#" class="btn_mod"></a>               
                                    <!-- 등록 이미지 있을 경우 -->
                                    <div class="p_box">

                                        <div class="img_rd">
                                            <img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/default.png' alt="프로필 기본이미지">
                                        </div>
                                        <p class="name"> 태양청년</p>
                                        <!--<button type="button" class="btn" style="position: absolute;bottom: 80px;border-radius: 100%;left: 80px;width: 30px;height: 30px;display: inline-block;">X</button>-->
                                    </div>
                              </div>
                              
                              <!--<div class="profile">
                                    <ul>
                                       <li>
                                           <dl>
                                              <dt>총 작업수</dt>
                                              <dd>565<span>건</span></dd>
                                           </dl>
                                       </li>
                                       <li>
                                           <dl>
                                              <dt>의뢰인 만족도</dt>
                                              <dd>98%</dd>
                                           </dl>
                                       </li>
                                       <li>
                                           <dl>
                                              <dt>평균응답시간</dt>
                                              <dd>1시간<span>이내</span></dd>
                                           </dl>
                                       </li>
                                    </ul>
                              </div>-->
                              
                              <div class="box-article">
                                  <div id="join_info">
                                      <div class="box-body">
                                            <dl class="row">
                                                <dd class="col-xs-1 req">*</dd>
                                                <dd class="col-xs-12">
                                                    <label for="reg_mb_phonenum">전화번호</label>
                                                    <input type="text" name="mb_phonenum" value="<?php echo $member['mb_phonenum'] ?>" id="reg_mb_phonenummb" class="regist-input <?php echo $required ?>" placeholder="전화번호 입력" <?php if($w=="u") echo "readonly";?>>
                                                </dd>
                                                <dd class="error col-xs-12"></dd>
                                            </dl>
                                            <dl class="row">
                                                <dd class="col-xs-1 req">*</dd>
                                                <dd class="col-xs-12">
                                                    <label for="reg_mb_worktime">연락가능시간</label>
                                                    <input type="text" name="mb_worktime" value="<?php echo $member['mb_worktime'] ?>" id="reg_mb_worktime" class="regist-input <?php echo $required ?>" placeholder="연락가능시간 입력 예)10시~20시" <?php if($w=="u") echo "readonly";?>>
                                                </dd>
                                                <dd class="error col-xs-12"></dd>
                                            </dl>
                                            <dl class="row">
                                                <dd class="col-xs-1 req">*</dd>
                                                <dd class="col-xs-12">
                                                    <label for="reg_mb_worktime">평균응답시간</label>
                                                    <input type="text" name="mb_worktime" value="<?php echo $member['mb_worktime'] ?>" id="reg_mb_worktime" class="regist-input <?php echo $required ?>" placeholder="평균응답시간 입력 예)1시간 이내" <?php if($w=="u") echo "readonly";?>>
                                                </dd>
                                                <dd class="error col-xs-12"></dd>
                                            </dl>
                                            <dl class="row">
                                                <dd class="col-xs-1 req">*</dd>
                                                <dd class="col-xs-12">
                                                    <label for="reg_mb_introduce">자기소개</label>
                                                    <textarea placeholder="자기소개를 입력해주세요." maxlength="255" rows="6" spellcheck="false" id="reg_mb_introduce" style="height: 204px;"></textarea>
                                                </dd>
                                                <dd class="error col-xs-12"></dd>
                                            </dl>
                                      </div>
                                   </div>
                                   <input type="submit" class="btn_submit ft_btn" value="프로필저장" accesskey="s">
                              </div>  
                                                         
                        </section>
                        
</article>
<!-- //프로필 관리 -->