<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>Untitled Document</title>
<meta http-equiv="imagetoolbar" content="no">
<link href="../style.css" rel="stylesheet" type="text/css">

<!--배경이미지 코드 시작 -->
<style type="text/css">
<!--
body {background:#1A1F2F url(../images/sub_bg.jpg) no-repeat  center top}
-->
</style>
<!--배경이미지 코드 끝 -->

<!--서브플래시 레이어 시작 -->
<style type="text/css">
<!--
#LayerContainer3 {
	position: absolute;
	top:141px;
	text-align: center;
	width: 100%;
	z-index: -1;
}
#Layer3 {
margin: 0 auto;
position: relative;
width: 990px;
text-align: center;
padding-left: 0px;
z-index: -1
}
-->
</style>
<!--서브플래시 레이어 끝 -->

</head>

<script languagwe='JavaScript' src='../js/printEmbed.js'></script>
<script languagwe='JavaScript' src='../printEmbed.js'></script>
<body topmargin="0" leftmargin="0">
<div id="LayerContainer3">
<div id="Layer3"><script type="text/javascript">flashWrite('../swf/sub1.swf?pageNum=<?=$num?>','990','223')</script></div>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td width="990" height="141" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="198" height="141" background="../images/logo.jpg"><script type="text/javascript">flashWrite('../swf/logo.swf?pageNum=<?=$num?>','198','141')</script></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="55" style="padding:10 0 0 0"><div align="right">
              <? include '../inc/top.htm'; ?>
            </div></td>
          </tr>
          <tr>
            <td height="86" background="../images/menu_bg.jpg"><? $num = "0"; include "../inc/menu.php"; ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td width="990" height="171">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td width="990"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="198" height="100%" valign="top"><table width="197" height="100%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td bgcolor="#000000"><div align="center">
              <table width="197" border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top" bgcolor="#000000"><div align="center">
                      <? $num = "1"; include "../inc/mem_menu.php"; ?>
                  </div></td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td height="100%" bgcolor="#000000">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#000000">&nbsp;</td>
          </tr>
        </table></td>
        <td width="19" valign="top">&nbsp;</td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="17"></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="203"><table width="100" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="../images/mem_t1.gif" width="203" height="21"></td>
                    </tr>
                    <tr>
                      <td><img src="../images/s_t.gif" width="203" height="14"></td>
                    </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="center"><img src="../images/login/t1.gif" width="468" height="91"></div></td>
              </tr>
              <tr>
                <td height="60"><div align="center"><img src="../images/login/t2.gif" width="246" height="23"></div></td>
              </tr>
              <tr>
                <td><table width="420" border="0" align="center" cellpadding="0" cellspacing="0">
                    <form name=mblogin method=post action='<?=$login_url?>' autocomplete=off>
                      <input type=hidden name=act value='ok'>
                      <input type=hidden name=url value='<?=$url?>'>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="75"><img src="../images/login/id.gif" width="65" height="12"></td>
                                    <td><input name="mb_id" type="text" class="input_01" style="width:200px;height:20px;padding-left:3px" value="<?if($ck_id_ok) echo $ck_mb_id;?>"></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="9"></td>
                            </tr>
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="75"><img src="../images/login/pw.gif" width="65" height="12"></td>
                                    <td><input name="mb_password" type="password" class="input_01" style="width:200px;height:20px;padding-left:3px"></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table>
						<div style="color:#FFF;margin-top:10px;"><input type="checkbox" name="ck_id" value="true" <?if($ck_id_ok) echo "checked = checked";?>"> ID 저장</div>
                        <td width="116"><input name="image" type="image" style="border:0px;"  src="../images/login/btn.gif"></td>
                      </tr>
                    </form>
                </table></td>
              </tr>
              <tr>
                <td height="35">&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center"><img src="../images/login/j_btn.gif" width="437" height="78" border="0" usemap="#j_btn">
                    <map name="j_btn">
                      <area shape="rect" coords="36,14,397,33" href="../bbs/mb_join_check.php">
                      <area shape="rect" coords="36,34,397,53" href="../bbs/mb_password.php">
                    </map>
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
              </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>
<?
include "../inc/copy.htm";
?>
</body>
</html>
