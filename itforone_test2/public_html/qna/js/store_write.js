
$(function() {
    // summernote
    $('#editor').summernote({
        height: 300, //(mobilecheck())? 150 : 300,
        lang: 'ko-KR',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            //['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'undo', 'redo']],
        ],
        //placeholder: '상세내용을 입력해 주세요',
    });



});

// form check
function frmSubmit(f) {
	if(f.srl_comp_name.value==''){
        alert('업체명을 입력해주세요.');
        f.srl_comp_name.focus();
        return false;
      }

    f.srl_content.value=$('#editor').summernote('code');
  return true;
}



// 완료일 체크
function comp_date_on(target){
    if(target.value=='완료'){
        let today = new Date();

        let year = today.getFullYear(); // 년도
        let get_month = today.getMonth() + 1;  // 월
        let get_date = today.getDate();  // 날짜

        let month = get_month < 10 ? "0" + get_month : get_month;
        let date = get_date < 10 ? "0" + get_date : get_date;

        let full_date = year+"-"+month+"-"+date;

        $("input[name=srl_complete_date]").attr("value",full_date);
        $(".complete_date_form").css("display","block");
    }else{
        $("input[name=srl_complete_date]").attr("value","");
        $(".complete_date_form").css("display","none");
    }
}




