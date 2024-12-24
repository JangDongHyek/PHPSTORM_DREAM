<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨


$siseArr=array("1"=>"sup","-1"=>"sdown","0"=>"ssame");
$siseFaArr=array("1"=>"fa-caret-up","-1"=>"fa-caret-down","0"=>"fa-minus");
?>



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




<?
	if(0<sql_num_rows($result)){
?>
	<div id="pro_list">
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
								
                <dd class="pro_price"><?php echo number_format($row[it_price]);?>P</dd>
                
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
<? }?>






