

// $(function(){
//   adjustHeight();
// });

// function adjustHeight() {
//   let textEle = $('.text_auto_hig');
//   let li_cnt = textEle.length;
//   console.log(textEle[0]);
//
//   if(li_cnt > 0){
//     for(let i = 0; i < li_cnt;i++){
//       textEle[i].style.height = 'auto';
//       var textEleHeight = textEle.prop('scrollHeight');
//       textEle.css('height', textEleHeight);
//     }
//   }
// };

// function history_submit(){
//     let frm = $("#history_wr_frm");
//     frm.submit();
// }





function resize(obj) {
  obj.style.height = "1px";
  obj.style.height = (12+obj.scrollHeight)+"px";
}


function history_update(sh_no,srl_no){

    $.ajax ({
        type : "POST",
        url : "./proc/query.php",
        data :  {
            sh_no: sh_no,
            srl_no: srl_no,
            val: "history_select"
        },
        timeout : 5000,
        dataType : 'text',
        success : function(data) {
                var obj = JSON.parse(data);
                $("input[name=sh_no]").val(obj['sh_no']);
                $("input[name=sh_reg_date]").val(obj['sh_reg_date'].substr(0,10));
                $("input[name=sh_reg_time]").val(obj['sh_reg_time']);
                $("input[name=val]").val("history_update");
                $("textarea[name=sh_content]").val(obj['sh_content']);
                $("#text_update").text('히스토리 수정');
                $("#history_frm").css("display","block");
                $("textarea[name=sh_content]").focus();
            },
            error : function(request, status, error ) {   // 오류가 발생했을 때 호출된다.
                console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        }
    });
}

function history_delete(sh_no,srl_no){
    if(!confirm("정말 삭제하시겠습니까?")){
        return false;
    }
    $.ajax ({
        type : "POST",
        url : "./proc/query.php",
        data :  {
            sh_no: sh_no,
            srl_no: srl_no,
            val: "history_delete"
        },
        timeout : 5000,
        dataType : 'text',
        success : function(data) {
            try{
                alert("히스토리 삭제가 완료되었습니다.");
                location.reload();
            }catch(e){
                console.log(e.message);
            }
        },
        error : function(request, status, error ) {   // 오류가 발생했을 때 호출된다.
            console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        }
    });

}

// 작성폼 오픈 체크
function history_on(chk_num){
    switch (chk_num) {
        case 1:
            let today = new Date();

            let year = today.getFullYear(); // 년도
            let get_month = today.getMonth() + 1;  // 월
            let get_date = today.getDate();  // 날짜

            let month = get_month < 10 ? "0" + get_month : get_month;
            let date = get_date < 10 ? "0" + get_date : get_date;

            let full_date = year+"-"+month+"-"+date;

            $("input[name=sh_reg_date]").val(full_date);
            $("#text_update").text('히스토리 작성');
            $("#history_frm").css("display","block");
            $("textarea[name=sh_content]").val("");
            $("textarea[name=sh_content]").focus();
            break;
        case 2:
            $("#history_frm").css("display","none");
            document.getElementById("reset_textarea").value='';
            break;
        default:
            alert( "히스토리 폼 열기 실패" );
    }
}

// 링크 이동
function move_link(link){
    location.href=link;
}

// 스토어 등록 삭제
function delete_link(param,url){
    if(!confirm("정말 삭제하시겠습니까?")){
        return false;
    }
    $.ajax ({
        type : "POST",
        url : url,
        data :  {
            srl_no: param,
            val: "delete"
        },
        timeout : 5000,
        dataType : 'text',
        success : function(data) {
            alert("스토어 삭제가 완료되었습니다.");
            location.href="./store_list.php";
        },
        error : function(request, status, error ) {   // 오류가 발생했을 때 호출된다.
            console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        }
    });
}
