<?
function popup_msg($msg) {
   echo("<script language=\"javascript\"> 
   <!--
   alert('$msg');
   history.back();
   //-->   
   </script>");
}

function error($errcode) {
   switch ($errcode) {
              
      case ("SAME_FILE_EXIST") :
         popup_msg("같은 파일이 존재합니다.\\n다른 이름으로 등록해주십시오!!");
         break;         

      case ("NEW_DIR_FAILED") :
        popup_msg("새디렉토리명을 입력해 주십시요!");
         break;         

      case ("SAME_DIR_EXIST") :
         popup_msg("같은 디렉토리명이 존재합니다\\n다른 이름으로 등록해 주십시오!!");
         break;
         
      case ("INPUT_FILE") :
         popup_msg("업로드할 파일을 입력해주십시오!");
         break;                       
                        
      case ("FILE_UPLOAD_FAILED") :
         popup_msg("파일 업로드에 실패했습니다.");
         break;                 

      case ("FILE_UNLINK_FAILED") :
         popup_msg("임시파일을 삭제하는데 실패했습니다.");
         break;                 

      case ("RENAME_CHANGE_FAILED") :
         popup_msg("이름 변경에 실패하였습니다.");
         break;                 
                     
			case ("NOT_EXCUTE") :
         popup_msg("부적절한 명령으로 실행할 수 없습니다.");
         break;
         
      case ("INVALID_ID") :
         popup_msg("아이디가 일치하지 않습니다.");
         break; 
         
      case ("INVALID_PASSWORD") :
         popup_msg("패스워드가 일치하지 않습니다.");
         break;     
         
      case ("INVALID_AUTH") :
         popup_msg("관리자 인증에 실패하였습니다.");
         break;                                   
      
      default :
   }
}

?>