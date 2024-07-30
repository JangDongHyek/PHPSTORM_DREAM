<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);


?>


<!-- 완료된서비스 -->

<div id="my_reser">
	<!--상단카테고리-->
    <ul class="cate cf">
        <li ><a href="<?php echo G5_BBS_URL ?>/my_service_end.php">완료된 서비스</a></li>
        <li class="active"><a href="<?php echo G5_BBS_URL ?>/my_report.php">내 건의함</a></li>
    </ul>
    
    <!--내용부분--> 
    <div class="in report">
    	<!--<div class="service_none"><span><i class="fas fa-smile"></i></span>건의된 내용이 없습니다.</div>--><!--건의함에 내용이 없을때 띄워주세요~~-->
        <ul class="report_list">
            <?php while($row = sql_fetch_array($review_result)){ ?>
                <li>
                    <div class="tx">
                        <div class="catego"><strong><i class="fas fa-car-wash"></i> <?=$cdt_list[$row['car_date_type']]?><span><?=$cs_list[$row['car_size']]?></span></strong><span><i class="fas fa-user-alt"></i> <?=$row['ma_name']?>님</span></div>
                        <div class="wk"><span>작업일</span> <?=$row['cw_complete_datetime']?></div>
                        <div class="message"><?=$row['re_content']?></div>
                        <div class="date"><?=$row['wr_datetime']?></div><!--date-->
                        <div class="photo">
                            <?php
                            // view 파일 출력
                            $file = get_file($g5['review_table'], $row['cw_idx']);
                            if ($file['count']) {
                                for ($i = 0; $i < $file['count']; $i++) {
                                        echo "<span>";
                                        $filename = $file[$i]['file'];
                                        $filepath = $file[$i]['path'];
                                        $filesrc = $filepath.'/'.$filename;
                                        $img_content = '<img src="' . $filesrc . '" style="writh:100px;height:100px">';
                                        echo $img_content;
                                        echo "</span>";

                                }
                            }
                            ?>
                        </div><!--첨부사진 있을시-->
                    </div>
                </li>
            <?php } ?>
        </ul><!--report_list-->
    </div><!--in-->
</div><!--my_reser-->

<!-- 완료된서비스 -->