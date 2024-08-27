<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<!-- 청소신청완료 -->

<div id="my_service" class="tk">
    
	<div class="tx">
    	<p><img src="<?php echo G5_THEME_IMG_URL ?>/app/tk_img.png"></p>
    	<h2><strong>청소</strong>가 <strong>예약완료</strong>되었습니다.</h2>
        <div class="con">곧 전문 매니저님이 연락드리겠습니다.</div>
        
        <div class="info">
        	<dl>
            	<dt>예약고객</dt>
                <dd><?= $view['cu_mb_name'] ?></dd>
            </dl>
        	<dl>
            	<dt>상품명</dt>
                <dd><?= $ct_list[$view['cu_type']] ?><span class="option"><?= $cub_list[$view['cu_building']] ?></span></dd>
            </dl>
        	<dl>
            	<dt>평수</dt>
                <dd><?= $view['cu_width'] ?>평</dd>
            </dl>
        	<dl>
            	<dt>청소일정</dt>
                <dd><?php      $date = $view['cu_date'];
                    //정기세차가 아닐경우
                    if ($view['car_date_type'] != 2){
                        $yoil = array("일","월","화","수","목","금","토");

                        $day = explode('-',$date);
                        echo $day[0] . "년 " . $day[1] . "월 " . $day[2] . "일  ".'('.$yoil[date('w', strtotime($date))].') '.$view['cu_time'];

                    }?></dd>
            </dl>
        	<dl>
            	<dt>주소</dt>
                <dd><?= $view['cu_addr1']." ".$view['cu_addr2'] ?></dd>
            </dl>
        	<dl>
            	<dt>요청사항</dt>
                <dd><?= $row['cu_memmo']!= "" ? $row['cu_memmo']: "없음";?></dd>
            </dl>
        	<dl class="price">
            	<dt>총 이용금액</dt>
                <dd>
                    <?= number_format($view['final_pay']) ?>원
                    <?php if ($view['cu_building'] == 3 && $view['cu_type'] == 1 && $view['cu_width'] <= 20 ){
                        $p = '* 오피스텔 입주청소의 경우 기본 200,000원 입니다.';
                    }else{
                        $p = '(1평당 '.number_format($cu_money_list[$view["cu_building"]."".$view["cu_type"]]).'원 X '.$view["cu_width"]. '평)';
                    }?>
                    <span class="opt"><?=$p?></span>
                </dd>

            </dl>
        </div><!--info-->
        
        
        
    </div>
    <div class="normal_btn"><a href="<?php echo G5_URL ?>/" class="btn cr">홈으로 가기</a></div>

<!-- 청소신청완료 -->