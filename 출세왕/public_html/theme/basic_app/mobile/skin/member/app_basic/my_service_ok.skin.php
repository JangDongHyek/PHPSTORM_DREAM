<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<!-- 출장세차신청완료 -->

<div id="my_service" class="tk">
    
	<div class="tx">
    	<p><img src="<?php echo G5_THEME_IMG_URL ?>/app/tk_img.png"></p>
    	<h2><strong>출장세차</strong>가 <strong>예약완료</strong>되었습니다.</h2>
        <div class="con">곧 전문 매니저님과 매칭될 예정입니다.</div>

        <div class="info">
        <?php if ($_REQUEST['cdt'] != 4){ ?>

            <dl>
            	<dt>예약고객</dt>
                <dd><?= $view['mb_name'] ?></dd>
            </dl>
        	<dl>
            	<dt>상품명</dt>
                <dd> <?= $cdt_list[$view['car_date_type']]."(".$cs_list[$view['car_size']].")" ?>
                    <!--
                    <span class="option" style="display: none"> <?= $view['car_in_yn'] == 'Y' ? '내부세차 포함': "내부세차 포함안함";?></span>
                    -->
                </dd>
            </dl>
        	<dl>
            	<dt>차량정보</dt>
                <dd><?= $view['car_no'] ?> / <?= $view['car_type'] ?> / <?= $view['car_color'] ?></dd>
            </dl>
        	<dl>
            	<dt>세차일정</dt>
                <dd>
                    <?php
                    // commonlib.php 에  날짜 함수 정의해둠 wc
                    successking_date($view['car_w_date'],$view['car_w_date2']);
                    ?>
                </dd>
            </dl>
        	<dl>
            	<dt>세차장소</dt>
                <dd><?= $view['car_w_addr1']." ".$view['car_w_addr2'] ?><br /><?=$view['car_place']." ".$view['car_place2']?></dd>
            </dl>
        	<dl>
            	<dt>요청사항</dt>
                <dd><?= $view['car_memo']!= "" ? $view['car_memo']: "없음";?></dd>
            </dl>
        	<dl class="price">
            	<dt>총 이용금액</dt>
                <dd><?= $final_pay ?>원
                    <span class="opt">
                        (<?= $cdt_list[$view['car_date_type']]."&nbsp&nbsp".number_format($pay) ?>원 <?= $in_pay ?>)
                        <?php if($view['cp_id']){ ?>
                            - (<?=$view['cp_subject']?> <?=$view['cp_price_view']?>)
                        <?php } ?>

                    </span>


                </dd>
            </dl>
        <?php }else{ ?>
            <dl>
                <dt>회사명</dt>
                <dd><?= $view['cc_company'] ?></dd>
            </dl>
            <dl>
                <dt>담당자명</dt>
                <dd><?= $view['cc_manager'] ?></dd>
            </dl>
            <dl>
                <dt>담당자 휴대폰</dt>
                <dd><?= $view['cc_hp'] ?></dd>
            </dl>
            <dl>
                <dt>주소</dt>
                <dd><?= $view['cc_w_addr1']." ".$view['cc_w_addr2'] ?></dd>
            </dl>
            <dl>
                <dt>신청가능대수</dt>
                <dd><?= $view['cc_number'] ?></dd>
            </dl>
            <dl>
                <dt>실내세차</dt>
                <dd><?php if($view['cc_in_yn'] == '1') echo '일반'; elseif($view['cc_in_yn'] == '2') echo '프리미엄'; else echo 'X'; ?></dd>
            </dl>
        <?php }?>

        </div><!--info-->




    </div>
    <div class="normal_btn"><a href="<?php echo G5_URL ?>/" class="btn cr">홈으로 가기</a></div>

<!-- 출장세차신청완료 -->
