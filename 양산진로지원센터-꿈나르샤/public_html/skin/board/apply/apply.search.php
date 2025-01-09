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
	<p style="margin:0; padding:0px 0px 5px 0px; font-size:15px;">■ 수강신청 정보 조회</p>
	<ul style="position:relative; margin:0; padding:0px 0px; list-style:none; text-decoration:none;">
		<li style="float:left; width:15%; height:50px; line-height:50px; border-top:1px solid #3a8476; border-bottom:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px; font-size:16px;">학생명</label></li>
		<li style="float:left; width:35%; height:50px; line-height:50px; border-top:1px solid #3a8476; border-bottom:1px solid #3a8476;"><input type="text" name="wr_name" value="" style="width:40%; margin-left:10px;" required/></li>
		<li style="float:left; width:15%; height:50px; line-height:50px; border-top:1px solid #3a8476; border-bottom:1px solid #3a8476; background:#3a8476; color:#fff;"><label style="padding-left:10px;  font-size:16px;">학생연락처</label></li>
		<li style="float:left; width:34.85%; height:50px; line-height:50px; border-top:1px solid #3a8476; border-bottom:1px solid #3a8476; border-right:1px solid #3a8476;"><input type="text" name="wr_2" value="" style="width:40%; margin-left:10px; IME-MODE:disabled;" required/></li>
	</ul>
	<div style="clear:both; margin:0 auto; padding:10px 0px; text-align:center;"><input type="submit" style="margin:0; padding:4px 8px; background-color:#eb4b3e; color:#fff; border:1px solid #eb4b3e;" value="예약조회" /></div>
	</form>
</div>