<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="'.$member_skin_url.'/js/epggea.js"></script>', 100);

header('Location: '.G5_BBS_URL.'/my_item.php?tab=1',true,301);
?>
<style>
.box-article .box-body .row{ background:#fff}
.tab-content {
	display: none;
	float: left;
	width: 100%;
	padding: 0 0 1em 0;
	background:#fff;
}
#mypage #left_view{ display:block !important}
</style>

<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->
<!-- 여기안씀 -->

<!--마이페이지-->

<article id="mypage">


    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>


    <?php if ($member['mb_division'] == 2 || $is_admin){ //전문인 일때?>
        <section id="right_view">
         
              <!--잡고캐쉬-->
              <div class="cash_idx">
                    <ul>
                        <li>
                            <dl>
                                <dt>출금가능 캐쉬</dt>
                                <dd><?=number_format($member['mb_6'])?><span>원</span><a href="<?php echo G5_BBS_URL ?>/my_withdraw.php"><span class="account">출금 신청</span></a></dd>
                            </dl>
                        </li>

                        <li>
                            <a href="<?=G5_BBS_URL?>/my_mileage.php"><dl>
                                <dt>마일리지</dt>
                                <dd><?=number_format($member['mb_7'])?><span>원</span></dd>
                            </dl></a>
                        </li>
                        <li>
                            <a href="<?=G5_BBS_URL?>/my_income.php"><dl>
                                <dt>출금 내역</dt>
                                <dd><?=number_format($pay_cnt)?><span>건</span></dd>
                            </dl></a>
                        </li>
                    </ul>
              </div>
              <!--//잡고캐쉬-->
         
              <!--재능/공모/문의글 요약-->
              <div class="item_idx">
                    <ul>
                        <li>
                            <a href="<?=G5_BBS_URL?>/my_item.php"><dl>
                                <dt><i class="fal fa-lightbulb-on"></i>전체 재능</dt>
                                <dd><?=number_format($talent_cnt)?><span>건</span></dd>
                            </dl></a>
                        </li>
                        <li>
                            <a href="<?=G5_BBS_URL?>/my_contest.php"><dl>
                                <dt><i class="fal fa-trophy-alt"></i>전체 공모전</dt>
                                <dd><?=number_format($comp_cnt)?><span>건</span></dd>
                            </dl></a>
                        </li>
                        <li>
                            <a href="<?=G5_BBS_URL?>/my_inquiry.php"><dl>
                                <dt><i class="fal fa-newspaper"></i>전체 문의글</dt>
                                <dd><?=number_format($comm_cnt)?><span>건</span></dd>
                            </dl></a>
                        </li>
                    </ul>
              </div>
              <!--//재능/공모/문의글 요약-->
              
              
              <!--관련 재능분야 상품-->
              <h3 class="tit">관련 재능분야 상품</h3>
              
                     <div id="my_goods">
                            <div class="in">
                                <div class="list cf">
                                    <?php
                                    if (sql_num_rows($talent_result) > 0){
                                        for ($i = 0; $row = sql_fetch_array($talent_result); $i++){
                                            include(G5_BBS_PATH."/li_content.php")
                                            ?>
                                        <?php }
                                    }else{ ?>
                                        <div class="text-center empty_list">
                                            <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                            <p class="t_padding17">관련 재능분야 상품이 없습니다.</p>
                                        </div>
                                    <?php }?>
                                </div><!--list-->
                            </div><!--in-->
                        </div>
              <!--//최근 판매한 상품-->

        </section>

    <? }else{ //일반인일때?>

        <section id="right_view">

            <!--잡고캐쉬-->
            <div class="cash_idx">
                <ul>
                    <li>
                        <dl>
                            <dt>캐쉬</dt>
                            <dd><?=number_format($member['mb_6'])?><span>원</span></dd>
                        </dl>
                    </li>
                    <li>
                        <dl>
                                <dt>출금 내역</dt>
                                <dd><?=number_format($pay_cnt)?><span>건</span></dd>
                            </dl>
                    </li>
                </ul>
            </div>
            <!--//잡고캐쉬-->


            <!--재능/공모/문의글 요약
            <div class="item_idx">
                  <ul>
                      <li>
                          <a href="<?=G5_BBS_URL?>/my_item.php"><dl>
                              <dt><i class="fal fa-lightbulb-on"></i>전체 재능</dt>
                              <dd>56<span>건</span></dd>
                          </dl></a>
                      </li>
                      <li>
                          <a href="<?=G5_BBS_URL?>/my_contest.php"><dl>
                              <dt><i class="fal fa-trophy-alt"></i>전체 공모전</dt>
                              <dd>12<span>건</span></dd>
                          </dl></a>
                      </li>
                      <li>
                          <a href="<?=G5_BBS_URL?>/my_inquiry.php"><dl>
                              <dt><i class="fal fa-newspaper"></i>전체 문의글</dt>
                              <dd>122<span>건</span></dd>
                          </dl></a>
                      </li>
                  </ul>
            </div>-->
              <!--//재능/공모/문의글 요약-->
              
              
              <!--관련 재능분야 상품-->
              <h3>추천 재능분야 상품</h3>
              
                     <div id="my_goods">
                            <div class="in">
                                <div class="list cf">
                                        <?php
                                        if (sql_num_rows($talent_result2) > 0){
                                            for ($i = 0; $row = sql_fetch_array($talent_result2); $i++){
                                                    include(G5_BBS_PATH."/li_content.php")
                                                ?>
                                            <?php }
                                        }else{ ?>
                                            <div class="text-center empty_list">
                                                <i class="fal fa-lightbulb-exclamation fa-4x"></i>
                                                <p class="t_padding17">관련 재능분야 상품이 없습니다.</p>
                                            </div>
                                        <?php }?>
                                </div><!--list-->
                            </div><!--in-->
                        </div>
              <!--//최근 판매한 상품-->   

        </section>

    <?php } ?>

</article>
<script>

    $(document).ready(function () {



    });



</script>