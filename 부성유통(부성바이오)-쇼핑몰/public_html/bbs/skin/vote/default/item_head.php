<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0> 
<TR> 
  <TD bgColor=#737373> <TABLE cellSpacing=1 cellPadding=0 width="100%" 
border=0> <TR bgColor=#f2f2f2> 
      <TD align=middle> <TABLE cellSpacing=0 cellPadding=0 width="95%" 
                              border=0>
          <TR> 
            <TD height=30>&nbsp;�����Ⱓ: 
              <?=$vt_start?>
              ~ 
              <?=$vt_end?>
              (
              <?=(($vote_expired)?'��ǥ����':'��ǥ������')?>
              )</TD>
            <TD align=right width=25%>&nbsp;��������: 
              <?=$vt_total_count?>
              ��</TD>
          </TR>
        </TABLE></TD>
    </TR> <TR> 
      <TD height=30 align=middle bgColor=#cde7ca><FONT 
                              color=#000000><b>&nbsp;
        <?=$vt_question?></b>
        </FONT></TD>
    </TR> <TR> 
      <TD align=middle bgColor=#ffffff>
			<TABLE width="95%" border=0 style="table-layout:fixed"> 
        <TR> 
          <TD style='word-break:break-all' align="center">
<form action="" method="post" name="vote_form" id="vote_form">
<input name="act" type="hidden" value="ok">
<input name="mode" type="hidden" value="vote">
<input name="vt_num" type="hidden" value="<?=$vt_num?>">
<table width="100%" border="0" cellspacing="3" cellpadding="0" style="table-layout:fixed">
