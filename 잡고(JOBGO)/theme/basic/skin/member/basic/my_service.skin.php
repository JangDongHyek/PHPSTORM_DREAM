<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="'.$member_skin_url.'/js/epggea.js"></script>', 100);


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
#reply{ display:none}
</style>


<!--마이페이지-->

<article id="mypage">


    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>

        <section id="right_view">
             <h3>서비스 관리<span>전체 서비스 관리 <?=sql_num_rows($result)?></span></h3>
             
                <!--서비스 관리 리스트-->
                <div class="box-article"> 
                        <div class="box-body">
                            <dl class="row">
                                <dd>
                                    <ul>
                                        <?=$pro_ctg1_html?>
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <div class="serv_mana"><a href="<?=G5_BBS_URL?>/register_expert_form03.php">서비스 관리</a></div>
                </div> 
        </section>

</article>


