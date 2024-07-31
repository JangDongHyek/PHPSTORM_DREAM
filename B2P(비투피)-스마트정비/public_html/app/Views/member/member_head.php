<?php
    if($member['mb_level'] != 10){
        return;
    }

    if(empty($member_type)){
        $member_type = "b2p";
    }


?>

<div class="tit_wrap">
    <h6 class="menu01">거래처 관리</h6>
    <div class="menu02">
<!--        <a href="<?=base_url('/member/member_list?member_type=b2p')?>" class="<?php if($member_type == 'b2p') { echo 'active'; } ?>">B2P 직원 관리</a>-->
        <a href="<?=base_url('/member/member_list?member_type=other')?>" class="<?php if($member_type == 'other') { echo 'active'; } ?>">제조·유통사 관리</a>

        <!--<a href="<?/*=base_url('/admin/manager01_03_list')*/?>">정비업체 지점 관리</a>-->
    </div>
</div>