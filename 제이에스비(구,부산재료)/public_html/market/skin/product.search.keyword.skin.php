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
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="46" background="../images/depth2_list_1.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2%">&nbsp;</td>
                <td width="48%"><img src="../images/list_icon.gif" width="8" height="9" align="absmiddle"> <span class="category_title"> 일반검색</span> </td>
                <td width="48%" align="right">&nbsp;</td>
                <td width="2%">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" background="../images/depth2_list_2.gif"><table width="93%"  border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td>&nbsp;&nbsp;<font  style="font-size:12pt;color:#6E72E5"><b><?=$kw?></b></font><font  style="font-size:9pt;color:#6E72E5">에 대한 검색결과입니다. (총 <?=$page_info[total_rows]?>건)</font></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="../images/depth2_list_3.gif"></td>
          </tr>
        </table>