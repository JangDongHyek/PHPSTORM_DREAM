// ��� �κ� ��Ŀ���϶� �ؽ�Ʈ ����
function focusTextRemove(obj){
	var str = '';
	var name = jQuery(obj).attr("name");
	var val = jQuery(obj).val();
	
	if(name == "name") {
		str = "�̸�";
		if (str == val) {
			jQuery(obj).val("");
			return; 
		}else{
			return;
		}
	}else if(name == "password_temp") {
		str = "��й�ȣ";
		if (str == val) {
			jQuery(obj).css("display","none");
			jQuery(obj).parent().find("#password").remove();
			jQuery(obj).parent().append("<input type='password' name='password' id='password' class='focus_zone' title='��й�ȣ�� �Է����ּ���'>");
			jQuery("#password").bind("blur",function(){
				blurTextInsert(this);
			});
			jQuery("#password").focus();
			return; 
		}else{
			return;
		}
	}
}

// ��� �κ� ��Ŀ���Ҿ����� �ؽ�Ʈ ����
function blurTextInsert(obj){
	
	var str = '';
	var name = jQuery(obj).attr("name");
	if (jQuery(obj).val() == "") {
		if (name == "name") {
			str = "�̸�";
		}else if (name == "password") {
			jQuery(obj).remove();
			jQuery(obj).val("");
			jQuery("#password_temp").css("display","block");
		}
	}else{
		
		str = jQuery(obj).val();
		
	}
	jQuery(obj).val(str);
}

// ��� �κ� ��Ŀ���϶� �ؽ�Ʈ ����
function focusAltRemove(obj){
	var str = '';
	var name = jQuery(obj).attr("name");
	var val = jQuery(obj).val();
	
	if(name == "image_alt") {
		str = "�̹����Դϴ�.";
		if (str == val) {
			jQuery(obj).val("");
			return; 
		}else{
			return;
		}
	}else if(name.indexOf("beforeimage") >= 0) {
		str = "ġ�� �� �����Դϴ�.";
		if (str == val) {
			jQuery(obj).val("");
			return; 
		}else{
			return;
		}
	}else if(name.indexOf("afterimage") >= 0) {
		str = "ġ�� �� �����Դϴ�.";
		if (str == val) {
			jQuery(obj).val("");
			return; 
		}else{
			return;
		}
	}
}

// �̹��� alt �κ� ��Ŀ���Ҿ����� �ؽ�Ʈ ����
function blurAltInsert(obj){
	
	var str = '';
	var name = jQuery(obj).attr("name");
	if (jQuery(obj).val() == "") {
		if (name == "image_alt") {
			str = "�̹����Դϴ�.";
		}else if (name.indexOf("beforeimage") >= 0) {
			str = "ġ�� �� �����Դϴ�.";
		}else if (name.indexOf("afterimage") >= 0) {
			str = "ġ�� �� �����Դϴ�.";
		}
	}else{
		
		str = jQuery(obj).val();
		
	}
	jQuery(obj).val(str);
}

// FAQ �з��� Ŭ���� �����Ű��
jQuery(function(){
	jQuery(".faq_open").click(function(){
		if(jQuery(this).children("dd").css("display")=="none") {
			jQuery(this).children("dd").css("display","block");
		}else if(jQuery(this).children("dd").css("display")=="block") {
			jQuery(this).children("dd").css("display","none");
		}
		
	});
});

// ������� selectbox ��������
function clinicSelectbox(hospital_fk,clinic_fk,type) {
	jQuery("#clinic_fk").load("clinicList.jsp?hospital_fk="+hospital_fk+"&clinic_fk="+clinic_fk+"&type="+type);
}

// �Ƿ��� selectbox ��������
function doctorSelectbox(hospital_fk,clinic_fk,doctor_fk,type) {
	jQuery("#doctor_fk").load("doctorList.jsp?hospital_fk="+hospital_fk+"&clinic_fk="+clinic_fk+"&doctor_fk="+doctor_fk+"&type="+type);
}

// �Ƿ��� ���� ��������
function doctorPhoto(hospital_fk,clinic_fk) {
	jQuery("#doctorPhoto").load("doctorPhoto.jsp?hospital_fk="+hospital_fk+"&clinic_fk="+clinic_fk);
}

// ����޷� ��������
function calendarList(shospital_fk, smonth) {
	jQuery("#resertime_zone").load("calendarList.jsp?shospital_fk="+shospital_fk+"&smonth="+smonth);
}

// ����ð� ��������
function reserTimeList(hospital_fk,doctor_fk,reserdate,resertime,times) {
	jQuery("#reserTime_zone").load("timeList.jsp?hospital_fk="+hospital_fk+"&doctor_fk="+doctor_fk+"&reserdate="+reserdate+"&resertime="+resertime+"&times="+times);
}

// ��ȭ ��� �ð� ��������
function curTime(selectDay, type){
	type = type.length > 2 ? type.substr(0,2) : 0;
	jQuery("#curTimeList").load("curTimeList.jsp?selectDay="+selectDay+"&type="+type);
}

// ��й�ȣ ��ȿ��üũ
function validPassword(password) {
	var jQuerypass = password.val();
	var jQuerystr = /^[a-zA-Z0-9@]{6,12}$/;
	var jQuerystr2 = /(\w)\1\1\1/;
	var jQuerychk_num = jQuerypass.search(/[0-9]/g);
	var jQuerychk_eng = jQuerypass.search(/[a-z]/ig);
	var check = false;
	if (jQuerypass == "") {
		alert("��й�ȣ�� �Է��� �ּ���.");
		password.focus();
	}else if(!jQuerystr.test(jQuerypass) || jQuerypass.indexOf(' ') > -1){
		alert("��й�ȣ�� ����+���� 6~12�ڸ��� �Է��� �ּ���.");
		password.focus();
	}else if(jQuerystr2.test(jQuerypass)){
		alert("��й�ȣ�� �ݺ��Ǵ� ���� �� ���ڰ� �ֽ��ϴ�.");
		password.focus();
	}else if(jQuerychk_num < 0 || jQuerychk_eng < 0) {
		alert("��й�ȣ�� ���ڿ� �����ڸ� ȥ���Ͽ��� �մϴ�.");
		password.focus();
	}else{
		check = true;
	}
	return check;
}

// ��й�ȣ ��ȿ��üũ(��й�ȣȮ��)
function validConfirmPassword(password, confirmPassword) {
	var jQuerypass = password.val();
	var jQueryconfirm = confirmPassword.val();
	var jQuerystr = /^[a-zA-Z0-9@]{6,12}$/;
	var jQuerystr2 = /(\w)\1\1\1/;
	var jQuerychk_num = jQuerypass.search(/[0-9]/g);
	var jQuerychk_eng = jQuerypass.search(/[a-z]/ig);
	var check = false;
	if (jQuerypass == "") {
		alert("��й�ȣ�� �Է��� �ּ���.");
		password.focus();
	}else if (jQuerypass != jQueryconfirm) {
		alert("�Է��� ��й�ȣ�� ���� �ٸ��ϴ�.");
		confirmPassword.focus();
	}else if(!jQuerystr.test(jQuerypass) || jQuerypass.indexOf(' ') > -1){
		alert("��й�ȣ�� ����+���� 6~12�ڸ��� �Է��� �ּ���.");
		password.focus();
	}else if(jQuerystr2.test(jQuerypass)){
		alert("��й�ȣ�� �ݺ��Ǵ� ���� �� ���ڰ� �ֽ��ϴ�.");
		password.focus();
	}else if(jQuerychk_num < 0 || jQuerychk_eng < 0) {
		alert("��й�ȣ�� ���ڿ� �����ڸ� ȥ���Ͽ��� �մϴ�.");
		password.focus();
	}else{
		check = true;
	}
	return check;
}

// ����Ű �̺�Ʈ
function entKeyEventListener(keycode, formID){
	if(keycode == 13){
		jQuery("#"+formID).submit();
	}
}