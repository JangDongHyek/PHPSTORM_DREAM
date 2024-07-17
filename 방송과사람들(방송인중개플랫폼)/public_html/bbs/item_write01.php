<?
include_once('./_common.php');
$g5['title'] = '재능등록';
include_once('./_head.php');
$name = "item_write";

//재능정보
$idx = $_REQUEST['idx'];
$sql = "select * from new_item left join new_category c on i.i_ctg = c.c_idx where i_idx = '{$idx}' ";
$view = sql_fetch($sql);

$main_ctg = ctg_list(0);

//$view_ctg = ctg_info($view["i_ctg"]);

if(!$is_member){
    alert("회원이시라면 로그인 후 이용해주세요.",G5_BBS_URL.'/login.php?url='.G5_BBS_URL."/item_write01.php" );
}

$c_name = ctg_info($view['c_p_idx'])["c_name"];
$c_name2 = $view["c_name"];
?>

<? if($name=="item_write") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="item_write">
<?}?>

<style>
	#ft_menu{display:none;}
</style>
<form id="fsave" name="fsave" action="./ajax.controller.php" method="post" onsubmit="return fsave_submit()">

    <span id="tab1" style="display: block">
        <div id="item_write">
                <input type="hidden" name="click_tab" id="click_tab" value="">
                <input type="hidden" name="now_tab" id="now_tab" value="1">

                <div class="inr v2" id="inr">
                <h3>재능등록</h3>
                <div class="snb">
                    <ul class="list_step">
                    <li id="" class="active">
                        <a href="javascript:tab_click(1)">
                            <em>1</em>
                            <span>기본정보</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="javascript:tab_click(2)">
                            <em>2</em>
                            <span>서비스 설명</span>
                        </a>
                    </li>
                    <li id="">
                        <a href="javascript:tab_click(3)">
                            <em>3</em>
                            <span>이미지 등록</span>
                        </a>
                    </li>
                    </ul>
                </div>
                <div class="box_list">
                    <div class="box_write">
                        <h4>1차 카테고리</h4>
                        <div class="cont">
                            <div class="select_box v1">
                                <div class="box">
                                    <div class="select">
                                        <?= ( $c_name != '') ? $c_name : "카테고리를 선택해주세요." ?>
                                    </div>
                                    <ul class="list date" id="ctg_ul" >
                                        <?php for ($i = 0; $i < count($main_ctg); $i++){ ?>
                                            <li class="<? if ($view["c_p_idx"] == $main_ctg[$i]["c_idx"] ) echo "selected"; ?>"
                                                onclick="area_filter('<?php echo $main_ctg[$i]["c_idx"] ?>'); ctg_list2(this.value);"
                                                value="<?php echo $main_ctg[$i]['c_idx'] ?>"><?=$main_ctg[$i]['c_name']?></li>
                                        <?php } ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>2차 카테고리</h4>
                        <!--
                        <div class="cont" id="ctg_ul2">
                            <div class="select_box v1">
                                <div class="box">
                                    <div class="select">
                                        <?= ($c_name2 != '') ?$c_name2 : "카테고리를 선택해주세요." ?>
                                    </div>
                                    <input type="hidden" id="i_ctg" name="i_ctg">
                                    <ul class="list2 date" id="ctg_ul2">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="cont" id="ctg_ul2">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>제목</h4>
                        <div class="cont">
                            <input name="i_title" id="i_title" value="<?=$view['i_title']?>" type="text" placeholder="제목을 입력해 주세요.">
                        </div>
                    </div>
                    <div class="box_write">
                        <h4>금액(VAT 포함)</h4>
                        <div class="cont">
                            <label>원</label>
                            <input name="i_price" type="tel" id="i_price" value="<?=number_format($view['i_price'])?>" onkeyup = "numberWithCommas(this)" placeholder="금액을 입력해 주세요.">
                        </div>
                    </div>
                    <div class="box_content">
                        <div class="box_write02">
                            <h4>가격정보</h4>
                            <div class="cont">
                                <div class="box_write">
                                    <h4>상품제목</h4>
                                    <div class="cont">
                                        <input type="text" name="i_price_title"  id="i_price_title" value="<?=$view['i_price_title']?>" placeholder="상품제목을 입력해 주세요." maxlength="50">
                                    </div>
                                </div>

                                <!-- 에디터 넣어주세요~! -->
                                <textarea name="i_price_content"  placeholder="가격설명을 입력해 주세요."><?=$view['i_price_content']?></textarea>
                            </div>
                            <div class="box_input col02">
                                <div class="box_write">
                                    <h4>작업기간</h4>
                                    <div class="cont">
                                        <label>일</label>
                                        <input name="i_work_date" type="number" value="<?=$view['i_work_date']?>"  placeholder="작업기간을 입력해 주세요.">
                                    </div>
                                </div>
                                <div class="box_write">
                                    <h4>수정횟수</h4>
                                    <div class="cont">
                                        <label>회</label>
                                        <input name="i_update_cnt" type="number" value="<?=$view['i_update_cnt']?>"  placeholder="수정횟수를 입력해 주세요.">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box_write02">
                            <h4>옵션선택</h4>
                            <div class="cont">
                                <div class="box_ck">
                                    <ul class="area_filter" id="area_filter" >
                                        <?php for ($i = 1; $i <= count($option_arr['shot']); $i++) { ?>
                                        <li>
                                            <input type="checkbox" id="filter0<?=$i?>" name="option_arr[]" value="<?=$i?>">
                                            <label for="filter0<?=($i)?>">
                                                <span></span>
                                                <em><?=$option_arr['shot'][$i]?></em>
                                            </label>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div id="area_btn"><a class="btn_next" href="javascript:tab_click('2')">다음</a></div>
            </div>
        </div>
    </span>
    <span id="tab2" style="display: none">
        <?php include_once('./item_write02.php'); ?>
    </span>
    <span id="tab3" style="display: none">
    <?php include_once('./item_write03.php');?>
    </span>
</form>

<script>
    $(document).ready(function () {
        <?php if ($ctg_key != ""){ ?>
        area_filter('<?=$view['i_ctg']?>');
        <?php } ?>
    });

    //탭 클릭시 저장 후 이동
    function tab_click(click_tab){

        var tab = $('#now_tab').val();
        if (click_tab != "complete") {
            $('#click_tab').val(click_tab);
        }

        if (tab == 1){
            fsave_submit1();
        }else if (tab == 2){
            fsave_submit2();
        }else if (tab == 3 ||click_tab == 'complete'){
            fsave_submit3(click_tab);
        }



    }

    function css_block_none(tab) {
        $("[id^='tab']").css("display","none");
        $("#tab"+tab).css("display","block");
        console.log('css'+tab);
        if (tab !='complete') {
            $('#now_tab').val(tab);
        }

    }

    function fsave_submit1() {
        var ctg_value = "";
        var submit_is = true;

        $.each($('#ctg_ul li'), function(index, item){
            var selected = $(this).attr('class');
            if (selected == "selected"){
                ctg_value = $(this).attr("value");
            }
        });
        if (ctg_value == ""){
            swal("카테고리를 선택해주세요.");
            submit_is = false;
        }

        //i로 시작하는 input value 빈값찾기
        $.each($("#inr [name^='i_']"), function(index, item){
            if ($(this).val() == "" && $(this).attr('name') != 'i_ctg'){
               swal($(this).attr('placeholder'));
               submit_is = false;
            };
        });

        if (submit_is) {
            css_block_none($('#click_tab').val());
        }
    }
    

    //카테고리별 옵션선택
    function area_filter(ctg) {

        //idx 있을 경우 카테고리 변경 시 카테고리 같을 경우에 옵션 선택 값 넣어줌
        var chk_val = "";
        if (ctg == "<?=$view['i_ctg']?>" ){
            chk_val = "<?=$view['i_option_arr']?>";
        }

        $('#i_ctg').val(ctg);

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "ctg": ctg,
                "mode": "area_filter",
                "chk_val": chk_val,
            },
            dataType: "html",
            success: function(data) {



                if (data != "") {
                    $('#area_filter').html(data);
                }
            }
        });
    }

    //2차카테고리
    function ctg_list2(ctg) {

        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "c_p_idx": ctg,
                "mode": "ctg_list2",
            },
            dataType: "html",
            success: function(data) {

                if (data != "") {
                    $('#ctg_ul2').html(data);
                }

            }
        });
    }

</script>



<?php include_once('./_tail.php'); ?>