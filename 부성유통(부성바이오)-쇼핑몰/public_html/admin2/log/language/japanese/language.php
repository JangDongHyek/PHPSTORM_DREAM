<?
####################################################################################
/*
				navyism@log analyzer 5
				���{���

* ���ӎ���:

    ' �� " ���� \ �̂悤�ȋL���͓��ʂȏꍇ�������A�g�p�o���܂���B
    ��L�̕����̓G���[�������N������肪����̂ŁA���ӂ��ĉ������B
    ' �̂悤�ȋL���͂��̑���� ` ���g���ĉ������B

*/
####################################################################################



####################################################################################
//			Include Version Info File (required)
####################################################################################
include"nalog_info.php";


####################################################################################
//			Language Information (naming in English only)
####################################################################################
$lang[name]		= "Japanese (shift-jis)";
$lang[english_name] 	= "Japanese";


####################################################################################
//			Page Header (please do not modify)
####################################################################################
$lang[head]		= "<!-----------------------------------------------------------------------------------------------------


                                 ========================================
                                 �v���O������ : navyism@log analyzer
                                 �o�[�W����   : $nalog_info[version]
                                 �z�z��  �@�@ : $nalog_info[date]
                                 ���  �@�@�@ : navyism
                                 e-mail �@    : navyism@navyism.com
                                 homepage �@  : http://navyism.com
                                 ========================================
                                 �� ��  �@�@  : ���{��@(shift-jis)
                                 �o�[�W����   : v1.0.2 for n@log 5.0.3
                                 �z�z��  �@�@ : 2003.03.05
                                 �|���       : uklife
                                 e-mail       : webmaster@uk-life.com
                                 ========================================



n@series�� PHP�� mySQL���x�[�X�ɂ���CGI�n�E�F�u�E�v���O�����ŁA
���ׂĂ̗��p�҂Ɏ��̂悤�ȋK�肪�K�p����܂��B

n@series�̒��쌠�y�єz�z���͍��(navyism)�ɂ���A
���쌠�\�L�̏�A�N�������p�A�����o���܂��B
�������A��҂Ƃ̎��O�̋��c���Ȃ��܂܁A���쌠�\�L��������͍폜�o���܂���B

n@series�̎g�p�ɂ��A�����Ȃ鑹�Q�ɑ΂��Ă���ҋy�єz�z�҂͐ӔC�𕉂��܂���B
�܂��A��ҋy�єz�z�҂Ɉێ��E��C�̋`���͂���܂���B

n@series�͌l�A��Ƌy�ђc�̂Ȃǂ̃T�C�g�Ŏ��R�ɐݒu���A�g�p�o���܂����A
��҂Ƌ��c�������An@series��ړI�Ƃ����L���݂��y�є̔��̂悤�ȏ��ƍs�ׂ͏o���܂���B

n@series�͒N�������R�Ɏ����̃T�C�g�Ŕz�z�o���܂����A
����҂�\�L���Ȃ��Ĕz�z�͏o���܂���B

------------------------------------------------------------------------------------------------------>

<html>
<head>
<title>n@log analyzer $nalog_info[version]</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=shift_jis\">
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
$lang[install_license_title]		= "���쌠 �C���X�g�[�� ����";
$lang[install_license_agreement]	= "<b>�v���O�������C���X�g�[������O�A�K�����L�̋K������ǂ݉������B</b>";
$lang[install_license_text]		= "n@series�� PHP�� mySQL���x�[�X�ɂ���CGI�n�E�F�u�E�v���O�����ŁA
���ׂĂ̗��p�҂Ɏ��̂悤�ȋK�肪�K�p����܂��B

n@series�̒��쌠�y�єz�z���͍��(navyism)�ɂ���A
���쌠�\�L�̏�A�N�������p�A�����o���܂��B
�������A��҂Ƃ̎��O�̋��c���Ȃ��܂܁A���쌠�\�L��������͍폜�o���܂���B

n@series�̎g�p�ɂ��A�����Ȃ鑹�Q�ɑ΂��Ă���ҋy�єz�z�҂͐ӔC�𕉂��܂���B
�܂��A��ҋy�єz�z�҂Ɉێ��E��C�̋`���͂���܂���B

n@series�͌l�A��Ƌy�ђc�̂Ȃǂ̃T�C�g�Ŏ��R�ɐݒu���A�g�p�o���܂����A
��҂Ƌ��c�������An@series��ړI�Ƃ����L���݂��y�є̔��̂悤�ȏ��ƍs�ׂ͏o���܂���B

n@series�͒N�������R�Ɏ����̃T�C�g�Ŕz�z�o���܂����A
����҂�\�L���Ȃ��Ĕz�z�͏o���܂���B";


$lang[install_license_ask]		= "<center>���p�K��ɓ��ӂ��܂����H</center><br>";
$lang[install_license_agree]		= "�͂��A���ӂ��܂�";
$lang[install_license_decline]		= "�������A���ӏo���܂���";


###################################################################################
//			Setup MySQL Connection (install_er.php)
###################################################################################
$lang[install_mysql_title]		= "MySQL �ڑ����ݒ�";
$lang[install_mysql_text]		= "n@log 5�� <b>MySQL database</b>�𗘗p���ď���ۑ����܂��B<br><b>MySQL database</b>�𗘗p����ɂ�<b>MySQL�A�J�E���g</b>���K�v�ł��B<br>
MySQL�A�J�E���g�Ɋւ���ڂ������e�ɂ��ẮA���̓T�[�o�[�Ǘ��҂ɖ₢���킹�������B<br><br>
<font color=tomato>(MySQL�A�J�E���g��FTP�A�J�E���g�Ƃ͈Ⴂ�܂��B)</font>";

$lang[install_mysql_account_mysql]	= "MySQL ���[�U�[�A�J�E���g������";
$lang[install_mysql_account_nalog]	= "n@log 5 �Ǘ��҃A�J�E���g�쐬";

$lang[install_mysql_input_db_host]	= "�z�X�g��";
$lang[install_mysql_input_db_id]	= "DB ID";
$lang[install_mysql_input_db_pass]	= "DB �p�X���[�h";
$lang[install_mysql_input_db_name]	= "DB��";
$lang[install_mysql_input_admin_id]	= "�Ǘ��� ID";
$lang[install_mysql_input_admin_pass]	= "�p�X���[�h";
$lang[install_mysql_input_admin_repass]	= "�p�X���[�h�ē���";

$lang[install_mysql_error_db_host]	= "�z�X�g������͂��ĉ�����";
$lang[install_mysql_error_db_id]	= "DB ID����͂��ĉ�����";
$lang[install_mysql_error_db_pass]	= "DB �p�X���[�h����͂��ĉ�����";
$lang[install_mysql_error_db_name]	= "DB������͂��ĉ�����";
$lang[install_mysql_error_admin_id]	= "�Ǘ��� ID����͂��ĉ�����";
$lang[install_mysql_error_admin_pass]	= "�Ǘ��� ID����͂��ĉ�����";
$lang[install_mysql_error_admin_repass]	= "�Ǘ��� ID��������x���͂��ĉ�����";
$lang[install_mysql_error_admin_match]	= "�Ǘ��҃p�X���[�h����v���܂���";


###################################################################################
//			When Installing... (install_ing.php)
###################################################################################
$lang[install_ing_error_db_id]		= "DB�ɐڑ��o���܂���\\nDB ID�ƃp�X���[�h���m�F���ĉ�����";
$lang[install_ing_error_db_name]	= "DB�ɐڑ��o���܂���\\nDB�����m�F���ĉ�����";
$lang[install_ing_error_permission1]	= "n@log�̃C���X�g�[���𒆎~����܂���\\n�t�H���_�[�̃p�[�~�V������707����777�łȂ����An@log�̃t�@�C�����K�؂łȂ����@�ŃR�s�[���ꂽ�Ǝv���܂�\\n\\n�܂��A�t�H���_�[�̃p�[�~�V�������m�F���Analog_connect.php���폜���Ă���ăC���X�g�[�����ĉ�����";
$lang[install_ing_error_permission2]	= "n@log�̃C���X�g�[�������~����܂���\\n�t�H���_�[�̃p�[�~�V������707����777�łȂ����An@log�̃t�@�C�����K�؂łȂ����@�ŃR�s�[���ꂽ�Ǝv���܂�\\n\\n�܂��A�t�H���_�[�̃p�[�~�V�������m�F���Analog_connect.php���폜���Ă���ăC���X�g�[�����ĉ�����";

$lang[install_ing_finish]		= "n@log analyzer�̃C���X�g�[�����������܂���";


###################################################################################
//			Version Info Check (check.php)
###################################################################################
$lang[version_check_title]		= "�ŐV�o�[�W�������";
$lang[version_check_this_version]	= "���݂̃o�[�W����: ";
$lang[version_check_latest_version]	= "�ŐV�o�[�W����: ";
$lang[version_check_update_button]	= "�A�b�v�f�[�g";
$lang[version_check_close_button]	= "����";


###################################################################################
//			Change Administration Account (change.php)
###################################################################################
$lang[change_admin_title]		= "�Ǘ��҃A�J�E���g�ύX";
$lang[change_admin_text]		= "�V�����Ǘ��҃A�J�E���g";
$lang[change_admin_change_button]	= "�ύX";
$lang[change_admin_close_button]	= "����";

$lang[change_admin_id]			= "�Ǘ��� ID";
$lang[change_admin_pass]		= "�p�X���[�h";
$lang[change_admin_repass]		= "�p�X���[�h�ē���";

$lang[change_admin_error_admin_id]	= "�ύX����Ǘ���ID����͂��ĉ�����";
$lang[change_admin_error_admin_pass]	= "�ύX����Ǘ��҃p�X���[�h����͂��ĉ�����";
$lang[change_admin_error_admin_repass]	= "�ύX����Ǘ���ID����͂��ĉ������������P�x���͂��ĉ�����";
$lang[change_admin_error_admin_match]	= "�ύX����Ǘ��҃p�X���[�h����v���܂���";

$lang[change_admin_finish]		= "�Ǘ��҃A�J�E���g���ύX����܂���";


###################################################################################
//			Program Uninstallation (uninstall.php)
###################################################################################
$lang[uninstall_finish]			= "n@log analyzer�̂��ׂĂ̏��ƃe�[�u�����폜���܂���\\n\\n�ēx�g���ꍇ�� install.php�����s���ĉ�����";


###################################################################################
//			Administrator Login Page (login.php)
###################################################################################
$lang[login_title]			= "n@log �Ǘ��� ���O�C��";
$lang[login_id]				= "ID";
$lang[login_pass]			= "�p�X���[�h";
$lang[login_auto]			= "�������O�C��";

$lang[login_warning_auto]		= "�������O�C�����g���ƃu���E�U�������ł�\\n���O�C����Ԃ��ێ����邽��\\n�p�\�R�������L����ꍇ�͒��ӂ��ĉ�����\\n\\n�������O�C�����g���܂����H";
$lang[login_error_id]			= "ID����͂��ĉ�����";
$lang[login_error_pass]			= "�p�X���[�h����͂��ĉ�����";

$lang[login_error_id_wrong]		= "ID������������܂���";
$lang[login_error_pass_wrong]		= "�p�X���[�h������������܂���";


###################################################################################
//			Root Manager (root.php)
###################################################################################
$lang[root_title]			= "�Ǘ��҃��j���[";
$lang[root_alt_counter_manager]		= "�J�E���^�Ǘ�";
$lang[root_alt_version_check]		= "�ŐV�o�[�W�����m�F";
$lang[root_alt_navyism_com]		= "n@log 5 �I�t�B�V�����T�C�g";
$lang[root_alt_change_admin]		= "�Ǘ��҃A�J�E���g�ύX";
$lang[root_alt_uninstall]		= "n@log 5 �폜";
$lang[root_warning_uninstall]		= "n@log analyzer���폜����ƁA\\n���ׂẴJ�E���^�̃��O�L�^�Ɛݒ肪�폜����܂�\\n\\n �폜���܂����H";

$lang[root_change_language_button]	= "����ύX";


###################################################################################
//			Counter Manager (admin.php)
###################################################################################
$lang[counter_manager_title]		= "�J�E���^�Ǘ�";
$lang[counter_manager_paging1]		= "&nbsp;&nbsp;�v ";
$lang[counter_manager_paging2]		= "�̃J�E���^, ���� ";
$lang[counter_manager_paging3]		= "�y�[�W, �v ";
$lang[counter_manager_paging4]		= "�y�[�W";
$lang[counter_manager_view]		= "�\������J�E���^�̐�";
$lang[counter_manager_view_button]	= "�m�F";
$lang[counter_manager_view_error]	= "���p�����œ��͂��ĉ�����";

$lang[counter_manager_table_no]		= "�ԍ�";
$lang[counter_manager_table_name]	= "�J�E���^��";
$lang[counter_manager_table_config]	= "���ݒ�";
$lang[counter_manager_table_example]	= "�T���v��";
$lang[counter_manager_table_drop]	= "�폜";
$lang[counter_manager_table_clean]	= "������";
$lang[counter_manager_table_total]	= "���v";
$lang[counter_manager_table_today]	= "����";
$lang[counter_manager_table_today_peak] = "�ő�";
$lang[counter_manager_table_peak]	= "�ő哯���ڑ�";
$lang[counter_manager_tablecell_view]	= "�T���v��";
$lang[counter_manager_tablecell_drop]	= "�폜";
$lang[counter_manager_tablecell_clean]	= "������";

$lang[counter_manager_warning_drop]	= "�I�����ꂽ�J�E���^���폜���܂�\\n��x�폜���ꂽ���͌��ɖ߂��܂���\\n\\n�����܂����H";
$lang[counter_manager_warning_clean]	= "�I�����ꂽ�J�E���^�����������܂�\\n�J�E���^�̐ݒ�͕ς��܂���\\n\\n�����܂����H";

$lang[counter_manager_create_button]	= "�J�E���^�쐬";
$lang[counter_manager_error_create]	= "�쐬����J�E���^������͂��ĉ�����";


###################################################################################
//			Creating Counter (admin_ing.php)
###################################################################################
$lang[counter_create_error_name]	= "�쐬����J�E���^������͂��ĉ�����";
$lang[counter_create_error_char]	= "�J�E���^���ɂ̓��[�}���A�����A _ �@���������L���Ȃǂ͎g���܂���";
$lang[counter_create_error_exist]	= "���݂���J�E���^���ł�";
$lang[counter_create_error_blank]	= "�J�E���^���ɂ͋󔒂������Ă͂����܂���";


###################################################################################
//			Counter Manager - Overall (admin_counter.php)
###################################################################################
$lang[counter_main_plug_in]		= "�v���O�C����I�����ĉ�����";

$lang[counter_main_date_format1]	= "Y-m-d H:i:s (D)";
$lang[counter_main_not_exist]		= "���݂��Ȃ��J�E���^�ł�";

$lang[counter_main_title]		= "�J�E���^�m�F";
$lang[counter_main_title_hour]		= "���ԕʓ��v";
$lang[counter_main_title_day]		= "����";
$lang[counter_main_title_week]		= "�j����";
$lang[counter_main_title_month]		= "����";
$lang[counter_main_title_year]		= "�N��";
$lang[counter_main_title_refer]		= "�����N�A�h���X���v (�T�[�o�[��)";
$lang[counter_main_title_refer_detail]	= "�����N�A�h���X���v (URL)";
$lang[counter_main_title_os]		= "OS & �u���E�U";
$lang[counter_main_title_visitor]	= "�K��ҏ��m�F";
$lang[counter_main_title_config]	= "�J�E���^�ݒ�";

$lang[counter_main_menu_hour]		= "���ԕ�";
$lang[counter_main_menu_day]		= "����";
$lang[counter_main_menu_week]		= "�j����";
$lang[counter_main_menu_month]		= "����";
$lang[counter_main_menu_year]		= "�N��";
$lang[counter_main_menu_refer]		= "�����N���ꂽ�T�[�o�[";
$lang[counter_main_menu_refer_detail]	= "�����N���ꂽ�y�[�W";
$lang[counter_main_menu_os]		= "OS & �u���E�U";
$lang[counter_main_menu_visitor]	= "�K���";
$lang[counter_main_menu_config]		= "���ݒ�";

$lang[counter_main_year]		= "�N";
$lang[counter_main_month]		= "��";
$lang[counter_main_day]			= "��";

$lang[counter_main_button_view]		= "�m�F";
$lang[counter_main_button_view_all]	= "�S��";
$lang[counter_main_button_print]	= "���";
$lang[counter_main_button_back]		= "�߂�";
$lang[counter_main_button_check_all]	= "���ׂđI��";
$lang[counter_main_button_cancel_all]	= "�I���L�����Z��";
$lang[counter_main_button_search]	= "����";
$lang[counter_main_button_delete]	= "�I�����ꂽ���O���폜";


###################################################################################
//			Counter Manager - Part 1 (by Hour)
###################################################################################
$lang[counter_main_1_date_format]	= "Y�N n�� j��";
$lang[counter_main_1_date]		= "���t: ";
$lang[counter_main_1_today]		= "����";
$lang[counter_main_1_sum]		= "�g�[�^��";
$lang[counter_main_1_total]		= " , ���v: ";
$lang[counter_main_1_total_visitor]	= "�l�̖K���";
$lang[counter_main_1_hour_format]	= "H��";
$lang[counter_main_1_hour]		= "��";
$lang[counter_main_1_visitor]		= "�l";
$lang[counter_main_1_view_visitor]	= "{yy}�N {mm}�� {dd}�� {hh}���̖K��҃��X�g�m�F";


###################################################################################
//			Counter Manager - Part 2 (by Day)
###################################################################################
$lang[counter_main_2_date_format]	= "Y�N n��";
$lang[counter_main_2_month]		= "��: ";
$lang[counter_main_2_this_month]	= "����";
$lang[counter_main_2_sum]		= "�g�[�^��";
$lang[counter_main_2_total]		= " , ���v: ";
$lang[counter_main_2_total_visitor]	= "�l�̖K���";
$lang[counter_main_2_day_format]	= "j��";
$lang[counter_main_2_visitor]		= "�l";
$lang[counter_main_2_view_visitor]	= "{yy}�N {mm}�� {dd}���̎��ԓ��v�m�F";


###################################################################################
//			Counter Manager - Part 3 (by Week)
###################################################################################
$lang[counter_main_3_sum]		= "�g�[�^��";
$lang[counter_main_3_total]		= " , ���v: ";
$lang[counter_main_3_total_visitor]	= "�l�̖K���";
$lang[counter_main_3_average]		= " , ���ςP�T��: ";
$lang[counter_main_3_average_visitor]	= "�l�̖K���";
$lang[counter_main_3_visitor]		= "�l";

$lang[counter_main_3_day_name0]		= "���j��";
$lang[counter_main_3_day_name1]		= "���j��";
$lang[counter_main_3_day_name2]		= "�Ηj��";
$lang[counter_main_3_day_name3]		= "���j��";
$lang[counter_main_3_day_name4]		= "�ؗj��";
$lang[counter_main_3_day_name5]		= "���j��";
$lang[counter_main_3_day_name6]		= "�y�j��";


###################################################################################
//			Counter Manager - Part 4 (by Month)
###################################################################################
$lang[counter_main_4_year]		= "�N: ";
$lang[counter_main_4_this_year]		= "���N";
$lang[counter_main_4_sum]		= "�g�[�^��";
$lang[counter_main_4_total]		= ", ���v: ";
$lang[counter_main_4_total_visitor]	= "�l�̖K���";
$lang[counter_main_4_month_format]	= "n��";
$lang[counter_main_4_visitor]		= "�l";
$lang[counter_main_4_view_visitor]	= "{yy}�N {mm}���̓��ʓ��v�m�F";


###################################################################################
//			Counter Manager - Part 5 (by Year)
###################################################################################
$lang[counter_main_5_sum]		= "�g�[�^��";
$lang[counter_main_5_total]		= ", ���v: ";
$lang[counter_main_5_total_visitor]	= "�l�̖K���";
$lang[counter_main_5_year_format]	= "Y�N";
$lang[counter_main_5_visitor]		= "�l";
$lang[counter_main_5_view_visitor]	= "{yy}�N�̌��ʓ��v�m�F";


###################################################################################
//			Counter Manager - Part 6 (by Referers - Host & URL)
###################################################################################
$lang[counter_main_6_date_format]	= "Y�N m�� d�� H�� i�� s�b";
$lang[counter_main_6_total]		= "���v: ";
$lang[counter_main_6_total_url]		= "�� URL, ";
$lang[counter_main_6_total_visitor]	= "�l�̖K���";
$lang[counter_main_6_total_zero]	= "���O�t�@�C��������܂���";
$lang[counter_main_6_total_delete]	= "�I���������O�t�@�C�����폜���܂����H";

$lang[counter_main_6_today_only]	= "�����̃��O�̂�";
$lang[counter_main_6_sort_by]		= "���׊���";

$lang[counter_main_6_sort_1]		= "�K��ҏ�";
$lang[counter_main_6_sort_2]		= "�K��ҋt��";
$lang[counter_main_6_sort_3]		= "���ԏ�";
$lang[counter_main_6_sort_4]		= "���ԋt��";
$lang[counter_main_6_sort_5]		= "URL��";
$lang[counter_main_6_sort_6]		= "URL�t��";

$lang[counter_main_6_search_negative]	= "�����p";
$lang[counter_main_6_search_and]	= "and";
$lang[counter_main_6_search_or] 	= "or";

$lang[counter_main_6_table_url]		= "�ڑ��T�[�o�[ (�z�X�g�� ���� URL�A�Ō�̐ڑ�����)";
$lang[counter_main_6_table_hit]		= "�ڑ��Ґ�";

$lang[counter_main_6_url_remember]	= "URL �L�^";
$lang[counter_main_6_url_forget]	= "URL �L�^�L�����Z��";

$lang[counter_main_6_url_remember_button]="<span lang=ja style=font-size:8pt>[ �L�^ ]</font>";
$lang[counter_main_6_url_forget_button]	= "<span lang=ja style=font-size:8pt;color:#F7418C>[�L�����Z��]</span>";

$lang[counter_main_6_direct_connect]	= "�A�h���X���ړ��� ���� ���C�ɓ���𗘗p�����K��";
$lang[counter_main_6_view_detail_url]	= "�ڍאڑ����[�g";
$lang[counter_main_6_delete_button]	= "���O�t�@�C���폜";
$lang[counter_main_6_delete_question]	= "�{���ɍ폜���Ă�낵���ł����H";

$lang[counter_main_6_error_pagenum]	= "��������͂��ĉ�����";


###################################################################################
//			Counter Manager - Part 7 (by Visitors' OS & Browser)
###################################################################################
$lang[counter_main_7_total]		= "���v: ";
$lang[counter_main_7_total_os]		= "��ނ�OS, ";
$lang[counter_main_7_total_browser]	= "��ނ̃u���E�U, ";
$lang[counter_main_7_total_visitor]	= "�l�̖K���";
$lang[counter_main_7_visitor]		= "�l";
$lang[counter_main_7_total_zero]	= "���O�t�@�C��������܂���";

$lang[counter_main_7_title_os]		= "�K��҂�OS";
$lang[counter_main_7_title_browser]	= "�K��҂̃u���E�U";

$lang[counter_main_7_error_pagenum]	= "�����œ��͂��ĉ�����";


###################################################################################
//			Counter Manager - Part 8 (by Visitors' Information)
###################################################################################
$lang[counter_main_8_date_format]	= "Y�N m�� d�� H�� i�� s�b";
$lang[counter_main_8_total]		= "���v: ";
$lang[counter_main_8_total_visitor]	= "�l�̖K���";
$lang[counter_main_8_total_zero]	= "���O�t�@�C��������܂���";
$lang[counter_main_8_today_only]	= "�����̃��O�̂�";
$lang[counter_main_8_member_only]	= "����L�^�̂�";
$lang[counter_main_8_sort_by]		= "���׊���";

$lang[counter_main_8_sort_1]		= "���ԏ�";
$lang[counter_main_8_sort_2]		= "���ԋt��";
$lang[counter_main_8_sort_3]		= "���ID��";
$lang[counter_main_8_sort_4]		= "���ID�t��";

$lang[counter_main_8_title_1]		= "�K��҂� ID / �����N���ꂽ�y�[�W / OS / �u���E�U";
$lang[counter_main_8_title_2]		= "�K��҂� IP / �K�⎞��";

$lang[counter_main_8_right_arrow]	= "<span style=font-size:6pt>&#9654;</span> ";
$lang[counter_main_8_direct_connect]	= "�A�h���X���ړ��� ���� ���C�ɓ���𗘗p�����K��";
$lang[counter_main_8_not_login]		= "���m�F";
$lang[counter_main_8_unknown_os]	= "�s����OS";
$lang[counter_main_8_unknown_browser]	= "�s���ȃu���E�U";
$lang[counter_main_8_search]		= "�K��L�^����";

$lang[counter_main_8_error_pagenum]	= "�����œ��͂��ĉ�����";


###################################################################################
//			Counter Manager - Part 9 (Configuration)
###################################################################################
$lang[counter_config_total]		= "���v�@�K��Ґ�";
$lang[counter_config_skin]		= "�X�L���ݒ�";
$lang[counter_config_skin_pattern]	= "�X�L���p�^�[���t�@�C���g�p";
$lang[counter_config_skin_pattern_use]	= "�X�L���p�^�[���t�@�C�����g�p����";
$lang[counter_config_reconnect]		= "�Đڑ��ݒ�";
$lang[counter_config_reconnect_always]	= "��ɃJ�E���^�������� (�N�b�L�[�g�p����)";
$lang[counter_config_reconnect_new_open]= "�u���E�U�ċN�����A�J�E���^�������� (�N�b�L�[���� : 0 sec)";
$lang[counter_config_reconnect_by_time1]= "�w�肳�ꂽ���Ԍ�A�J�E���^�������� (�N�b�L�[���� : ";
$lang[counter_config_reconnect_by_time2]= " sec)";
$lang[counter_config_reconnect_once]	= "����Ɉ��̂ݑ�����";
$lang[counter_config_time_zone1]	= "�L�^���ԑѕύX";
$lang[counter_config_time_zone2]	= "���� + �T�[�o�[�̌��n���� [�����ߏo���܂���]";
$lang[counter_config_admin_check]	= "�Ǘ��Ґڑ��`�F�b�N";
$lang[counter_config_admin_check_not]	= "�Ǘ��҂̐ڑ��̓J�E���^����O��";
$lang[counter_config_now_check]		= "���ݐڑ��҃`�F�b�N";
$lang[counter_config_now_check_use]	= "���ݐڑ��҂��`�F�b�N����";
$lang[counter_config_now_time]		= "�ڑ��ێ�����";
$lang[counter_config_now_time_use1]	= "";
$lang[counter_config_now_time_use2]	= " �b�ԁA�ڑ�����Ă���Ɛݒ� (10�b�ȏ�)";
$lang[counter_config_admin_data]	= "���v�����Ǘ�";
$lang[counter_config_admin_data_delete1]= "���v�L�^�폜";
$lang[counter_config_admin_data_delete2]= " ���ʁA�j���ʁA���ʁA�N�ʓ��v�L�^���폜����";
$lang[counter_config_admin_os]		= "OS & Browser �����Ǘ�";
$lang[counter_config_admin_os_delete1]	= "OS & Browser �L�^�폜";
$lang[counter_config_admin_os_delete2]	= " OS & Browser ���v���폜����";
$lang[counter_config_visitor_check]	= "�ڑ������`�F�b�N";
$lang[counter_config_visitor_check_use]	= "�K��ҋL�^�`�F�b�N";
$lang[counter_config_visitor_limit]	= "�ڑ���������";
$lang[counter_config_visitor_delete1]	= "�ڑ������폜";
$lang[counter_config_visitor_delete2]	= " �ڑ��������폜����";
$lang[counter_config_visitor_limit_set1]= "";
$lang[counter_config_visitor_limit_set2]= " �l���̋L�^�����ۑ� (0�Ŗ�����)";
$lang[counter_config_log_check]		= "���O�t�@�C���`�F�b�N";
$lang[counter_config_log_check_use]	= "�K��҂̃��O���`�F�N����";
$lang[counter_config_log_limit]		= "���O�t�@�C������";
$lang[counter_config_log_delete1]	= "���O�t�@�C���폜";
$lang[counter_config_log_delete2]	= " ���O�t�@�C�����폜����";
$lang[counter_config_log_limit_set1]	= "";
$lang[counter_config_log_limit_set2]	= " �̃��O�L�^�̂ݕۑ� (0�Ŗ�����)";
$lang[counter_config_member_cookie]	= "����敪�@�N�b�L�[��";
$lang[counter_config_member_cookie_is]	= "(<b>n@board 3:</b> na3_member)";
$lang[counter_config_permission]	= "�����ݒ�";
$lang[counter_config_permission1]	= "�Ǘ��҂̂݁A���ԕʓ��v�m�F��";
$lang[counter_config_permission2]	= "�Ǘ��҂̂݁A���ʓ��v�m�F��";
$lang[counter_config_permission3]	= "�Ǘ��҂̂݁A�j���ʓ��v�m��";
$lang[counter_config_permission4]	= "�Ǘ��҂̂݁A���ʓ��v�m�F��";
$lang[counter_config_permission5]	= "�Ǘ��҂̂݁A�N�ʓ��v�m�F��";
$lang[counter_config_permission6]	= "�Ǘ��҂̂݁A���O���v�m�F��";
$lang[counter_config_permission7]	= "�Ǘ��҂̂݁A�ڍ׃��O���v�m�F��";
$lang[counter_config_permission8]	= "�Ǘ��҂̂݁AOS/�u���E�U ���v�m�F��";
$lang[counter_config_permission9]	= "�Ǘ��҂̂݁A�K��ғ��v�m�F��";

$lang[counter_config_warning_data]	= "���v�L�^���폜�����\\n���ʁA�j���ʁA���ʁA�N�ʓ��v�����ׂč폜����܂�\\n\\n�����܂����H";
$lang[counter_config_warning_os]	= "OS & Browser �L�^���폜�����\\n�ۑ�����Ă��� OS & Browser �֘A�L�^�����ׂč폜����܂�\\n\\n�����܂����H";
$lang[counter_config_warning_visitor]	= "�K��ҋL�^���폜�����\\n�ۑ�����Ă���K��ҋL�^�����ׂč폜����܂�\\n\\n�����܂����H";
$lang[counter_config_warning_log]	= "���O�L�^���폜�����\\n�T�[�o�[�y�яڍאڑ��L�^�����ׂč폜����܂�\\n\\n�����܂����H";

$lang[counter_config_button_save]	= " �ۑ� ";
$lang[counter_config_button_reset]	= "�L�����Z��";

$lang[counter_manager_error_not_exist]	= "���݂��Ȃ��J�E���^�ł�";
$lang[counter_manager_error_total_is]	= "���v�K��Ґ��͔��p�����œ��͂��ĉ�����";
$lang[counter_manager_error_cookie_time]= "�N�b�L�[���Ԃ͔��p�����œ��͂��ĉ�����";
$lang[counter_manager_error_connect_time]="�ڑ��ێ����Ԃ͔��p�����œ��͂��ĉ�����";
$lang[counter_manager_error_log_limit]	= "���O���������͔��p�����œ��͂��ĉ�����";


###################################################################################
//			IP Address Information Check (check_ip.php)
###################################################################################
$lang[check_ip_title]			= "IP���Ɖ� : ";
$lang[check_ip_support]			= "���� �y�� �֘A���";
$lang[check_ip_close]			= "����";
$lang[check_ip_false_msg]		= "whois �T�[�o�[�Ƃ̐ڑ����o���܂���ł����B<br>���΂炭���Ă��玩���� http://www.apnic.net�� IP���m�F�y�[�W�Ɉړ����܂�<br>�����Ɉڂ�Ȃ��ꍇ�͎��̃����N���N���b�N���AIP�����m�F���ĉ�����<br><br><a href=http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip>http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip</a>";
$lang[check_ip_right_arrow]		= "<span style=font-size:6pt>&#9654;</span>";
?>
