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

<?=$show_name_begin?>이름입력<?=$show_name_end?>
<?=$rg_name?>					이름

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
<Script language="javascript" src="../js/jquery-1.7.min.js"></script>
<script language="javascript">
	$(document).ready(function(){
		var $radio=$(".bbs_write_form input[type=radio]");
		$radio.click(function(){
			var $val=$radio.index(this)*10;
			$rg_cat_num=parseInt($("#rg_cat_num").attr("value"));
			if($val==0){
				document.getElementById("rg_cat_num2").value="";
				document.getElementById("rg_cat_num3").value="";
				document.getElementById("rg_cat_num4").value="";
			}else if($val==10){
				document.getElementById("rg_cat_num2").value=$rg_cat_num+$val;
				document.getElementById("rg_cat_num3").value="";
				document.getElementById("rg_cat_num4").value="";
			}else if($val==20){
				document.getElementById("rg_cat_num2").value=$rg_cat_num+10;
				document.getElementById("rg_cat_num3").value=$rg_cat_num+$val;
				document.getElementById("rg_cat_num4").value="";
			}else if($val==30){
				document.getElementById("rg_cat_num2").value=$rg_cat_num+10;
				document.getElementById("rg_cat_num3").value=$rg_cat_num+20;
				document.getElementById("rg_cat_num4").value=$rg_cat_num+$val;
			}
		});
	});

	function chk_Form(f){
		if(document.form_write.rg_title.value == ""){
			alert('연락처를 입력해주세요.');
			return false;
		}

		if(f.rg_ext2.value == ""){
			alert('인원수를 선택해주세요.');
			return false;
		}

		return true;
	}
</script>
<? 
	$bbs_category_table="rg_".$bbs_id."_category";
	$sql="select * from $bbs_category_table where cat_num='$rg_cat_num'";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	$cat_name=$rs[cat_name];
?>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data' onSubmit="return chk_Form(this);">
<input type=hidden name=act value='ok'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<input type="hidden" name="rg_cat_num" id="rg_cat_num" value="<?=$rg_cat_num?>">
<input type=hidden name=rg_ext5 value='<?=$rg_ext5?>'>
 <input name=rg_secret type=hidden id="rg_secret" value='1' <?=$checked_secret?>>
 <input type="hidden" name="rg_cat_num2" value="<?=$rg_cat_num2?>" id="rg_cat_num2">
<input type="hidden" name="rg_cat_num3" value="<?=$rg_cat_num3?>" id="rg_cat_num3">
<input type="hidden" name="rg_cat_num4" value="<?=$rg_cat_num4?>" id="rg_cat_num4">
<input type="hidden" name="rg_ext5" value="<?=$rg_ext5?>">
<input type="hidden" name="rg_content" value="1">
		<span class="bbs_write_new">새글작성 (*)표시가 있는 부분은 필수항목입니다.</span>
		
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title">* 예약자명&nbsp;&nbsp;</span>
		   <span class="bbs_write_form">
			  <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='이름' style=width:80%; class="b_input">
			</span>
		</div>
		
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title">* 연락처&nbsp;&nbsp;</span>
		   <span class="bbs_write_form">
			   <input name='rg_title' type=text style=width:100%;height:22; class=b_input value='<?=$rg_title?>' maxlength=100>
			</span>
		</div>
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title"> * 인원&nbsp;&nbsp;</span>
		   <span class="bbs_write_form">
			  <select name="rg_ext2">
							<option value="">===인원 수===</option>
							<option value="2명" <? if($rg_ext2=="2명"){echo "selected";}?>>2명</option>
							<option value="3명" <? if($rg_ext2=="3명"){echo "selected";}?>>3명</option>
							<option value="4명" <? if($rg_ext2=="4명"){echo "selected";}?>>4명</option>
						  </select>
			</span>
		</div>
		<div class="bbs_write">
		   <span bgColor=#fafafa class="bbs_write_title"> 홀수&nbsp;&nbsp;</span>
		   <span class="bbs_write_form">
			  <input type="radio" name="rg_ext1" id="rg_ext1" value="9홀" <? if($rg_ext1=="9홀"){echo "checked";}else if(!$rg_ext1){echo "checked";}?>>9홀
							<? if($rg_cat_num < 104){ ?>
						   <input type="radio" name="rg_ext1"  id="rg_ext1"value="18홀" <? if($rg_ext1=="18홀"){echo "checked";}?>>18홀
						    <? } ?>
						   <input type="radio" name="rg_ext1" id="rg_ext1" value="27홀" <? if($rg_ext1=="27홀"){echo "checked";}?>>27홀
						   <input type="radio" name="rg_ext1" id="rg_ext1" value="36홀" <? if($rg_ext1=="36홀"){echo "checked";}?>>36홀
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
	

		<div class="bbs_write_content">
			<span  class="bbs_write_title" style=cursor:hand></span>
			 <span class="bbs_write_form"> </span>
		 </div>
		 

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
	<span class="bbs_write_new"><INPUT onfocus=this.blur() type=image src="<?=$skin_board_url?>images/submit.gif"> &nbsp; <a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a>&nbsp; </span>
</form>

