<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<style>
    .blur {
        -webkit-filter: blur(10px) !important;
        -moz-filter: blur(10px) !important
        -o-filter: blur(10px) !important;
        -ms-filter: blur(10px) !important;
        filter: blur(10px) !important;
    }
</style>

<!--회원상세페이지(취미/관심사)-->
<div id="mem_view">
	<!--상단카테고리-->
    <ul class="cate cf">
        <li><a href="javascript:void(0);" onclick="location.replace('<?php echo G5_BBS_URL ?>/mem_view.php?mb_no=<?=$mb_no?>')">기본정보</a></li>
        <li><a href="javascript:void(0);" onclick="location.replace('<?php echo G5_BBS_URL ?>/mem_view2.php?mb_no=<?=$mb_no?>')">인터뷰</a></li>
        <li class="active"><a href="javascript:void(0);">취미/관심사</a></li>
    </ul>
    
    <!--내용부분--> 
    <div class="in">
        <div class="con_info">
        	<div class="list top">
            	<dl class="part">
                	<dt class="title">좋아하는 취미활동</dt>
                    <dd class="cont">
                    	<div class="bk">
                            <?php
                            $sql = " select co.co_main_code_value from g5_code as co ";
                            $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                            $sql .= " where co.co_code_name = '취미' and mh.mb_no = '{$mb_no}' order by co.co_code*1 ";
                            $result = sql_query($sql);
                            for($i=0;$row=sql_fetch_array($result);$i++) {
                            ?>
                        	<span><?=$row['co_main_code_value']?></span>
                            <?php
                            }
                            ?>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">좋아하는 운동</dt>
                    <dd class="cont">
                    	<div class="bk">
                            <?php
                            $sql = " select co.co_main_code_value from g5_code as co ";
                            $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                            $sql .= " where co.co_code_name = '운동' and mh.mb_no = '{$mb_no}' order by co.co_code*1 ";
                            $result = sql_query($sql);
                            for($i=0;$row=sql_fetch_array($result);$i++) {
                            ?>
                            <span><?=$row['co_main_code_value']?></span>
                            <?php
                            }
                            ?>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->
        	<div class="list">
            	<dl class="part">
                	<dt class="title">좋아하는 관심사</dt>
                    <dd class="cont">
                    	<div class="bk">
                        	<div class="pt">
                            	<strong>영화부문</strong>
                                <?php
                                $sql = " select co.co_main_code_value from g5_code as co ";
                                $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                                $sql .= " where co.co_code_name = '영화' and mh.mb_no = '{$mb_no}' order by co.co_code*1 ";
                                $result = sql_query($sql);
                                for($i=0;$row=sql_fetch_array($result);$i++) {
                                ?>
                                <span><?=$row['co_main_code_value']?></span>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="pt">
                            	<strong>음악부문</strong>
                                <?php
                                $sql = " select co.co_main_code_value from g5_code as co ";
                                $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                                $sql .= " where co.co_code_name = '음악' and mh.mb_no = '{$mb_no}' order by co.co_code*1 ";
                                $result = sql_query($sql);
                                for($i=0;$row=sql_fetch_array($result);$i++) {
                                ?>
                                <span><?=$row['co_main_code_value']?></span>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="pt">
                            	<strong>TV부문</strong>
                                <?php
                                $sql = " select co.co_main_code_value from g5_code as co ";
                                $sql .= " left outer join g5_member_hobby as mh on co.co_code = mh.co_code ";
                                $sql .= " where co.co_code_name = 'TV' and mh.mb_no = '{$mb_no}' order by co.co_code*1 ";
                                $result = sql_query($sql);
                                for($i=0;$row=sql_fetch_array($result);$i++) {
                                ?>
                                <span><?=$row['co_main_code_value']?></span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </dd>
                </dl>
            </div><!--list-->

			<!-- 추가210917_추가정보 -->
        	<div class="list">
				
            	<dl class="part">
                    <?php
                    $profile_view = sql_fetch( " select count(*) as count from g5_member_point where mb_id = '{$member['mb_id']}' and rel_mb_id = '{$mb['mb_id']}' and point_content like '%정보%'; ")['count'];
                    ?>
                	<dt class="title">추가 정보<?php if($profile_view == 0 && !empty($mb['mb_salary'] && $mb_no != $member['mb_no'])) { ?><!--<a href="javascript:addProfileView('<?/*=$mb_no*/?>');" class="btn add_profile_btn">정보보기</a>--><?php } ?></dt>
                    <?php if(!empty($mb['mb_salary'])) { ?>
                    <!--22.01.21 만나 차감하여 조회 하였어도 추가 정보 볼수 없음, 만나 차감한 사람은 추가 정보 볼수 있어야하면 아래 행 주석 해제, 그 다음 행 삭제-->
                    <!--<dd class="cont <?php /*echo $profile_view > 0 || $mb_no == $member['mb_no'] ? '' : 'blur'; */?> add_profile">-->
                    <dd class="cont blur add_profile">
                    	<div class="bk">
                        	<div class="pt">
                            	<strong>가족사항</strong>
                                <?php
                                if(!empty($mb['mb_family'])) {
                                    $family = explode(',', $mb['mb_family']);
                                    for($i=0; $i<count($family); $i++) {
                                    ?>
                                    <span><?=$family[$i]?></span>
                                    <?php
                                    }
                                }
                                ?>
                                <?php if(!empty($mb['mb_family_txt'])) { ?>
                                형제자매
                                <span><?=$mb['mb_family_txt']?></span>
                                <?php } ?>
                            </div>
                            <div class="pt">
                            	<strong>현재거주</strong>
                                <span><?php echo $mb['mb_live'] == 'alone' ? '본인혼자' : '가족거주'; ?></span>
                                <?php if(!empty($mb['mb_live_txt'])) { ?>
                                기타
                                <span><?=$mb['mb_live_txt']?></span>
                                <?php } ?>
                            </div>
                            <div class="pt">
                            	<strong>본인연봉</strong>
                                <span><?=$mb['mb_salary']?></span>
                            </div>
                            <div class="pt">
                            	<strong>자차소유여부</strong>
                                <span><?php echo $mb['mb_mycar'] == 'Y' ? '있음' : '없음'; ?></span>
                            </div>
                            <div class="pt">
                            	<strong>자가소유여부</strong>
                                <span><?php echo $mb['mb_myhome'] == 'Y' ? '있음' : '없음'; ?></span>
                            </div>
                        </div>
                    </dd>
                    <?php } ?>
                </dl>
            </div><!--list-->


        </div><!--con_info-->
    </div><!--in-->
</div><!--mem_view-->

<!--회원상세페이지(취미/관심사)-->

<script>
    // 추가 정보 블러 해제 -- 확인 시 15만나 차감
    function addProfileView(mb_no) {
        swal({
            text: "추가 정보를 보시겠습니까?\n15만나가 차감됩니다.",
            icon: "warning",
            buttons: {
                cancel: "취소",
                defeat: "확인",
            }
        })
        .then((value) => {
            switch (value) {
                case "defeat":
                    $.ajax({
                        type: 'POST',
                        url: g5_bbs_url + "/ajax.profile_img_view.php",
                        data: {mb_no: mb_no, mode: 'add_profile'},
                        success: function (data) {
                            if(data == 'fail') {
                                swal('만나가 부족합니다.');
                            }
                            else if(data == 'success') {
                                swal('15만나가 차감되었습니다.')
                                .then(() => {
                                    $('.add_profile_btn').hide();
                                    $('.add_profile').removeClass('blur');
                                });
                            }
                        }
                    });
                    break;
                }
            });
        }
</script>