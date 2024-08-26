<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

?>
<!-- 지역선택하기 MODAL -->
<div class="modal fade" id="Local" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><i class="fal fa-location"></i>&nbsp;지역선택</h4>
            </div>

            <div class="modal-body">
                <label class="box-radio-input"><input type="radio" name="ctg_option" value="" checked="checked"><span>전체</span></label>

                <?php for ($i = 1; $i < count($option_list['education']); $i++) { ?>
                <label class="box-radio-input"><input type="radio" name="ctg_option" value="education_<?= $i ?>"><span><?=$option_list['education'][$i]?></span></label>
                <?php } ?>
            </div>

            <div class="modal-footer">
                <button type="button" onclick="choice_area()" class="btn btn-default">지역선택하기</button>
            </div>
        </div><!--//modal-content-->
    </div>
</div>
<!-- //지역선택하기 MODAL -->

<?php //관리자: 배너관리에서 넣은 이미지 불러오기 - 3차카테고리 배너 없을 경우 2차 배너 출력, 2차카테고리 없을 경우 1차 배너 출력
        $sql = "select * from new_adm_banner where ba_place = 'ctg' and ba_category = '{$ba_category}' and ba_use = 1 order by ba_number desc";
        $banner_result = sql_query($sql);
        if (sql_num_rows($banner_result) == 0){
            $ba_p_code = p_common_code($ba_category);
            $sql = "select * from new_adm_banner where ba_place = 'ctg' and ba_category = '{$ba_p_code['idx']}' and ba_use = 1  order by ba_number desc";
            $banner_result = sql_query($sql);
            if (sql_num_rows($banner_result) == 0){
                $sql = "select * from new_adm_banner where ba_place = 'ctg' and ba_category = '{$ba_p_code['p_idx']}' and ba_use = 1 order by ba_number desc";
                $banner_result = sql_query($sql);
            }
        }

if (sql_num_rows($banner_result)){ ?>

<!--서브비주얼 배너-->
<div id="visual" class="wow fadeIn animated b_padding20" data-wow-delay="0.2s" data-wow-duration="0.5s">
      <ul class="sliderbx">
            

            <?php for($i = 0; $btm_img = sql_fetch_array($banner_result); $i++ ){
                echo '<li><a href="#" id="banner_'.$i.'" data-link = "'.$btm_img['ba_link'].'" onclick="open_tab(this,'.$btm_img['ba_new_tab'].')" ><img src="'.G5_DATA_URL.'/banner/'.$btm_img['image'].'"></a></li>';
            }
            ?>
            
<!--            <li><img src="--><?php //echo G5_THEME_IMG_URL ?><!--/sub/roll01.jpg" alt="" /></li>-->
            
    </ul><!--.sliderbx-->
</div><!-- visual -->
<!--//서브비주얼 배너-->
<?php } ?>

<!--재능 카테고리-->
<article id="cate_list">

    <section id="cate_depth">
        <div class="cateTit"><h2><?=$category?><br><span><?=$category2?></span></h2></div>
        <div class="cateList">
            <div class="sort">
                <ul>
                    <li id="li_all"><a href="<?=$_SERVER['PHP_SELF']?>?category=<?=$p_code[0]['name']?>">전체</a></li>
                    <?php

                    for($a = 0; $a < count($code); $a++){ ?>
                        <li id="li_<?=$code[$a]['idx']?>" ><a href="<?=$_SERVER['PHP_SELF']?>?category=<?=$p_code[0]['name']?>&category2=<?=$code[$a]['name']?>" value="<?=$code[$a]?>"><?=$code[$a]['name']?></a></li>
                    <?php } ?>
                </ul>
                <?php if ($category_key == 6){ ?>
                <div class="localselect"><a data-toggle="modal" href="#Local">지역선택 <i class="fal fa-location"></i></a></div>
                <?php } ?>
            </div>
            <div class="depthList">

                <ul>
<!--                    <li class="check">--><?//=$code[0]['name']?><!--</li>-->
<!--                    --><?php //for($a = 0; $a < count($code); $a++){?>
<!--                        <a href="--><?//=$_SERVER['PHP_SELF']?><!--?category=--><?//=$p_code[0]['name']?><!--&category2=--><?//=$code[$a]['name']?><!--"><li id="li_--><?//=$code[$a]['idx']?><!--">--><?//=$code[$a]['name']?><!--</li></a>-->
<!--                    --><?php //}?>

                    <?php if ($code3_ctg != 0){ //count 가 0일 경우에도 돌아가서 if문 처리해줌
                        for($a = 0; $a < count($code3_ctg); $a++){?>
                            <a href="<?=$_SERVER['PHP_SELF']?>?category=<?=$p_code[0]['name']?>&category2=<?=$category2?>&category3=<?=$code3_ctg[$a]['name']?>"><li id="li_<?=$code3_ctg[$a]['idx']?>"><?=$code3_ctg[$a]['name']?></li></a>
                    <?php if ($category_key == 6){ ?>
                         <li><a data-toggle="modal" href="#Local">지역선택 <i class="fal fa-location"></i></a></li>
                    <?php } ?>
                        <?php }
                    } ?>
                    <?php if ($code3_ctg == 0){
                        echo '<span><i class="fal fa-lightbulb-on"></i> 전체 재능상품입니다.</span>';
                    }?>
                </ul>
            </div>
        </div>
    </section>

    <!--모바일일때 3차 메뉴-->
    <section id="cate_mdepth">
            <nav id="bo_cate_blue">
                    <ul id="bo_cate_ul">
                        <?php for($a = 0; $a < count($code3_ctg); $a++){?>
                            <li><a name="mobile_li_<?=$code3_ctg[$a]['idx']?>" href="<?=$_SERVER['PHP_SELF']?>?category=<?=$p_code[0]['name']?>&category2=<?=$category2?>&category3=<?=$code3_ctg[$a]['name']?>"><?=$code3_ctg[$a]['name']?></a></li>
                        <?php }?>
                        <?php if ($code3_ctg == 0){
                            echo '<span><i class="fal fa-lightbulb-on"></i> 전체 재능상품입니다.</span>';
                        }?>
<!--                            <li><a id="bo_cate_on" href="">랜딩 페이지</a></li>-->
                    </ul>
            </nav>
    </section>
    <!--잡고 플러스 광고 추출 (1 페이지 일때만)-->
    <?php if($page == 1 && sql_num_rows($ad_result) > 0){ ?>
    <section id="goods">
        <div class="in">
            <h2 class="title">잡고 <strong>플러스</strong></h2>
             <div class="list cf">
                 <?php for ($i = 0; $ad = sql_fetch_array($ad_result); $i++){
                     if (empty($row)){
                         continue;
                     }
                     include(G5_BBS_PATH."/li_content.php")

                     ?>
            <?php } ?>

            </div>
        </div><!--in-->
    </section>
    <?php } ?>
    <section id="goods">
        <div class="in">
            <!--<h2 class="title">회원들이 많이 <strong>찾아 본</strong> 서비스</h2>회원들이 많이 검색하고 찾아본 상품들이 추출될 예정-->
            <div class="list cf">
                <?php
                for ($i = 0;  $row = sql_fetch_array($result); $i++){

                    //ios 스토어업데이트를 위해 추가한 신고..
                    $sql = "select count(*) cnt from new_report where mb_id = '{$member["mb_no"]}' and r_p_idx= '{$row['ta_idx']}' ";
                    $report_cnt = sql_fetch($sql)["cnt"];
                    if ($report_cnt > 0){
                        continue;
                    }

                    // 재능 등록 이미지 (첫번째 이미지)
                    include(G5_BBS_PATH."/li_content.php")
                ?>
                <?php } ?>
            </div><!--list-->
        </div><!--in-->
    </section>
</article>

<?php if ($category_key == 6){ ?>
<div class="mlocalselect"><a data-toggle="modal" href="#Local">지역선택 <i class="fal fa-location"></i></a></div>
<?php } ?>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$made_qstr.'&amp;page='); ?>

<!--//재능 카테고리-->

<script>
    $(document).ready(function() {
        //3차 카테고리 체크해주기
        <?php if ($code3_request[0]['idx'] != ""){ ?>
            $('#li_<?=$code3_request[0]['idx']?>').addClass('check');
            $('[name = mobile_li_<?=$code3_request[0]['idx']?>]').attr('id','bo_cate_on');
        <?php } ?>
        <?php if ($category2 != "전체"){ ?>
        $('#li_<?=$code2[0]['idx']?>').addClass('check');
        $('[name = mobile_li_<?=$code2[0]['idx']?>]').attr('id','bo_cate_on');
        <?php }else{ ?>
        $('#li_all').addClass('check');
        <?php }  ?>
        $("input:radio[name='ctg_option']:radio[value='<?=$area?>']").prop("checked", true);

        $('#cate').val('<?=$filter?>').attr('selected','selected');
    });

    function choice_area() {
        var value = $('input[name="ctg_option"]:checked').val();
        location.href = '<?=$now_url?>'+'&area='+value;

    }

    //blank하면 ios처리 어려워서 함수 생성.
    function open_tab(f,type) {
        // 새탭으로 띄우기 = 1
        var link = $('#'+f.id).data('link');

        if (type == 1){
            window.open(link);
        }else{
            window.location = link
        }
    }

    // 검색 필터
    function category_filter(value) {
        if('<?=$category2?>' != '') {
            location.href="<?=$_SERVER['PHP_SELF']?>?category=<?=$category?>&category2=<?=$category2?>&filter="+value;
        } else {
            location.href="<?=$_SERVER['PHP_SELF']?>?category=<?=$category?>&filter="+value;
        }
    }
	
	//bx 카테고리 슬라이더시작
	$(document).ready(function(){
	  $('.sliderbx').bxSlider({
		  responsive : true,            // 반응형
		  mode : 'fade',           // 'horizontal', 'vertical', 'fade'
		  pager : false,                 // 페이지버튼 사용유무
		  Controls : false,              // 좌우버튼 사용유무
		  auto : true,                  // 자동재생
		  pause : 5000,                  // 자동재생간격
		  speed : 1000,                  // 이미지전환속도
		  autoControls : false,          // 재생버튼 사용
		  autoHover: true,
		  autoControlsCombine : true,   // 플레이, 스탑버튼 교차
		  });
	});


</script>