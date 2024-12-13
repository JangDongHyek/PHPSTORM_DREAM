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
<?=$checked_html_use2?>	html+<br>체크

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
<script>
	function chkForm(f)
	{
		var denyArr=Array(",","-","/","=","~","|","?");
		for(var i=0;i<=denyArr.length;i++){
		//금지 단어 방지 스크립트
			var msg=denyText(denyArr[i]);
			if(msg){
				alert(msg);
				return false;
				break;
			}
		}
		var rg_spam1=document.getElementById("rg_spam1").value;
		if(rg_spam1){
			var rg_spam2=document.getElementById("rg_spam2").value;
			if(rg_spam1!=rg_spam2){
				alert("스팸방지 번호가 맞지 않습니다.");
				return false;
			}
		}
		/*var obj_Title_arr=document.getElementById("rg_title").value.split(",");
		var obj_titles="";
		var obj_conetents="";
		var obj_Content_arr=document.getElementById("rg_content").value.split(",");
		var obj_DenyArr=obj_Deny.split(",");
		for(var j=0;j<obj_Title_arr.length;j++){
			obj_titles+=obj_Title_arr[j];
		}
		for(var k=0;k<obj_Content_arr.length;k++){
			obj_conetents+=obj_Content_arr[k];
		}
		var obj_Title=obj_titles;
		var obj_Content=obj_conetents;
		if(obj_Deny){
			for(var i=0;i<obj_DenyArr.length;i++){
				var chk1=obj_Title.match(obj_DenyArr[i].toString());
				var chk2=obj_Content.match(obj_DenyArr[i].toString());
				if(chk1==obj_DenyArr[i]){
					alert("제목에 "+chk1+"는(은) 사용할 수 없는 단어입니다.");
					return false;
					break;
				}
				if(chk2==obj_DenyArr[i]){
					alert("내용에 "+chk2+"는(은) 사용할 수 없는 단어입니다.");
					return false;
					break;
				}
			}
		}*/
	}
	function denyText(gubun){
		var obj_Deny=document.getElementById("bbs_deny_word").value;
		var obj_Title_arr=document.getElementById("rg_title").value.split(gubun);
		var obj_titles="";
		var obj_conetents="";
		var obj_Content_arr=document.getElementById("rg_content").value.split(gubun);
		var obj_DenyArr=obj_Deny.split(",");
		for(var j=0;j<obj_Title_arr.length;j++){
			obj_titles+=obj_Title_arr[j];
		}
		for(var k=0;k<obj_Content_arr.length;k++){
			obj_conetents+=obj_Content_arr[k];
		}
		var obj_Title=obj_titles;
		var obj_Content=obj_conetents;
		if(obj_Deny){
			for(var i=0;i<obj_DenyArr.length;i++){
				var chk1=obj_Title.match(obj_DenyArr[i].toString());
				var chk2=obj_Content.match(obj_DenyArr[i].toString());
				if(chk1==obj_DenyArr[i]){
					return "제목에 "+chk1+"는(은) 사용할 수 없는 단어입니다.";
					break;
				}
				if(chk2==obj_DenyArr[i]){
					return "내용에 "+chk2+"는(은) 사용할 수 없는 단어입니다.";
					break;
				}
			}
		}
		return "";
	}
	
</script>
<TABLE cellSpacing=0 cellPadding=0 width="<?=$width?>"  border=0>
<form name=form_write method=post action='<?=$u_action?>' enctype='multipart/form-data' onSubmit="return chkForm(this);">
<input type=hidden name=act value='ok'>
<input type=hidden name="rg_title" value='보수교육 신청서'>
<input type=hidden name=old_password value='<?=$old_password?>'>
<input type="hidden" name="bbs_deny_word" value="<?=$bbs[bbs_deny_word]?>">
<TR>
	<TD bgcolor=#B6C232 height=2></TD>
</TR>
<TR>
            <TD>
                <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <TR>
                        <TD>
                            <TABLE cellSpacing=0 cellPadding=0 width="100%" bgColor=#ffffff border=0>
                                <TR>
                                    <TD height=30 align=middle><B>새글작성</B> (*)표시가 있는 부분은 필수항목입니다.</TD>
                                </TR>
                                <TR>
                                    <TD bgColor=#e7e7e7 height=1></TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">* 성명<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input name='rg_name' type=text id="rg_name" value='<?=$rg_name?>' maxlength=20 required itemname='이름' style=width:90%;height:22; class=b_input>                        </TD>
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">생년월일<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="date" name="birth">
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">* 주소<B>
                                                        &nbsp; </B></TD>
                                                <TD align=left class="bbs" bgcolor="#FFFFFF">
                                                    <input id="address1" name='address1' type="text" style=width:90%;height:22; class="b_input" readonly onclick="openPostCode()" placeholder="주소"/>
                                                    <input name='address2' type="text" style=width:90%;height:22; class="b_input" placeholder="상세주소"/>
                                                    <br>
                                                    <button onclick="openPostCode()">주소찾기</button>
                                                    &nbsp;</TD>
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">소속 기관명<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="text" name="belong">
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">휴대폰<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="text" name="phone">
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">근무형태<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="radio" name="work_type" value="방문요양">방문요양
                                                    <input type="radio" name="work_type" value="방문목욕">방문목욕
                                                    <input type="radio" name="work_type" value="주간보호센터">주간보호센터
                                                    <input type="radio" name="work_type" value="요양시설">요양시설
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">신청 교육일<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="date" name="birth">
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <TABLE cellSpacing=1 cellPadding=1 width="100%" border=0>
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs">교육시간<B> &nbsp; </B></TD>
                                                <TD bgcolor="#FFFFFF">
                                                    <input type="radio" name="work_time" value="주간(종일)">주간(종일)
                                                    <input type="radio" name="work_time" value="토">토
                                                    <input type="radio" name="work_time" value="일">일
                                                    <input type="radio" name="work_time" value="오전">오전
                                                    <input type="radio" name="work_time" value="오후">오후
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                                <TR>
                                    <TD height="50">
                                        <TABLE width="100%" height="100" border="0" cellPadding=1 cellSpacing=1 bordercolor="#ffffff">
                                            <TR>
                                                <TD width=131 align=right bgColor=#F6F7E3 class="bbs" onclick="document.form_write.rg_content.rows=document.form_write.rg_content.rows+2" style=cursor:hand>* 남기고싶은말 ▼<B>&nbsp;</B></TD>
                                                <TD align=left height="100" bgcolor="#FFFFFF"> <textarea name="rg_content" id="rg_content"  rows=15  style=width:90%; class="b_textarea" required itemname='내용'><?=$rg_content?></textarea> <img width="1" height="1"></TD>
                                            </TR>
                                        </TABLE>
                                    </TD>
                                </TR>

                            </TABLE>
                        </TD>
	</TR>
	<TR>
		<TD bgcolor=#E7E7E7 height=1></TD>
	</TR>
	<TR> 
		<TD align=middle bgColor=#ffffff><BR> <INPUT onfocus=this.blur() type=image src="<?=$skin_board_url?>images/submit.gif"> &nbsp; <a href="javascript:history.back()" onfocus=this.blur()><IMG src="<?=$skin_board_url?>images/cancel.gif" border=0></a>&nbsp; </TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</form>
</TABLE>
<br>
<br>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

<script>
    function openPostCode() {
        new daum.Postcode({
            oncomplete: function(data) {
                document.getElementById("address1").value = data.address;
            }
        }).open();
    }
</script>