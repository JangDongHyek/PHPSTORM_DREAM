<?
####################################################################################
/*
				navyism@log analyzer 5
				  ���ѹα��� �����

* ���ǻ���:

    ' �� " �Ǵ� \ �� ���� Ư�� ���ڴ� Ư���� ��츦 �����ϰ�� ����� �� �����ϴ�.
    �� ���ڵ��� ������� ���Ͽ� ������ �߻� �� �� ������ ���� �ϼ���.
    ' �� ���� ���ڴ� ` ������ ��ü �Ͽ� ��� �Ͻñ� �ٶ��ϴ�.

*/
####################################################################################



####################################################################################
//			Include Version Info File (required)
####################################################################################
include"nalog_info.php";


####################################################################################
//			Language Information (naming in English only)
####################################################################################
$lang[name]		= "Korean (euc-kr)";
$lang[english_name] 	= "Korean";


####################################################################################
//			Page Header (please do not modify)
####################################################################################
$lang[head]		= "<!-----------------------------------------------------------------------------------------------------


                                 ���������������������
                                 ���α׷��� : navyism@log analyzer
                                 ��������   : $nalog_info[version]
                                 ��������   : $nalog_info[date]
                                 �� �� ��   : navyism
                                 e-mail     : navyism@navyism.com
                                 homepage   : http://navyism.com
                                 ���������������������
                                 �� �� ��   : �ѱ��� (euc-kr)
                                 ��������   : v1.0.2 for n@log 5.0.2
                                 ��������   : 2003.02.27
                                 �� �� ��   : navyism
                                 e-mail     : navyism@navyism.com
                                 homepage   : http://navyism.com
                                 ���������������������



n@series�� PHP�� mySQL�� ������� �ϴ� CGI������ �� ���α׷�����,
��� ����ڿ��Դ� ������ ���� ���� ������ ���� �˴ϴ�.

n@series�� ���۱� �� �������� ������(navyism)���� ������, 
���۱� ǥ���� ������ ��� �� ���� �Ҽ� �ֽ��ϴ�.
�� �����ڿ��� ���� ���� ���� ���۱� ǥ�⸦ �����ϰų� ���� �� �� �����ϴ�.

n@series�� ������� ���� �ս� �� ���ؿ� ���ؼ� ������ �� �����ڿ��Դ� å���� ������, 
������ �� �����ڿ��Դ� ���� �� ������ �ǹ��� �����ϴ�.

n@series�� ����, ��� �� ���� ��ü ����Ʈ ��� �����Ӱ� ��ġ �� ��� �� �� ������, 
�����ڿ��� ���� ���� n@series�� �������� �ϴ� ���� �뿩 �� �Ǹſ� ���� ������� ������ �� �� �����ϴ�.

n@series�� ������ �����Ӱ� �ڽ��� ����Ʈ���� ���� �� �� ������, 
�� �����ڸ� ǥ������ ���� ���������� ������� �ʽ��ϴ�.

�����ڿ��� ���� ���� ���۱� ǥ�⸦ ���� �� ���� �� ��� 
���۱ǹ� (��97���� 5��)�� ��õ� ���׿� ���� ó�� �� �� �ֽ��ϴ�.
'���� �Ǹ��� ����, ����, ���, ����, ����(���ͳ�), 2���� ���۹� �ۼ��� ������� ħ���� �ڿ� ���� 
5������ ¡�� �Ǵ� 5õ���� ������ �������� ó�� ���ϴ�.'
------------------------------------------------------------------------------------------------------>

<html>
<head>
<title>n@log analyzer $nalog_info[version]</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=euc-kr\">
<meta name=\"Description\" content=\"navyism@log\">
<meta name=\"Keywords\" content=\"navyism@log,n@log\">
<meta name=\"Author\" content=\"navyism\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"language/$language/style.css\">
</head>
";
$lang[copy]	= "<font size=1>n@log analyzer $nalog_info[version] &copy;2001-2003 </font><a href=http://navyism.com target=_blank><font size=1><b>navyism</b></font></a>";


###################################################################################
//			Displaying License Agreement (install.php)
###################################################################################
$lang[install_license_textarea_rows]	= 21;
$lang[install_license_title]		= "���۱� ��ġ ����";
$lang[install_license_agreement]	= "<b>���α׷� ��ġ�� �����ϱ� ���� �Ʒ� ������ �� �о� ���ñ� �ٶ��ϴ�.</b>";
$lang[install_license_text]		= "n@series�� PHP�� mySQL�� ������� �ϴ� CGI������ �� ���α׷�����,
��� ����ڿ��Դ� ������ ���� ���� ������ ���� �˴ϴ�.

n@series�� ���۱� �� �������� ������(navyism)���� ������, 
���۱� ǥ���� ������ ��� �� ���� �Ҽ� �ֽ��ϴ�.
�� �����ڿ��� ���� ���� ���� ���۱� ǥ�⸦ �����ϰų� ���� �� �� �����ϴ�.

n@series�� ������� ���� �ս� �� ���ؿ� ���ؼ� ������ �� �����ڿ��Դ� å���� ������, ������ �� �����ڿ��Դ� ���� �� ������ �ǹ��� �����ϴ�.

n@series�� ����, ��� �� ���� ��ü ����Ʈ ��� �����Ӱ� ��ġ �� ��� �� �� ������, �����ڿ��� ���� ���� n@series�� �������� �ϴ� ���� �뿩 �� �Ǹſ� ���� ������� ������ �� �� �����ϴ�.

n@series�� ������ �����Ӱ� �ڽ��� ����Ʈ���� ���� �� �� ������, 
�� �����ڸ� ǥ������ ���� ���������� ������� �ʽ��ϴ�.

�����ڿ��� ���� ���� ���۱� ǥ�⸦ ���� �� ���� �� ��� ���۱ǹ� (��97���� 5��)�� ��õ� ���׿� ���� ó�� �� �� �ֽ��ϴ�.
'���� �Ǹ��� ����, ����, ���, ����, ����(���ͳ�), 2���� ���۹� �ۼ��� ������� ħ���� �ڿ� ���� 5������ ¡�� �Ǵ� 5õ���� ������ �������� ó�� ���ϴ�.'";
$lang[install_license_ask]		= "<center>���� ������ ��� �о� ��������, ���� �Ͻðڽ��ϱ�?</center><br>";
$lang[install_license_agree]		= "��, ���� �մϴ�.";
$lang[install_license_decline]		= "�ƴϿ�, ���� ���� �ʽ��ϴ�.";


###################################################################################
//			Setup MySQL Connection (install_er.php)
###################################################################################
$lang[install_mysql_title]		= "MySQL �������� ����";
$lang[install_mysql_text]		= "n@log 5�� <b>MySQL database</b>�� �̿��Ͽ� ������ ���� �ϸ�, <b>MySQL database</b>�� �̿��Ϸ��� ������� <b>MySQL����</b>�� �ʿ� �մϴ�.<br>
MySQL������ ���� �ڼ��� ������ ���� �����ڿ��� ���� �Ͻñ� �ٶ��ϴ�.<br><br>
<font color=tomato>(MySQL������ FTP�������� �ٸ����Դϴ�)</font>";

$lang[install_mysql_account_mysql]	= "MySQL ����� �������� �Է�";
$lang[install_mysql_account_nalog]	= "n@log 5 ������ ��������";

$lang[install_mysql_input_db_host]	= "ȣ��Ʈ�̸�";
$lang[install_mysql_input_db_id]	= "DB ���̵�";
$lang[install_mysql_input_db_pass]	= "DB �н�����";
$lang[install_mysql_input_db_name]	= "DB �̸�";
$lang[install_mysql_input_admin_id]	= "������ ID";
$lang[install_mysql_input_admin_pass]	= "��й�ȣ";
$lang[install_mysql_input_admin_repass]	= "��й�ȣ ���Է�";

$lang[install_mysql_error_db_host]	= "ȣ��Ʈ�̸��� �Է��ϼ���";
$lang[install_mysql_error_db_id]	= "DB ���̵� �Է��ϼ���";
$lang[install_mysql_error_db_pass]	= "DB �н����带 �Է��ϼ���";
$lang[install_mysql_error_db_name]	= "DB �̸��� �Է��ϼ���";
$lang[install_mysql_error_admin_id]	= "������ ���̵� �Է��ϼ���";
$lang[install_mysql_error_admin_pass]	= "������ ��й�ȣ�� �Է��ϼ���";
$lang[install_mysql_error_admin_repass]	= "������ ��й�ȣ�� �ѹ��� �Է��ϼ���";
$lang[install_mysql_error_admin_match]	= "������ ��й�ȣ�� ���� ��ġ���� �ʽ��ϴ�";


###################################################################################
//			When Installing... (install_ing.php)
###################################################################################
$lang[install_ing_error_db_id]		= "DB�� �����Ҽ� �����ϴ�\\nDB ���̵�� �н����带 Ȯ���ϼ���";
$lang[install_ing_error_db_name]	= "DB�� �����Ҽ� �����ϴ�\\nDB �̸��� Ȯ���ϼ���";
$lang[install_ing_error_permission1]	= "n@log�� ��ġ�� ��� �� �� �����ϴ�.\\n���丮�� �۹̼��� 707 �Ǵ� 777�� �ƴϰų� n@log�� ���ϵ��� �������� ���� ������� �� ������ ������ �� �����ϴ�.\\n\\n���丮�� �۹̼��� Ȯ���� ���ð� nalog_connect.php�� �����Ͻð� �ٽ� ��ġ�� �õ��� ���ñ� �ٶ��ϴ�";
$lang[install_ing_error_permission2]	= "n@log�� ��ġ�� ��� �� �� �����ϴ�.\\n���丮�� �۹̼��� 707 �Ǵ� 777�� �ƴϰų� n@log�� ���ϵ��� �������� ���� ������� �� ������ ������ �� �����ϴ�.\\n\\n���丮�� �۹̼��� Ȯ���� ���ð� nalog_language.php�� �����Ͻð� �ٽ� ��ġ�� �õ��� ���ñ� �ٶ��ϴ�";

$lang[install_ing_finish]		= "n@log analyzer�� ��ġ�� �Ϸ�Ǿ����ϴ�";


###################################################################################
//			Version Info Check (check.php)
###################################################################################
$lang[version_check_title]		= "�ֽŹ��� üũ";
$lang[version_check_this_version]	= "���� ����: ";
$lang[version_check_latest_version]	= "�ֽ� ����: ";
$lang[version_check_update_button]	= "������Ʈ�ϱ�";
$lang[version_check_close_button]	= "â�ݱ�";


###################################################################################
//			Change Administration Account (change.php)
###################################################################################
$lang[change_admin_title]		= "������ ��������";
$lang[change_admin_text]		= "�� ������ ����";
$lang[change_admin_change_button]	= "�����ϱ�";
$lang[change_admin_close_button]	= "â�ݱ�";

$lang[change_admin_id]			= "������ ID";
$lang[change_admin_pass]		= "��й�ȣ";
$lang[change_admin_repass]		= "��й�ȣ ���Է�";

$lang[change_admin_error_admin_id]	= "������ ������ ���̵� �Է��ϼ���";
$lang[change_admin_error_admin_pass]	= "������ ������ ��й�ȣ�� �Է��ϼ���";
$lang[change_admin_error_admin_repass]	= "������ ������ ��й�ȣ�� �ѹ��� �Է��ϼ���";
$lang[change_admin_error_admin_match]	= "������ ������ ��й�ȣ�� ���� ��ġ���� �ʽ��ϴ�";

$lang[change_admin_finish]		= "������ ������ ���� �Ǿ����ϴ�";


###################################################################################
//			Program Uninstallation (uninstall.php)
###################################################################################
$lang[uninstall_finish]			= "n@log analyzer�� ��� �ڷ� �� ���̺��� ���� �Ͽ����ϴ�.\\n\\n�ٽ� ����Ϸ��� install.php�� �����Ͽ�\\n�缳ġ�� �ϼž� �մϴ�";


###################################################################################
//			Administrator Login Page (login.php)
###################################################################################
$lang[login_title]			= "n@log ������ �α���";
$lang[login_id]				= "���̵�";
$lang[login_pass]			= "��й�ȣ";
$lang[login_auto]			= "�ڵ��α���";

$lang[login_warning_auto]		= "�ڵ��α����� �Ͻø� �������� ���� �Ŀ���\\n����ؼ� �α��λ��¸� �����ϱ� ������\\nPC���̳� �б��� ���� ��ҿ����� �����մϴ�\\n\\n�ڵ��α����� ����Ͻðڽ��ϱ�?";
$lang[login_error_id]			= "���̵� �Է��ϼ���";
$lang[login_error_pass]			= "��й�ȣ�� �Է��ϼ���";

$lang[login_error_id_wrong]		= "���̵� ��Ȯ���� �ʽ��ϴ�";
$lang[login_error_pass_wrong]		= "��й�ȣ�� ��Ȯ���� �ʽ��ϴ�";


###################################################################################
//			Root Manager (root.php)
###################################################################################
$lang[root_title]			= "�ְ� ������ �޴�";
$lang[root_alt_counter_manager]		= "ī���� ����";
$lang[root_alt_version_check]		= "�ֽŹ��� Ȯ��";
$lang[root_alt_navyism_com]		= "n@log 5 ����Ȩ������";
$lang[root_alt_change_admin]		= "������ ���� ����";
$lang[root_alt_uninstall]		= "n@log 5 ����";
$lang[root_warning_uninstall]		= "n@log analyzer�� ���� �ϸ�, \\n��� ī������ �α� ��ϰ� ������ ���� �˴ϴ�.\\n\\n ���� �Ͻðڽ��ϱ�?";

$lang[root_change_language_button]	= "����";


###################################################################################
//			Counter Manager (admin.php)
###################################################################################
$lang[counter_manager_title]		= "ī���� ����";
$lang[counter_manager_paging1]		= "&nbsp;&nbsp;�� ";
$lang[counter_manager_paging2]		= "���� ������ ī����, ���� ";
$lang[counter_manager_paging3]		= "������, �� ";
$lang[counter_manager_paging4]		= "������";
$lang[counter_manager_view]		= "ǥ�ð���";
$lang[counter_manager_view_button]	= "����";
$lang[counter_manager_view_error]	= "���ڸ� �Է��ϼž� �մϴ�";

$lang[counter_manager_table_no]		= "��ȣ";
$lang[counter_manager_table_name]	= "ī���� �̸�";
$lang[counter_manager_table_config]	= "ȯ�漳��";
$lang[counter_manager_table_example]	= "��������";
$lang[counter_manager_table_drop]	= "����";
$lang[counter_manager_table_clean]	= "����";
$lang[counter_manager_table_total]	= "��ü";
$lang[counter_manager_table_today]	= "����";
$lang[counter_manager_table_today_peak] = "�ִ�";
$lang[counter_manager_table_peak]	= "�ִ뵿�����Ӽ�";
$lang[counter_manager_tablecell_view]	= "��������";
$lang[counter_manager_tablecell_drop]	= "����";
$lang[counter_manager_tablecell_clean]	= "����";

$lang[counter_manager_warning_drop]	= "���õ� ī���͸� ���� �մϴ�.\\n���ŵ� �ڷ�� �ǵ��� �� �����ϴ�.\\n\\n�۾��� ����Ͻðڽ��ϱ�?";
$lang[counter_manager_warning_clean]	= "���õ� ī������ �ڷḦ ���� �մϴ�.\\nī������ ������ �������� �ʽ��ϴ�.\\n\\n�۾��� ����Ͻðڽ��ϱ�?";

$lang[counter_manager_create_button]	= "ī���ͻ���";
$lang[counter_manager_error_create]	= "������ ī�����̸��� �Է��ϼ���";


###################################################################################
//			Creating Counter (admin_ing.php)
###################################################################################
$lang[counter_create_error_name]	= "������ ī�����̸��� �Է��ϼ���";
$lang[counter_create_error_char]	= "ī�����̸����� ���� ���� _ �� ������ Ư�� ���ڸ� ��� �� �� �����ϴ�";
$lang[counter_create_error_exist]	= "�����ϴ� ī�����̸� �Դϴ�";
$lang[counter_create_error_blank]	= "ī�����̸����� ������ ���Ե� �� �����ϴ�";


###################################################################################
//			Counter Manager - Overall (admin_counter.php)
###################################################################################
$lang[counter_main_plug_in]		= "�÷������� �����ϼ���";

$lang[counter_main_date_format1]	= "Y-m-d H:i:s (D)";
$lang[counter_main_not_exist]		= "�������� �ʴ� ī���� �Դϴ�";

$lang[counter_main_title]		= "ī����Ȯ��";
$lang[counter_main_title_hour]		= "�ð������";
$lang[counter_main_title_day]		= "��¥�����";
$lang[counter_main_title_week]		= "���Ϻ����";
$lang[counter_main_title_month]		= "�������";
$lang[counter_main_title_year]		= "�⵵�����";
$lang[counter_main_title_refer]		= "��ũ�ּ���� (������)";
$lang[counter_main_title_refer_detail]	= "��ũ�ּ���� (URL)";
$lang[counter_main_title_os]		= "�ü�� & ��������";
$lang[counter_main_title_visitor]	= "�湮������Ȯ��";
$lang[counter_main_title_config]	= "ī���ͼ���";

$lang[counter_main_menu_hour]		= "�ð���";
$lang[counter_main_menu_day]		= "�Ϻ�";
$lang[counter_main_menu_week]		= "���Ϻ�";
$lang[counter_main_menu_month]		= "����";
$lang[counter_main_menu_year]		= "�⵵��";
$lang[counter_main_menu_refer]		= "��ũ�ȼ���";
$lang[counter_main_menu_refer_detail]	= "��ũ��������";
$lang[counter_main_menu_os]		= "�ü��&������";
$lang[counter_main_menu_visitor]	= "�湮��";
$lang[counter_main_menu_config]		= "ȯ�漳��";

$lang[counter_main_year]		= "��";
$lang[counter_main_month]		= "��";
$lang[counter_main_day]			= "��";

$lang[counter_main_button_view]		= "����";
$lang[counter_main_button_view_all]	= "��ü����";
$lang[counter_main_button_print]	= "�μ��ϱ�";
$lang[counter_main_button_back]		= "�ڷ��̵�";
$lang[counter_main_button_check_all]	= "��ü����";
$lang[counter_main_button_cancel_all]	= "�������";
$lang[counter_main_button_search]	= "�˻�";
$lang[counter_main_button_delete]	= "���õ� �α׸� ����";


###################################################################################
//			Counter Manager - Part 1 (by Hour)
###################################################################################
$lang[counter_main_1_date_format]	= "Y�� n�� j��";
$lang[counter_main_1_date]		= "��¥: ";
$lang[counter_main_1_today]		= "����";
$lang[counter_main_1_sum]		= "����";
$lang[counter_main_1_total]		= " , ��: ";
$lang[counter_main_1_total_visitor]	= "���� �湮��";
$lang[counter_main_1_hour_format]	= "H��";
$lang[counter_main_1_hour]		= "��";
$lang[counter_main_1_visitor]		= "��";
$lang[counter_main_1_view_visitor]	= "{yy}�� {mm}�� {dd}�� {hh}���� �湮�� ��� Ȯ��";


###################################################################################
//			Counter Manager - Part 2 (by Day)
###################################################################################
$lang[counter_main_2_date_format]	= "Y�� n��";
$lang[counter_main_2_month]		= "��: ";
$lang[counter_main_2_this_month]	= "�����";
$lang[counter_main_2_sum]		= "����";
$lang[counter_main_2_total]		= " , ��: ";
$lang[counter_main_2_total_visitor]	= "���� �湮��";
$lang[counter_main_2_day_format]	= "j��";
$lang[counter_main_2_visitor]		= "��";
$lang[counter_main_2_view_visitor]	= "{yy}�� {mm}�� {dd}���� �ð���� Ȯ��";


###################################################################################
//			Counter Manager - Part 3 (by Week)
###################################################################################
$lang[counter_main_3_sum]		= "����";
$lang[counter_main_3_total]		= " , ��: ";
$lang[counter_main_3_total_visitor]	= "���� �湮��";
$lang[counter_main_3_average]		= " , ��� 1���ϴ�: ";
$lang[counter_main_3_average_visitor]	= "���� �湮��";
$lang[counter_main_3_visitor]		= "��";

$lang[counter_main_3_day_name0]		= "�Ͽ���";
$lang[counter_main_3_day_name1]		= "������";
$lang[counter_main_3_day_name2]		= "ȭ����";
$lang[counter_main_3_day_name3]		= "������";
$lang[counter_main_3_day_name4]		= "�����";
$lang[counter_main_3_day_name5]		= "�ݿ���";
$lang[counter_main_3_day_name6]		= "�����";


###################################################################################
//			Counter Manager - Part 4 (by Month)
###################################################################################
$lang[counter_main_4_year]		= "�⵵: ";
$lang[counter_main_4_this_year]		= "�ݳ�";
$lang[counter_main_4_sum]		= "����";
$lang[counter_main_4_total]		= ", ��: ";
$lang[counter_main_4_total_visitor]	= "���� �湮��";
$lang[counter_main_4_month_format]	= "n��";
$lang[counter_main_4_visitor]		= "��";
$lang[counter_main_4_view_visitor]	= "{yy}�� {mm}���� ������� Ȯ��";


###################################################################################
//			Counter Manager - Part 5 (by Year)
###################################################################################
$lang[counter_main_5_sum]		= "����";
$lang[counter_main_5_total]		= ", ��: ";
$lang[counter_main_5_total_visitor]	= "���� �湮��";
$lang[counter_main_5_year_format]	= "Y��";
$lang[counter_main_5_visitor]		= "��";
$lang[counter_main_5_view_visitor]	= "{yy}���� ������� Ȯ��";


###################################################################################
//			Counter Manager - Part 6 (by Referers - Host & URL)
###################################################################################
$lang[counter_main_6_date_format]	= "Y�� m�� d�� H�� i�� s��";
$lang[counter_main_6_total]		= "��: ";
$lang[counter_main_6_total_url]		= "���� URL, ";
$lang[counter_main_6_total_visitor]	= "���� �湮��";
$lang[counter_main_6_total_zero]	= "�α� ����� �����ϴ�";
$lang[counter_main_6_total_delete]	= "���õ� �α׸� ���� �Ͻðڽ��ϱ�?";

$lang[counter_main_6_today_only]	= "���ϱ�ϸ�";
$lang[counter_main_6_sort_by]		= "���Ĺ��";

$lang[counter_main_6_sort_1]		= "�湮�ڼ�";
$lang[counter_main_6_sort_2]		= "�湮�ڿ���";
$lang[counter_main_6_sort_3]		= "�ð���";
$lang[counter_main_6_sort_4]		= "�ð�����";
$lang[counter_main_6_sort_5]		= "URL��";
$lang[counter_main_6_sort_6]		= "URL����";

$lang[counter_main_6_search_negative]	= "������";
$lang[counter_main_6_search_and]	= "�׸���";
$lang[counter_main_6_search_or] 	= "�Ǵ�";

$lang[counter_main_6_table_url]		= "���Ӽ��� (ȣ��Ʈ �̸� �Ǵ� URL, ������ ���ӽð�)";
$lang[counter_main_6_table_hit]		= "�����ڼ�";

$lang[counter_main_6_url_remember]	= "URL ����ϱ�";
$lang[counter_main_6_url_forget]	= "URL ������";

$lang[counter_main_6_url_remember_button]="<span lang=ko style=font-family:����,Dotum;font-size:8pt>[����ϱ�]</font>";
$lang[counter_main_6_url_forget_button]	= "<span lang=ko style=font-family:����,Dotum;font-size:8pt;color:#F7418C>[������]</span>";

$lang[counter_main_6_direct_connect]	= "�ּ������Է� �Ǵ� ���ã�⸦ �̿��� �湮";
$lang[counter_main_6_view_detail_url]	= "�����Ӱ��";
$lang[counter_main_6_delete_button]	= "�α׻���";
$lang[counter_main_6_delete_question]	= "���� ���� �Ͻðڽ��ϱ�?";

$lang[counter_main_6_error_pagenum]	= "���ڸ� �Է��ϼž� �մϴ�";


###################################################################################
//			Counter Manager - Part 7 (by Visitors' OS & Browser)
###################################################################################
$lang[counter_main_7_total]		= "��: ";
$lang[counter_main_7_total_os]		= "���� �ü��, ";
$lang[counter_main_7_total_browser]	= "���� ������, ";
$lang[counter_main_7_total_visitor]	= "���� �湮��";
$lang[counter_main_7_visitor]		= "��";
$lang[counter_main_7_total_zero]	= "�α� ����� �����ϴ�";

$lang[counter_main_7_title_os]		= "�湮���� �ü��";
$lang[counter_main_7_title_browser]	= "�湮���� ��������";

$lang[counter_main_7_error_pagenum]	= "���ڸ� �Է��ϼž� �մϴ�";


###################################################################################
//			Counter Manager - Part 8 (by Visitors' Information)
###################################################################################
$lang[counter_main_8_date_format]	= "Y�� m�� d�� H�� i�� s��";
$lang[counter_main_8_total]		= "��: ";
$lang[counter_main_8_total_visitor]	= "���� �湮��";
$lang[counter_main_8_total_zero]	= "�α� ����� �����ϴ�";
$lang[counter_main_8_today_only]	= "���ϱ�ϸ�";
$lang[counter_main_8_member_only]	= "ȸ����ϸ�";
$lang[counter_main_8_sort_by]		= "���Ĺ��";

$lang[counter_main_8_sort_1]		= "�ð���";
$lang[counter_main_8_sort_2]		= "�ð�����";
$lang[counter_main_8_sort_3]		= "ȸ��ID��";
$lang[counter_main_8_sort_4]		= "ȸ��ID����";

$lang[counter_main_8_title_1]		= "�湮���� ID / ��ũ�������� / �ü�� / ������";
$lang[counter_main_8_title_2]		= "�湮���� IP / �湮�ð�";

$lang[counter_main_8_right_arrow]	= "<span style=font-size:6pt>��</span> ";
$lang[counter_main_8_direct_connect]	= "�ּ������Է� �Ǵ� ���ã�⸦ �̿��� �湮";
$lang[counter_main_8_not_login]		= "��Ȯ��";
$lang[counter_main_8_unknown_os]	= "�˼����� �ü��";
$lang[counter_main_8_unknown_browser]	= "�˼����� ������";
$lang[counter_main_8_search]		= "�湮��� �˻�";

$lang[counter_main_8_error_pagenum]	= "���ڸ� �Է��ϼž� �մϴ�";


###################################################################################
//			Counter Manager - Part 9 (Configuration)
###################################################################################
$lang[counter_config_total]		= "�� �湮�ڼ�";
$lang[counter_config_skin]		= "��Ų ����";
$lang[counter_config_skin_pattern]	= "��Ų ���� ���� ���";
$lang[counter_config_skin_pattern_use]	= "��Ų ���� ������ �����";
$lang[counter_config_reconnect]		= "������ ����";
$lang[counter_config_reconnect_always]	= "�׻� ī���� ���� (��Ű�� ������� ����)";
$lang[counter_config_reconnect_new_open]= "�� �������� �ٽ� �����ϸ� ī���� ���� (��Ű �ð� : 0 sec)";
$lang[counter_config_reconnect_by_time1]= "������ �ð� ���Ŀ� ī���� ���� (��Ű �ð� : ";
$lang[counter_config_reconnect_by_time2]= " sec)";
$lang[counter_config_reconnect_once]	= "�Ϸ翡 �ѹ��� ī���� ����";
$lang[counter_config_time_zone1]	= "��Ͽ� ������ �ð��� ����";
$lang[counter_config_time_zone2]	= "�ð� + ������ ���� �ð� [�������� ����]";
$lang[counter_config_admin_check]	= "������ ���� üũ";
$lang[counter_config_admin_check_not]	= "�������� ������ ��迡 �������� ����";
$lang[counter_config_now_check]		= "���� ������ üũ";
$lang[counter_config_now_check_use]	= "���� �����ڼ��� üũ��";
$lang[counter_config_now_time]		= "���� ���� �ð�";
$lang[counter_config_now_time_use1]	= "";
$lang[counter_config_now_time_use2]	= " �� ���� �����ϰ� �ִ� ������ ������ (10�� �̻�)";
$lang[counter_config_admin_data]	= "��� �ڷ� ����";
$lang[counter_config_admin_data_delete1]= "��� ��� ����";
$lang[counter_config_admin_data_delete2]= " �Ϻ�,���Ϻ�,����,������ ��踦 ����";
$lang[counter_config_admin_os]		= "OS & Browser �ڷ� ����";
$lang[counter_config_admin_os_delete1]	= "OS & Browser ��� ����";
$lang[counter_config_admin_os_delete2]	= " OS & Browser ��踦 ����";
$lang[counter_config_visitor_check]	= "���� �ڷ� üũ";
$lang[counter_config_visitor_check_use]	= "�湮�� ����� üũ��";
$lang[counter_config_visitor_limit]	= "���� �ڷ� ����";
$lang[counter_config_visitor_delete1]	= "���� ��� ����";
$lang[counter_config_visitor_delete2]	= " ���� ����� ����";
$lang[counter_config_visitor_limit_set1]= "";
$lang[counter_config_visitor_limit_set2]= " ���� �湮�� ��ϸ��� ������ (0�϶� ������)";
$lang[counter_config_log_check]		= "�α� �ڷ� üũ";
$lang[counter_config_log_check_use]	= "�湮���� �α׸� üũ��";
$lang[counter_config_log_limit]		= "�α� �ڷ� ����";
$lang[counter_config_log_delete1]	= "�α� ��� ����";
$lang[counter_config_log_delete2]	= " �α� ����� ����";
$lang[counter_config_log_limit_set1]	= "";
$lang[counter_config_log_limit_set2]	= " ���� �α� ��ϸ��� ������ (0�϶� ������)";
$lang[counter_config_member_cookie]	= "ȸ�� ���� ��Ű �̸�";
$lang[counter_config_member_cookie_is]	= "(<b>n@board 3:</b> na3_member, <b>Zeroboard:</b> <a href=patch/zboard_login/README.txt target=_blank>�α��� ���� ��ġ �ʿ�</a>)";
$lang[counter_config_permission]	= "���� ����";
$lang[counter_config_permission1]	= "�����ڸ� �ð��� ��� Ȯ�� �ϱ�";
$lang[counter_config_permission2]	= "�����ڸ� ��¥�� ��� Ȯ�� �ϱ�";
$lang[counter_config_permission3]	= "�����ڸ� ���Ϻ� ��� Ȯ�� �ϱ�";
$lang[counter_config_permission4]	= "�����ڸ� ���� ��� Ȯ�� �ϱ�";
$lang[counter_config_permission5]	= "�����ڸ� �⵵�� ��� Ȯ�� �ϱ�";
$lang[counter_config_permission6]	= "�����ڸ� �α� ��� Ȯ�� �ϱ�";
$lang[counter_config_permission7]	= "�����ڸ� �󼼷α� ��� Ȯ�� �ϱ�";
$lang[counter_config_permission8]	= "�����ڸ� �ü��/�� ������ ��� Ȯ�� �ϱ�";
$lang[counter_config_permission9]	= "�����ڸ� �湮�� ��� Ȯ�� �ϱ�";

$lang[counter_config_warning_data]	= "��� ����� ���� �ϸ�\\n�Ϻ�,���Ϻ�,����,������ ��谡 ��� ���� �˴ϴ�\\n\\n��� �Ͻðڽ��ϱ�?";
$lang[counter_config_warning_os]	= "OS & Browser ����� ���� �ϸ�\\n����� OS & Browser ���� ����� ��� ���� �˴ϴ�\\n\\n��� �Ͻðڽ��ϱ�?";
$lang[counter_config_warning_visitor]	= "�湮�� ����� ���� �ϸ�\\n����� �湮�� ����� ��� ���� �˴ϴ�\\n\\n��� �Ͻðڽ��ϱ�?";
$lang[counter_config_warning_log]	= "�α� ����� ���� �ϸ�\\n���� �� �� �α� ����� ��� ���� �˴ϴ�\\n\\n��� �Ͻðڽ��ϱ�?";

$lang[counter_config_button_save]	= "�����ϱ�";
$lang[counter_config_button_reset]	= "�������";

$lang[counter_manager_error_not_exist]	= "�������� �ʴ� ī���� �Դϴ�";
$lang[counter_manager_error_total_is]	= "�� �湮�ڼ��� ���ڸ� �Է��ϼž� �մϴ�";
$lang[counter_manager_error_cookie_time]= "��Ű �ð��� ���ڸ� �Է��ϼž� �մϴ�";
$lang[counter_manager_error_connect_time]="���� ���� �ð��� ���ڸ� �Է��ϼž� �մϴ�";
$lang[counter_manager_error_log_limit]	= "�α� �ڷ� ������ ���ڸ� �Է��ϼž� �մϴ�";


###################################################################################
//			IP Address Information Check (check_ip.php)
###################################################################################
$lang[check_ip_title]			= "IP������ȸ : ";
$lang[check_ip_support]			= "���� �� �����ڷ�";
$lang[check_ip_close]			= "â�ݱ�";
$lang[check_ip_false_msg]		= "whois �������� ������ ���������� �̷������ �ʾҽ��ϴ�.<br>����� �ڵ����� http://www.apnic.net�� IP���� Ȯ�� �������� �̵��մϴ�.<br>�ڵ����� �̵����� ������ ������ ��ũ�� Ŭ���Ͽ� IP������ Ȯ���ϼ���.<br><br><a href=http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip>http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip</a>";
$lang[check_ip_right_arrow]		= "<span style=font-size:6pt>��</span>";
?>
