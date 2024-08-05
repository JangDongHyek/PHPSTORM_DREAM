<?
include_once('./_common.php');
include_once("../class/Lib.php");
$g5['title'] = '서비스등록';
include_once('./_head.php');
$name = "item_write";

$jl = new JL();

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

<div id="vueapp">
    <product-input></product-input>
    <span id="tab2" <!--style="display: none"-->>
    <?php include_once('./item_write02.php'); ?>
    </span>
    <span id="tab3" <!--style="display: none;"-->>
    <?php include_once('./item_write03.php');?>
    </span>
</div>

<?php
$jl->vueLoad("vueapp");
include_once ($jl->ROOT."/component/modal/modal-portfolio.php");
include_once ($jl->ROOT."/component/product/product-input.php");
include_once ($jl->ROOT."/component/slot/slot-modal.php");
?>

<script>
        //패키지 가격설정
        // Function to handle checkbox toggle
        function togglePackage() {
            var packageCheckbox = document.getElementById('package');
            var packageBox = document.querySelector('.box_write.package');
            var priceInput = document.getElementById('i_price');

            // Check if the package checkbox is checked
            if (packageCheckbox.checked) {
                // If checked, show the package box and disable price input
                packageBox.style.display = 'block';
                priceInput.disabled = true;
            } else {
                // If unchecked, hide the package box and enable price input
                packageBox.style.display = 'none';
                priceInput.disabled = false;
            }
        }

        // Attach togglePackage function to checkbox change event
        document.getElementById('package').addEventListener('change', togglePackage);

        // Optional: Ensure initial state reflects checkbox state on page load
        togglePackage();
    </script>

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