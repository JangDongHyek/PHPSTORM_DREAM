<?
	$site_path = '../';
	$site_url = '../';
	require_once($site_path."include/admin.lib.inc.php");
?>
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="100%" height="50" bgcolor="F2F2F2" class="title" align="center"><b>�������</b></td>
	</tr>
</table>
<table width="796" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td width="350" align="center" valign="top">
      <!--��з� ���̺� ���� -->
      <?
			if (!$mode) {
				$cyear = date("Y");
				$cmonth = date("m");
				$cday = date("d");
				$mode = "day";
			}
			?>
      <TABLE WIDTH=780 HEIGHT=40 align="center">
        <FORM ACTION='./LOG.php3'>
          <INPUT TYPE=HIDDEN NAME=mode VALUE='<?ECHO"$mode";?>'>
          <TR>
            <TD ALIGN=CENTER BGCOLOR=C0C0C0><SELECT NAME='cyear' style='width:67;' onchange='this.form.submit();'>
              <?
			if (eregi($mode, "week:os:agent:referer")) {
					ECHO "<OPTION VALUE='' SELECTED style='background:c0c0c0;'>------</OPTION>\n";
			}
			else {
			for($i = "2002"; $i <= date("Y")+1; $i++ ) {
				if($cyear == $i) {
					ECHO "<OPTION VALUE='$i' SELECTED>${i}��</OPTION>\n";
				}
				else {
					ECHO "<OPTION VALUE='$i'>${i}��</OPTION>\n";
				}
			}
			}
			?>
            </SELECT>
                <SELECT NAME='cmonth' style='width:55;' onchange='this.form.submit();'>
                  <?
			if (eregi($mode, "week:os:agent:referer")) {
					ECHO "<OPTION VALUE='' SELECTED style='background:c0c0c0;'>----</OPTION>\n";
			}
			else {
				if ($mode == 'month') {
					ECHO "<OPTION VALUE='' SELECTED style='background:c0c0c0;'>----</OPTION>\n";
				}
				else {
					for($i = 1; $i <= 12; $i++) {
						if ($i < 10) {$o = "0".$i;} else {$o = $i;}
						if($cmonth == $i) {
							ECHO "<OPTION VALUE='$o' SELECTED>${o}��</OPTION>\n";
						}
						else {
							ECHO "<OPTION VALUE='$o'>${o}��</OPTION>\n";
						}
					}
				}
			}
			?>
                </SELECT>
                <SELECT NAME='cday' style='width:55;' onchange='this.form.submit();'>
                  <?
			if (eregi($mode, "week:os:agent:referer")) {
					ECHO "<OPTION VALUE='' SELECTED style='background:c0c0c0;'>----</OPTION>\n";
			}
			else {
				if($mode == 'hour') {
					for($i = 1; $i <= 31; $i++) {
						if ($i < 10) {$o = "0".$i;} else {$o = $i;}
						if($cday == $i) {
							ECHO "<OPTION VALUE='$o' SELECTED>${o}��</OPTION>\n";
						}
						else {
							ECHO "<OPTION VALUE='$o'>${o}��</OPTION>\n";
						}
					}
				}
				else {
					ECHO "<OPTION VALUE='' SELECTED style='background:c0c0c0;'>----</OPTION>\n";
				}
			}
			?>
                </SELECT>
                <INPUT name="BUTTON" TYPE=BUTTON onClick="javascript:split_part('month');" VALUE='������'<?if($mode=='month'){ECHO" style='background:gold;'";}?>>
                <INPUT name="BUTTON" TYPE=BUTTON onClick="javascript:split_part('day');" VALUE='��¥��'<?if($mode=='day'){ECHO" style='background:gold;'";}?>>
                <INPUT name="BUTTON" TYPE=BUTTON onClick="javascript:split_part('hour');" VALUE='�ð���'<?if($mode=='hour'){ECHO" style='background:gold;'";}?>>
                <INPUT name="BUTTON" TYPE=BUTTON onClick="javascript:split_part('week');" VALUE='���Ϻ�'<?if($mode=='week'){ECHO" style='background:gold;'";}?>>
                <INPUT name="BUTTON" TYPE=BUTTON onClick="javascript:split_part('referer');" VALUE='���ӷ�Ʈ'<?if($mode=='referer'){ECHO" style='background:gold;'";}?>>
            </TD>
          </TR>
        </FORM>
      </TABLE>
      <script language=javascript>
			function split_part(str) {
				var str;
				window.location.href = "./LOG.php3?r_type=<?ECHO"$r_type";?>&mode=" + str + "&cyear=<?ECHO"$cyear";?>&cmonth=<?ECHO"$cmonth";?>&cday=<?ECHO"$cday";?>";
			}
			</script>
      <?if($mode != 'referer'):?>
      <TABLE WIDTH=692>
        <TR>
          <TD VALIGN=TOP WIDTH=157 VALIGN=TOP>
          <?
			$TOTAL_HIT = @@mysql_fetch_array(mysql_query("SELECT sum(DAY_TOTAL),avg(DAY_TOTAL),max(DAY_TOTAL),min(DAY_TOTAL) FROM nit_counter",$dbcon));
			$TODAY_HIT = @@mysql_fetch_array(mysql_query("SELECT UID,DAY_TOTAL FROM nit_counter WHERE COUNT_DATE='".date("Ymd")."'",$dbcon));
			$YESTER_HIT = @@mysql_fetch_array(mysql_query("SELECT DAY_TOTAL FROM nit_counter WHERE UID='".($TODAY_HIT[UID]-1)."'",$dbcon));
			?>
          <TABLE BGCOLOR=GRAY CELLSPACING=0 CELLPADDING=1>
            <TR>
              <TD><TABLE WIDTH=100% CELLSPACING=1 CELLPADDING=1 BGCOLOR=EFEFEF>
                <TR>
                  <TD COLSPAN=2 ALIGN=CENTER HEIGHT=5></TD>
                </TR>
                <TR>
                  <TD WIDTH=80><IMG SRC='./log/dot_1.gif' align=absmiddle> ������ </TD>
                  <TD WIDTH=77>: <FONT COLOR=RED><?ECHO number_format($TOTAL_HIT[0]);?></FONT></TD>
                </TR>
                <TR>
                  <TD COLSPAN=2 ALIGN=CENTER><IMG SRC='./log/l_line.gif'></TD>
                </TR>
                <TR>
                  <TD WIDTH=80><IMG SRC='./log/dot_1.gif' align=absmiddle> ���� </TD>
                  <TD WIDTH=77>: <FONT COLOR=BLUE><?ECHO number_format($TODAY_HIT[DAY_TOTAL]);?></FONT></TD>
                </TR>
                <TR>
                  <TD COLSPAN=2 ALIGN=CENTER><IMG SRC='./log/l_line.gif'></TD>
                </TR>
                <TR>
                  <TD WIDTH=80><IMG SRC='./log/dot_1.gif' align=absmiddle> ���� </TD>
                  <TD WIDTH=77>: <FONT COLOR=GRAY><?ECHO number_format($YESTER_HIT[DAY_TOTAL]);?></FONT></TD>
                </TR>
                <TR>
                  <TD COLSPAN=2 ALIGN=CENTER><IMG SRC='./log/l_line.gif'></TD>
                </TR>
                <TR>
                  <TD WIDTH=80><IMG SRC='./log/dot_1.gif' align=absmiddle> �ִ� </TD>
                  <TD WIDTH=77>: <FONT COLOR=GREEN><?ECHO number_format($TOTAL_HIT[2]);?></FONT></TD>
                </TR>
                <TR>
                  <TD COLSPAN=2 ALIGN=CENTER><IMG SRC='./log/l_line.gif'></TD>
                </TR>
                <TR>
                  <TD WIDTH=80><IMG SRC='./log/dot_1.gif' align=absmiddle> �ּ� </TD>
                  <TD WIDTH=77>: <FONT COLOR=GREEN><?ECHO number_format($TOTAL_HIT[3]);?></FONT></TD>
                </TR>
                <TR>
                  <TD COLSPAN=2 ALIGN=CENTER><IMG SRC='./log/l_line.gif'></TD>
                </TR>
                <TR>
                  <TD WIDTH=80><IMG SRC='./log/dot_1.gif' align=absmiddle> ��� </TD>
                  <TD WIDTH=77>: <FONT COLOR=BROWN><?ECHO number_format($TOTAL_HIT[1]);?></FONT></TD>
                </TR>
                <TR>
                  <TD COLSPAN=2 ALIGN=CENTER HEIGHT=5></TD>
                </TR>
              </TABLE></TD>
            </TR>
          </TABLE>
        </TD>
        
        <TD WIDTH=5></TD>
            <TD VALIGN=TOP WIDTH=530 BGCOLOR=GRAY><TABLE WIDTH=550 BGCOLOR=WHITE BACKGROUND='./log/log_bg.gif'>
                <TR HEIGHT=18>
                  <TD BGCOLOR=EFEFEF COLSPAN=2><FONT COLOR=GRAY> <IMG SRC='./log/blank.gif' height=10 width=40>0% <IMG SRC='./log/blank.gif' height=10 width=80>25% <IMG SRC='./log/blank.gif' height=10 width=80>50% <IMG SRC='./log/blank.gif' height=10 width=80>75% <IMG SRC='./log/blank.gif' height=10 width=85>100% </FONT> </TD>
                </TR>
                <?
			/***************************************************************************�������**/ 
			if ($mode == 'month'):

			$TOTAL_COUNT = @@mysql_fetch_array(mysql_query("SELECT sum(DAY_TOTAL) FROM nit_counter WHERE COUNT_DATE LIKE '$cyear%'", $dbcon));
			if(!$TOTAL_COUNT[0]) {$TOTAL_NUM = 1;}else{$TOTAL_NUM = $TOTAL_COUNT[0];}

			for($i = 1; $i < 13; $i++) {
				if($i < 10) {$ii = "0".$i;}else{$ii = $i;}

				$MONTH_COUNT = @@mysql_fetch_array(mysql_query("SELECT sum(DAY_TOTAL) FROM nit_counter WHERE COUNT_DATE LIKE '$cyear$ii%'", $dbcon));	

			?>
                <TR HEIGHT=18>
                  <TD ALIGN=CENTER WIDTH=42 BGCOLOR=EFEFEF><A HREF='./LOG.php3?mode=day&cyear=<?ECHO$cyear;?>&cmonth=<?ECHO$ii;?>'><?ECHO $ii;?> <FONT COLOR=GRAY>��</FONT></A> </TD>
                  <TD WIDTH=488><A HREF='./LOG.php3?mode=day&cyear=<?ECHO$cyear;?>&cmonth=<?ECHO$ii;?>'><IMG SRC='./log/grp1.gif' height='12' width='<?ECHO intval($MONTH_COUNT[0]/$TOTAL_NUM*430);?>' align=absmiddle BORDER=0 ALT='���Ӽ� : <?ECHO number_format($MONTH_COUNT[0]);?>ȸ'></A> <FONT COLOR=GRAY>
                    <?if($MONTH_COUNT[0]){ECHO number_format($MONTH_COUNT[0]);}?>
                  </FONT> </TD>
                </TR>
                <?
			}


			endif;
			/***************************************************************************�������**/
			/***************************************************************************���ں����**/
			if ($mode == 'day'):

			$MONTH_COUNT = @@mysql_fetch_array(mysql_query("SELECT sum(DAY_TOTAL) FROM nit_counter WHERE COUNT_DATE LIKE '$cyear$cmonth%'", $dbcon));
			if(!$MONTH_COUNT[0]) {$MONTH_COUNT = 1;}else{$MONTH_COUNT = $MONTH_COUNT[0];}

			$month_max = array("31","28","31","30","31","30","31","31","30","31","30","31");

			for($i = 1; $i <= $month_max[$cmonth-1]; $i++) {
				if($i < 10) {$ii = "0".$i;}else{$ii = $i;}

				$TODAY_COUNT = @@mysql_fetch_array(mysql_query("SELECT sum(DAY_TOTAL) FROM nit_counter WHERE COUNT_DATE='$cyear$cmonth$ii'", $dbcon));	

				if (date( 'l', mktime(0,0,0,$cmonth,$ii,$cyear)) == 'Sunday') { 
					$day_str = "$ii <FONT COLOR=RED>(��)</FONT>";
				}
				elseif (date( 'l', mktime(0,0,0,$cmonth,$ii,$cyear)) == 'Monday') {
					$day_str = "$ii <FONT COLOR=GRAY>(��)</FONT>";
				}
				elseif (date( 'l', mktime(0,0,0,$cmonth,$ii,$cyear)) == 'Tuesday') {
					$day_str = "$ii <FONT COLOR=GRAY>(ȭ)</FONT>";
				}
				elseif (date( 'l', mktime(0,0,0,$cmonth,$ii,$cyear)) == 'Wednesday') { 
					$day_str = "$ii <FONT COLOR=GRAY>(��)</FONT>";
				}
				elseif (date( 'l', mktime(0,0,0,$cmonth,$ii,$cyear)) == 'Thursday') {
					$day_str = "$ii <FONT COLOR=GRAY>(��)</FONT>";
				}
				elseif (date( 'l', mktime(0,0,0,$cmonth,$ii,$cyear)) == 'Friday') {
					$day_str = "$ii <FONT COLOR=GRAY>(��)</FONT>";
				}
				else {
					$day_str = "$ii <FONT COLOR=BLUE>(��)</FONT>";
				}
			?>
                <TR HEIGHT=18>
                  <TD ALIGN=CENTER WIDTH=42 BGCOLOR=EFEFEF><A HREF='./LOG.php3?mode=hour&cyear=<?ECHO$cyear;?>&cmonth=<?ECHO$cmonth;?>&cday=<?ECHO$ii;?>'><?ECHO"$day_str";?></A> </TD>
                  <TD WIDTH=488><A HREF='./LOG.php3?mode=hour&cyear=<?ECHO$cyear;?>&cmonth=<?ECHO$cmonth;?>&cday=<?ECHO$ii;?>'><IMG SRC='./log/grp1.gif' height='12' width='<?ECHO intval($TODAY_COUNT[0]/$MONTH_COUNT*430);?>' align=absmiddle BORDER=0 ALT='���Ӽ� : <?ECHO number_format($TODAY_COUNT[0]);?>ȸ'></A> <FONT COLOR=GRAY>
                    <?if($TODAY_COUNT[0]){ECHO number_format($TODAY_COUNT[0]);}?>
                    </FONT>
                      <?
			if(is_file("./cal/$cmonth$ii")) {
				$cal_f = file("./cal/$cmonth$ii");
				ECHO "<FONT COLOR=ORANGE>$cal_f[0]</FONT>";
			}
			?>
                  </TD>
                </TR>
                <?
			}

			endif;
			/***************************************************************************���ں����**/
			/***************************************************************************�ð������**/
			if ($mode == 'hour'):

			$DAY_COUNT = @@mysql_fetch_array(mysql_query("SELECT * FROM nit_counter WHERE COUNT_DATE='$cyear$cmonth$cday'", $dbcon));
			if(!$DAY_COUNT[DAY_TOTAL]) {$DAY_TOTAL = 1;}else{$DAY_TOTAL = $DAY_COUNT[DAY_TOTAL];}


			for($i = 0; $i < 24; $i++) {
				if($i < 10) {$ii = "0".$i;}else{$ii = $i;}

			?>
                <TR HEIGHT=18 onClick="javascript:split_part('day');" style='cursor:hand;' title="Ŭ���Ͻø� [��¥������]�� ���ư��ϴ�.">
                  <TD ALIGN=CENTER WIDTH=42 BGCOLOR=EFEFEF><?ECHO $ii;?> <FONT COLOR=GRAY>��</FONT> </TD>
                  <TD WIDTH=488><IMG SRC='./log/grp1.gif' height='12' width='<?ECHO intval($DAY_COUNT["H_".$ii]/$DAY_TOTAL*430);?>' align=absmiddle BORDER=0 ALT='���Ӽ� : <?ECHO number_format($DAY_COUNT["H_".$ii]);?>ȸ'> <FONT COLOR=GRAY>
                    <?if($DAY_COUNT["H_".$ii]){ECHO number_format($DAY_COUNT["H_".$ii]);}?>
                  </FONT> </TD>
                </TR>
                <?
			}

			endif;
			/***************************************************************************�ð������**/
			/***************************************************************************���Ϻ����**/ 
			if ($mode == 'week'):

			$TOTAL_DATA = mysql_query("SELECT * FROM nit_counter", $dbcon);
			while($LIST = @@mysql_fetch_array($TOTAL_DATA)) {

				$week_year = substr($LIST[COUNT_DATE],0,4);
				$week_month = substr($LIST[COUNT_DATE],4,2);
				$week_day = substr($LIST[COUNT_DATE],6,2);


				if (date( 'l', mktime(0,0,0,$week_month,$week_day,$week_year)) == 'Sunday') { 
					$week_num_0 = $week_num_0 + $LIST[DAY_TOTAL];
				}
				elseif (date( 'l', mktime(0,0,0,$week_month,$week_day,$week_year)) == 'Monday') {
					$week_num_1 = $week_num_1 + $LIST[DAY_TOTAL];
				}
				elseif (date( 'l', mktime(0,0,0,$week_month,$week_day,$week_year)) == 'Tuesday') {
					$week_num_2 = $week_num_2 + $LIST[DAY_TOTAL];
				}
				elseif (date( 'l', mktime(0,0,0,$week_month,$week_day,$week_year)) == 'Wednesday') { 
					$week_num_3 = $week_num_3 + $LIST[DAY_TOTAL];
				}
				elseif (date( 'l', mktime(0,0,0,$week_month,$week_day,$week_year)) == 'Thursday') {
					$week_num_4 = $week_num_4 + $LIST[DAY_TOTAL];
				}
				elseif (date( 'l', mktime(0,0,0,$week_month,$week_day,$week_year)) == 'Friday') {
					$week_num_5 = $week_num_5 + $LIST[DAY_TOTAL];
				}
				else {
					$week_num_6 = $week_num_6 + $LIST[DAY_TOTAL];
				}
				$TOTAL_NUM = $TOTAL_NUM + $LIST[DAY_TOTAL];
			}

			if(!$TOTAL_NUM) {$TOTAL_NUM = 1;}

			$WEEK_ARRAY = array("<FONT COLOR=RED>�Ͽ���</FONT>","������","ȭ����","������","�����","�ݿ���","<FONT COLOR=BLUE>�����</FONT>");
			for ($i = 0; $i < sizeof($WEEK_ARRAY); $i++) {
			?>
                <TR HEIGHT=18>
                  <TD ALIGN=CENTER WIDTH=42 BGCOLOR=EFEFEF><?ECHO $WEEK_ARRAY[$i];?></TD>
                  <TD WIDTH=488><IMG SRC='./log/grp1.gif' height='12' width='<?ECHO intval(${week_num_.$i}/$TOTAL_NUM*430);?>' align=absmiddle BORDER=0 ALT='���Ӽ� : <?ECHO number_format(${week_num_.$i});?>ȸ'> <FONT COLOR=GRAY>
                    <?if(${week_num_.$i}){ECHO number_format(${week_num_.$i});}?>
                  </FONT> </TD>
                </TR>
                <?
			}
			endif;
			/***************************************************************************���Ϻ����**/
			/***************************************************************************OS�����**/ 
			if ($mode == 'os'):

			$OS_COUNT = @@mysql_fetch_array(mysql_query("SELECT sum(XP),sum(WIN2000),sum(WINME),sum(WINNT),sum(WIN98),sum(WIN95),sum(LINUX),sum(SUN),sum(MAC),sum(OSETC),sum(DAY_TOTAL) FROM nit_counter", $dbcon));

			if(!$OS_COUNT[10]) {$OS_NUM = 1;}else{$OS_NUM = $OS_COUNT[10];}

			$WEEK_ARRAY = array("��XP","��2K","��ME","��NT","��98","��95","LINUX","SUN","MAC","ETC");
			for ($i = 0; $i < sizeof($WEEK_ARRAY); $i++) {
			?>
                <TR HEIGHT=18>
                  <TD WIDTH=42 BGCOLOR=EFEFEF>&nbsp;<?ECHO $WEEK_ARRAY[$i];?></TD>
                  <TD WIDTH=488><IMG SRC='./log/grp1.gif' height='12' width='<?ECHO intval($OS_COUNT[$i]/$OS_NUM*430);?>' align=absmiddle BORDER=0 ALT='���Ӽ� : <?ECHO number_format($OS_COUNT[$i]);?>ȸ'> <FONT COLOR=GRAY>
                    <?if($OS_COUNT[$i]){ECHO number_format($OS_COUNT[$i]);}?>
                  </FONT> </TD>
                </TR>
                <?
			}
			endif;
			/***************************************************************************OS�����**/
			/***************************************************************************OS�����**/ 
			if ($mode == 'agent'):

			$BR_COUNT = @@mysql_fetch_array(mysql_query("SELECT sum(IE40),sum(IE50),sum(IE55),sum(IE60),sum(OPERA),sum(NES),sum(BRETC),sum(DAY_TOTAL) FROM  nit_counter", $dbcon));

			if(!$BR_COUNT[7]) {$BR_NUM = 1;}else{$BR_NUM = $BR_COUNT[7];}

			$BR_ARRAY = array("IE4.0","IE5.0","IE5.5","IE6.0","OPE","NES","ETC");
			for ($i = 0; $i < sizeof($BR_ARRAY); $i++) {
			?>
                <TR HEIGHT=18>
                  <TD WIDTH=42 BGCOLOR=EFEFEF>&nbsp;<?ECHO $BR_ARRAY[$i];?></TD>
                  <TD WIDTH=488><IMG SRC='./log/grp1.gif' height='12' width='<?ECHO intval($BR_COUNT[$i]/$BR_NUM*430);?>' align=absmiddle BORDER=0 ALT='���Ӽ� : <?ECHO number_format($BR_COUNT[$i]);?>ȸ'> <FONT COLOR=GRAY>
                    <?if($BR_COUNT[$i]){ECHO number_format($BR_COUNT[$i]);}?>
                  </FONT> </TD>
                </TR>
                <?
			}
			endif;
			/***************************************************************************OS�����**/
			?>
            </TABLE></TD>
        </TR>
      </TABLE>
      <?else:?>
      <?if($r_type == 'sort'):?>
      <TABLE WIDTH=692 CELLSPACING=1 CELLPADDING=1 BGCOLOR=EFEFEF>
        <TR ALIGN=CENTER HEIGHT=25 BGCOLOR=c2dcf4>
          <TD WIDTH=30> NO </TD>
          <TD> �����Ͻ� </TD>
          <TD> ����IP </TD>
          <TD> ����ȣ��Ʈ </TD>
          <TD WIDTH=200><A HREF='./LOG.php3?mode=referer&cyear=<?ECHO$cyear;?>&cmonth=<?ECHO$cmonth;?>&cday=<?ECHO$cday;?>'><B>���Ӱ��[��躸��]</A></B> </TD>
        </TR>
        <?
			$LISTNUM = "15";
			$RECNUM = "50";
			if ( !$p ) { $p = 1; $PAGENUM = 1; } else {$PAGENUM = $p;}
			$START_NUM = ($PAGENUM-1)*$RECNUM;

			if ($where && $keyword) {
			$WHERE = "WHERE $where LIKE '%$keyword%'";
			}

			$COUNT_DATA = mysql_query( "SELECT count(*) FROM nit_referer $WHERE", $dbcon ); 
			$COUNT_ARRAY = @@mysql_fetch_array($COUNT_DATA);
			$DATA_NUM = $COUNT_ARRAY[0];
			$TOTAL_PAGE = intval(($DATA_NUM-1)/$RECNUM)+1;

			$REFERER_DATA = mysql_query("SELECT * FROM nit_referer $WHERE ORDER BY UID DESC LIMIT $START_NUM,$RECNUM", $dbcon);
			while($LIST = @@mysql_fetch_array($REFERER_DATA)) :
			$REPERER_SITE = split("/", $LIST[REFERER]);
			//http://$REPERER_SITE[2]
			?>
        <TR ALIGN=CENTER HEIGHT=24 BGCOLOR=WHITE>
          <TD nowrap><?ECHO $DATA_NUM - ($i + ($RECNUM*($p - 1)));?> </TD>
          <TD nowrap><?ECHO"$LIST[REFER_DATE]";?> </TD>
          <TD nowrap><A HREF='<?ECHO"http://$LIST[IP]";?>' TARGET=_blank><?ECHO"$LIST[IP]";?></A> </TD>
          <TD><A HREF='<?ECHO"http://$LIST[HOST]";?>' TARGET=_blank><?ECHO"$LIST[HOST]";?></A> </TD>
          <TD ALIGN=LEFT style='word-break:break-all;'><A HREF='<?ECHO"$LIST[REFERER]";?>' TARGET=_blank>
            <?if($LIST[REFERER]){ECHO"$LIST[REFERER]";}?>
          </A> </TD>
        </TR>
        <?$i++; endwhile;?>
      </TABLE>
      <?else:?>
      <!----------------------------------------------------------------------------------------->
      <TABLE WIDTH=692 CELLSPACING=1 CELLPADDING=1 BGCOLOR=EFEFEF>
        <TR ALIGN=CENTER HEIGHT=25 BGCOLOR=c2dcf4>
          <TD WIDTH=30> �� </TD>
          <TD> ���Ӱ�� </TD>
          <TD> ���Ӽ� </TD>
          <TD> �ֱ����� </TD>
          <TD WIDTH=200><A HREF='./LOG.php3?mode=referer&r_type=sort&cyear=<?ECHO$cyear;?>&cmonth=<?ECHO$cmonth;?>&cday=<?ECHO$cday;?>'><B>���Ӱ��[��ü����]</A></B> </TD>
        </TR>
        <?
			$LISTNUM = "15";
			$RECNUM = "50";
			if ( !$p ) { $p = 1; $PAGENUM = 1; } else {$PAGENUM = $p;}
			$START_NUM = ($PAGENUM-1)*$RECNUM;

			$DATA_NUM_ARRAY = @@mysql_fetch_array(mysql_query( "SELECT count(*),sum(HIT) FROM nit_referer_rank", $dbcon )); 
			$DATA_NUM = $DATA_NUM_ARRAY[0];
			$HIT_SUM = $DATA_NUM_ARRAY[1];
			$TOTAL_PAGE = intval(($DATA_NUM-1)/$RECNUM)+1;

			$REFERER_DATA = mysql_query("SELECT * FROM nit_referer_rank ORDER BY HIT DESC LIMIT $START_NUM,$RECNUM", $dbcon);
			while($LIST = @@mysql_fetch_array($REFERER_DATA)) :$i++;
			?>
        <TR ALIGN=CENTER HEIGHT=24 BGCOLOR=WHITE>
          <TD nowrap><B><?ECHO $i + ($RECNUM*($p - 1));?></B> </TD>
          <TD ALIGN=LEFT><?if($LIST[REFERER_SITE] != 'http://'):?>
              <A HREF='<?ECHO"$LIST[REFERER_SITE]";?>' TARGET=_blank><FONT COLOR='#F45C00'><B><?ECHO"$LIST[REFERER_SITE]";?></B></FONT></A>
              <?else:?>
              <B>���ã��(�Ǵ� ����������)�� ��������</B>
              <?endif;?>
          </TD>
          <TD nowrap><FONT COLOR=RED><B><?ECHO number_format($LIST[HIT]);?></B></FONT> </TD>
          <TD nowrap><FONT COLOR=GREEN><?ECHO $LIST[REFER_DATE];?></FONT> </TD>
          <TD ALIGN=LEFT><IMG SRC='./log/grp1.gif' WIDTH='<?ECHO intval(($LIST[HIT]/$HIT_SUM)*150);?>' HEIGHT='10'> <?ECHO round(($LIST[HIT]/$HIT_SUM)*100,1);?>% </TD>
        </TR>
        <?endwhile;?>
      </TABLE>
      <!----------------------------------------------------------------------------------------->
      <?endif;?>
      <TABLE BORDER=0 WIDTH=692 CELLSPACING=0 CELLPADDING=0>
        <TR>
          <TD BACKGROUND='./image/list_bg1.gif' HEIGHT=25><?
			$move_query_str = "mode=referer&r_type=$r_type&cyear=$cyear&cmonth=$cmonth&cday=$cday&";
			$move_imgdir = "./image";
			include ("./ROOT_MOVE_BAR.php3");
			?>
          </TD>
        </TR>
        <FORM ACTION='./LOG.php3' method=post>
        
        <INPUT TYPE=hidden name=r_type VALUE='sort'>
        <INPUT TYPE=hidden name=mode2 VALUE='referer'>
        <INPUT TYPE=hidden name=cyear VALUE='<?ECHO"$cyear";?>'>
        <INPUT TYPE=hidden name=cmonth VALUE='<?ECHO"$cmonth";?>'>
        <INPUT TYPE=hidden name=cday VALUE='<?ECHO"$cday";?>'>
      </TABLE>
      <P ALIGN=CENTER>
        <SELECT NAME=where>
          <OPTION VALUE='IP'>���� IP</OPTION>
          <OPTION VALUE='HOST'>����ȣ��Ʈ</OPTION>
          <OPTION VALUE='REFERER'>���Ӱ��</OPTION>
        </SELECT>
        <INPUT TYPE=TEXT NAME=keyword SIZE=15 VALUE='<?ECHO"$keyword";?>'>
        <INPUT name="SUBMIT" TYPE=SUBMIT VALUE=' �˻� '>
      </P>
      <TABLE WIDTH=692>
        </FORM>
        
        <TR>
          <TD style='line-height:130%;'><FONT COLOR=GRAY>
            <LI></LI>
            REFERER �׸��� ����ִ� ���� ���ã�⳪ URL�� ���� �Է��Ͽ� ������ ����Դϴ�.
            <LI></LI>
            ���ӷ�Ʈ������ �ִ�10000������ ����Ǹ� 10000�� �̻��� ��� �ڵ����� 1000���� �ڵ������˴ϴ�. </FONT> </TD>
        </TR>
      </TABLE>
      <?endif;?>
    </td>
	</tr>
	</table>