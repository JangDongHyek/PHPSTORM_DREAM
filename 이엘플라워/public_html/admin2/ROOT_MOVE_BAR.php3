<TABLE WIDTH=100% CELLPADDING=0 CELLSPACING=0 BORDER=0>
<TR>
<TD ALIGN=CENTER>
<?
	if ($p == 1) {
		ECHO "<IMG src='./log/prev1.gif' border='0' ALIGN=ABSMIDDLE>";
	}
	else {
		$PrevPage = $p-1;
		ECHO "<A HREF='$PHP_SELF?${move_query_str}p=$PrevPage'><img src='./log/prev2.gif' border='0' ALIGN=ABSMIDDLE></A>";
	}
	ECHO "<IMG SRC='./log/cut_line.gif' ALIGN='ABSMIDDLE'>";

	$term = $LISTNUM;
	$f = 1;
	$l = $term;

	while ($f <= $TOTAL_PAGE) {
		if (($f <= $p) && ($p <= $l)) {
			if ($l <= $TOTAL_PAGE) {
				for ($page = $f; $page <= $l; $page++) {
					if ($page == $p) {
						echo "<FONT COLOR=RED>$page</FONT><IMG SRC='./log/cut_line.gif' ALIGN='ABSMIDDLE'>";
					}
					else {
						echo "<A HREF='$PHP_SELF?${move_query_str}p=$page'>$page</A><IMG SRC='./log/cut_line.gif' ALIGN='ABSMIDDLE'>";
					}
				}
			}
			else {
				for ($page = $f; $page <= $TOTAL_PAGE; $page++) {
					if ($page == $p) {
						echo "<FONT COLOR=RED>$page</FONT><IMG SRC='./log/cut_line.gif' ALIGN='ABSMIDDLE'>";
					}
					else {
						echo "<A HREF='$PHP_SELF?${move_query_str}p=$page'>$page</A><IMG SRC='./log/cut_line.gif' ALIGN='ABSMIDDLE'>";
					}
				}
			}
		}
		
		$f = $f + $term;
		$l = $l + $term;
	}

	if($p == $TOTAL_PAGE) {
		ECHO "<IMG src='./log/next1.gif' border='0' ALIGN=ABSMIDDLE>";
	}
	else {
		$NextPage = $p+1;
		ECHO "<A HREF='$PHP_SELF?${move_query_str}p=$NextPage'><img src='./log/next2.gif' border='0' ALIGN=ABSMIDDLE></A>";
	}
?>
</TD>
</TR>
</TABLE>