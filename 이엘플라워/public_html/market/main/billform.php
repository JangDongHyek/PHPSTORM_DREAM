<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";



include "../include/getmartinfo.php";
include "../include/head_alltemplate.php";
?>


<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../js/jquery-1.7.min.js"></script>


<!-- AceCounter eCommerce (Product_Detail) v7.5 Start -->
<!-- Function and Variables Definition Block Start -->
<script language='javascript'>
var _JV="AMZ2013010701";//script Version
var _UD='undefined';var _UN='unknown';
function _IDV(a){return (typeof a!=_UD)?1:0}
var _CRL='http://'+'gtc10.acecounter.com:8080/';
var _GCD='AS4A41028768549';
if( document.URL.substring(0,8) == 'https://' ){ _CRL = 'https://gtc10.acecounter.com/logecgather/' ;};
if(!_IDV(_A_i)) var _A_i = new Image() ;if(!_IDV(_A_i0)) var _A_i0 = new Image() ;if(!_IDV(_A_i1)) var _A_i1 = new Image() ;if(!_IDV(_A_i2)) var _A_i2 = new Image() ;if(!_IDV(_A_i3)) var _A_i3 = new Image() ;if(!_IDV(_A_i4)) var _A_i4 = new Image() ;
function _RP(s,m){if(typeof s=='string'){if(m==1){return s.replace(/[#&^@,]/g,'');}else{return s.replace(/[#&^@]/g,'');} }else{return s;} };
function _RPS(a,b,c){var d=a.indexOf(b),e=b.length>0?c.length:1; while(a&&d>=0){a=a.substring(0,d)+c+a.substring(d+b.length);d=a.indexOf(b,d+e);}return a};
function AEC_F_D(pd,md,cnum){var i=0,amt=0,num=0;var cat='',nm='';num=cnum;md=md.toLowerCase();if(md=='b'||md=='i'||md=='o'){for(i=0;i<_A_pl.length;i++){if(_A_nl[i]==''||_A_nl[i]==0)_A_nl[i]='1';if(num==0||num=='')num='1';if(_A_pl[i]==pd){nm=_RP(_A_pn[i]);amt=(parseInt(_RP(_A_amt[i],1))/parseInt(_RP(_A_nl[i],1)))*num;cat=_RP(_A_ct[i]);var _A_cart=_CRL+'?cuid='+_GCD;_A_cart+='&md='+md+'&ll='+_RPS(escape(cat+'@'+nm+'@'+amt+'@'+num+'^&'),'+','%2B');break;};};if(_A_cart.length>0)_A_i.src=_A_cart+"rn="+String(new Date().getTime());setTimeout("",2000);};};
if(!_IDV(_A_pl)) var _A_pl = Array(1) ;
if(!_IDV(_A_nl)) var _A_nl = Array(1) ;
if(!_IDV(_A_ct)) var _A_ct = Array(1) ;
if(!_IDV(_A_pn)) var _A_pn = Array(1) ;
if(!_IDV(_A_amt)) var _A_amt = Array(1) ;
if(!_IDV(_pd)) var _pd = '' ;
if(!_IDV(_ct)) var _ct = '' ;
if(!_IDV(_amt)) var _amt = '' ;
</script>
<!-- Function and Variables Definition Block End-->
<style>
	.email-form tr td,.email-form tr th{border-bottom:1px solid #ccc; height:30px; line-height:30px;padding:5px}
	.input{border:1px solid #ccc;height:25px;}
	.primercy tr th{border:1px solid #ccc;border-top:2px solid #333;width:33.3%}
	.primercy tr td{border:1px solid #ccc;line-height:15px;text-align:center;border-top:0px}
	.btn-submit{border-radius:10px; background-color:#783fc6;color:#fff;font-weight:bold;border:0px;padding-top:3px}
	.btn-cancel{border-radius:10px; background-color:#067dd2;color:#fff;font-weight:bold;border:0px;padding-top:3px}
</style>

<script language='JavaScript' src='../printEmbed.js'></script>
<? if($Mall_Admin_ID&&$MemberLevel==1){ ?>
<body topmargin="0" leftmargin="0">
<?}else{?>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false" topmargin="0" leftmargin="0"> 
<?}?>

<? include("../include/top2.htm"); ?></td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="1000" valign="top" background="../images/proudct/product_list_box_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="100%" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">

                        <tr>
                          <td height="100%"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td valign="top" style="font-weight:bold;font-size:20px">
																	▣ 계산요청서
																</td>
                              </tr>
                              <tr>
                                <td height="7"></td>
                              </tr>
															<tr>
																<td>
																	<!-- 폼 시작 -->
																	<form name="emailForm" method="get" action="billform_update.php" onsubmit="return formCheck()">
																	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="email-form">
																		<tbody>
																		<tr>
																			<th>회사명</th>
																			<td><input type="text" name="company" id="company" value="" class="input" size="20" required></td>
																		</tr>
																		<tr>
																			<th>대표자명</th>
																			<td><input type="text" name="repres" id="repres" value="" class="input" size="10" required></td>
																		</tr>
																		<tr>
																			<th>업태</th>
																			<td><input type="text" name="business" id="business" value="" class="input" size="30" ></td>
																		</tr>
																		<tr>
																			<th>업종</th>
																			<td><input type="text" name="line" value="" id="line" class="input" size="30"></td>
																		</tr>
																		<tr>
																			<th>사업자 등록번호</th>
																			<td><input type="text" name="biz_no" value="" id="biz_no" class="input" size="30" required></td>
																		</tr>
																		<tr>
																			<th>사업자 주소</th>
																			<td><input type="text" name="biz_addr" value="" id="biz_addr" class="input" size="50" required></td>
																		</tr>
																		<tr>
																			<th>주문번호</th>
																			<td><input type="text" name="order_no" value="" id="order_no" class="input" size="30" required></td>
																		</tr>
																		<tr>
																			<th>수령자이메일</th>
																			<td><input type="email" name="res_email" value="" id="email" class="input" size="50" required></td>
																		</tr>
																		<tr>
																			<th colspan="2">개인정보 수집 및 이용동의</th>
																		</tr>
																		<tr>
																			<td colspan="2">
																				<table width="100%" cellpadding="0" cellspacing="0" class="primercy">
																					<tr>
																						<th>목적</th>
																						<th>항목</th>
																						<th>보유기간</th>
																					</tr>
																					<tr>
																						<td>세금계산서 발행 요청을 위한 서비스제공</td>
																						<td>담당자성명 / 연락처 / 상호 / 업태 / 주소 / 이메일 / 휴대폰 / 사업자번호 / 대표자명 / 종목</td>
																						<td>목적 달성 후 1개월(관계법률로 인해 필요 시, 일정기간 보존)</td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																		<tr>
																			<td colspan="2" style="padding-left:10px">
																				<input type="checkbox" name="chk" id="chk" value=""> 개인정보 수집 및 이용에 동의합니다.
																			</td>
																		</tr>
																		<tr>
																			<td colspan="2" style="text-align:center">
																				<button type="submit" class="btn-submit">확 인</button>
																				<button type="button" class="btn-cancel">재입력</button>
																			</td>
																		</tr>
																		</tbody>
																	</table>
																	</form>
																	<!-- 폼 끝 -->
																	<script type="text/javascript">
																	$(function(){
																		$(".btn-cancel").bind("click",function(){
																			$("input").val("");
																		});
																	});
																		function formCheck(){
																			if($("#company").val().length<1){
																				alert("회사명을 입력하세요");
																				$("#company").focus();
																				return false;
																			}
																			if($("#repres").val().length<1){
																				alert("대표자명을 입력하세요");
																				$("#repres").focus();
																				return false;
																			}
																			if($("#biz_no").val().length<1){
																				alert("사업자 등록 번호를 입력하세요");
																				$("#biz_no").focus();
																				return false;
																			}
																			if($("#biz_addr").val().length<1){
																				alert("사업자 주소를 입력하세요");
																				$("#biz_addr").focus();
																				return false;
																			}
																			if($("#order_no").val().length<1){
																				alert("주문번호를 입력하세요");
																				$("#order_no").focus();
																				return false;
																			}
																			if($("#email").val().length<1){
																				alert("이메일을 입력하세요");
																				$("#email").focus();
																				return false;
																			}
																			if($("#email").val().lastIndexOf(".")<1){
																				alert("이메일 형식이 맞지 않습니다.");
																				return false;
																			}
																			if($("#email").val().lastIndexOf("@")<1){
																				alert("이메일 형식이 맞지 않습니다.");
																				return false;
																			}
																			if($("#chk").prop("checked")==false){
																				alert("개인정보 수집 및 이용약관에 동의하지 않으셨습니다.");
																				return false;
																			}
																			return true;
																		}
																	</script>
																</td>
															</tr>
                              
                              
 
                          </table></td>
                        </tr>
					</table></td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

<!-- AceCounter eCommerce (Product_Detail) v7.5 Start -->
<!-- Data Allocation (Product_Detail) -->
<script language='javascript'>

_pd =_RP("<?=$item_name?>");
_ct =_RP("<?=$category_num?>");
_amt = _RP('<?=$z_price?>'.replace(/[^0-9]/g,''),1); // _RP(1)-> 가격

_A_amt=Array('<?=$z_price?>'.replace(/[^0-9]/g,''));
_A_nl=Array('1');
_A_pl=Array('<?=$item_no?>');
_A_pn=Array('<?=$item_name?>');
_A_ct=Array('<?=$category_num?>');
</script>
<!-- AceCounter eCommerce (Product_detail) v6.4 Start -->


<iframe name="add" frameborder="0" scrolling="no" height="0" width="0"></iframe>
<!---------------------- 하단메뉴 시작 -------------------------------------------------->
<?
include "../include/bottom.htm";
?>
<!---------------------- 하단메뉴 끝 ---------------------------------------------------->	
                                              <map name="pro_detail_1Map">
                                                <area shape="rect" coords="391,5,583,29" href="#qna">
                                                <area shape="rect" coords="197,5,387,30" href="#review">
                                              </map>
                                              <map name="pro_detail_1">
                                                <area shape="rect" coords="151,7,297,37" href="#review">
                                                <area shape="rect" coords="299,7,447,36" href="#qna">
                                              </map>
											          <map name="pro_detail_2">
          <area shape="rect" coords="1,4,194,30" href="#info">
          <area shape="rect" coords="388,5,586,30" href="#qna">
        </map>
		        <map name="pro_detail_3">
          <area shape="rect" coords="2,5,194,30" href="#info">
          <area shape="rect" coords="194,5,392,30" href="#review">
        </map>
</body>
</html>
