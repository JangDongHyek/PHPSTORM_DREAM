<style>
.smenu{
	width: 190px; /*width of menu*/
	/*border-style: solid solid none solid;*/
	/*border-color: #94AA74;*/
	/*border-size: 1px;*/
	/*border-width: 1px;*/
	font-family:"돋움","굴림";
	letter-spacing:-1;
}

.smenu ul{
	list-style-type: none;
	margin: 0;
	padding: 0;
}
	
.smenu li a{
	font-size:12px;
	display: block;
	background: transparent url("../img/smenu.gif") 100% 0;
	height: 40px; /*Set to height of bg image- padding within link (ie: 32px - 4px - 4px)*/
	padding: 0px 0 0px 15px;
	line-height: 40px; /*Set line-height of bg image- padding within link (ie: 32px - 4px - 4px)*/
	text-decoration: none;
}	

.smenu li a:link, .smenu li a:visited {
	color: #333232;
}

.smenu li a:hover{
	color: #000;
	background-position: 100% -40px;
}

	
.smenu li a.selected{
	color: #fff;
	background-position: 100% -80px;
}

.smenu_t{ color:#fff; font-size:18px; line-height:normal; padding:0px 0px 0px 12px}
</style>



<!--왼쪽부분시작-->
<table width="190" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="50" bgcolor="#2d87ff" class="smenu_t">주문 관리</td>
  </tr>
<tr>
	<td><!--2차메뉴-->
            <div class="smenu">
	             <ul>
	             	<li><a href="../order/order_new.php">주문 관리</a></li>
	             	<li><a href="../order/change_list.php">교환/반품 관리</a></li>
	             </ul>
             </div>
<!--//2차메뉴--></td>
</tr>
<tr>
	<td><a href="#"><img src="../img/top.gif" width="190" height="31" border="0" /></a></td>
  </tr>
</table>
<!--왼쪽부분 END-->