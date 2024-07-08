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
                      <? $num = "2"; include "../inc/mem_menu.php"; ?>
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
                      <td><img src="../images/mem_t2.gif" width="203" height="21"></td>
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
              <form name="frm_agree" method="post" action="mb_join.php" onSubmit="return confirm_agree();">
                <input type=hidden name=url value='<?=$url?>'>
                <tr>
                  <td><div align="center"><img src="../images/login/t1.gif" width="468" height="91"></div></td>
                </tr>
                <tr>
                  <td height="30"><div align="center"></div></td>
                </tr>
                <tr>
                  <td height="45" valign="top"><img src="../images/login/join1.gif" width="545" height="29"></td>
                  <?=$show_agreement_begin?>
                </tr>
                <tr>
                  <td height="218" background="../images/login/box.gif"><div align="center">
                      <table width="530" height="130" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
                        <tr>
                          <td valign="top" bgcolor="#1A1F2F"><iframe src="<?=$skin_site_path?>contract.php" frameborder=0 width=530 height=130></iframe></td>
                        </tr>
                      </table>
                  </div></td>
                </tr>
                <tr>
                  <td><div align="center">
                      <input type="checkbox" name="agree[]" value="1">
                      <span class="text1">위 약관에 동의함</span></div></td>
                </tr>
                <?=$show_agreement_end?>
                <?=$show_pravacy_policy_begin?>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td height="45" valign="top"><img src="../images/login/join2.gif" width="534" height="29"></td>
                </tr>
                <tr>
                  <td height="218" background="../images/login/box.gif"><table width="530" height="130" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
                      <tr>
                        <td valign="top" bgcolor="#1A1F2F"><iframe src="<?=$skin_site_path?>policy.php" frameborder=0 width=530 height=130></iframe></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><div align="center">
                      <input name="agree[]" type="checkbox" id="agree[]" value="1">
                      <span class="text1">위 정책에 동의함</span></div></td>
                </tr>
                <tr>
                  <td height="70"><div align="center"><img src="../images/login/join_box_t.gif" width="437" height="57"></div></td>
                </tr>
                <tr>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><div align="center">
                      <input name="submit" type="image" src="../images/login/join_btn_1.gif" value="회원 가입 신청" /><a href="javascript:history.back()" onfocus=this.blur()><img src="../images/login/join_btn_2.gif" width="214" height="34" border="0"></a></div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <?=$show_pravacy_policy_end?>
                  <td>&nbsp;</td>
                </tr>
              </form>
            </table></td>
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
