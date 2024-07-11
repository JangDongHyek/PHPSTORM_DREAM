<link href="../../css/common.css?version=<?php echo date('YmdHis')?>" rel="stylesheet" type="text/css">

<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?	






$SQL = "select * from $CategoryTable where g_id='$_SESSION[Mall_Admin_ID]'";
$dbresult = mysql_query($SQL, $dbconn);
$rows = mysql_fetch_array($dbresult);

$target_prevno = $rows[prevno];
$target_degree = $rows[category_degree];
$category_num = $rows[category_num];

$sea_area = $rows[sea_area];
$sung_area = $rows[sung_area];
$khan_area = $rows[khan_area];

$country_num = $rows[country_num];
$sea_num = $rows[sea_num];
$sung_num = $rows[sung_num];
$khan_num = $rows[khan_num];
$sudong_num = $rows[sudong_num];



if($target_degree == 3)												// 4차일 때 
{
	$target_thirdno = $target_prevno;					// 3차
	$SQL = "select prevno from $CategoryTable where category_num='$target_thirdno'";
	$dbresult = mysql_query($SQL, $dbconn);
	$target_prevno = mysql_result($dbresult,0,0);		// 2차그룹
	$SQL = "select prevno from $CategoryTable where category_num='$target_prevno'";
	$dbresult = mysql_query($SQL, $dbconn);
	$target_firstno = mysql_result($dbresult,0,0);	// 1차그룹
}
elseif($target_degree == 2)									// 3차일 때 
{
	$SQL = "select prevno from $CategoryTable where category_num='$target_prevno'";		
	$dbresult = mysql_query($SQL, $dbconn);
	$target_firstno = mysql_result($dbresult,0,0);		// 1차그룹
	$target_thirdno = $category_num;
}elseif($target_degree == 1)								// 2차일 때
{
	$target_firstno = $target_prevno;
	$target_prevno = $category_num;
}else												// 1차일 때
{
	$target_firstno = $category_num;
}



$firstno = $target_firstno;
$prevno = $target_prevno;
$thirdno = $target_thirdno;















/*


$item_name = $rows[item_name];
$address = $rows[address];
$tel = $rows[tel];
$hobby = $rows[hobby];
$email = $rows[email];
$my_bank_name = $rows[my_bank_name];
$my_bank_account = $rows[my_bank_account];
$my_bank_master = $rows[my_bank_master];

$open_address = $rows[open_address];
$open_tel = $rows[open_tel];
$open_hobby = $rows[open_hobby];
$open_email = $rows[open_email];

*/

$SQL = "select * from $New_BoardConfigTable where mart_id = '$mart_id' and bbs_no = '$bbs_no'";
$dbresult = mysql_query($SQL, $dbconn);
$ary = mysql_fetch_array($dbresult);

$board_title = $ary[board_title];	
$item_fg_color = $ary[item_fg_color];	
$item_bg_color = $ary[item_bg_color];	
$table_fg_color = $ary[table_fg_color];	
$table_bg_color = $ary[table_bg_color];	
$headhtml = $ary[headhtml];
$tailhtml = $ary[tailhtml];
$top_body = $ary[top_body];
$bottom_body = $ary[bottom_body];	
$board_class = $ary[board_class];	
$pagecount = $ary[pagecount];	
$if_use_secret = $ary[if_use_secret];	
$userfile_use = $ary[userfile_use];

if($bbs_no == 7 && !$_SESSION["Mall_Admin_ID"])
{
	echo ("		
	<script>
		alert('관리자만 글을 쓰실수 있습니다.');
		history.go(-1);
	</script>
	");
	exit;
}

if( $board_class == 1 || $board_class == 3 ){
	$SQL = "select username from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows < 1 && !$_SESSION["Mall_Admin_ID"]){
		echo ("		
			<script>
			window.alert('회원전용 공간입니다.');
			parent.location.href='../member/login.html?url=$url&mart_id=$mart_id';
			</script>
		");
		exit;
	}
}

if($board_class == 2){
	if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
	echo ("		
	<script>
		alert('관리자만 글을 쓰실수 있습니다.');
		history.go(-1);
	</script>
	");
	exit;
	}
}

include( '../include/getmartinfo.php' );
if(isset($flag)==false || $flag != "write"){
	include('../include/head_alltemplate.php');
?>
<script language="javascript">
<!--
/*function goTo(){
	var f=document.boardchange;
	f.action="board.php";
	f.submit();
}*/
//-->
</script>
<script>
/*var blnBodyLoaded = false;
var blnEditorLoaded = false;

function HandleLoad() {
	blnBodyLoaded = true;
	if (blnEditorLoaded == true) {
		init();
	}
}

function setEditMode(sMode){
	var f = document.writeform;
	f.editBox.editmode = sMode;
}
function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.content.value;
	f.editBox.focus();
	f.editBox.setFocus();
}
*/

function board_checkform(){
	var f = document.writeform;
	var content = ed.getHtml(); //대체한 textarea에 작성한HTML값 전달
	
	
	
	
	
	
	
	
	
	
	
	
	






	if(f.ga_sudong_num.value != ''){


		var Digit = '1234567890'
		var len =f.ga_sudong_num.value.length;
		var ret;
		ret =false;		
		for(var i=0;i<len;i++){  
		    var ch = f.ga_sudong_num.value.substring(i,i+1);
		    
			for (var k=0;k<=Digit.length;k++){				
				
				if(Digit.substring(k,k+1) == ch)
				{					
					ret = true;
					break;					
				}
			}	
			 
			if (!ret){
					
					alert("숫자만 입력가능합니다.");
					f.ga_sudong_num.focus();
					return false;
			} 
			ret = false;
		}


			var ext1 = f.ga_country_num.value;
			var ext2 = f.ga_sea_num.value;
			var ext3 = f.ga_sung_num.value;
			var ext4 = f.ga_khan_num.value;
			var ext5 = f.ga_sudong_num.value;

			jQuery.ajax({
			type:"GET",
			url:"./gamaeng_id_chk.php?ext1="+ext1+"&ext2="+ext2+"&ext3="+ext3+"&ext4="+ext4+"&ext5="+ext5,
			success:function(msg){
				
				if(msg > 0){
					f.jungbok.value = 'y';
				}else{
				}
			
			
			}, error: function(xhr,status,error){
				alert(error);
			}
			});
	}


	if(f.jungbok.value == 'y'){
		alert("이미 존재하는 번호입니다.");
		return;
	}



if(content=="")
	{
			alert("내용을 적어주세요!");
			ed.focus();
			return false;
	}	




	if (f.yakwan.checked == false){
		alert("약관에 동의 하셔야 등록이 가능합니다.")
		f.yakwan.focus();
		return;
	}
	if (!f.bunryu.value){
		alert("글의 분류를 선택하시기 바랍니다.")
		f.bunryu.focus();
		return;
	}	
	if (f.writer.value.length < 1){
		alert("성명을 입력하세요.")
		f.writer.focus();
		return;
	}
	if (f.subject_new.value.length < 1){
		alert("글의 제목을 기입하시기 바랍니다.")
		f.subject_new.focus();
		return;
	}

	if (f.end_date.value.length < 1){
		alert("게시기간을 기입하시기 바랍니다.")
		f.end_date.focus();
		return;
	}


	//f.editBox.editmode = "html";
	//f.content.value = f.editBox.html;

	f.submit();	
}
</script>
<script event="onscriptletevent(name, eventData)" for=editBox>
/*if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}*/
</script>
 
<?
if( $top_body ){
	//include "$top_body";
}
if( $headhtml ){
	echo "<br>$headhtml";
}
?>
<script src="../../editor/easyEditor.js"></script>
<style>
.fc_main { background: #DDDDDD; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { font-family: tahoma; border: 1px solid #D9D9D9;  cursor:pointer; font-size: 8pt; text-align: center;}
.fc_dateHover, TD.fc_date:hover { font-family: tahoma;cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 8pt; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 11px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 11px; text-align: center;}
.fc_wknd1 { color: blue; font-weight: bold; font-size: 11px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
.style1 {color: #003399;font-weight: bold;}
.style2 {color: #007eb9;font-weight: bold;}
</style>
<script language="javascript">
	var fc_ie = false;
	if (document.all) { fc_ie = true; }
	
	var calendars = Array();
	var fc_months = Array('1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월');
	var fc_openCal;

	var fc_calCount = 0;
	
	function getCalendar(fieldId) {
		return calendars[fieldId];
	}
	
	function displayCalendarFor(fieldId) {
		var formElement = fc_getObj(fieldId);
		displayCalendar(formElement);
	}
	
	function displayCalendar(formElement) {
		if (!formElement.id) {
			formElement.id = fc_calCount++;
		} 
		var cal = calendars[formElement.id];
		if (typeof(cal) == 'undefined') {
			cal = new floobleCalendar();
			cal.setElement(formElement);
			calendars[formElement.id] = cal;
		}
		if (cal.shown) {
			cal.hide();
		} else {
			cal.show();
		}
	}
	
	function display3FieldCalendar(me, de, ye) {
		if (!me.id) { me.id = fc_calCount++; }
		if (!de.id) { de.id = fc_calCount++; }
		if (!ye.id) { ye.id = fc_calCount++; }
		var id = me.id + '-' + de.id + '-' + ye.id;
		var cal = calendars[id];
		if (typeof(cal) == 'undefined') {
			cal = new floobleCalendar();
			cal.setElements(me, de, ye);
			calendars[id] = cal;
		}
		if (cal.shown) {
			cal.hide();
		} else {
			cal.show();
		}
	}

	//--Class Stuff--------------------------------------------------
	function floobleCalendar() {
		// Define Methods
		this.setElement = fc_setElement;
		this.setElements = fc_setElements;
		this.parseDate = fc_parseDate;
		this.generateHTML = fc_generateHTML;
		this.show = fc_show;
		this.hide = fc_hide;
		this.moveMonth = fc_moveMonth;
		this.setDate = fc_setDate;
		this.formatDate = fc_formatDate;
		this.setDateFields = fc_setDateFields;
		this.parseDateFields = fc_parseDateFields;
		
		this.shown = false;
	}
	
	function fc_setElement(formElement) {
		this.element = formElement;
		this.format = this.element.title;
		this.value = this.element.value;
		this.id = this.element.id;
		this.mode = 1;
	}
	
	function fc_setElements(monthElement, dayElement, yearElement) {
		this.mElement = monthElement;
		this.dElement = dayElement;
		this.yElement = yearElement;
		this.id = this.mElement.id + '-' + this.dElement.id + '-' + this.yElement.id;
		this.element = this.mElement;
		if (fc_absoluteOffsetLeft(this.dElement) < fc_absoluteOffsetLeft(this.element)) {
			this.element = this.dElement;
		}
		if (fc_absoluteOffsetLeft(this.yElement) < fc_absoluteOffsetLeft(this.element)) {
			this.element = this.yElement;
		}
		if (fc_absoluteOffsetTop(this.mElement) > fc_absoluteOffsetTop(this.element)) {
			this.element = this.mElement;
		}
		if (fc_absoluteOffsetTop(this.dElement) > fc_absoluteOffsetTop(this.element)) {
			this.element = this.dElement;
		}
		if (fc_absoluteOffsetTop(this.yElement) > fc_absoluteOffsetTop(this.element)) {
			this.element = this.yElement;
		}

		this.mode = 2;
	}
	
	function fc_parseDate() {
		if (this.element.value) {
			this.date = new Date();
			var out = '';
			var token = '';
			var lastCh, ch;
			var start = 0;
			lastCh = this.format.substring(0, 1);
			for (i = 0; i < this.format.length; i++) {
				ch = this.format.substring(i, i+1);
				if (ch == lastCh) { 
					token += ch;
				} else {
					fc_parseToken(this.date, token, this.element.value, start);
					start += token.length;
					token = ch;
				}
				lastCh = ch;
			}
			fc_parseToken(this.date, token, this.element.value, start);
		} else {
			this.date = new Date();
		}
		if ('' + this.date.getMonth() == 'NaN') {
			this.date = new Date();
		}
	}	
	
	function fc_parseDateFields() {
		this.date = new Date();
		if (this.mElement.value) this.date.setMonth(fc_getFieldValue(this.mElement) - 1);
		if (this.dElement.value) this.date.setDate(fc_getFieldValue(this.dElement));
		if (this.yElement.value) this.date.setFullYear(fc_getFieldValue(this.yElement));
		if ('' + this.date.getMonth() == 'NaN') {
			this.date = new Date();
		}
	}
	
	function fc_setDate(d, m, y) {
		this.date.setYear(y);
		this.date.setMonth(m);
		this.date.setDate(d);
		if (this.mode == 1) {
			this.element.value = this.formatDate();
		} else {
			this.setDateFields();
		}
		this.hide();
	}
	
	function fc_setDateFields() {
		fc_setFieldValue(this.mElement, fc_zeroPad(this.date.getMonth() + 1));
		fc_setFieldValue(this.dElement, fc_zeroPad(this.date.getDate()));
		fc_setFieldValue(this.yElement, this.date.getFullYear());
	}
	
	function fc_formatDate() {
		var out = '';
		var token = '';
		var lastCh, ch;
		lastCh = this.format.substring(0, 1);
		for (i = 0; i < this.format.length; i++) {
			ch = this.format.substring(i, i+1);
			if (ch == lastCh) { 
				token += ch;
			} else {
				out += fc_formatToken(this.date, token);
				token = ch;
			}
			lastCh = ch;
		}
		out += fc_formatToken(this.date, token);
		return out;
	}
	
	function fc_show() {
		if (typeof(fc_openCal) != 'undefined') { fc_openCal.hide(); }
	
		if (this.mode == 1) {
			this.parseDate();
		} else {
			this.parseDateFields();
		}
		this.showDate = new Date(this.date.getTime());
		if (typeof(this.div) != 'undefined') {
			this.div.innerHTML = this.generateHTML();
		}

		if (typeof(this.div) == 'undefined') {
			this.div = document.createElement('DIV');
			this.div.id="calendar";
			this.div.style.position = 'absolute';
			this.div.style.display = 'none';
			this.div.className = 'fc_main';
			this.div.innerHTML = this.generateHTML();
			this.div.style.left = fc_absoluteOffsetLeft(this.element);
			this.div.style.top = fc_absoluteOffsetTop(this.element) + this.element.offsetHeight + 1;
			document.body.appendChild(this.div);
		}
		this.div.style.display = 'block';
		this.shown = true;
		fc_openCal = this;
	}
	
	function fc_generateHTML() {
		var html = '<TABLE id=canlendar><TR><TD CLASS="fc_head" COLSPAN="6">CALENDAR :</TD><TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').hide();"><B>X</B></TD></TR>';
		html += '<TR><TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').moveMonth(-12);"><B><<</B></TD><TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').moveMonth(-1);"><B><</B></TD><TD COLSPAN="3" CLASS="fc_wk">' + fc_getYear(this.showDate) + '년 ' + fc_months[this.showDate.getMonth()] + ' </TD><TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').moveMonth(1);"><B>></B></TD><TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').moveMonth(12);"><B>>></B></TD></TR>';
		html += '<TR><TD WIDTH="14%" CLASS="fc_wk">월</TD><TD WIDTH="14%" CLASS="fc_wk">화</TD><TD WIDTH="14%" CLASS="fc_wk">수</TD><TD WIDTH="14%" CLASS="fc_wk">목</TD><TD WIDTH="14%" CLASS="fc_wk">금</TD><TD class="fc_wknd1" WIDTH="14%">토</TD><TD class="fc_wknd" WIDTH="14%">일</TD></TR>';
		html += '<TR>';
		var dow = 0;
		var i, style;
		var totald = fc_monthLength(this.showDate);
		for (i = 0; i < fc_firstDOW(this.showDate); i++) {
			dow++;
			html += '<TD> </TD>';
		}
		for (i = 1; i <= totald; i++) {
			if (dow == 0) { html += '<TR>'; }
			if (this.showDate.getMonth() == this.date.getMonth() && this.showDate.getYear() == this.date.getYear() && this.date.getDate() == i) { 
				style = ' style="font-weight: bold;"';
			} else {
				style = '';
			}
			html += '<TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').setDate(' + i + ', ' + this.showDate.getMonth() + ', ' + this.showDate.getFullYear() + ');" ' + style + '>' + i + '</TD>';
			dow++;
			if (dow == 7) {
				html += '</TR>';
				dow = 0;
			}
		}
		if (dow != 0) {
			for (i = dow; i < 7; i++) {
				html += '<TD> </TD>';
			}
		}
		html +='</TR>';
		html += '</TABLE>';
		return html;
	}
	
	function fc_hide() {
		
		if (this.div != false) {
			this.div.style.display = 'none';
		}
		this.shown = false;
		fc_openCal = undefined;
		//getContent();
	}
	function fc_hide2() {
		if (this.div != false) {
			this.div.style.display = 'none';
		}
		this.shown = false;
		fc_openCal = undefined;
		//getContent();
	}
	function fc_moveMonth(amount) {
		var m = this.showDate.getMonth();
		var y = fc_getYear(this.showDate);
		if (amount == 1)  {
			if (m == 11)  {
				this.showDate.setMonth(0);
				this.showDate.setYear(y + 1);
			} else {
				this.showDate.setMonth(m + 1);
			}
		} else if (amount == -1)  {
			if (m == 0)  {
				this.showDate.setMonth(11);
				this.showDate.setYear(y - 1);
			} else {
				this.showDate.setMonth(m - 1);
			}
		} else if (amount == 12) {
			this.showDate.setYear(y + 1);
		} else if (amount == -12) {
			this.showDate.setYear(y - 1);
		}
		this.div.innerHTML = this.generateHTML();
	}
	
	//--Utils-------------------------------------------------------------
	function fc_absoluteOffsetTop(obj) {
     	var top = obj.offsetTop;
     	var parent = obj.offsetParent;
     	while (parent != document.body) {
     		top += parent.offsetTop;
     		parent = parent.offsetParent;
     	}
     	return top;
     }
     
     function fc_absoluteOffsetLeft(obj) {
     	var left = obj.offsetLeft;
     	var parent = obj.offsetParent;
     	while (parent != document.body) {
     		left += parent.offsetLeft;
     		parent = parent.offsetParent;
     	}
     	return left;
     }
     
     function fc_firstDOW(date) {
     	var dow = date.getDay();
     	var day = date.getDate();
 		if (day % 7 == 0) return dow;
     	return (7 + dow - (day % 7)) % 7; 
     }
     
     function fc_getYear(date) {
     	var y = date.getYear();
     	if (y > 1900) return y;
     	return 1900 + y;
     }
     
     function fc_monthLength(date) {
		var month = date.getMonth();
		var totald = 30;
		if (month == 0 
			|| month == 2
			|| month == 4
			|| month == 6
			|| month == 7
			|| month == 9
			|| month == 11) totald = 31;
		if (month == 1) {
			var year = date.getYear();
			if (year % 4 == 0 && (year % 400 == 0 || year % 100 != 0))
		 		totald = 29;
			else
				totald = 28;
		}
		return totald;
     }
     
     function fc_formatToken(date, token) {
		var command = token.substring(0, 1);
		if (command == 'y' || command == 'Y') {
			if (token.length == 2) { return fc_zeroPad(date.getFullYear() % 100); }
			if (token.length == 4) { return date.getFullYear(); } 
		}
		if (command == 'd' || command == 'D') {
			if (token.length == 2) { return fc_zeroPad(date.getDate()); }
		}
		if (command == 'm' || command == 'M') {
			if (token.length == 2) { return fc_zeroPad(date.getMonth() + 1); }
			if (token.length == 3) { return fc_months[date.getMonth()]; } 
		}
		return token;
     }
     
     function fc_parseToken(date, token, value, start) {
		var command = token.substring(0, 1);
		var v;
		if (command == 'y' || command == 'Y') {
			if (token.length == 2) { 
				v = value.substring(start, start + 2);
				if (v < 70) { date.setFullYear(2000 + parseInt(v)); } else { date.setFullYear(1900 + parseInt(v)); } 
			}
			if (token.length == 4) { v = value.substring(start, start + 4); date.setFullYear(v);} 
		}
		if (command == 'd' || command == 'D') {
			if (token.length == 2) { v = value.substring(start, start + 2); date.setDate(v); }
		}
		if (command == 'm' || command == 'M') {
			if (token.length == 2) { v = value.substring(start, start + 2); date.setMonth(v - 1); }
			if (token.length == 3) { 
				v = value.substring(start, start + 3);
				var i;
				for (i = 0; i < fc_months.length; i++) {
					if (fc_months[i].toUpperCase() == v.toUpperCase()) { date.setMonth(i); }
				}
			} 
		}
     }
     
     function fc_zeroPad(num) {
		if (num < 10) { return '0' + num; }
		return num;
     }

	function fc_getObj(id) {
		if (fc_ie) { return document.all[id]; } 
		else { return document.getElementById(id);	}
	}

      function fc_setFieldValue(field, value) {
                if (field.type.substring(0,6) == 'select') {
                        var i;
                        for (i = 0; i < field.options.length; i++) {
                                if (fc_equals(field.options[i].value, value)) {
                                        field.selectedIndex = i;
                                }
                        }
                } else {
                        field.value = value;
                }
      }

      function fc_getFieldValue(field) {
                if (field.type.substring(0,6) == 'select') {
                        return field.options[field.selectedIndex].value;
                } else {
                        return field.value;
                }
      }
      
      function fc_equals(val1, val2) {
      		if (val1 == val2) return true;      		
      		if (1 * val1 == 1 * val2) return true;
      		return false;
      }

	
	

</script>
<script type="text/javascript">
<!--
	function gigan_change(gv){
		var arrString = gv.split("|"); 
		var gigan_10=arrString[0];
		var gigan_20=arrString[1];
		var gigan_30=arrString[2];
		var cate_num=arrString[3];

		document.getElementById("gigan_money10").value = gigan_10;
		document.getElementById("gigan_money20").value = gigan_20;
		document.getElementById("gigan_money30").value = gigan_30;

		<?
		$sql = "select * from jungbo_cate_bunya order by binary(category_name)";
		$res = mysql_query($sql,$dbconn);
		for($z=0;$row = mysql_fetch_array($res);$z++){
		?>
			document.getElementById(<?=$row[category_num]?>).style.display = "none";
		<?
			}
		?>
		document.getElementById(cate_num).style.display = "";
	}

	function bubun_input(value){
		document.getElementById("bubun").value = value;
	}
 

	function addDay(ymd, v_day){
	 var yyyy = ymd.substr(0,4);
	 var mm = eval(ymd.substr(4,2) + "- 1") ;
	 var dd = ymd.substr(6,2);
	 var dt3 = new Date(yyyy, mm, eval(dd + '+' + v_day));
	 yyyy = dt3.getFullYear();
	
	 mm = (dt3.getMonth()+1)<10? "0" + (dt3.getMonth()+1) : (dt3.getMonth()+1) ;
	 dd = dt3.getDate()<10 ? "0" + dt3.getDate() : dt3.getDate();

	 document.getElementById("end_date").value = yyyy+"-"+mm+"-"+dd;

	}


//-->
</script>
<script src="jquery-1.7.min.js"></script>

<!---------------------- 게시판 시작 ---------------------------------------------------->
					<form method="POST" name='writeform' enctype="multipart/form-data" onsubmit='board_checkform(); return false'> 
					<input type="hidden" name="flag" value="write">
					<input type="hidden" name="mart_id" value="<?=$mart_id?>">
					<input type="hidden" name="bbs_no" value="<?=$bbs_no?>">
					<input type="hidden" name="item_no" value="<?=$item_no?>">
					<input type="hidden" name="return" value="<?=$return?>">


					<input type="hidden" name="firstno" value="<?=$firstno?>">
					<input type="hidden" name="prevno" value="<?=$prevno?>">
					<input type="hidden" name="thirdno" value="<?=$thirdno?>">
					<input type="hidden" name="category_num" value="<?=$category_num?>">


					<input type="hidden" name="country_num" value="<?=$country_num?>">
					<input type="hidden" name="sea_num" value="<?=$sea_num?>">
					<input type="hidden" name="sung_num" value="<?=$sung_num?>">
					<input type="hidden" name="khan_num" value="<?=$khan_num?>">

					<input type="hidden" name="jungbok" value="">



					<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td width="100%" align=center><textarea name="textarea" cols=120 rows=10>“칸” 가맹점 약관

제1조 [“칸” 가맹점의 체결]
가맹점이란 이 약관을 승인하고 회사(www.wickhan.com 정보제공서비스 “회사”라 함.)에 가맹점 가입을 신청하여 승낙 받은 업소를 말한다.

제2조 [가맹점의 체결조건]
가맹점은 회사의 정보를 제공받는 “칸”회원이 신분(전자, 통신)을 제시하고 이용 시 약관에 따라 이용하도록 하여야 합니다.
   1) 가맹점은 일반판매 가격은 정해진(몇)%로의 할인된 가격에 “칸”회원이 이용할 수 있도록 합니다.
   2) 가맹점은 물품 및 위생상에 항상 청결히 하여야 합니다.
   3) 가맹점은 타 동등업계에 비교 서비스 수준 이상이어야 합니다.

제3조 [가맹점의 준수사항]
   1) 가맹점은 “칸”회원이 아닌 자와 동등한 가격에 가맹점을 이용 하도록 하여서는 안 됩니다.
   2) 가맹점은 물품 및 위생상에 항상 청결히 하지 않으면 안 됩니다.
   3) 가맹점은 타 동등업체에 비교 서비스 수준 이하면 안 됩니다.

제4조 [가맹점 체결해지]
회사는 위 3조 1항, 2항, 3항에 위배 시 가맹점 체결을 해지할 수 있습니다.

제5조 [약관의 변경]
약관의 변경은 회사운영의 상황에 따라 약관을 변경 할 수 있습니다.

							</textarea></td>
						</tr>
						<tr>
							<td width="100%" height="40" align=center>
							
						  <input type=checkbox name="yakwan" value="y"> 위의 약관에 동의합니다.						  </td>
						</tr>					
					</table>


<?
	

?>








                        <div class="form"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="box2">






			<tr>
			  <td align=center width=15%  class="title">지역</td> 
			  <td width=85% bgcolor="#FFFFFF" colspan=3>
<!--

							<select name="sea_area" onchange="javascript:location.href='<?=$PHP_SELF?>?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&item_no=<?=$item_no?>&return=<?=$return?>&firstno=<?=$firstno?>&prevno=<?=$prevno?>&thirdno=<?=$thirdno?>&category_num=<?=$category_num?>&sea_num=<?=$sea_num?>&sung_num=<?=$sung_num?>&khan_num=<?=$khan_num?>&sea_area='+this.value">
								<option value=''>=선택=</option>
								<?
								$sql = "select distinct(sea_area) from category where category_degree='0' order by category_num ";
								$res = mysql_query($sql,$dbconn);
								for($i=0;$row=mysql_fetch_array($res);$i++){
									if($row[sea_area] == $sea_area){
										$sea_selected="selected";
									}
								?>
									<option value="<?=$row[sea_area]?>" <?=$sea_selected?>><?=$row[sea_area]?></option>
								<?
									$sea_selected="";
								}
								?>
								</option>
							</select>

							<select name="sung_area" onchange="javascript:location.href='<?=$PHP_SELF?>?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>&item_no=<?=$item_no?>&return=<?=$return?>&firstno=<?=$firstno?>&prevno=<?=$prevno?>&thirdno=<?=$thirdno?>&category_num=<?=$category_num?>&sea_num=<?=$sea_num?>&sung_num=<?=$sung_num?>&khan_num=<?=$khan_num?>&sea_area=<?=$sea_area?>&sung_area='+this.value">
								<option value=''>=선택=</option>
								<?
								$sql = "select distinct(sung_area) from category where category_degree='1' and sea_area='$sea_area' order by category_num ";
								$res = mysql_query($sql,$dbconn);
								for($i=0;$row=mysql_fetch_array($res);$i++){
									if($row[sung_area] == $sung_area){
										$sung_selected="selected";
									}
								?>
									<option value="<?=$row[sung_area]?>" <?=$sung_selected?>><?=$row[sung_area]?></option>
								<?
									$sung_selected="";
								}
								?>
								</option>
							</select>

							<select name="khan_area">
								<option value=''>=선택=</option>
								<?
								$sql = "select distinct(khan_area),khan_area from category where category_degree='2' and sea_area='$sea_area' and sung_area='$sung_area' order by category_num ";
								$res = mysql_query($sql,$dbconn);
								for($i=0;$row=mysql_fetch_array($res);$i++){
									if($row[khan_area] == $khan_area){
										$khan_selected="selected";
									}
								?>
									<option value="<?=$row[khan_area]?>" <?=$khan_selected?>><?=$row[khan_area]?></option>
								<?
									$khan_selected="";
								}
								?>
								</option>
							</select>
-->

<b><?=$sea_area?>  <?=$sung_area?>  <?=$khan_area?></b>

<input type=hidden name="sea_area" value="<?=$sea_area?>">
<input type=hidden name="sung_area" value="<?=$sung_area?>">
<input type=hidden name="khan_area" value="<?=$khan_area?>">


	</td>
	</tr>


    <tr>
      <td align=center width=15% class="title">분야</td> 
      <td width=35% bgcolor="#FFFFFF">
		<?
		$big_value = 5;
		?>
		<select name=bunryu onchange="location.href='<?=$PHP_SELF?>?bbs_no=<?=$bbs_no?>&big_value=<?=$big_value?>&bunryu='+this.options[this.selectedIndex].value">
			<option value="">==분야선택==</option>	
		<?
		$sql = "select * from gameng_cate_bunya where parent_num='$big_value' and parent_num2 is null";
		$result = mysql_query( $sql,$dbconn ) or err_msg("분야 쿼리오류.");
		for($i=0; $rows = mysql_fetch_array($result); $i++){
			if($rows[seq_num] == $bunryu){
				$bunryu_selected = "selected";
			}
		?>
			<option value="<?=$rows[seq_num]?>" <?=$bunryu_selected?>><?=$rows[category_name]?></option>			

		<?
			$bunryu_selected="";
		}
		?>
		</select>				

								</select>
	  </td>
      <td align=center width=15% class="title">부분</td>
      <td width=35% bgcolor="#FFFFFF">
<select name=bubun onchange="location.href='<?=$PHP_SELF?>?bbs_no=<?=$bbs_no?>&big_value=<?=$big_value?>&bunryu=<?=$bunryu?>&bubun='+this.options[this.selectedIndex].value">
		 <option value="">==부분선택==</option>	
			<?
			if($bunryu){
				$sql = "select * from gameng_cate_bunya where parent_num2='$bunryu'";
				$result = mysql_query( $sql,$dbconn ) or err_msg("부분 쿼리오류.");
				for($i=0; $rows = mysql_fetch_array($result); $i++){
					if($rows[seq_num] == $bubun){
						$bubun_selected = "selected";
					}
				?>
					<option value="<?=$rows[seq_num]?>" <?=$bubun_selected?>><?=$rows[category_name]?></option>
				<?
					$bubun_selected="";
				}
			}else{
			?>
			<option value="">==부분선택==</option>	
			<?
			}
			?>
		</select>	  	  </td>
    </tr>


	<?
	$sql = "select * from gameng_cate_bunya where seq_num='$bubun'";
	$result = mysql_query( $sql,$dbconn ) or err_msg("부분 쿼리오류.");
	$rows = mysql_fetch_array($result);
	?>
	<tr>
      <td align=center width=15% class="title">기간선택</td> 
      <td bgcolor="#FFFFFF">
			<input type=radio name="gigan_day" value="10" onclick="addDay('<?=date("Ymd")?>','10');">10일:<input type=text name="gigan_money10" id="gigan_money10" value="<?=$rows[gigan_money10]?>" size=7 readonly>원<br>
			<input type=radio name="gigan_day" value="20" onclick="addDay('<?=date("Ymd")?>','20');">20일:<input type=text name="gigan_money20" id="gigan_money20" value="<?=$rows[gigan_money20]?>" size=7 readonly>원<br>
			<input type=radio name="gigan_day" value="30" onclick="addDay('<?=date("Ymd")?>','40');">30일:<input type=text name="gigan_money30" id="gigan_money30" value="<?=$rows[gigan_money30]?>" size=7 readonly>원

	  </td>
      <td align=center width=15% class="title">게시기간</td>
      <td bgcolor="#FFFFFF">
		<?=date("Y-m-d");?> ~ <input name='end_date' type=text size=15 class=b_input id="end_date"  value='<?=$end_date?>' readonly required='required' itemname='등록일'>	  
	  </td>
    </tr>


    <tr>
      <td align=center width=15% class="title">상호명</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3>
			<input type="text" class="input_03" size="30" name="subject_new" value='<?=$subjejct_new?>' style='ime-mode:active'>
	  </td>
    </tr>










    <tr>
      <td align=center width=15% class="title">할인율</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3 class="flex">
			<input type="text" class="input_03" size="4" name="halin" value='<?=$halin?>' style='ime-mode:active'>%
	  </td>
    </tr>



	<tr>
      <td align=center width=15% class="title">작성자</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3><input type="text" class="input_03" size="20" name="writer" value='<?=$item_name?>' style='ime-mode:active'></td>
    </tr>

	<tr>
      <td align=center width=15% class="title">전화번호</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3 class="flex">
								  <select name="tel1" class=input_03>
                                    <option value=''>선택</option>
                                    <option value='02'>02</option>
                                    <option value='031'>031</option>
                                    <option value='032'>032</option>
                                    <option value='033'>033</option>
                                    <option value='041'>041</option>
                                    <option value='042'>042</option>
                                    <option value='043'>043</option>
                                    <option value='051'>051</option>
                                    <option value='052'>052</option>
                                    <option value='053'>053</option>
                                    <option value='054'>054</option>
                                    <option value='055'>055</option>
                                    <option value='061'>061</option>
                                    <option value='062'>062</option>
                                    <option value='063'>063</option>
                                    <option value='064'>064</option>
                                    <option value='0502'>0502</option>
                                    <option value='0503'>0503</option>
                                    <option value='0504'>0504</option>
                                    <option value='0505'>0505</option>
                                    <option value='0506'>0506</option>
                                    <option value='0507'>0507</option>
                                    <option value='070'>070</option>
									<option value='010'>010</option>
									<option value='011'>011</option>
									<option value='016'>016</option>
									<option value='017'>017</option>
									<option value='018'>018</option>
									<option value='019'>019</option>
                                 </select>
                                   -
                                    <input type=text class=input_03 name='tel2' size=5 maxlength=4 value=''>
                                   -
                                    <input type=text class=input_03 name='tel3' size=5 maxlength=4 value=''>
	  </td>
    </tr>
	<tr>
      <td align=center width=15% class="title">주소</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3><input type="text" class="input_03" size="80" name="address" value='<?=$address?>' style='ime-mode:active'></td>
    </tr>
<?
if( $userfile_use == "y" ){//첨부파일 사용
?>
	<tr>
      <td align=center width=15% class="title">첨부파일1</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3><input type='file' name='userfile'  size="50" class="input_03"></td>
    </tr>
	<tr>
      <td align=center width=15% class="title">첨부파일2</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3><input type='file' name='userfile1' size="50" class="input_03"></td>
    </tr>

<?
}	
?>
<tr>
      <td align=center width=15% class="title">가맹점 회원등록</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3>
						<input class="aa" type="text" name="ga_country_num" value='<?=$country_num?>' size="5" maxlength=3 >
						<input class="aa" type="text" name="ga_sea_num" value='<?=$sea_num?>' size="5" maxlength=3 >
						<input class="aa" type="text" name="ga_sung_num" value='<?=$sung_num?>' size="3" maxlength=2 >
						<input class="aa" type="text" name="ga_khan_num" value='<?=$khan_num?>' size="3" maxlength=2 >
						<input class="aa" type="text" name="ga_sudong_num" value='' size="5" maxlength=4 >
	  </td>
    </tr>
	
	<tr>
      <td align=center width=15% class="title">내용</td> 
      <td width=85% bgcolor="#FFFFFF" colspan=3>
		<textarea name="content" id="content" style="width:100%;height:290px"><?=$content?></textarea>
		<script>
		var ed = new easyEditor("content"); //초기화 id속성값
		ed.init(); //웹에디터 삽입
		</script>	
	  </td>
    </tr>





</table></div>








					
					<table width="60%" align="center" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td height="50" align="center">
<?if($_SESSION["Mall_Admin_ID"]){?>
							<input type='image' onfocus='blur();' src="../image/helpdesk/bu_writeok.gif" border="0">
							&nbsp;&nbsp;&nbsp;<a href="board_list.php?mart_id=<?=$mart_id?>&bbs_no=<?=$bbs_no?>"><img src="../image/helpdesk/bu_cancel.gif" border="0"></a>
<?}else{?>
							<input type='button' onclick="javascript:alert('칸에 등록 후 이용가능합니다.');" src="../image/helpdesk/bu_writeok.gif" border="0">

<?}?></td>

						</tr>
					</table>

					</form>
<!---------------------- 게시판 끝 ------------------------------------------------------>

<?
if( $bottom_body ){
	//include "$bottom_body";
}
if( $tailhtml ){
	echo "<br>$tailhtml";
}
?>
</body>
</html>

<?
	if($board_class == 1){
	}
}
elseif ($flag == "write") {

#######################금지단어팅구기################################	


	//가맹점등록시 차감

	if($gigan_day==10){
		$bonus = $gigan_money10;
	}
	elseif($gigan_day==20){
		$bonus = $gigan_money20;
	}
	elseif($gigan_day==30){
		$bonus = $gigan_money30;
	}
	
	$write_date = date("YmdHis");
	$content = "가맹점등록";
	$mode = "gi";
	$id= $sea_num.$sung_num.$khan_num.$sudong_num;


	$SQL1 = "insert into $BonusTable (mart_id, provider_id, id, write_date, bonus, content, mode) values ('$mart_id', '', '$id', '$write_date', '-$bonus', '$content', '$mode')";
	
	$dbresult1 = mysql_query($SQL1, $dbconn);



	$SQL2 = "update item set gamaeng='1' where country_num='$country_num' and sea_num='$ga_sea_num' and sung_num='$ga_sung_num' and khan_num='$ga_khan_num' and sudong_num='$ga_sudong_num'";
	$dbresult2 = mysql_query($SQL2, $dbconn);




	//=================== LOCK을 건다 ========================================================
	$query1 = " LOCK TABLES $New_BoardTable WRITE" ;
	mysql_query( $query1, $dbconn );

	//=================== 쓰레드 찾기 ========================================================
	$query2 = "select MAX(thread) from $New_BoardTable where mart_id = '$mart_id' and bbs_no='$bbs_no'";
	$result2 = mysql_query( $query2, $dbconn );
	$row2 = mysql_fetch_array( $result2 );
	$thread = $row2[0] + 1;

	//=================== 포지션 찾기 ========================================================
	$query3 = "select MIN(ansno) from $New_BoardTable where mart_id = '$mart_id' and bbs_no='$bbs_no'" ;
	$result3 = mysql_query( $query3, $dbconn );
	$row3 = mysql_fetch_array( $result3 );
	$ansno = $row3[0] + 1;

	//=================== 질문이후의 글들의 AnsNo 를 1씩 증가시킴 ========================
	$query4 = "update $New_BoardTable set ansno = ansno + 1 where (ansno > 0) and mart_id = '$mart_id' and bbs_no='$bbs_no'";
	mysql_query( $query4, $dbconn );

	//============= 최고 index_no 값을 찾아서 1을 더해주고 이 uid 값을 insert 시켜줌 =========
	$query6 = "select MAX(index_no) from $New_BoardTable where mart_id = '$mart_id'";
	$result6 = mysql_query( $query6, $dbconn );
	$row6 = mysql_fetch_array( $result6 );
	$index_no = $row6[0] + 1;
	
	$subject_new = str_replace( "\n", "<br>", $subject_new );
	$content = str_replace( "\n", "<br>", $content );

	//한글자르기
	$subject_new = substr($subject_new, 0, 200);
	preg_match('/^([\x00-\x7e]|.{2})*/', $subject_new, $subject_new_tmp);

	$write_date = date("Ymd H:i:s");

	//================== 업로드 함수 불러옴 ==================================================
	include "../upload.php";
	$upload_dir = "$UploadRoot$mart_id/";
	// 워터마크 서버경로
	$watermark_path = $upload_dir."__watermark.png";		
	//================== 첨부 파일을 업로드함 ================================================
	if( $userfile_name ){
		$file = FileUploadName( "", "$upload_dir", $userfile, $userfile_name );
		//echo "$upload_dir". $userfile_name;

		// 워터마킹
		$arr_result = waterMarkImage("$upload_dir".$file, $watermark_path, 50, 100);
		/*if(!$arr_result["bool"])
		{
			echo $arr_result["error"];
			exit;
		}*/		
	}
	if( $userfile1_name ){
		$file1 = FileUploadName( "", "$upload_dir", $userfile1, $userfile1_name );

		// 워터마킹
		$arr_result = waterMarkImage("$upload_dir".$file1, $watermark_path, 50, 100);
	}
	if($notice_no == "y"){
		
		$que = "select max(notice_no) from $New_BoardTable where bbs_no='$bbs_no'";
		$result = mysql_query($que, $dbconn);
		$max_notice = mysql_result($result,0,0);

		if($max_notice == 0){
			$max_notice = "100000";
		}else{
			$max_notice = $max_notice + 1;
		}

	}
	if(!$max_notice){
		$max_notice = "0";
	}	



	//$bunryu_ex = explode("|",$bunryu);
	//$bunryu = $bunryu_ex[0];
	//$end_date = date("Y-m-d",strtotime("+$bunryu_ex[1] day"));

	$tel = $tel1."-".$tel2."-".$tel3;



$ga_sudong_num = str_pad( $ga_sudong_num, 4, "0", STR_PAD_LEFT );



	$SQL = "insert into $New_BoardTable (index_no, firstno, prevno, thirdno, category_num, bbs_no, notice_no, mart_id, code, username, writer, passwd, write_date, ansno, step, thread, email, subject_new, content, userfile, userfile1, if_secret, writer_ip, area, address,tel,hobby, open_address,open_tel,open_hobby,open_email,my_bank_name,my_bank_account,my_bank_master,open_bank,end_date,open_auth,del_chk,bunryu,bubun,halin,sea_area,sung_area,khan_area,ga_country_num,ga_sea_num,ga_sung_num,ga_khan_num,ga_sudong_num) values ('$index_no', '$firstno', '$prevno', '$thirdno', '$category_num', '$bbs_no', '$max_notice', '$mart_id', '$code', '$_SESSION[Mall_Admin_ID]', '$writer', '$passwd', '$write_date', '1', '0', '$thread', '$email', '$subject_new_tmp[0]', '$content', '$file', '$file1', '$if_secret', '$REMOTE_ADDR', '$item_no', '$address','$tel','$hobby','$open_address','$open_tel','$open_hobby','$open_email','$my_bank_name','$my_bank_account','$my_bank_master','$open_bank','$end_date','y','n','$bunryu','$bubun','$halin','$sea_area','$sung_area','$khan_area','$ga_country_num','$ga_sea_num','$ga_sung_num','$ga_khan_num','$ga_sudong_num')";

	$dbresult = mysql_query($SQL, $dbconn);






	if( !$dbresult ){
		echo "
			<script>
				window.alert('글 작성에 실패했습니다');
				history.go(-1);
			</script>
		";
		exit;
	}
	//=================== LOCK을 푼다 ========================================================
	$query5 =" UNLOCK TABLES " ;
	mysql_query( $query5, $dbconn );

	if( $return == "product" ){
		echo "
			<script>
				window.alert('글을 작성했습니다');
				window.close();
				window.opener.location.reload();
			</script>
		";
		exit;
	}else{
		echo "<meta http-equiv='refresh' content='0; URL=board_list.php?mart_id=$mart_id&bbs_no=$bbs_no'>";
	}
}
?>
<?
mysql_close($dbconn);
?>