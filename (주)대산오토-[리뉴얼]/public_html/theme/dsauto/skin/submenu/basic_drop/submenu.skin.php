<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section>
    <div id="left">
        <ul class="topnav">
            <!--검색-->
            <div id="stnb_sch">
                    <h3>검색</h3>
                    <form name="fsearchbox" id="form2" action="<?php echo G5_BBS_URL ?>/search2.php" onsubmit="return search_submit(this);" autocomplete="off">
                        <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                        <select name="sfl">
                            <option value="wr_subject||wr_content||wr_1||wr_2||wr_3">전체</option>
                            <option value="wr_1">품번</option>
                            <option value="wr_subject||wr_2">품명</option>
                            <option value="wr_3">차종</option>
                        </select>
                        <!--<input type="hidden" name="sfl" value="wr_subject||wr_content">-->
                        <input type="hidden" name="sop" value="and">
                        <input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력하세요.">
                        <button type="submit" id="sch_submit"><i class="fal fa-search"></i><span class="sound_only">검색</span></button>
                    </form>
            </div><!--#tnb_sch-->
            <!--//검색-->
            <li class="home"><a href="<?php echo G5_URL ?>"><i class="fal fa-home-alt"></i></a></li>
            <li class="subm2_t"><?php echo $title['sm_name'] ?></li>
            <li class="subm2_b">
                <a href="javascript:return false;" class="subm2">
				<?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?>
                </a>
                <?php /*?><? if($co_id == "event01"){	
                        echo ("전시회정보"); 
                    }else if($co_id == "parti01" || $co_id == "parti02" || $bo_table == "online"){ 
                        echo ("참가업체");  
                    }else if($co_id == "visitor01" || $bo_table =="before" || $co_id == "visitor02"){ 
                        echo ("관람객");  
                    }
                    ?><?php */?>
                
				<?php /*?><? if($co_id == "event01" || $bo_table == "notice" || $bo_table == "data") {  ?>
                전시회정보
                <? } else if ($co_id == "parti01" || $co_id == "parti02" || $bo_table == "online"){  ?>
                참가업체
                <? } else if ($co_id == "visitor01" || $bo_table =="before" || $co_id == "visitor02"){  ?>
                관람객
                <? } ?><?php */?>
                <ul class="subnav">
					<?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
                    <li><a href="<?php echo G5_URL.$sub['sm_link']?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>><?php echo $sub['sm_name'];?></a></li>
                    <?php } ?>                
            	</ul>
                <span class="adrop"><i class="far fa-angle-down"></i></span>
            </li>
        </ul><!--.topnav-->
    </div><!--#left-->  
</section>


<?php /*?><script>
$(document).ready(function(){
 
 $("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)
 
 $("ul.topnav li .subm2").click(function() { //When trigger is clicked...
 
  //Following events are applied to the subnav itself (moving subnav up and down)
  $(this).parent().find("ul.subnav").slideDown('slow').show(); //Drop down the subnav on click
 
  $(this).parent().hover(function() {
  }, function(){
   $(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
  });
 
  //Following events are applied to the trigger (Hover events for the trigger)
  }).hover(function() {
   $(this).addClass("subhover"); //On hover over, add class "subhover"
  }, function(){ //On Hover Out
   $(this).removeClass("subhover"); //On hover out, remove class "subhover"
 });
 
});

</script><?php */?>

<script>
$(document).ready(function(){
 
 $("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)
 
 $("ul.topnav li span").click(function() { //When trigger is clicked...
 
  //Following events are applied to the subnav itself (moving subnav up and down)
  $(this).parent().find("ul.subnav").slideDown('slow').show(); //Drop down the subnav on click
 
  $(this).parent().hover(function() {
  }, function(){
   $(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up
  });
 
  //Following events are applied to the trigger (Hover events for the trigger)
  }).hover(function() {
   $(this).addClass("subhover"); //On hover over, add class "subhover"
  }, function(){ //On Hover Out
   $(this).removeClass("subhover"); //On hover out, remove class "subhover"
 });
 
});

</script>


<?php /*?><dl>
			<dt><?php echo $title['sm_name'] ?>
       		<p><?php echo $config['cf_title']; ?></p></dt>
			<?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
			<dd><a href="<?php echo G5_URL.$sub['sm_link']?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>><?php echo $sub['sm_name'];?></a></dd>
			<?php } ?>
		</dl><?php */?>