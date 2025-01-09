var double_click = true;
$(document).ready(function(){
	var cur_url = location.href;
	//hide�� 1�̰� ��Ű�� ������ ����������������  �˾�â �����ֱ�
	if(display == 1 && getCookie("incore_popup") != "off" && cur_url == ajax_url + "/"){ 
		document.querySelector('#popup').style.display = "block";
	}
});

function open_modal(){
	document.querySelector('#popup_modal').style.display = "block";
}

function close_modal(){
	document.querySelector('#popup_modal').style.display = "none";
}

function close_popup(){
	var check = document.querySelector('#today_close');
	if(check.checked == true){ //���� �Ϸ� ���� �ʱ⸦ Ŭ���ϰ� close btn�� �������� �˾� ��Ű ����
		var d = new Date();
		d.setTime(d.getTime() + (1 * 24 * 60 * 60 * 1000));
		var expires = "expires=" + d.toUTCString();
		document.cookie = "incore_popup=off;" + expires + '; Path=/;';
		console.log(document.cookie);
	}
	document.querySelector('#popup').style.display = "none";
}

function show_popup(elem){
	var check_value = "";
	if(elem.checked == true){
		check_value = 1;
	}else{
		check_value = 0;
	}
	var check = { "check" : check_value };
	$.ajax({
		url : ajax_url + "/theme/incore/popup_show_process.php",
		type : "post",
		data : check,
	}).done(function(data){
		
	});
}

function register_popup(){
	$('form[name=register_form]').submit();
	//if(double_click){
	//	double_click = false;
	//	var file_view = document.querySelector('image_view');
	//	var link = document.querySelector('#link');
	//	if(file_view.value == ""){
	//		alert("�̹����� ������ּ���.");
	//		double_click = true;
	//	}else if(link.value == ""){
	//		alert("��ũ�� �Է����ּ���.");
	//		double_click = true;
	//	}else{
	//		$('form[name=register_form]').submit();
	//	}
	//}
}

//���� ÷�ν� Input�� File �̸��� �����ִ� �Լ�
function file_view(elem){
    var file_view = elem.parentNode.querySelector('.file_view'); //���� �̸��� �����ִ� Input
    elem.parentNode.querySelector('.hidden_file').value = "";
    file_view.value = "";
    
    var file_name = elem.value.split('\\').pop(); // ���������� ���� �迭�� ���������� ���� �̸�
    //���� �뷮 üũ
    if(elem.files[0] != null){
        var max_size = 5 * 1024 * 1024; //5MB
        var file_size = elem.files[0].size;
        if(file_size > max_size){
            alert("5MB ������ ���ϸ� ����Ͻ� �� �ֽ��ϴ�.\n\n" + "�������� : " + Math.round(file_size / 1024 / 1024 * 100) / 100 + "MB");
            file_view.value = "";
            elem.value = "";
            return;
        }
    }
    
    /* ���� Ȯ���� üũ */
    var last_dot = file_name.lastIndexOf('.');
    var ext = file_name.slice(last_dot + 1, (file_name.length));
    if(elem.id == "img_file"){ //����� �̹��� Ȯ���� üũ
        var allowed_extentions = ["jpg", "png", "jpeg", "gif"];
        if(allowed_extentions.indexOf(ext) == - 1){
            if(elem.files[0] == null){
                file_view.value = "";
            }else{
                alert("�̹��� ���ϸ� ÷�� �����մϴ� : ( jpg, png, jpeg, gif )");
                file_view.value = "";
                elem.value = "";
                return;
            }
        }
    }
    file_view.value = file_name;
}

//��Ű���� �������� �Լ�
var getCookie = function(key) {
    var cookieKey = key + "="; 
    var result = "";
    var cookieArr = document.cookie.split(";");
    for(var i = 0; i < cookieArr.length; i++) {
      if(cookieArr[i][0] === " ") {
        cookieArr[i] = cookieArr[i].substring(1);
      }
      if(cookieArr[i].indexOf(cookieKey) === 0) {
        result = cookieArr[i].slice(cookieKey.length, cookieArr[i].length);
        return result;
      }
    }
    return result;
}