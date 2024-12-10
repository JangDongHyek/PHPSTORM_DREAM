		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title">예약자명&nbsp;&nbsp;</span>
		   <span class="bbs_write_form"><?=$rg_name?></span>
		</div>
		
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title"> 연락처&nbsp;&nbsp;</span>
		   <span class="bbs_write_form"><?=$rg_title?></span>
		</div>
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title"> 예약날짜&nbsp;&nbsp;</span>
		   <span class="bbs_write_form"><?=date("Y-m-d",$rg_ext5)?> <?=$rg_cat_name?></span>
		</div>
		
		
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title"> 인원수&nbsp;&nbsp;</span>
		   <span class="bbs_write_form"><?=$rg_ext2?></span>
		</div>
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title">* 내용&nbsp;&nbsp;</span>
		   <span class="bbs_write_form"><?=nl2br($rg_content)?></span>
		</div>