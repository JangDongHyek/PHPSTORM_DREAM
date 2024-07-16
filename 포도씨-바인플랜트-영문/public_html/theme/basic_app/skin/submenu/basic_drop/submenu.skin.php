<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 100);
?>


<section>
    <div id="lnb" class="container">
        <ul class="topnav">
            <li class="home"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_URL ?>/skin/submenu/<?php $skin_dir ?>basic/sub_home.png" alt="home" /></a><i class="fas fa-angle-right"></i></li>
            <li class="subm2_t"><?php echo $config['cf_title']; ?><i class="fas fa-angle-right"></i></li>
            <li class="subm2_b"><?php echo $title['sm_name'] ?><i class="fas fa-angle-right"></i></li>
            <li class="subm2_b down">
                <a href="javascript:return false;" class="subm2">
					<?php if($bo_table) {?>
                            <?php echo $board['bo_subject']; ?>
                     <?php }else { ?>
                            <?php echo $g5['title'] ?>
                     <?php } ?>
                </a>
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
 
 $("ul.subnav").parent().append("<span><i class='fas fa-chevron-down'></i></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)
 
 $("ul.topnav li.down").click(function() { //When trigger is clicked...
 
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