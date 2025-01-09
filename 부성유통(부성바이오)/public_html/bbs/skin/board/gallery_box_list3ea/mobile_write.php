<?
/******************************************************************
 ★ 파일설명 ★ 
목록하단

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$width?> 					테이블의 넓이
<?=$skin_board_url?>	스킨 URL
<?=$site_url?>				사이트 URL
<?=$bbs_id?>					게시판 아이디

<?=$u_action?>				글쓰기 URL
<?=$old_password?>		수정시 기존 암호
<?=$a_list?>					글목록 링크

<?=$show_notice_begin?>공지사항체크<?=$show_notice_end?>
<?=$checked_notice?>	공지사항체크여부

<?=$show_secret_begin?>비밀글체크<?=$show_secret_end?>
<?=$checked_secret?>	비밀글체크여부

<?=$show_reply_mail_begin?>응답글메일로받기여부<?=$show_reply_mail_end?>
<?=$checked_reply_mail?>	응답글체크여부

<?=$show_name_begin?>작성자입력<?=$show_name_end?>
<?=$rg_name?>					작성자

<?=$show_password_begin?>암호입력<?=$show_password_end?>
<?=(!$mode_edit)?'required':''?>	글수정모드가 아니라면 필수입력

<?=$show_email_begin?>메일입력<?=$show_email_end?>
<?=$rg_email?>				메일

<?=$show_home_url_begin?>홈페이지입력<?=$show_home_url_end?>
<?=$rg_home_url?>			홈체이지

<?=$show_category_begin?>카테고리선택<?=$show_category_end?>
<?=$category_list_option?>	카테고리목록

<?=$show_html_begin?>	html 형태선택<?=$show_html_end?>
<?=$checked_html_use0?>	일반글체크
<?=$checked_html_use1?>	html체크
<?=$checked_html_use2?>	html+체크

<?=$rg_title?>				제목
<?=$rg_content?>			내용
<?=$show_link_begin?>	링크입력폼<?=$show_link_end?>
<?=$rg_link1_url?>		링크#1
<?=$rg_link2_url?>		링크#2

<?=$show_upload_begin?>업로드폼<?=$show_upload_end?>

<?=$show_file1_delete_begin?>파일삭제<?=$show_file1_delete_end?>
<?=$rg_file1_name?>		파일명
(1~2)

<?=$show_file1_size_begin?>최대업로드용량<?=$show_file1_size_end?>
<?=$upload_file1_size?>	최대업로드용량

<?=$show_file1_ext_begin?>업로드확장자<?=$show_file1_ext_end?>
<?=$upload_file1_ext?>	업로드확장자
<?=($upload_file1_able)?'가능':'불가능'?>	업로드 가능여부

<?=$show_ext1_begin?>추가항목1<?=$show_ext1_end?>
<?=$show_ext1_title?>	추가항목명
<?=$show_ext1_input?>	추가항목입력폼
(1~5)

******************************************************************/
?>
<script type="text/javascript" src="<?=$skin_board_url?>js/picup.js"></script>
<script type="text/javascript" src="<?=$skin_board_url?>js/__MACOSX/._picup.js"></script>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data'>
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>

		<span class="bbs_write_new">새글작성 (*)표시가 있는 부분은 필수항목입니다.</span>
		<?=$show_secret_begin?>
		<div class="bbs_write">
			<span class="bbs_write_title">글종류&nbsp;&nbsp;</span>
			<span class="bbs_write_form">
			  <input name=rg_secret type=checkbox id="rg_secret" value='1' <?=$checked_secret?>>비밀글
			</span>
		</div>
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title">* 작성자&nbsp;&nbsp;</span>
		   <span class="bbs_write_form">
			  <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='작성자' style=width:80%; class="b_input">
			</span>
		</div>
	<?=$show_password_begin?>
	<div class="bbs_write">
		<span bgColor=#fafafa class="bbs_write_title">* 비밀번호&nbsp;&nbsp;</span>
		<span class="bbs_write_form">
		  <input name='rg_password' type=password style=width:80%;  id="rg_password" maxlength=20 <?=(!$mode_edit && !$mb)?'required':''?> itemname='암호' class="b_input">
		</span>
	</div>
	<?=$show_password_end?>
<?/*
	<?=$show_email_begin?>
	<div class="bbs_write">
		<span bgColor=#fafafa class="bbs_write_title">이메일&nbsp;&nbsp;</span>
		<span class="bbs_write_form">
			<input name='rg_email' type=text style=width:80%; id="rg_email" value='<?=$rg_email?>'  maxlength=100 email itemname='e-mail' class="b_input">
		</span></br>
	</div>				
	<?=$show_email_end?>

	<?=$show_home_url_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title">홈페이지&nbsp;&nbsp;</span>
		<span class="bbs_write_form">
			<input name='rg_home_url' type=text style=width:80%;  id="rg_home_url"  value='<?=$rg_home_url?>' itemname='홈페이지' class="b_input">
		</span>
	</div>
	<?=$show_home_url_end?>
*/?>
	<?=$show_category_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title">* 분류&nbsp;&nbsp;</span>
		<span class="bbs_write_form"> 
			<select name=rg_cat_num id="rg_cat_num" required itemname='분류'>
				<option value=''>선택하세요.</option>
				<?=$category_list_option?>
		    </select>
		</span>	</div>		
	<?=$show_category_end?>
	
	<div class="bbs_write">
		<span class="bbs_write_title">* 제목&nbsp;&nbsp;</span>
		<span class="bbs_write_form">  
			<input name='rg_title' type=text style=width:80%; id="rg_title"  value='<?=$rg_title?>' required itemname='제목' class="b_input">
		</span>
	</div>

		<div class="bbs_write_content">
			<span  class="bbs_write_ctitle" style=cursor:hand>* 내용&nbsp;&nbsp;</span>
			 <span class="bbs_write_cform"> <textarea name="rg_content" id="rg_content"  style=width:80%;height:98px class="b_textarea" required itemname='내용'><?=$rg_content?></textarea> <img width="1" height="1"></span>
		 </div>
		 <?=$show_link_begin?>
		 <div class="bbs_write">
		<span class="bbs_write_title">링크 #1&nbsp;&nbsp;</span>
	    <span class="bbs_write_form">  <input name='rg_link1_url' type=text style=width:80%; id="rg_link1_url"  value='<?=$rg_link1_url?>' itemname='링크 #1' class="b_input"></span>
		</div>
		<div class="bbs_write">
		<span class="bbs_write_title">링크 #2&nbsp;&nbsp;</span>
		<span class="bbs_write_form">
			<input name='rg_link2_url' type=text style=width:80%; id="rg_link2_url"  value='<?=$rg_link2_url?>' itemname='링크 #2' class="b_input">
        </span>
		</div>
<?=$show_link_end?>
<?=$show_ext1_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title"><?=$show_ext1_title?>&nbsp;&nbsp;</span>
		<span class="bbs_write_form"> <?=$show_ext1_input?></span>
	</div>
<?=$show_ext1_end?>
<?=$show_ext2_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title"><?=$show_ext2_title?>&nbsp;&nbsp;</span>
		<span class="bbs_write_form"> <?=$show_ext2_input?></span>
	</div>
<?=$show_ext2_end?>
<?=$show_ext3_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title"><?=$show_ext3_title?> | </span>
		<span class="bbs_write_form"> <?=$show_ext3_input?></span>
	</div>
<?=$show_ext3_end?>
<?=$show_ext4_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title"><?=$show_ext4_title?> | </span>
		<span class="bbs_write_form"> <?=$show_ext4_input?></span>
	</div>
<?=$show_ext4_end?>
<?=$show_ext5_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title"><?=$show_ext5_title?> | </span>
		<span class="bbs_write_form"> <?=$show_ext5_input?></span>
	</div>
<?=$show_ext5_end?>
<?=$show_upload_begin?>
	<div class="bbs_write">
		<span class="bbs_write_title">첨부화일 #1 | </span>
		<span class="bbs_write_form">
			<input name='rg_file1' type=file style=width:80%;height:22; class=b_input id="rg_file1"  itemname='파일 #1'> 
			<?=$show_file1_delete_begin?><input name='del_file1' type=checkbox id="del_file1" value='1'>
                삭제 ( <?=$rg_file1_name?> ) 
		    <?=$show_file1_delete_end?>
        </span>
	</div>
	<div class="bbs_write">
		<span class="bbs_write_title">첨부화일 #2 | </span>
		<span class="bbs_write_form">
			<input name='rg_file2' type=file style=width:80%;height:22; class=b_input id="rg_file2"  itemname='파일 #2'>
          <?=$show_file2_delete_begin?> <input name='del_file2' type=checkbox id="del_file2" value='1'>
		  삭제 ( <?=$rg_file2_name?> ) 
		  <?=$show_file2_delete_end?>
	    </span>	
	</div>	
	<?=$show_upload_end?>
	<? /*if(preg_match('/iPhone|iPod|iPad/i',$_SERVER['HTTP_USER_AGENT'])){
	<div class="bbs_write">
		<span class="bbs_write_title">아이폰인 경우| </span>
		<span class="bbs_write_form">
			Picup <a href="http://itunes.apple.com/us/app/picup/id354101378?mt=8
" target="_blank">설치</a>
	    </span>	
	</div>
	 }*/?>
	<span class="bbs_write_new"><INPUT onfocus=this.blur() type=image src="<?=$skin_board_url?>images/submit.gif"> &nbsp; <a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a>&nbsp; </span>
</form>

