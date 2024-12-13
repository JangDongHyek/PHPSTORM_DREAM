<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
?>	
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<table width="801" border="0" align="center" cellpadding="0" cellspacing="0" style="border-width:1px; border-color:rgb(221,221,221); border-style:solid;">
  <tr> 
    <td align="center"> <br>
      <table border="1" cellpadding="0" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1">
        <tr> 
          <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><span style="font-size:9pt;"><font color="#404040"><a href="create_zip_tables.php">우편번호테이블 
              생성</a></font></span></p></td>
        </tr>
      </table>
      <br>
      <table border="1" cellpadding="0" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1">
        <tr> 
          <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><span style="font-size:9pt;"><font color="#404040"><a href="create_vote_tables.php">투표테이블 
              생성</a></font></span></p></td>
        </tr>
      </table>
      <br> <table border="1" cellpadding="0" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1">
        <tr> 
          <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><span style="font-size:9pt;"><font color="#404040"><a href="create_count_tables.php">접속통계테이블 
              생성</a></font></span></p></td>
        </tr>
      </table>
      <br>
      <table border="1" cellpadding="0" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1">
        <tr> 
          <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><span style="font-size:9pt;"><font color="#404040"><a href="delete_rgboard.php" target="_blank">보드 
              삭제</a></font></span></p></td>
        </tr>
      </table>
      <br> <table border="1" cellpadding="0" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1">
        <tr> 
          <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><span style="font-size:9pt;"><font color="#404040"><a href="up30102to30103.php">업그레이드 
              3.1.2 =&gt; 3.1.3</a></font></span></p></td>
        </tr>
      </table> 
      <br>
      <table border="1" cellpadding="0" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1">
        <tr> 
          <td width="796" height="40" bgcolor="#F7F7F7"> <p align="center"><span style="font-size:9pt;"><font color="#404040"><a href="../counter" target="_blank">접속통계</a> 
              (<a href="../counter/counter_log_remove.php" target="_blank">접속로그삭제)</a><br>
              (접속통계기능을 사용하려면 counter/readme.txt 를 읽어보세요)</font></span></p></td>
        </tr>
      </table> 
      <br>
      <table border="1" cellpadding="0" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1">
        <tr>
          <td width="796" height="40" bgcolor="#F7F7F7"><p align="center"><span style="font-size:9pt;"><font color="#404040"><a href="doc_tracert.php">문서추적</a></font></span></p></td>
        </tr>
      </table>
      <br>
    </td>
  </tr>
</table>
<? include("admin.footer.php"); ?>