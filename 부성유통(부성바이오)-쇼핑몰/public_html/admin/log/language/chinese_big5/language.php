<?
####################################################################################
/*
				navyism@log analyzer 5

			   Traditional Chinese Language Pack
				   (�c�餤��y�t�])

* �Яd�N:

    �b�]�w�r���ܼƤ��e���ɭԡA�кɶq�קK�ϥ� ' , " , \ �o�ǯS��r���A
    �]���o�Ǧr���w�Q�O�d�����S�O�γ~�C
    �p�G�A�b�r���ܼƤ��ϥγo�ǯS��r���A��{������ɫK�i��|�X�{���i�w�������~�C
    ��ĳ�A�ϥΨ�L���r���ΨӥN���b�Τ޸��A�Ҧp�b�Ϊ��u ` �v�M���Ϊ��u�� �������v

*/
####################################################################################



####################################################################################
//			�]�t������T�� (�o�O���n��)
####################################################################################
include"nalog_info.php";


####################################################################################
//			�y�t��T (�����ϥέ^��W��)
####################################################################################
$lang[name]		= "Traditional Chinese (Big5)";
$lang[english_name] 	= "Traditional Chinese";


####################################################################################
//			�������� (�Ф��n�ק����a��)
####################################################################################
$lang[head]		= "<!-----------------------------------------------------------------------------------------------------


                                 ========================================
                                 �{���W��: navyism@log analyzer
                                 �����s��: $nalog_info[version]
                                 �o����: $nalog_info[date]
                                 �{���@��: navyism
                                 �q�l�l��: navyism@navyism.com
                                 ������}: http://navyism.com
                                 ========================================
                                 �y�t�W��: �c�餤�� (Big5)
                                 �����s��: v1.0.2 for n@log 5.0.2
                                 �o����: 2003.02.27
                                 �y�t�s�g: kiddiken (�媽)
                                 �q�l�l��: webmaster@kiddiken.net
                                 ������}: http://kiddiken.net
                                 ========================================



�@�@�o��{�������v�O�ݩ� navyism �Ҧ��C
�@�@����H���i�H�ϥΩM�ק�o��{���A����O�z�����O�d���{�����v�ŧi�������C

�@�@���p�]���ϥΥ��{���ӥO�z�X����ƿ򥢩ηl���Anavyism �@�����|���t�d�C
�@�@�P�ɡAnavyism ��S���d�����z�״_����i��o�ͤ����D�ε��z���Ѩ�U�C

�@�@�o�O�@��K�O�{���A�ҥH�Ф��n�ϥΦb�ӷ~�γ~�W�C

�@�@�p�G�z��{��(�έ��O)������a��@�X�ק�A�Φb�����W�o��z�ק�L�������A
�@�@�Х����b���v�ŧi���O�d�{��(�έ��O)��@�̤λy�t�]�s�@�̪��W�r(�κ����s��)�C
------------------------------------------------------------------------------------------------------>

<html>
<head>
<title>n@log analyzer $nalog_info[version]</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=big5\">
<meta http-equiv=\"Content-Language\" content=\"zh-tw\">
<meta name=\"Description\" content=\"navyism@log\">
<meta name=\"Keywords\" content=\"navyism@log,n@log\">
<meta name=\"Author\" content=\"navyism\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"language/$language/style.css\">
</head>
";
$lang[copy] = "<span style='font-size:7pt'>n@log analyzer $nalog_info[version] &copy;2001-2003 </span><a href=http://navyism.com target=_blank><span style='font-size:7pt'><b>navyism</b></span></a><span lang=zh-tw class=minichi><br>[ �c�餤��y�t�]: <a href=http://kiddiken.net target=_blank><span lang=zh-tw class=minichi>�媽</span></a> ]</span>";


###################################################################################
//			��ܳn����v��ĳ (install.php)
###################################################################################
$lang[install_license_textarea_rows]	= 10;
$lang[install_license_title]		= "<span style=font-size:12pt>�n����v��ĳ</span>";
$lang[install_license_agreement]	= "<b>�ХJ�Ӿ\Ū�H�U���n����v��ĳ�C</b>";
$lang[install_license_text]		= "�o��{�������v�O�ݩ� navyism �Ҧ��C
����H���i�H�ϥΩM�ק�o��{���A����O�z�����O�d���{�����v�ŧi�������C

���p�]���ϥΥ��{���ӥO�z�X����ƿ򥢩ηl���Anavyism �@�����|���t�d�C
�P�ɡAnavyism ��S���d�����z�״_����i��o�ͤ����D�ε��z���Ѩ�U�C

�o�O�@��K�O�{���A�ҥH�Ф��n�ϥΦb�ӷ~�γ~�W�C

�p�G�z��{��(�έ��O)������a��@�X�ק�A�Φb�����W�o��z�ק�L�������A
�Х����b���v�ŧi���O�d�{��(�έ��O)��@�̤λy�t�]�s�@�̪��W�r(�κ����s��)�C";
$lang[install_license_ask]		= "<center>�z�O�_�M�����դα����H�W��ĳ���Ҧ����e�H</center><br>";
$lang[install_license_agree]		= "�O���A�ڱ���";
$lang[install_license_decline]		= "���A�کڵ�����";


###################################################################################
//			�]�w MySQL ��Ʈw�s�u��T (install_er.php)
###################################################################################
$lang[install_mysql_title]		= "<span style=font-size:12pt>�]�w MySQL ��Ʈw�s�u���</span>";
$lang[install_mysql_text]		= "n@log 5 �ݭn�Q�� <b>MySQL ��Ʈw</b> �Ӧs��z�������έp��ơC<br><br>
�p�G�z�Q�n�s�� MySQL ��Ʈw�̭�����ơA�z�����P�ɾ֦� <b>MySQL �b�� (DB User)</b> �� <b>MySQL ��Ʈw�W�� (DB Name)�C</b><br><br>
�гs���z���D�����Ѫ̡A�F�ѧ�h���� MySQL ��Ʈw���]�w�ȤΨϥΤ�k�C<br>
<font color=tomato>(�`�N�GMySQL �b���� FTP �b���O��ˤ��P���F��A�Ф��n�V�c)</font>";

$lang[install_mysql_account_mysql]	= "�]�w�z�� MySQL ��Ʈw�s�u���";
$lang[install_mysql_account_nalog]	= "�]�w�z�� n@log 5 �޲z�̱b��";

$lang[install_mysql_input_db_host]	= "DB Host / ��Ʈw��}";
$lang[install_mysql_input_db_id]	= "DB User ID / ��Ʈw�n�J�W��";
$lang[install_mysql_input_db_pass]	= "DB Password / ��Ʈw�n�J�K�X";
$lang[install_mysql_input_db_name]	= "DB Name / ��Ʈw�W��";
$lang[install_mysql_input_admin_id]	= "�޲z�̵n�J�W��";
$lang[install_mysql_input_admin_pass]	= "�޲z�̵n�J�K�X";
$lang[install_mysql_input_admin_repass]	= "�A����J�޲z�̵n�J�K�X";

$lang[install_mysql_error_db_host]	= "�п�J��Ʈw��}";
$lang[install_mysql_error_db_id]	= "�п�J��Ʈw�n�J�W��";
$lang[install_mysql_error_db_pass]	= "�п�J��Ʈw�n�J�K�X";
$lang[install_mysql_error_db_name]	= "�п�J��Ʈw�W��";
$lang[install_mysql_error_admin_id]	= "�п�J�޲z�̵n�J�W��";
$lang[install_mysql_error_admin_pass]	= "�п�J�޲z�̵n�J�K�X";
$lang[install_mysql_error_admin_repass]	= "�Цb���w�����A����J�޲z�̵n�J�K�X�H�K�T�{";
$lang[install_mysql_error_admin_match]	= "�޲z�̵n�J�K�X���۰t�A�ЦA�դ@��";


###################################################################################
//			���b�i��w��... (install_ing.php)
###################################################################################
$lang[install_ing_error_db_id]		= "�s����Ʈw���ѡI\\n���ˬd��Ʈw��}�B�n�J�W�٤αK�X�O�_���T�C";
$lang[install_ing_error_db_name]	= "�s����Ʈw���ѡI\\n���ˬd��Ʈw�W��(DB Name)�O�_���T�C\\n�٬O�z�S���إ߳o�Ӹ�Ʈw�H";
$lang[install_ing_error_permission1]	= "�v���]�w�����T�I\\n�нT�w n@log ��Ƨ����v���]�w�Ȭ� 707 �� 777\\n(�ΧR�� \\'nalog_connect.php\\') �M��A�դ@���C";
$lang[install_ing_error_permission2]	= "�v���]�w�����T�I\\n�нT�w n@log ��Ƨ����v���]�w�Ȭ� 707 �� 777\\n(�ΧR�� \\'nalog_language.php\\') �M��A�դ@���C";

$lang[install_ing_finish]		= "���߱z�In@log �p�ƾ��βέp���R�{���w�g�w�˦��\�F�I";


###################################################################################
//			�u�W�ˬd������T (check.php)
###################################################################################
$lang[version_check_title]		= "<span style=font-size:12pt>�u�W�ˬd������T</span>";
$lang[version_check_this_version]	= "�z�b�Ϊ� n@log �����G";
$lang[version_check_latest_version]	= "�̷s�� n@log �����G";
$lang[version_check_update_button]	= "�U���̷s������";
$lang[version_check_close_button]	= "����";


###################################################################################
//			���޲z�̱b����� (change.php)
###################################################################################
$lang[change_admin_title]		= "<span style=font-size:12pt>���޲z�̱b�����</span>";
$lang[change_admin_text]		= "�ж�g�s���޲z�̱b�����";
$lang[change_admin_change_button]	= "�T�w�ܧ�";
$lang[change_admin_close_button]	= "����";

$lang[change_admin_id]			= "(�i�O�d����) �s���޲z�̵n�J�W��";
$lang[change_admin_pass]		= "�s���޲z�̵n�J�K�X";
$lang[change_admin_repass]		= "�A����J�s���޲z�̵n�J�K�X";

$lang[change_admin_error_admin_id]	= "�п�J�s���޲z�̵n�J�W��";
$lang[change_admin_error_admin_pass]	= "�п�J�s���޲z�̵n�J�K�X";
$lang[change_admin_error_admin_repass]	= "�Цb���w�����A����J�s���޲z�̵n�J�K�X�H�K�T�{";
$lang[change_admin_error_admin_match]	= "�޲z�̵n�J�K�X���۰t�A�ЦA�դ@��";

$lang[change_admin_finish]		= "�޲z�̱b������Ƥw�g���\���F�C";


###################################################################################
//			�Ѱ��w�˭p�ƾ��{�� (uninstall.php)
###################################################################################
$lang[uninstall_finish]			= "n@log �p�ƾ��βέp���R�{���w�g�Ѱ��w�ˤF�C\\n�p�G�z�Q�n�A���w�˳o��{�����ܡA�Э��s����\\n�{���D��Ƨ��̪� install.php �o���ɮסC";


###################################################################################
//			�޲z�̵n�J���� (login.php)
###################################################################################
$lang[login_title]			= "<span style=font-size:12pt>n@log �޲z�̵n�J</span>";
$lang[login_id]				= "�޲z�̵n�J�W��";
$lang[login_pass]			= "�޲z�̵n�J�K�X";
$lang[login_auto]			= "�۰ʵn�J�H";

$lang[login_warning_auto]		= "�p�G�z����u�۰ʵn�J�v�A�{���|�b�z���s�����]�w�z���n�J���A���u�w�n�J�v�C�@�@�@�@\\n�o�˱z�i�H���εn�X�A�C���i�J�޲z�Ҧ����ɭԫK����۰ʵn�J�C\\n�Ф��n�b�z�ϥΤ��ιq���ӤW�������X��(�Ҧp���@�B�Ǯ�)�ϥγo�\��C\\n\\n�z�T�w�n�ϥΡu�۰ʵn�J�v�ܡH";
$lang[login_error_id]			= "�п�J�޲z�̵n�J�W��";
$lang[login_error_pass]			= "�п�J�޲z�̵n�J�K�X";

$lang[login_error_id_wrong]		= "�z�ҿ�J���޲z�̵n�J�W�٨ä����T�C";
$lang[login_error_pass_wrong]		= "�z�ҿ�J���޲z�̵n�J�K�X�ä����T�C";


###################################################################################
//			n@log �޲z�Ҧ� (root.php)
###################################################################################
$lang[root_title]			= "<span style=font-size:12pt>n@log �޲z�Ҧ�</span>";
$lang[root_alt_counter_manager]		= "�]�w�z���p�ƾ�";
$lang[root_alt_version_check]		= "�u�W�ˬd n@log ���̷s�����s��";
$lang[root_alt_navyism_com]		= "���[�{���@�� navyism ������ [����]";
$lang[root_alt_change_admin]		= "���޲z�̱b�����";
$lang[root_alt_uninstall]		= "�Ѱ��w�� n@log";
$lang[root_warning_uninstall]		= "�z�O�_�T�w�n�Ѱ��w�� n@log �p�ƾ��βέp���R�{���H";

$lang[root_change_language_button]	= "�����y�t";


###################################################################################
//			�p�ƾ��޲z�� (admin.php)
###################################################################################
$lang[counter_manager_title]		= "<span style=font-size:12pt>�p�ƾ��޲z��</span>";
$lang[counter_manager_paging1]		= "&nbsp;&nbsp;�z�w�g�]�w�F";
$lang[counter_manager_paging2]		= "�ӭp�ƾ��A�ثe��ܲ�";
$lang[counter_manager_paging3]		= "��(�@";
$lang[counter_manager_paging4]		= "��)";
$lang[counter_manager_view]		= "�C���n��ܦh�֭ӭp�ƾ��G";
$lang[counter_manager_view_button]	= "���";
$lang[counter_manager_view_error]	= "�o�ä��O���T���ƥ�";

$lang[counter_manager_table_no]		= "�s��";
$lang[counter_manager_table_name]	= "�p�ƾ��W��";
$lang[counter_manager_table_config]	= "�]�w";
$lang[counter_manager_table_example]	= "�ϥΤ�k�d��";
$lang[counter_manager_table_drop]	= "�R���H";
$lang[counter_manager_table_clean]	= "�M�šH";
$lang[counter_manager_table_total]	= "�`�p�H��";
$lang[counter_manager_table_today]	= "���ѤH��";
$lang[counter_manager_table_today_peak] = "���s���H�����p";
$lang[counter_manager_table_peak]	= "�P�ɦb�u���p";
$lang[counter_manager_tablecell_view]	= "�˵�";
$lang[counter_manager_tablecell_drop]	= "�R��";
$lang[counter_manager_tablecell_clean]	= "�M��";

$lang[counter_manager_warning_drop]	= "�z�O�_�T�w�n�R���o�ӭp�ƾ��H";
$lang[counter_manager_warning_clean]	= "�z�O�_�T�w�n�M�ųo�ӭp�ƾ��H";

$lang[counter_manager_create_button]	= "�إ߭p�ƾ�";
$lang[counter_manager_error_create]	= "�п�J�p�ƾ����W�١C";


###################################################################################
//			���b�إ߭p�ƾ� (admin_ing.php)
###################################################################################
$lang[counter_create_error_name]	= "�п�J�p�ƾ����W�١C";
$lang[counter_create_error_char]	= "�u�i�H�ϥΥb�Ϊ��p�g�^��r�� (a-z)�B�ƥئr (0-9)\\n��  _  �o��ӯS��r���өR�W�p�ƾ��C";
$lang[counter_create_error_exist]	= "�o�ӭp�ƾ��w�g�s�b�F�C";
$lang[counter_create_error_blank]	= "�p�ƾ��W�٤���ϥΪťզr��(Space)�C";


###################################################################################
//			�p�ƾ��޲z�� - ���� (admin_counter.php)
###################################################################################
$lang[counter_main_plug_in]		= "�п�ܴ���";

$lang[counter_main_date_format1]	= "Y/n/j (D) H:i:s";
$lang[counter_main_not_exist]		= "�S���o�ӭp�ƾ�";

$lang[counter_main_title]		= "<span style=font-size:12pt>�p�ƾ��޲z��</span>";
$lang[counter_main_title_hour]		= "<span style=font-size:12pt>�H�C�p�ɤ��R</span>";
$lang[counter_main_title_day]		= "<span style=font-size:12pt>�H�C�Ѥ��R</span>";
$lang[counter_main_title_week]		= "<span style=font-size:12pt>�H�P���X���R</span>";
$lang[counter_main_title_month]		= "<span style=font-size:12pt>�H������R</span>";
$lang[counter_main_title_year]		= "<span style=font-size:12pt>�H�~�����R</span>";
$lang[counter_main_title_refer]		= "<span style=font-size:12pt>�H�ӷ��D�����R</span>";
$lang[counter_main_title_refer_detail]	= "<span style=font-size:12pt>�H�ӷ����}���R</span>";
$lang[counter_main_title_os]		= "<span style=font-size:12pt>�H�X�Ȫ��@�~�t�ΩM�s�����������R</span>";
$lang[counter_main_title_visitor]	= "<span style=font-size:12pt>�H�X�ȸ�Ƥ��R</span>";
$lang[counter_main_title_config]	= "<span style=font-size:12pt>�]�w�p�ƾ�</span>";

$lang[counter_main_menu_hour]		= "�C�p��";
$lang[counter_main_menu_day]		= "�C��";
$lang[counter_main_menu_week]		= "�P���X";
$lang[counter_main_menu_month]		= "���";
$lang[counter_main_menu_year]		= "�~��";
$lang[counter_main_menu_refer]		= "�ӷ��D��";
$lang[counter_main_menu_refer_detail]	= "�ӷ����}";
$lang[counter_main_menu_os]		= "OS+�s����";
$lang[counter_main_menu_visitor]	= "�X�ȸ��";
$lang[counter_main_menu_config]		= "�]�w�p�ƾ�";

$lang[counter_main_year]		= "�~";
$lang[counter_main_month]		= "��";
$lang[counter_main_day]			= "��";

$lang[counter_main_button_view]		= "���";
$lang[counter_main_button_view_all]	= "�������";
$lang[counter_main_button_print]	= "�C�L����";
$lang[counter_main_button_back]		= "��^";
$lang[counter_main_button_check_all]	= "�������";
$lang[counter_main_button_cancel_all]	= "��������";
$lang[counter_main_button_search]	= "�j�M";
$lang[counter_main_button_delete]	= "�R��������O��";


###################################################################################
//			�p�ƾ��޲z�� - �� 1 ���� (�H�C�p�ɤ��R)
###################################################################################
$lang[counter_main_1_date_format]	= "Y�~n��j��";
$lang[counter_main_1_date]		= "����G";
$lang[counter_main_1_today]		= "����";
$lang[counter_main_1_sum]		= "�ֿn�p��";
$lang[counter_main_1_total]		= "�A�`�p ";
$lang[counter_main_1_total_visitor]	= "�H��";
$lang[counter_main_1_hour_format]	= "H��";
$lang[counter_main_1_visitor]		= "�H��";
$lang[counter_main_1_view_visitor]	= "��ܩҦ��b {yy}�~{mm}��{dd}��{hh}�� �s�u���X�ȰO��";


###################################################################################
//			�p�ƾ��޲z�� - �� 2 ���� (�H�C�Ѥ��R)
###################################################################################
$lang[counter_main_2_date_format]	= "Y�~n��";
$lang[counter_main_2_month]		= "����G";
$lang[counter_main_2_this_month]	= "�����";
$lang[counter_main_2_sum]		= "�ֿn�p��";
$lang[counter_main_2_total]		= "�A�`�p ";
$lang[counter_main_2_total_visitor]	= "�H��";
$lang[counter_main_2_day_format]	= "j��";
$lang[counter_main_2_visitor]		= "�H��";
$lang[counter_main_2_view_visitor]	= "��ܦb {yy}�~{mm}��{dd}�� ��ѡA�H�C�p�ɤ��R���έp��";


###################################################################################
//			�p�ƾ��޲z�� - �� 3 ���� (�H�P���X���R)
###################################################################################
$lang[counter_main_3_sum]		= "�ֿn�p��";
$lang[counter_main_3_total]		= "�A�`�p ";
$lang[counter_main_3_total_visitor]	= "�H��";
$lang[counter_main_3_average]		= "�A�����C�P�� ";
$lang[counter_main_3_average_visitor]	= "�H��";
$lang[counter_main_3_visitor]		= "�H��";

$lang[counter_main_3_day_name0]		= "�P����";
$lang[counter_main_3_day_name1]		= "�P���@";
$lang[counter_main_3_day_name2]		= "�P���G";
$lang[counter_main_3_day_name3]		= "�P���T";
$lang[counter_main_3_day_name4]		= "�P���|";
$lang[counter_main_3_day_name5]		= "�P����";
$lang[counter_main_3_day_name6]		= "�P����";


###################################################################################
//			�p�ƾ��޲z�� - �� 4 ���� (�H������R)
###################################################################################
$lang[counter_main_4_year]		= "�~���G";
$lang[counter_main_4_this_year]		= "���~";
$lang[counter_main_4_sum]		= "�ֿn�p��";
$lang[counter_main_4_total]		= "�A�`�p ";
$lang[counter_main_4_total_visitor]	= "�H��";
$lang[counter_main_4_month_format]	= "n��";
$lang[counter_main_4_visitor]		= "�H��";
$lang[counter_main_4_view_visitor]	= "��ܦb {yy}�~{mm}�� �����A�H�C�Ѥ��R���έp��";


###################################################################################
//			�p�ƾ��޲z�� - �� 5 ���� (�H�~�����R)
###################################################################################
$lang[counter_main_5_sum]		= "�ֿn�p��";
$lang[counter_main_5_total]		= "�A�`�p ";
$lang[counter_main_5_total_visitor]	= "�H��";
$lang[counter_main_5_year_format]	= "Y�~";
$lang[counter_main_5_visitor]		= "�H��";
$lang[counter_main_5_view_visitor]	= "��ܦb {yy}�~ �����A�H������R���έp��";


###################################################################################
//			�p�ƾ��޲z�� - �� 6 ���� (�H�ӷ����}���R)
###################################################################################
$lang[counter_main_6_date_format]	= "Y�~n��j�� H:i:s";
$lang[counter_main_6_total]		= "�`�p ";
$lang[counter_main_6_total_url]		= "�Өӷ����}�A�@ ";
$lang[counter_main_6_total_visitor]	= "�H��";
$lang[counter_main_6_total_zero]	= "�S������O��";
$lang[counter_main_6_total_delete]	= "�z�O�_�T�w�n�R��������O���H";

$lang[counter_main_6_today_only]	= "�u�j�M���Ѫ�";
$lang[counter_main_6_sort_by]		= "�ƧǨ�";

$lang[counter_main_6_sort_1]		= "�s�u����(�Ѥp�ܤj)";
$lang[counter_main_6_sort_2]		= "�s�u����(�Ѥj�ܤp)";
$lang[counter_main_6_sort_3]		= "�s�u�ɶ�(�ѥH�e�}�l)";
$lang[counter_main_6_sort_4]		= "�s�u�ɶ�(�ѳ̪�}�l)";
$lang[counter_main_6_sort_5]		= "�ӷ����}(�ϡ��)";
$lang[counter_main_6_sort_6]		= "�ӷ����}(����)";

$lang[counter_main_6_search_negative]	= "���]�t�r��";
$lang[counter_main_6_search_and]	= "��";
$lang[counter_main_6_search_or] 	= "��";

$lang[counter_main_6_table_url]		= "�ӷ����}�O�����ԲӸ�� (���}�γ̫�s�u�ɶ�)";
$lang[counter_main_6_table_hit]		= "�s�u����";

$lang[counter_main_6_url_remember]	= "�ʹ�o�Ӻ��} (�N�o���O�����̳���)";
$lang[counter_main_6_url_forget]	= "�����ʹ�o�Ӻ��}";

$lang[counter_main_6_url_remember_button]="<span lang=zh-tw style=font-family:�s�ө���,PMingLiU;font-size:8pt>[ �ʹ��} ]</font>";
$lang[counter_main_6_url_forget_button]	= "<span lang=zh-tw style=font-family:�s�ө���,PMingLiU;font-size:8pt;color:#F7418C>[ �����ʹ� ]</span>";

$lang[counter_main_6_direct_connect]	= "�X�ȬO�����b�s������J���}�A�ΨϥΡu�ڪ��̷R�v��X�������C";
$lang[counter_main_6_view_detail_url]	= "��ܧ�����}";
$lang[counter_main_6_delete_button]	= "�R��";
$lang[counter_main_6_delete_question]	= "�z�O�_�T�w�n�R���o���O���H";

$lang[counter_main_6_error_pagenum]	= "�u�i�H�ϥΥb�μƥئr�ӫ��w����";


###################################################################################
//			�p�ƾ��޲z�� - �� 7 ���� (�H�X�Ȫ��@�~�t�ΩM�s�����������R)
###################################################################################
$lang[counter_main_7_total]		= "�`�p ";
$lang[counter_main_7_total_os]		= "�ا@�~�t�ΡA�@ ";
$lang[counter_main_7_total_browser]	= "���s�����A�@ ";
$lang[counter_main_7_total_visitor]	= "�H��";
$lang[counter_main_7_visitor]		= "�H��";
$lang[counter_main_7_total_zero]	= "�S������O��";

$lang[counter_main_7_title_os]		= "�X�ȨϥΪ��@�~�t��";
$lang[counter_main_7_title_browser]	= "�X�ȨϥΪ��s����";

$lang[counter_main_7_error_pagenum]	= "�u�i�H�ϥΥb�μƥئr�ӫ��w����";


###################################################################################
//			�p�ƾ��޲z�� - �� 8 ���� (�H�X�ȸ�Ƥ��R)
###################################################################################
$lang[counter_main_8_date_format]	= "Y�~n��j�� H:i:s";
$lang[counter_main_8_total]		= "�`�p ";
$lang[counter_main_8_total_visitor]	= "�H��";
$lang[counter_main_8_total_zero]	= "�S������O��";
$lang[counter_main_8_today_only]	= "�u�j�M���Ѫ�";
$lang[counter_main_8_member_only]	= "�u�j�M���Ϸ|��";
$lang[counter_main_8_sort_by]		= "�ƧǨ�";

$lang[counter_main_8_sort_1]		= "�s�u�ɶ�(�ѥH�e�}�l)";
$lang[counter_main_8_sort_2]		= "�s�u�ɶ�(�ѳ̪�}�l)";
$lang[counter_main_8_sort_3]		= "�|���n�J�W��(�ϡ��)";
$lang[counter_main_8_sort_4]		= "�|���n�J�W��(����)";

$lang[counter_main_8_title_1]		= "�X�Ȫ��|���n�J�W�١B�ӷ����}�B�@�~�t�Τ��s����";
$lang[counter_main_8_title_2]		= "�X�Ȫ�IP��}�γs�u�ɶ�";

$lang[counter_main_8_right_arrow]	= "<span style=font-size:6pt>&#9654;</span> ";
$lang[counter_main_8_direct_connect]	= "�X�ȬO�����b�s������J���}�A�ΨϥΡu�ڪ��̷R�v��X�������C";
$lang[counter_main_8_not_login]		= "���n�J";
$lang[counter_main_8_unknown_os]	= "�L�k���Ѫ��@�~�t��";
$lang[counter_main_8_unknown_browser]	= "�L�k���Ѫ��s����";
$lang[counter_main_8_search]		= "�j�M";

$lang[counter_main_8_error_pagenum]	= "�u�i�H�ϥΥb�μƥئr�ӫ��w����";


###################################################################################
//			�p�ƾ��޲z�� - �� 9 ���� (�]�w�p�ƾ�)
###################################################################################
$lang[counter_config_total]		= "�`�p�s���H��";
$lang[counter_config_skin]		= "��ܭ��O";
$lang[counter_config_skin_pattern]	= "�ϥέ��O�ϼˡH";
$lang[counter_config_skin_pattern_use]	= "�O�� (�аѦҭ��O��Ƨ��̭��� skin.php �Ӧۭq�p�ƾ��ϼ�)";
$lang[counter_config_reconnect]		= "�X�ȭ��s���J�����ɪ��B�z";
$lang[counter_config_reconnect_always]	= "�L����a�p�� (���� cookie)";
$lang[counter_config_reconnect_new_open]= "��X�ȭ��s�}���s�����ɤ~�p�� (cookie �ɭ����s��)";
$lang[counter_config_reconnect_by_time1]= "��L�F���w���ɶ���~�p�� (cookie �ɭ��� ";
$lang[counter_config_reconnect_by_time2]= " ��)";
$lang[counter_config_reconnect_once]	= "�C�ѥu��p��@��";
$lang[counter_config_time_zone1]	= "�ɰϳ]�w";
$lang[counter_config_time_zone2]	= "�p�� (����ĳ�ϥΦ��\��)<br>&nbsp;(�Ҧp: ��z�]�� +16�A�{���|�b�g�J��ƮɡA�N�ɶ��ծը�D���ɶ��� 16 �p�ɤ���)";
$lang[counter_config_admin_check]	= "�����޲z�̪��s�u�H";
$lang[counter_config_admin_check_not]	= "�O���A���n��ڪ��s�u�]�p��b��";
$lang[counter_config_now_check]		= "�O�_�n�p��ثe�u�W�H�ơH";
$lang[counter_config_now_check_use]	= "�O���A�n�P�ɭp��ثe�u�W�H��";
$lang[counter_config_now_time]		= "�p��ثe�u�W�H�ƪ��ɭ�";
$lang[counter_config_now_time_use1]	= "�b�X�ȳs�u�᪺ ";
$lang[counter_config_now_time_use2]	= " �����A�p�⬰�ثe�u�W�H�ơC(��ĳ�]�� 10 �ΥH�W���ƭ�)";
$lang[counter_config_admin_data]	= "�ɶ��ʪ��έp��ƺ޲z";
$lang[counter_config_admin_data_delete1]= "�R���ɶ��ʪ��έp���";
$lang[counter_config_admin_data_delete2]= "<br>&nbsp;�I�@�U�o�ӫ��s�A�R���Ҧ����ɶ��ʲέp���(�C�p��/�C��/�P���X/�C��/�C�~)�C";
$lang[counter_config_admin_os]		= "�@�~�t�Τ��s������<br>&nbsp;�έp��ƺ޲z";
$lang[counter_config_admin_os_delete1]	= "�R���@�~�t�Τ��s�������έp���";
$lang[counter_config_admin_os_delete2]	= "<br>&nbsp;�I�@�U�o�ӫ��s�A�R���Ҧ����@�~�t�Τ��s�����έp��ơC";
$lang[counter_config_visitor_check]	= "�O���X�Ȫ��s�u��ơH";
$lang[counter_config_visitor_check_use]	= "�O���A�ڷQ�n�N�X�Ȫ��s�u���(�]�A�n�J�W�٩MIP��})�O���U�ӡC";
$lang[counter_config_visitor_limit]	= "�X�ȳs�u��ƺ޲z";
$lang[counter_config_visitor_delete1]	= "�R���X�Ȫ��s�u���";
$lang[counter_config_visitor_delete2]	= "<br>&nbsp;�I�@�U�o�ӫ��s�A�R���Ҧ����X�ȳs�u��ơC";
$lang[counter_config_visitor_limit_set1]= "�ڷQ�n�O�d ";
$lang[counter_config_visitor_limit_set2]= " ���O�����X�ȳs�u��ơC(�]�� 0 �h�S������)";
$lang[counter_config_log_check]		= "�O���X�Ȫ��ӷ����}�H";
$lang[counter_config_log_check_use]	= "�O���A�ڷQ�n�N�X�Ȫ��ӷ����}�O���U�ӡC";
$lang[counter_config_log_limit]		= "�X�Ȩӷ����}�޲z";
$lang[counter_config_log_delete1]	= "�R���X�Ȫ��ӷ����}";
$lang[counter_config_log_delete2]	= "<br>&nbsp;�I�@�U�o�ӫ��s�A�R���Ҧ����X�Ȩӷ����}�C";
$lang[counter_config_log_limit_set1]	= "�ڷQ�n�O�d ";
$lang[counter_config_log_limit_set2]	= " ���O�����X�Ȩӷ����}�C(�]�� 0 �h�S������)";
$lang[counter_config_member_cookie]	= "�z�ҨϥΪ��ϵ{����<br>&nbsp;Cookie �|���W��";
$lang[counter_config_member_cookie_is]	= "(�Ҧp: <b>n@board 3</b> �� Cookie �|���W�٬O na3_member)";
$lang[counter_config_permission]	= "�˵���ƪ��v���]�w";
$lang[counter_config_permission1]	= "�u���޲z�̤~�i�H�˵��H�C�p�ɤ��R���έp��ơC";
$lang[counter_config_permission2]	= "�u���޲z�̤~�i�H�˵��H�C�Ѥ��R���έp��ơC";
$lang[counter_config_permission3]	= "�u���޲z�̤~�i�H�˵��H�P���X���R���έp��ơC";
$lang[counter_config_permission4]	= "�u���޲z�̤~�i�H�˵��H������R���έp��ơC";
$lang[counter_config_permission5]	= "�u���޲z�̤~�i�H�˵��H�~�����R���έp��ơC";
$lang[counter_config_permission6]	= "�u���޲z�̤~�i�H�˵��ӷ��D�����O���C";
$lang[counter_config_permission7]	= "�u���޲z�̤~�i�H�˵��ӷ����}���O���C";
$lang[counter_config_permission8]	= "�u���޲z�̤~�i�H�˵��H�@�~�t�ΩM�s�������R���έp��ơC";
$lang[counter_config_permission9]	= "�u���޲z�̤~�i�H�˵��X�ȳs�u��ƪ��O���C";

$lang[counter_config_warning_data]	= "�z�O�_�T�w�n�R���Ҧ����ɶ��ʲέp���(�C�p��/�C��/�P���X/�C��/�C�~)�H";
$lang[counter_config_warning_os]	= "�z�O�_�T�w�n�R���Ҧ����@�~�t�Τ��s�����έp��ơH";
$lang[counter_config_warning_visitor]	= "�z�O�_�T�w�n�R���Ҧ����X�ȳs�u��ơH";
$lang[counter_config_warning_log]	= "�z�O�_�T�w�n�R���Ҧ����X�Ȩӷ����}�H";

$lang[counter_config_button_save]	= "�x�s";
$lang[counter_config_button_reset]	= "���]";

$lang[counter_manager_error_not_exist]	= "�S���o�ӭp�ƾ�";
$lang[counter_manager_error_total_is]	= "�u�i�H�ϥΥb�μƥئr�ӳ]�w�`�p�s���H��";
$lang[counter_manager_error_cookie_time]= "�u�i�H�ϥΥb�μƥئr�ӳ]�w Cookie �ɭ�";
$lang[counter_manager_error_connect_time]="�u�i�H�ϥΥb�μƥئr�ӳ]�w�ثe�u�W�H�ƪ��ɭ�";
$lang[counter_manager_error_log_limit]	= "�u�i�H�ϥΥb�μƥئr�ӳ]�w�X�Ȩӷ����}�O��������";


###################################################################################
//			�ˬd IP ��}����T (check_ip.php)
###################################################################################
$lang[check_ip_title]			= "<span style=font-size:12pt>�ˬd IP ��}����T: </span>";
$lang[check_ip_support]			= "��h��T�Χ޳N�䴩";
$lang[check_ip_close]			= "��������";
$lang[check_ip_false_msg]		= "�s�� whois ���A�����ѡI<br>�й��ղ��ܥH�U�����d�߱z�Q�n����T<br><br><a href=http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip>http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip</a>";
$lang[check_ip_right_arrow]		= "<span style=font-size:6pt>&#9654;</span>";
?>
