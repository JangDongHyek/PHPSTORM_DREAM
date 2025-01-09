<style>
/*카운셀링*/
#programText{letter-spacing:-1px;}
#programText .counselimg{ width:100%; height:auto;}
#programText h2{ background:url(../img/subicon.jpg) no-repeat 1px top; font-weight:bold; color:#000; font-size:20px; overflow:hidden; padding-top:10px; }
#programText .subtext{ font-size:16px; color:#333; display:block; font-weight:500; line-height:30px; }
#programText .subtext span{color:#de3d18;}
</style>

<div>
	<form method="post" name="book_form" action="./board.php?bo_table=<?php echo $bo_table; ?>" onsubmit="return book_act(this);">
	<input type="hidden" name="identify_act" value="ok" />
	
	

	
	<ul style="margin-left:0px; padding:0px 0px; list-style:none; text-decoration:none;">
		
		
		
		<li style="float:left; width:30%; height:50px; line-height:50px; border-top:1px solid #3a8476; border-bottom:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px; font-size:16px;">학생명</label></li>
		
		
		
		
		<li style="width:100%; height:50px; line-height:50px; border:1px solid #3a8476; margin:10px 0;"><input type="text" name="wr_name" value="" style="width:60%; margin-left:10px; height:20px; border:1px solid #999999; padding:6px;" required/></li>
		
		
		
		<li style="width:30%; float:left; height:50px; line-height:50px; border-top:1px solid #3a8476; border-bottom:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;  font-size:16px;">학생연락처</label></li>
		
		
		
		<li style="width:100%; height:50px; line-height:50px; border:1px solid #3a8476;"><input type="text" name="wr_2" value="" style="width:60%; height:20px; margin-left:10px; border:1px solid #999999; padding:6px; IME-MODE:disabled;" required/></li>
	</ul>
	<div style="clear:both; margin:0 auto; padding:10px 0px; text-align:center;"><input type="submit" style="margin:0; padding:4px 8px; background-color:#eb4b3e; color:#fff; border:1px solid #eb4b3e;" value="예약조회" /></div>
	</form>
</div>