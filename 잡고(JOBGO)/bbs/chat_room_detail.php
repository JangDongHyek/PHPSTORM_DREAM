<?php
include_once('./_common.php');
$g5['title'] = '전문인 정보';
include_once(G5_PATH.'/head.php');

// 전문인 회원 정보
$mb = get_member($pro_id);

// 전문인 프로필 이미지
$dest_path = G5_DATA_PATH . '/member/' . $mb_dir . '/' . $pro_id . '.jpg';

// 의뢰인 만족도
$sql = "select IF(avg(rating) is null,'없음',CONCAT (avg(rating),'점')) as avg from new_payment_review pr left join {$g5['talent_table']} ta on ta.ta_idx = pr.ta_idx where ta.mb_id = '{$pro_id}' ";
$member_avg = sql_fetch($sql)['avg'];

// 전문인 프로필 정보
$sql = "select *from {$g5['profile_table']} where mb_id = '{$pro_id}' ";
$profile = sql_fetch($sql);

// 전문인이 등록한 재능 리스트
$sql = " select ta.*, (select pta_pay from new_pay_talent where pta_info = 1 and ta_idx = ta.ta_idx) pta_pay from {$g5['talent_table']} as ta where ta.mb_id = '{$pro_id}' ";
$ta_result = sql_query($sql);

// 내가 구매한 서비스
$buy_count = sql_fetch(" select count(*) as count from new_payment where userId = '{$member['mb_id']}' and seller_id = '{$pro_id}' and ResultCode in('3001', '4000') ")['count'];
?>

<div id="MessageBoxWrap" class="appVer"> 
    <div class="msgConts">
        <!-- 파트너 프로필 -->
        <div class="userBox">
            <div class="profileInfo">
                <p class="img">
                    <?php
                    if(file_exists($dest_path)) { echo '<img src="'.$dest_url.'">'; }
                    else { echo '<img class="p_img" src="'.G5_THEME_IMG_URL.'/sub/default.png">'; }
                    ?>
                    <!--<img src="http://jobgo.ac/theme/basic/img/sub/default.png" alt="">-->
                </p>
                <p class="name"><?=$mb['mb_nick']?></p>
            </div>

            <div class="partnerInfo">
                <div><h5>만족도</h5><span><?php if(!$idx) { ?><?=$member_avg?><?php } ?></span></div>
                <!--<div><h5>회원구분</h5><span>개인회원</span></div>-->
                <div><h5>연락가능시간</h5><span><?php if(!$idx) { ?><?=date('H:i',strtotime($profile['pf_call_time1']))?>~<?=date('H:i',strtotime($profile['pf_call_time2']))?><?php } ?></span></div>
                <div><h5>평균응답시간</h5><span><?=$pf_time_list[$profile['pf_time']]?></span></div>
            </div>
            <div class="partnerHis">
                <h4><a href="javascript:void(0);">구매했던 서비스 <span><?=number_format($buy_count)?>건</span></a></h4>
            </div>
            <div class="partnerServ">
                <h4>전문가 서비스</h4>
                <ul class="serviceList">
                <?php
                for($i=0; $ta=sql_fetch_array($ta_result);$i++) {
                    // 재능 등록 이미지 (첫번째 이미지)
                    $file_sql = " select * from {$g5['board_file_table']} where bo_table = 'talent' and wr_id = {$ta['ta_idx']} order by bf_datetime limit 1 ";
                    $file_row = sql_fetch($file_sql);
                ?>
                    <li>
                        <a href="<?php echo G5_BBS_URL; ?>/item_view.php?idx=<?=$ta['ta_idx']?>">
                            <div>
                            <?php
                            if($file_row['wr_id']) { ?>
                                <img src="<?php echo G5_DATA_URL ?>/file/talent/<?=$file_row['bf_file']?>">
                            <?php } else { ?>
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"> <!-- 디폴트 이미지 -->
                            <?php } ?>
                            <!--<img src="<?php /*echo G5_THEME_IMG_URL */?>/common/msg_test.jpg" alt="서비스" >-->
                            </div>
                            <div class="txt">
                                <p class="tit"><?=$ta['ta_title']?></p>
                                <p class="pri"><?=number_format($ta['pta_pay'])?>원</p>
                            </div>
                        </a>
                    </li>
                <?php
                }
                if($i == 0) {
                ?>
                    <li style="text-align: center;">상품이 없습니다.</li>
                <?php
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
include_once(G5_PATH.'/tail.php');
?>