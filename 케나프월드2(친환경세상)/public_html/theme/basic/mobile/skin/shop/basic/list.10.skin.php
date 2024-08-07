<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_CSS_URL.'/style.css">', 0);


$siseArr=array("1"=>"sup","-1"=>"sdown","0"=>"ssame");
$siseFaArr=array("1"=>"fa-caret-up","-1"=>"fa-caret-down","0"=>"fa-minus");
?>

<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

<!-- 상품진열 10 시작 { -->
<?php
/*
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i == 0) {
        if ($this->css) {
            echo "<ul id=\"sct_wrap\" class=\"{$this->css}\">\n";
        } else {
            echo "<div id=\"sct_wrap_bd\"><ul id=\"sct_wrap\" class=\"sct sct_10\">\n";
        }
    }

    if($i % $this->list_mod == 0)
        $li_clear = ' sct_clear';
    else
        $li_clear = '';

    echo "<li class=\"col-xs-4 sct_li{$li_clear}\"><div class=\"inner-bd\">\n";

    if ($this->href) {
        echo "<div class=\"sct_img\"><a href=\"{$this->href}{$row['it_id']}&ca_id={$_GET['ca_id']}\" class=\"sct_a\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']), true)."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }


    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

    if ($this->href) {
        echo "<div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}&ca_id={$_GET['ca_id']}\" class=\"sct_a\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }

    if ($this->view_it_price) {
        echo "<div class=\"sct_cost\">\n";
        echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        echo "</div>\n";
    }

    echo "</div></li>\n";
}

if ($i > 0) echo "</ul></div>\n";

if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";*/
$action_url=G5_SHOP_URL."/all.cartupdate.php";
?>
<!-- } 상품진열 10 끝 -->

<script type="text/javascript">
	var ea=0;
	$(function(){
		//체크 선택시
		$("input[name='it_id[]']").click(function(){
			if($(this).prop("checked")){

				ea++;
			}else{
				ea--;
			}
			$("#ea").html(ea);
		});
		//선택 초기화
		$("#check-reset").click(function(){
			var checkForm=$("input[name='it_id[]']");
			for(var i=0;i<checkForm.size();i++){
				checkForm.eq(i).prop("checked",false);
			}
			ea=0;
			$("#ea").html(ea);
		});
	});
	function eaSubmit(it_id){
		var ct_qty=$("#ct_qty"+it_id).val();
		//location.href="<?=G5_SHOP_URL?>/ajax.cartupdate.php?it_id="+it_id+"&ct_qty="+ct_qty;

		$.ajax({
			url:"<?=G5_SHOP_URL?>/ajax.cartupdate.php",
			data:{"it_id":it_id,"ct_qty":ct_qty},
			dataType:"HTML",
			type:"POST",
			success:function(data){
				alert("장바구니에 담았습니다.");
				location.reload();
			}
		});

	}
	//수량 선택시 체크하기
	function ct_qty_change(it_id){
		ea++;
		$("#reg_req"+it_id).prop("checked",true);
		$("#ea").html(ea);
	}
</script>


<!--------상품리스트 부분---------->
<? if($_GET[ca_id]){
		$sql="select * from g5_shop_category where ca_use='1'";
		$result2=sql_query($sql);
?>
<div id="pro_cate">
	<ul>
			<? while($row2=sql_fetch_array($result2)){?>
    	<li><a href="<?=G5_SHOP_URL?>/list.php?ca_id=<?=$row2[ca_id]?>"<?php echo $_GET[ca_id]==$row2[ca_id]?' class="selected"':"";?>><?=$row2[ca_name]?> <span></span></a></li>
			<? }?>

    </ul>
</div><!--#pro_cate-->
<? }?>
<form name="fitem" action="<?php echo $action_url; ?>" method="post" onsubmit="return fitem_submit(this);">
<input type="hidden" name="sw_direct" value="1">
<input type="hidden" name="ct_select" value="1">

<input type="hidden" name="url">

<div id="pro_list_wrap">
	<div id="pro_list">
    	<div class="pro_check_off" id="check-reset"><i class="far fa-redo"></i> 선택 초기화</div>
			<!-- 목록 시작 -->

			<?
			$no=1;
			for ($i=0; $row=sql_fetch_array($result); $i++) {

			?>
    	<div class="pro_list_box">

        	<div class="chk_ico">
        	<input type="checkbox" name="it_id[]" id="reg_req<?=$row[it_id]?>" value="<?=$row[it_id]?>">
            <label for="reg_req<?=$row[it_id]?>"></label>
            </div>
            <div class="pro_img">
			<a href="<?=$this->href.$row['it_id']."&ca_id=".$_GET['ca_id']?>">
				<?
                    if ($this->view_it_img) {
                            echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']), true)."\n";
                    }?>


<!--							<img src="<?php echo G5_SHOP_CSS_URL ?>/img/pro_img.jpg">-->
                </a>
            </div><!--.pro_img-->
            <dl><a href="<?=$this->href.$row['it_id']."&ca_id=".$_GET['ca_id']?>">
                <dt><?php  echo stripslashes($row['it_name'])."\n";?></dt>
                <dd class="pro_sinfo"><?php echo $row[it_basic];?></dd>

                <dd class="pro_custprice"><?php echo $row[it_cust_price];?>P</dd>

                <dd class="pro_price"><?php echo display_price($row[it_price]);?></dd>

								<!--	<? if($row[it_3]!="0"&&$row[it_3]!=""){?>
									<div class="sise <?=$siseArr[$row[it_3]]?>">
									<?php echo $row[it_3]<0?"-".number_format($row[it_2]):number_format($row[it_2]);?>원 <i class="fas <?=$siseFaArr[$row[it_3]]?>"></i></div>
									<? }else if($row[it_3]=="0"){?>
									 <div class="sise ssame">변동없음 <i class="fas fa-minus"></i></div>
									<? }else if($row[it_3]==""){?>
									<? }?>-->
                <!--<div class="sise sup">5000원 <i class="fas fa-caret-up"></i></div>
               -->
            </a> </dl>
            <div class="pro_count">
            	<select class="pro_num" name="ct_qty[<?=$row[it_id]?>][]" id="ct_qty<?=$row[it_id]?>" onchange="ct_qty_change('<?=$row[it_id]?>')">
									<? for($i=1;$i<=10;$i++){?>
                	<option value="<?=$i?>"><label><?=$i?></label></option>
									<? }?>

                </select>
                <div class="pro_cart" onclick="eaSubmit('<?=$row[it_id]?>')"><i class="far fa-shopping-basket"></i></div>
            </div><!--.pro_count-->

    	</div><!--.pro_list_box-->
			<? $no++;}?>
			<!-- 목록 끝 -->



    </div><!--#pro_list-->
</div><!--#pro_list_wrap-->

<div id="plist_btn_buy"><button><span id="ea">0</span>개 상품 주문하기</button></div>
</form>




