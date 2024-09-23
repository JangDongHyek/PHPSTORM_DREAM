<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<!-- 메뉴 시작 { -->
<link rel="stylesheet" href="<?php echo $groupmenu_skin_url ?>/css/style.css">
<section id="groupmenu">
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
   <tr height="37">
        <td colspan='3' style='padding-left:15px'; bgcolor="#f6f6f6">
		  <!--  그룹 네임 시작 -->
		  <b><? echo $group['gr_subject'] ?></b>
	      <!-- 그룹 네임 끝 -->
		</td>
    </tr>
		<tr>
		<td colspan="2" height='1'bgcolor='#dde4e9'></td>
		</tr>
        <?php for ($i=0; $i<count($groupmenu); $i++) {  ?>
		<tr>
		<td style="padding:3px 0px 0px 10px" width="12"><img src="<?php echo $groupmenu_skin_url ?>/img/dot.gif""></td>
		<td><div id="nav1">
  <ul>
    <li<?php if($co_id==$groupmenu[$i]['co_id']) { echo " class=\"on\""; } ?>><a href="<?php echo $groupmenu[$i]['href'] ?>"><?php echo $groupmenu[$i]['subject'] ?></a></li>
  </ul>
</div></td>
		</tr>
		<tr>
		<td colspan="2" height='1' background="<?php echo $groupmenu_skin_url ?>/img/_dot.gif"></td>
		</tr>
        <?php }  ?>
		<tr>
		<td colspan="2" height='10' background="<?php echo $groupmenu_skin_url ?>/img/side_menu_tail.gif"></td>
		</tr>
		<tr>
		<td colspan="2" height='1'bgcolor='#dde4e9'></td>
		</tr>
</table> 
</section>
<!-- } 메뉴 끝 -->