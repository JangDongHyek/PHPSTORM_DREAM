<?
/*----------------------------------------------------------------------------- 
 *	제작자 : 여성술
 *	제작일 : 2006. 12. 20
 *	이메일 : heroyeo@hanmail.net
 *	파일명 : product.search.keyword.skin.php
 *	
 *	검색에 의한 상품리스트 
 -----------------------------------------------------------------------------*/
?>
				<table width="97%"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="DFDFDF">
              <tr>
                <td bgcolor="F7F7F7"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="10"></td>
                    </tr>
                    <tr>
                      <td><img src="../images/proudct/product_info_title_icon.gif" width="13" height="13" align="absmiddle" /> <span class="category_title"><strong>일반검색</strong></span></td>
                    </tr>
                    <tr>
                      <td height="7"></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="D4CFC3"></td>
                    </tr>
                    <tr>
                      <td height="7" bgcolor="#FFFFFF"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFFFFF" style="padding-left:5px;padding-right:5px"><font  style="font-size:12pt;color:#6E72E5"><b>
					  <!--AceCounter Plus Search variable Start -->
						<script language='javascript'>
							var _AceTM=(_AceTM||{}); _AceTM.pSearch='<?=$kw?>'; //사이트내부검색어
						</script>
					  <!--AceCounter Plus Search variable End -->
					  
      <?=$kw?>
      </b></font><font  style="font-size:9pt;color:#806340"><b>에 대한 검색결과입니다. (총
        <?=$page_info[total_rows]?>
        건)</font></b></td>
                    </tr>
                    <tr>
                      <td height="7" bgcolor="#FFFFFF"></td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="D4CFC3"></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
</table>