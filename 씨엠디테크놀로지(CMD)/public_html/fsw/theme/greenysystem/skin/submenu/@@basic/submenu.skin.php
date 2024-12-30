<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section>
    <div id="left">
        <ul class="topnav">
            <li class="home"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sub_home.png" alt="home" /></a></li>
            <li class="subm2_t">2018 부산누들 &amp; 간편식 페어</li>
            <li class="subm2_b">
                <a href="#" class="subm2">
				<?php echo $title['sm_name'] ?>	
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
            </li>
        </ul><!--.topnav-->
    </div><!--#left-->  
</section>


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