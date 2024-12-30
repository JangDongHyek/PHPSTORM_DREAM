<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css">', 0);
?>

<section>
<div id="left">
		<dl>
            <div class="dd">
				
			<?php 
			for($i=0; $i<$row=sql_fetch_array($result); $i++){

				$me_link = $row['me_link'];
				if(!$row['me_absolute']){
					$me_link = G5_URL.$me_link;
				}
			?>
			<dd>
				<a href="<?php echo $me_link;?>" target="_<?php echo $row['me_target']; ?>" <?php if($me['me_id'] == $row['me_id']){ echo "class='on'"; } ?>>
					<?php echo $row['me_name'];?>
				</a>
			</dd>
			<?php } ?>
            </div>
		</dl>
</div><!--#left-->  
</section>
