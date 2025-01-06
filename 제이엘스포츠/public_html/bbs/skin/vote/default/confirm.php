<?
/******************************************************************
 ★ 파일설명 ★ 
글삭제,코멘트삭제시 확인

 ★ 스킨 제작을 위한 변수 설명 ★ 

<?=$skin_vote_url?>		스킨 URL
<?=$u_action?> 				폼 action URL
<?=$title?>		 				타이틀
<?=$message?> 				부가메시지

******************************************************************/
?>
<TABLE cellPadding=0 width="100%" border=0>
<form name=frgform method=post action='<?=$u_action?>' enctype='multipart/form-data'>
<input type=hidden name=act value='confirm_ok'>
		<TR> 
      <TD align=middle> <TABLE cellSpacing=0 cellPadding=1 width="100%" border=0>
          <TR> 
            <TD align=middle bgColor=#737373> <TABLE cellSpacing=0 cellPadding=0 width="100%" 
                        bgColor=#ffffff border=0>
                <TR bgColor=#cde7ca> 
                  <TD height=24 align=middle class="bbs"><B>&nbsp;<font color="#000000"><?=$title?></font></B></TD>
                </TR>
                <TR> 
                  <TD align=middle bgColor=#ffffff class="bbs"><BR>
                    <font color="#000000">
                    <?=$message?>
                    </font> 
                    <INPUT type=image onfocus=this.blur() 
                              src="<?=$skin_vote_url?>submit.gif"> &nbsp; 
															
                    <a href="javascript:history.back()" onfocus=this.blur()><IMG 
                        src="<?=$skin_vote_url?>cancel.gif" border=0></a>&nbsp; <BR> <BR></TD>
                </TR>
              </TABLE></TD>
          </TR>
        </TABLE></TD>
    </TR>
	</FORM>
</TABLE>