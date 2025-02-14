<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<!--알람설정 시작-->
<div id="mypage">
	<div id="point">
		<div class="mypoint">
			<h3>보유 만나</h3>
			<span><?=number_format($mb['cw_point'])?> 만나</span>
		</div>
		<ul class="point_list">
            <?php
            for($i=0; $row=sql_fetch_array($result); $i++) {
                $class = '';

                $text = "만나";
                if (strpos($row['point_category'], "섹션" )  !== false ){
                    $text = "섹션";
                }

                if($row['point_category'] == '적립' || $row['point_category'] == '섹션적립' || $row['point_category'] == '지급') {
                    $row['point_category'] = '지급';
                    $class = 'plus';
                }
                else { $class = 'minus'; }

            ?>
            <li>
                <i class="<?=$class?>"><?=$row['point_category']?></i>
                <div class="cont"><?=$row['point_content']?></div>
                <div class="point <?=$class?>"><?php if($class == 'minus') echo '-'; else echo '+'; ?> <?=number_format($row['point'])?> <?=$text?></div>
                <div class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></div>
                <div class="total"><?=number_format($row['acc_point'])?> <?=$text?></div>
            </li>
            <?php
            }
            if($i==0) {
            ?>
            <div class="msg_none"><span><i class="fas fa-coins"></i></span> 만나 내역이 없습니다.</div>
            <?php
            }
            ?>
		</ul>
	</div>
</div><!--mypage-->
<!--마이페이지 끝-->
