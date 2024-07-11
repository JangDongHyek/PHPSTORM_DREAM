<?
####################################################################################
/*
				navyism@log analyzer 5

			   Traditional Chinese Language Pack
				   (繁體中文語系包)

* 請留意:

    在設定字串變數內容的時候，請盡量避免使用 ' , " , \ 這些特殊字元，
    因為這些字元已被保留做為特別用途。
    如果你在字串變數內使用這些特殊字元，當程式執行時便可能會出現不可預期的錯誤。
    建議你使用其他的字元用來代替半形引號，例如半形的「 ` 」和全形的「“ ”〝〞」

*/
####################################################################################



####################################################################################
//			包含版本資訊檔 (這是必要的)
####################################################################################
include"nalog_info.php";


####################################################################################
//			語系資訊 (必須使用英文名稱)
####################################################################################
$lang[name]		= "Traditional Chinese (Big5)";
$lang[english_name] 	= "Traditional Chinese";


####################################################################################
//			頁首部份 (請不要修改任何地方)
####################################################################################
$lang[head]		= "<!-----------------------------------------------------------------------------------------------------


                                 ========================================
                                 程式名稱: navyism@log analyzer
                                 版本編號: $nalog_info[version]
                                 發表日期: $nalog_info[date]
                                 程式作者: navyism
                                 電子郵件: navyism@navyism.com
                                 網站位址: http://navyism.com
                                 ========================================
                                 語系名稱: 繁體中文 (Big5)
                                 版本編號: v1.0.2 for n@log 5.0.2
                                 發表日期: 2003.02.27
                                 語系編寫: kiddiken (驚直)
                                 電子郵件: webmaster@kiddiken.net
                                 網站位址: http://kiddiken.net
                                 ========================================



　　這支程式的版權是屬於 navyism 所有。
　　任何人都可以使用和修改這支程式，條件是您必須保留本程式版權宣告的部份。

　　假如因為使用本程式而令您蒙受資料遺失或損毀，navyism 一概不會對其負責。
　　同時，navyism 亦沒有責任替您修復任何可能發生之問題或給您提供協助。

　　這是一支免費程式，所以請不要使用在商業用途上。

　　如果您對程式(或面板)的任何地方作出修改，或在網路上發表您修改過的版本，
　　請必須在版權宣告中保留程式(或面板)原作者及語系包製作者的名字(及網站連結)。
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
$lang[copy] = "<span style='font-size:7pt'>n@log analyzer $nalog_info[version] &copy;2001-2003 </span><a href=http://navyism.com target=_blank><span style='font-size:7pt'><b>navyism</b></span></a><span lang=zh-tw class=minichi><br>[ 繁體中文語系包: <a href=http://kiddiken.net target=_blank><span lang=zh-tw class=minichi>驚直</span></a> ]</span>";


###################################################################################
//			顯示軟體授權協議 (install.php)
###################################################################################
$lang[install_license_textarea_rows]	= 10;
$lang[install_license_title]		= "<span style=font-size:12pt>軟體授權協議</span>";
$lang[install_license_agreement]	= "<b>請仔細閱讀以下的軟體授權協議。</b>";
$lang[install_license_text]		= "這支程式的版權是屬於 navyism 所有。
任何人都可以使用和修改這支程式，條件是您必須保留本程式版權宣告的部份。

假如因為使用本程式而令您蒙受資料遺失或損毀，navyism 一概不會對其負責。
同時，navyism 亦沒有責任替您修復任何可能發生之問題或給您提供協助。

這是一支免費程式，所以請不要使用在商業用途上。

如果您對程式(或面板)的任何地方作出修改，或在網路上發表您修改過的版本，
請必須在版權宣告中保留程式(或面板)原作者及語系包製作者的名字(及網站連結)。";
$lang[install_license_ask]		= "<center>您是否清楚明白及接受以上協議的所有內容？</center><br>";
$lang[install_license_agree]		= "是的，我接受";
$lang[install_license_decline]		= "不，我拒絕接受";


###################################################################################
//			設定 MySQL 資料庫連線資訊 (install_er.php)
###################################################################################
$lang[install_mysql_title]		= "<span style=font-size:12pt>設定 MySQL 資料庫連線資料</span>";
$lang[install_mysql_text]		= "n@log 5 需要利用 <b>MySQL 資料庫</b> 來存放您的網站統計資料。<br><br>
如果您想要存取 MySQL 資料庫裡面的資料，您必須同時擁有 <b>MySQL 帳號 (DB User)</b> 及 <b>MySQL 資料庫名稱 (DB Name)。</b><br><br>
請連絡您的主機提供者，了解更多關於 MySQL 資料庫的設定值及使用方法。<br>
<font color=tomato>(注意：MySQL 帳號跟 FTP 帳號是兩樣不同的東西，請不要混淆)</font>";

$lang[install_mysql_account_mysql]	= "設定您的 MySQL 資料庫連線資料";
$lang[install_mysql_account_nalog]	= "設定您的 n@log 5 管理者帳號";

$lang[install_mysql_input_db_host]	= "DB Host / 資料庫位址";
$lang[install_mysql_input_db_id]	= "DB User ID / 資料庫登入名稱";
$lang[install_mysql_input_db_pass]	= "DB Password / 資料庫登入密碼";
$lang[install_mysql_input_db_name]	= "DB Name / 資料庫名稱";
$lang[install_mysql_input_admin_id]	= "管理者登入名稱";
$lang[install_mysql_input_admin_pass]	= "管理者登入密碼";
$lang[install_mysql_input_admin_repass]	= "再次輸入管理者登入密碼";

$lang[install_mysql_error_db_host]	= "請輸入資料庫位址";
$lang[install_mysql_error_db_id]	= "請輸入資料庫登入名稱";
$lang[install_mysql_error_db_pass]	= "請輸入資料庫登入密碼";
$lang[install_mysql_error_db_name]	= "請輸入資料庫名稱";
$lang[install_mysql_error_admin_id]	= "請輸入管理者登入名稱";
$lang[install_mysql_error_admin_pass]	= "請輸入管理者登入密碼";
$lang[install_mysql_error_admin_repass]	= "請在指定的欄位再次輸入管理者登入密碼以便確認";
$lang[install_mysql_error_admin_match]	= "管理者登入密碼不相配，請再試一次";


###################################################################################
//			正在進行安裝... (install_ing.php)
###################################################################################
$lang[install_ing_error_db_id]		= "連接資料庫失敗！\\n請檢查資料庫位址、登入名稱及密碼是否正確。";
$lang[install_ing_error_db_name]	= "連接資料庫失敗！\\n請檢查資料庫名稱(DB Name)是否正確。\\n還是您沒有建立這個資料庫？";
$lang[install_ing_error_permission1]	= "權限設定不正確！\\n請確定 n@log 資料夾的權限設定值為 707 或 777\\n(或刪除 \\'nalog_connect.php\\') 然後再試一次。";
$lang[install_ing_error_permission2]	= "權限設定不正確！\\n請確定 n@log 資料夾的權限設定值為 707 或 777\\n(或刪除 \\'nalog_language.php\\') 然後再試一次。";

$lang[install_ing_finish]		= "恭喜您！n@log 計數器及統計分析程式已經安裝成功了！";


###################################################################################
//			線上檢查版本資訊 (check.php)
###################################################################################
$lang[version_check_title]		= "<span style=font-size:12pt>線上檢查版本資訊</span>";
$lang[version_check_this_version]	= "您在用的 n@log 版本：";
$lang[version_check_latest_version]	= "最新的 n@log 版本：";
$lang[version_check_update_button]	= "下載最新的版本";
$lang[version_check_close_button]	= "關閉";


###################################################################################
//			更改管理者帳號資料 (change.php)
###################################################################################
$lang[change_admin_title]		= "<span style=font-size:12pt>更改管理者帳號資料</span>";
$lang[change_admin_text]		= "請填寫新的管理者帳號資料";
$lang[change_admin_change_button]	= "確定變更";
$lang[change_admin_close_button]	= "關閉";

$lang[change_admin_id]			= "(可保留不變) 新的管理者登入名稱";
$lang[change_admin_pass]		= "新的管理者登入密碼";
$lang[change_admin_repass]		= "再次輸入新的管理者登入密碼";

$lang[change_admin_error_admin_id]	= "請輸入新的管理者登入名稱";
$lang[change_admin_error_admin_pass]	= "請輸入新的管理者登入密碼";
$lang[change_admin_error_admin_repass]	= "請在指定的欄位再次輸入新的管理者登入密碼以便確認";
$lang[change_admin_error_admin_match]	= "管理者登入密碼不相配，請再試一次";

$lang[change_admin_finish]		= "管理者帳號的資料已經成功更改了。";


###################################################################################
//			解除安裝計數器程式 (uninstall.php)
###################################################################################
$lang[uninstall_finish]			= "n@log 計數器及統計分析程式已經解除安裝了。\\n如果您想要再次安裝這支程式的話，請重新執行\\n程式主資料夾裡的 install.php 這個檔案。";


###################################################################################
//			管理者登入頁面 (login.php)
###################################################################################
$lang[login_title]			= "<span style=font-size:12pt>n@log 管理者登入</span>";
$lang[login_id]				= "管理者登入名稱";
$lang[login_pass]			= "管理者登入密碼";
$lang[login_auto]			= "自動登入？";

$lang[login_warning_auto]		= "如果您選取「自動登入」，程式會在您的瀏覽器設定您的登入狀態為「已登入」。　　　　\\n這樣您可以不用登出，每次進入管理模式的時候便能夠自動登入。\\n請不要在您使用公用電腦來上網的場合中(例如網咖、學校)使用這功能。\\n\\n您確定要使用「自動登入」嗎？";
$lang[login_error_id]			= "請輸入管理者登入名稱";
$lang[login_error_pass]			= "請輸入管理者登入密碼";

$lang[login_error_id_wrong]		= "您所輸入的管理者登入名稱並不正確。";
$lang[login_error_pass_wrong]		= "您所輸入的管理者登入密碼並不正確。";


###################################################################################
//			n@log 管理模式 (root.php)
###################################################################################
$lang[root_title]			= "<span style=font-size:12pt>n@log 管理模式</span>";
$lang[root_alt_counter_manager]		= "設定您的計數器";
$lang[root_alt_version_check]		= "線上檢查 n@log 的最新版本編號";
$lang[root_alt_navyism_com]		= "參觀程式作者 navyism 的網站 [韓文]";
$lang[root_alt_change_admin]		= "更改管理者帳號資料";
$lang[root_alt_uninstall]		= "解除安裝 n@log";
$lang[root_warning_uninstall]		= "您是否確定要解除安裝 n@log 計數器及統計分析程式？";

$lang[root_change_language_button]	= "切換語系";


###################################################################################
//			計數器管理員 (admin.php)
###################################################################################
$lang[counter_manager_title]		= "<span style=font-size:12pt>計數器管理員</span>";
$lang[counter_manager_paging1]		= "&nbsp;&nbsp;您已經設定了";
$lang[counter_manager_paging2]		= "個計數器，目前顯示第";
$lang[counter_manager_paging3]		= "頁(共";
$lang[counter_manager_paging4]		= "頁)";
$lang[counter_manager_view]		= "每頁要顯示多少個計數器：";
$lang[counter_manager_view_button]	= "顯示";
$lang[counter_manager_view_error]	= "這並不是正確的數目";

$lang[counter_manager_table_no]		= "編號";
$lang[counter_manager_table_name]	= "計數器名稱";
$lang[counter_manager_table_config]	= "設定";
$lang[counter_manager_table_example]	= "使用方法範例";
$lang[counter_manager_table_drop]	= "刪除？";
$lang[counter_manager_table_clean]	= "清空？";
$lang[counter_manager_table_total]	= "總計人次";
$lang[counter_manager_table_today]	= "今天人次";
$lang[counter_manager_table_today_peak] = "日瀏覽人次高峰";
$lang[counter_manager_table_peak]	= "同時在線高峰";
$lang[counter_manager_tablecell_view]	= "檢視";
$lang[counter_manager_tablecell_drop]	= "刪除";
$lang[counter_manager_tablecell_clean]	= "清空";

$lang[counter_manager_warning_drop]	= "您是否確定要刪除這個計數器？";
$lang[counter_manager_warning_clean]	= "您是否確定要清空這個計數器？";

$lang[counter_manager_create_button]	= "建立計數器";
$lang[counter_manager_error_create]	= "請輸入計數器的名稱。";


###################################################################################
//			正在建立計數器 (admin_ing.php)
###################################################################################
$lang[counter_create_error_name]	= "請輸入計數器的名稱。";
$lang[counter_create_error_char]	= "只可以使用半形的小寫英文字母 (a-z)、數目字 (0-9)\\n或  _  這兩個特殊字元來命名計數器。";
$lang[counter_create_error_exist]	= "這個計數器已經存在了。";
$lang[counter_create_error_blank]	= "計數器名稱不能使用空白字元(Space)。";


###################################################################################
//			計數器管理員 - 整體 (admin_counter.php)
###################################################################################
$lang[counter_main_plug_in]		= "請選擇插件";

$lang[counter_main_date_format1]	= "Y/n/j (D) H:i:s";
$lang[counter_main_not_exist]		= "沒有這個計數器";

$lang[counter_main_title]		= "<span style=font-size:12pt>計數器管理員</span>";
$lang[counter_main_title_hour]		= "<span style=font-size:12pt>以每小時分析</span>";
$lang[counter_main_title_day]		= "<span style=font-size:12pt>以每天分析</span>";
$lang[counter_main_title_week]		= "<span style=font-size:12pt>以星期幾分析</span>";
$lang[counter_main_title_month]		= "<span style=font-size:12pt>以月份分析</span>";
$lang[counter_main_title_year]		= "<span style=font-size:12pt>以年份分析</span>";
$lang[counter_main_title_refer]		= "<span style=font-size:12pt>以來源主機分析</span>";
$lang[counter_main_title_refer_detail]	= "<span style=font-size:12pt>以來源網址分析</span>";
$lang[counter_main_title_os]		= "<span style=font-size:12pt>以訪客的作業系統和瀏覽器種類分析</span>";
$lang[counter_main_title_visitor]	= "<span style=font-size:12pt>以訪客資料分析</span>";
$lang[counter_main_title_config]	= "<span style=font-size:12pt>設定計數器</span>";

$lang[counter_main_menu_hour]		= "每小時";
$lang[counter_main_menu_day]		= "每天";
$lang[counter_main_menu_week]		= "星期幾";
$lang[counter_main_menu_month]		= "月份";
$lang[counter_main_menu_year]		= "年份";
$lang[counter_main_menu_refer]		= "來源主機";
$lang[counter_main_menu_refer_detail]	= "來源網址";
$lang[counter_main_menu_os]		= "OS+瀏覽器";
$lang[counter_main_menu_visitor]	= "訪客資料";
$lang[counter_main_menu_config]		= "設定計數器";

$lang[counter_main_year]		= "年";
$lang[counter_main_month]		= "月";
$lang[counter_main_day]			= "日";

$lang[counter_main_button_view]		= "顯示";
$lang[counter_main_button_view_all]	= "全部顯示";
$lang[counter_main_button_print]	= "列印報表";
$lang[counter_main_button_back]		= "返回";
$lang[counter_main_button_check_all]	= "全部選取";
$lang[counter_main_button_cancel_all]	= "全部不選";
$lang[counter_main_button_search]	= "搜尋";
$lang[counter_main_button_delete]	= "刪除選取的記錄";


###################################################################################
//			計數器管理員 - 第 1 部份 (以每小時分析)
###################################################################################
$lang[counter_main_1_date_format]	= "Y年n月j日";
$lang[counter_main_1_date]		= "日期：";
$lang[counter_main_1_today]		= "今天";
$lang[counter_main_1_sum]		= "累積計算";
$lang[counter_main_1_total]		= "，總計 ";
$lang[counter_main_1_total_visitor]	= "人次";
$lang[counter_main_1_hour_format]	= "H時";
$lang[counter_main_1_visitor]		= "人次";
$lang[counter_main_1_view_visitor]	= "顯示所有在 {yy}年{mm}月{dd}日{hh}時 連線的訪客記錄";


###################################################################################
//			計數器管理員 - 第 2 部份 (以每天分析)
###################################################################################
$lang[counter_main_2_date_format]	= "Y年n月";
$lang[counter_main_2_month]		= "月份：";
$lang[counter_main_2_this_month]	= "本月份";
$lang[counter_main_2_sum]		= "累積計算";
$lang[counter_main_2_total]		= "，總計 ";
$lang[counter_main_2_total_visitor]	= "人次";
$lang[counter_main_2_day_format]	= "j日";
$lang[counter_main_2_visitor]		= "人次";
$lang[counter_main_2_view_visitor]	= "顯示在 {yy}年{mm}月{dd}日 當天，以每小時分析的統計表";


###################################################################################
//			計數器管理員 - 第 3 部份 (以星期幾分析)
###################################################################################
$lang[counter_main_3_sum]		= "累積計算";
$lang[counter_main_3_total]		= "，總計 ";
$lang[counter_main_3_total_visitor]	= "人次";
$lang[counter_main_3_average]		= "，平均每星期 ";
$lang[counter_main_3_average_visitor]	= "人次";
$lang[counter_main_3_visitor]		= "人次";

$lang[counter_main_3_day_name0]		= "星期日";
$lang[counter_main_3_day_name1]		= "星期一";
$lang[counter_main_3_day_name2]		= "星期二";
$lang[counter_main_3_day_name3]		= "星期三";
$lang[counter_main_3_day_name4]		= "星期四";
$lang[counter_main_3_day_name5]		= "星期五";
$lang[counter_main_3_day_name6]		= "星期六";


###################################################################################
//			計數器管理員 - 第 4 部份 (以月份分析)
###################################################################################
$lang[counter_main_4_year]		= "年份：";
$lang[counter_main_4_this_year]		= "今年";
$lang[counter_main_4_sum]		= "累積計算";
$lang[counter_main_4_total]		= "，總計 ";
$lang[counter_main_4_total_visitor]	= "人次";
$lang[counter_main_4_month_format]	= "n月";
$lang[counter_main_4_visitor]		= "人次";
$lang[counter_main_4_view_visitor]	= "顯示在 {yy}年{mm}月 期間，以每天分析的統計表";


###################################################################################
//			計數器管理員 - 第 5 部份 (以年份分析)
###################################################################################
$lang[counter_main_5_sum]		= "累積計算";
$lang[counter_main_5_total]		= "，總計 ";
$lang[counter_main_5_total_visitor]	= "人次";
$lang[counter_main_5_year_format]	= "Y年";
$lang[counter_main_5_visitor]		= "人次";
$lang[counter_main_5_view_visitor]	= "顯示在 {yy}年 期間，以月份分析的統計表";


###################################################################################
//			計數器管理員 - 第 6 部份 (以來源網址分析)
###################################################################################
$lang[counter_main_6_date_format]	= "Y年n月j日 H:i:s";
$lang[counter_main_6_total]		= "總計 ";
$lang[counter_main_6_total_url]		= "個來源網址，共 ";
$lang[counter_main_6_total_visitor]	= "人次";
$lang[counter_main_6_total_zero]	= "沒有任何記錄";
$lang[counter_main_6_total_delete]	= "您是否確定要刪除選取的記錄？";

$lang[counter_main_6_today_only]	= "只搜尋今天的";
$lang[counter_main_6_sort_by]		= "排序依";

$lang[counter_main_6_sort_1]		= "連線次數(由小至大)";
$lang[counter_main_6_sort_2]		= "連線次數(由大至小)";
$lang[counter_main_6_sort_3]		= "連線時間(由以前開始)";
$lang[counter_main_6_sort_4]		= "連線時間(由最近開始)";
$lang[counter_main_6_sort_5]		= "來源網址(Ａ～Ｚ)";
$lang[counter_main_6_sort_6]		= "來源網址(Ｚ～Ａ)";

$lang[counter_main_6_search_negative]	= "不包含字串";
$lang[counter_main_6_search_and]	= "及";
$lang[counter_main_6_search_or] 	= "或";

$lang[counter_main_6_table_url]		= "來源網址記錄的詳細資料 (網址及最後連線時間)";
$lang[counter_main_6_table_hit]		= "連線次數";

$lang[counter_main_6_url_remember]	= "監察這個網址 (將這筆記錄放到最頂端)";
$lang[counter_main_6_url_forget]	= "取消監察這個網址";

$lang[counter_main_6_url_remember_button]="<span lang=zh-tw style=font-family:新細明體,PMingLiU;font-size:8pt>[ 監察位址 ]</font>";
$lang[counter_main_6_url_forget_button]	= "<span lang=zh-tw style=font-family:新細明體,PMingLiU;font-size:8pt;color:#F7418C>[ 取消監察 ]</span>";

$lang[counter_main_6_direct_connect]	= "訪客是直接在瀏覽器輸入網址，或使用「我的最愛」到訪網站的。";
$lang[counter_main_6_view_detail_url]	= "顯示完整網址";
$lang[counter_main_6_delete_button]	= "刪除";
$lang[counter_main_6_delete_question]	= "您是否確定要刪除這筆記錄？";

$lang[counter_main_6_error_pagenum]	= "只可以使用半形數目字來指定頁數";


###################################################################################
//			計數器管理員 - 第 7 部份 (以訪客的作業系統和瀏覽器種類分析)
###################################################################################
$lang[counter_main_7_total]		= "總計 ";
$lang[counter_main_7_total_os]		= "種作業系統，共 ";
$lang[counter_main_7_total_browser]	= "種瀏覽器，共 ";
$lang[counter_main_7_total_visitor]	= "人次";
$lang[counter_main_7_visitor]		= "人次";
$lang[counter_main_7_total_zero]	= "沒有任何記錄";

$lang[counter_main_7_title_os]		= "訪客使用的作業系統";
$lang[counter_main_7_title_browser]	= "訪客使用的瀏覽器";

$lang[counter_main_7_error_pagenum]	= "只可以使用半形數目字來指定頁數";


###################################################################################
//			計數器管理員 - 第 8 部份 (以訪客資料分析)
###################################################################################
$lang[counter_main_8_date_format]	= "Y年n月j日 H:i:s";
$lang[counter_main_8_total]		= "總計 ";
$lang[counter_main_8_total_visitor]	= "人次";
$lang[counter_main_8_total_zero]	= "沒有任何記錄";
$lang[counter_main_8_today_only]	= "只搜尋今天的";
$lang[counter_main_8_member_only]	= "只搜尋社區會員";
$lang[counter_main_8_sort_by]		= "排序依";

$lang[counter_main_8_sort_1]		= "連線時間(由以前開始)";
$lang[counter_main_8_sort_2]		= "連線時間(由最近開始)";
$lang[counter_main_8_sort_3]		= "會員登入名稱(Ａ～Ｚ)";
$lang[counter_main_8_sort_4]		= "會員登入名稱(Ｚ～Ａ)";

$lang[counter_main_8_title_1]		= "訪客的會員登入名稱、來源網址、作業系統及瀏覽器";
$lang[counter_main_8_title_2]		= "訪客的IP位址及連線時間";

$lang[counter_main_8_right_arrow]	= "<span style=font-size:6pt>&#9654;</span> ";
$lang[counter_main_8_direct_connect]	= "訪客是直接在瀏覽器輸入網址，或使用「我的最愛」到訪網站的。";
$lang[counter_main_8_not_login]		= "未登入";
$lang[counter_main_8_unknown_os]	= "無法辨識的作業系統";
$lang[counter_main_8_unknown_browser]	= "無法辨識的瀏覽器";
$lang[counter_main_8_search]		= "搜尋";

$lang[counter_main_8_error_pagenum]	= "只可以使用半形數目字來指定頁數";


###################################################################################
//			計數器管理員 - 第 9 部份 (設定計數器)
###################################################################################
$lang[counter_config_total]		= "總計瀏覽人次";
$lang[counter_config_skin]		= "選擇面板";
$lang[counter_config_skin_pattern]	= "使用面板圖樣？";
$lang[counter_config_skin_pattern_use]	= "是的 (請參考面板資料夾裡面的 skin.php 來自訂計數器圖樣)";
$lang[counter_config_reconnect]		= "訪客重新載入頁面時的處理";
$lang[counter_config_reconnect_always]	= "無條件地計算 (忽略 cookie)";
$lang[counter_config_reconnect_new_open]= "當訪客重新開啟瀏覽器時才計算 (cookie 時限為零秒)";
$lang[counter_config_reconnect_by_time1]= "當過了指定的時間後才計算 (cookie 時限為 ";
$lang[counter_config_reconnect_by_time2]= " 秒)";
$lang[counter_config_reconnect_once]	= "每天只能計算一次";
$lang[counter_config_time_zone1]	= "時區設定";
$lang[counter_config_time_zone2]	= "小時 (不建議使用此功能)<br>&nbsp;(例如: 當您設為 +16，程式會在寫入資料時，將時間調校到主機時間的 16 小時之後)";
$lang[counter_config_admin_check]	= "忽略管理者的連線？";
$lang[counter_config_admin_check_not]	= "是的，不要把我的連線也計算在內";
$lang[counter_config_now_check]		= "是否要計算目前線上人數？";
$lang[counter_config_now_check_use]	= "是的，要同時計算目前線上人數";
$lang[counter_config_now_time]		= "計算目前線上人數的時限";
$lang[counter_config_now_time_use1]	= "在訪客連線後的 ";
$lang[counter_config_now_time_use2]	= " 秒之內，計算為目前線上人數。(建議設為 10 或以上的數值)";
$lang[counter_config_admin_data]	= "時間性的統計資料管理";
$lang[counter_config_admin_data_delete1]= "刪除時間性的統計資料";
$lang[counter_config_admin_data_delete2]= "<br>&nbsp;點一下這個按鈕，刪除所有的時間性統計資料(每小時/每天/星期幾/每月/每年)。";
$lang[counter_config_admin_os]		= "作業系統及瀏覽器的<br>&nbsp;統計資料管理";
$lang[counter_config_admin_os_delete1]	= "刪除作業系統及瀏覽器的統計資料";
$lang[counter_config_admin_os_delete2]	= "<br>&nbsp;點一下這個按鈕，刪除所有的作業系統及瀏覽器統計資料。";
$lang[counter_config_visitor_check]	= "記錄訪客的連線資料？";
$lang[counter_config_visitor_check_use]	= "是的，我想要將訪客的連線資料(包括登入名稱和IP位址)記錄下來。";
$lang[counter_config_visitor_limit]	= "訪客連線資料管理";
$lang[counter_config_visitor_delete1]	= "刪除訪客的連線資料";
$lang[counter_config_visitor_delete2]	= "<br>&nbsp;點一下這個按鈕，刪除所有的訪客連線資料。";
$lang[counter_config_visitor_limit_set1]= "我想要保留 ";
$lang[counter_config_visitor_limit_set2]= " 筆記錄的訪客連線資料。(設為 0 則沒有限制)";
$lang[counter_config_log_check]		= "記錄訪客的來源網址？";
$lang[counter_config_log_check_use]	= "是的，我想要將訪客的來源網址記錄下來。";
$lang[counter_config_log_limit]		= "訪客來源網址管理";
$lang[counter_config_log_delete1]	= "刪除訪客的來源網址";
$lang[counter_config_log_delete2]	= "<br>&nbsp;點一下這個按鈕，刪除所有的訪客來源網址。";
$lang[counter_config_log_limit_set1]	= "我想要保留 ";
$lang[counter_config_log_limit_set2]	= " 筆記錄的訪客來源網址。(設為 0 則沒有限制)";
$lang[counter_config_member_cookie]	= "您所使用社區程式的<br>&nbsp;Cookie 會員名稱";
$lang[counter_config_member_cookie_is]	= "(例如: <b>n@board 3</b> 的 Cookie 會員名稱是 na3_member)";
$lang[counter_config_permission]	= "檢視資料的權限設定";
$lang[counter_config_permission1]	= "只有管理者才可以檢視以每小時分析的統計資料。";
$lang[counter_config_permission2]	= "只有管理者才可以檢視以每天分析的統計資料。";
$lang[counter_config_permission3]	= "只有管理者才可以檢視以星期幾分析的統計資料。";
$lang[counter_config_permission4]	= "只有管理者才可以檢視以月份分析的統計資料。";
$lang[counter_config_permission5]	= "只有管理者才可以檢視以年份分析的統計資料。";
$lang[counter_config_permission6]	= "只有管理者才可以檢視來源主機的記錄。";
$lang[counter_config_permission7]	= "只有管理者才可以檢視來源網址的記錄。";
$lang[counter_config_permission8]	= "只有管理者才可以檢視以作業系統和瀏覽器分析的統計資料。";
$lang[counter_config_permission9]	= "只有管理者才可以檢視訪客連線資料的記錄。";

$lang[counter_config_warning_data]	= "您是否確定要刪除所有的時間性統計資料(每小時/每天/星期幾/每月/每年)？";
$lang[counter_config_warning_os]	= "您是否確定要刪除所有的作業系統及瀏覽器統計資料？";
$lang[counter_config_warning_visitor]	= "您是否確定要刪除所有的訪客連線資料？";
$lang[counter_config_warning_log]	= "您是否確定要刪除所有的訪客來源網址？";

$lang[counter_config_button_save]	= "儲存";
$lang[counter_config_button_reset]	= "重設";

$lang[counter_manager_error_not_exist]	= "沒有這個計數器";
$lang[counter_manager_error_total_is]	= "只可以使用半形數目字來設定總計瀏覽人次";
$lang[counter_manager_error_cookie_time]= "只可以使用半形數目字來設定 Cookie 時限";
$lang[counter_manager_error_connect_time]="只可以使用半形數目字來設定目前線上人數的時限";
$lang[counter_manager_error_log_limit]	= "只可以使用半形數目字來設定訪客來源網址記錄的筆數";


###################################################################################
//			檢查 IP 位址的資訊 (check_ip.php)
###################################################################################
$lang[check_ip_title]			= "<span style=font-size:12pt>檢查 IP 位址的資訊: </span>";
$lang[check_ip_support]			= "更多資訊或技術支援";
$lang[check_ip_close]			= "關閉視窗";
$lang[check_ip_false_msg]		= "連接 whois 伺服器失敗！<br>請嘗試移至以下頁面查詢您想要的資訊<br><br><a href=http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip>http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip</a>";
$lang[check_ip_right_arrow]		= "<span style=font-size:6pt>&#9654;</span>";
?>
