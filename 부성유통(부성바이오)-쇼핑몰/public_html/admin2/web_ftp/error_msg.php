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
         popup_msg("���� ������ �����մϴ�.\\n�ٸ� �̸����� ������ֽʽÿ�!!");
         break;         

      case ("NEW_DIR_FAILED") :
        popup_msg("�����丮���� �Է��� �ֽʽÿ�!");
         break;         

      case ("SAME_DIR_EXIST") :
         popup_msg("���� ���丮���� �����մϴ�\\n�ٸ� �̸����� ����� �ֽʽÿ�!!");
         break;
         
      case ("INPUT_FILE") :
         popup_msg("���ε��� ������ �Է����ֽʽÿ�!");
         break;                       
                        
      case ("FILE_UPLOAD_FAILED") :
         popup_msg("���� ���ε忡 �����߽��ϴ�.");
         break;                 

      case ("FILE_UNLINK_FAILED") :
         popup_msg("�ӽ������� �����ϴµ� �����߽��ϴ�.");
         break;                 

      case ("RENAME_CHANGE_FAILED") :
         popup_msg("�̸� ���濡 �����Ͽ����ϴ�.");
         break;                 
                     
			case ("NOT_EXCUTE") :
         popup_msg("�������� ������� ������ �� �����ϴ�.");
         break;
         
      case ("INVALID_ID") :
         popup_msg("���̵� ��ġ���� �ʽ��ϴ�.");
         break; 
         
      case ("INVALID_PASSWORD") :
         popup_msg("�н����尡 ��ġ���� �ʽ��ϴ�.");
         break;     
         
      case ("INVALID_AUTH") :
         popup_msg("������ ������ �����Ͽ����ϴ�.");
         break;                                   
      
      default :
   }
}

?>