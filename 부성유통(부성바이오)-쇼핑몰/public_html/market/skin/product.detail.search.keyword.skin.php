<?
/*----------------------------------------------------------------------------- 
 *	������ : ������
 *	������ : 2006. 12. 21
 *	�̸��� : heroyeo@hanmail.net
 *	���ϸ� : product.detail.search.keyword.skin.php
 *	
 *	�󼼰˻��� ���� ��ǰ����Ʈ 
 *	form_price ~����  *	to_price ~����
 *	item_name ��ǰ�� *	item_company ������
 *	item_explain ���� ���� 
 -----------------------------------------------------------------------------*/
?>
<script type="text/javascript">
<!--
	function checkDetailSearch()
	{
		if(document.getElementById("from_price").value == "" && document.getElementById("to_price").value == "" && !document.getElementById("item_name").value && !document.getElementById("item_company").value && !document.getElementById("item_explain").value)
		{
			alert("�˻��Ͻ� ������ �Է��ϼ���.");
			return false;
		}
		return true;
	}
//-->
</script>
					<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="60" valign="middle"><img src="../image/search_title.gif" width="120" height="31"></td>
            </tr>
            <tr>
              <td height="1" bgcolor="D9D9D9"></td>
            </tr>
            <tr>
              <td><table width="100%"  border="0" cellpadding="10" cellspacing="5" bgcolor="F2F2F2">
                  <form name='detail_search' method='get' action='?' onsubmit='return checkDetailSearch();'>
                  <input type='hidden' name='ss[search_mode]' value='detail'>
                    <tr>
                      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="10" height="10" bgcolor="#F7F7F7">&nbsp;</td>
                            <td width="700" bgcolor="#F7F7F7"></td>
                            <td width="10" bgcolor="#F7F7F7">&nbsp;</td>
                          </tr>
                          <tr bgcolor="#F7F7F7">
                            <td></td>
                            <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                      <!--���ݺ� �˻�-->
                                      <tr>
                                        <td height="25">���ݺ�</td>
                                        <td><input name="from_price" id="from_price" value='<?=$from_price?>' type="text" class="input_02" size="15" onKeyUp="this.value=comma(this.value);" onKeyDown="checkNumber()">
                                          �� ~ <input name="to_price" id="to_price" value='<?=$to_price?>' type="text" class="input_02" size="15" onKeyUp="this.value=comma(this.value);" onKeyDown="checkNumber()">
                                            ��</td>
                                      </tr>
                                      <!--�����纰 �˻�-->
                                      <tr>
                                        <td height="25">�����纰</td>
                                        <td><input name="item_company" id="item_company" value='<?=$item_company?>' type="text" class="input_02" size="37" style='ime-mode:active'></td>
                                      </tr>
                                      <!--��ǰ�� �˻�-->
                                      <tr>
                                        <td height="25">��ǰ��</td>
                                        <td><input name="item_name" id="item_name" value='<?=$item_name?>' type="text" class="input_02" size="37" style='ime-mode:active'></td>
                                      </tr>
                                      <!--��༳�� �˻�-->
                                      <tr>
                                        <td height="25">��༳��</td>
                                        <td><input name="item_explain" id="item_explain" value='<?=$item_explain?>' type="text" class="input_02" size="37" style='ime-mode:active'></td>
                                      </tr>
                                  </table></td>
                                  <td width="110" valign="bottom"><input type='image' src="../image/bu_search5.gif"  border="0" onfocus='blur();'></td>
                                </tr>
                            </table></td>
                            <td bgcolor="F7F7F7"></td>
                          </tr>
                          <tr>
                            <td width="10" height="10" bgcolor="#F7F7F7">&nbsp;</td>
                            <td bgcolor="#F7F7F7"></td>
                            <td bgcolor="#F7F7F7">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                  </form>
              </table></td>
            </tr>
            <tr>
              <td height="10"></td>
            </tr>
</table>