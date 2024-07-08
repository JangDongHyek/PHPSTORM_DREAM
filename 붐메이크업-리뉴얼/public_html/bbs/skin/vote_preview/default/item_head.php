<script language="JavaScript" type="text/JavaScript">
if (VOTE_SCRIPT_DEFAULT == null)
{
	// 한번만 실행되게
	var VOTE_SCRIPT_DEFAULT = true;
	function vote(form1,popup) {
		if(popup=='1') {
			window.open('','vote_win','width=650,height=650,scrollbars=1');
			form1.target="vote_win";
			form1.action="<?=$vote_popup_url?>";
		} else {
			form1.target="";
			form1.action="<?=$vote_url?>";
		}
	}
	function vote_view(popup) {
		if(popup=='1') {
			window.open('<?=$vote_popup_url?>','vote_win','width=650,height=650,scrollbars=1');
		} else {
			location.replace("<?=$vote_url?>");
		}
	}
}
</script>

<TABLE cellSpacing=1 cellPadding=0 width="100%" 
border=0>
	<form action="<?=$vote_url?>" method="post" name="vote_form" id="vote_form" onSubmit="vote(this,'<?=$vote_popup?>')">
	<input name="act" type="hidden" value="ok">
	<input name="mode" type="hidden" value="vote">
	<input name="vt_num" type="hidden" value="<?=$vt_num?>">
  <TR> 
    <TD align=middle>&nbsp;<a href="#" onClick="vote_view('<?=$vote_popup?>')"><b><?=$vt_question?></b></a> <span style='font-size:8pt;'><?=$vt_cmt_count?></span>
    </TD>
  </TR>
  <TR> 
    <TD align=middle bgColor=#ffffff>
        <table width="100%" border="0" cellspacing="1" cellpadding="0" style="table-layout:fixed">
