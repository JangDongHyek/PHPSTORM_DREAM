<?
####################################################################################
/*
				navyism@log analyzer 5
				日本語版

* 注意事項:

    ' と " 又は \ のような記号は特別な場合を除き、使用出来ません。
    上記の文字はエラーを引き起こす問題があるので、注意して下さい。
    ' のような記号はその代わりに ` を使って下さい。

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
                                 プログラム名 : navyism@log analyzer
                                 バージョン   : $nalog_info[version]
                                 配布日  　　 : $nalog_info[date]
                                 作者  　　　 : navyism
                                 e-mail 　    : navyism@navyism.com
                                 homepage 　  : http://navyism.com
                                 ========================================
                                 言 語  　　  : 日本語　(shift-jis)
                                 バージョン   : v1.0.2 for n@log 5.0.3
                                 配布日  　　 : 2003.03.05
                                 翻訳者       : uklife
                                 e-mail       : webmaster@uk-life.com
                                 ========================================



n@seriesは PHPと mySQLをベースにするCGI系ウェブ・プログラムで、
すべての利用者に次のような規定が適用されます。

n@seriesの著作権及び配布権は作者(navyism)にあり、
著作権表記の上、誰もが利用、改造出来ます。
ただし、作者との事前の協議がないまま、著作権表記を訂正又は削除出来ません。

n@seriesの使用による、いかなる損害に対しても作者及び配布者は責任を負いません。
また、作者及び配布者に維持・補修の義務はありません。

n@seriesは個人、企業及び団体などのサイトで自由に設置し、使用出来ますが、
作者と協議をせず、n@seriesを目的とした有料貸し及び販売のような商業行為は出来ません。

n@seriesは誰もが自由に自分のサイトで配布出来ますが、
原作者を表記しない再配布は出来ません。

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
$lang[install_license_title]		= "著作権 インストール 同意";
$lang[install_license_agreement]	= "<b>プログラムをインストールする前、必ず下記の規約をお読み下さい。</b>";
$lang[install_license_text]		= "n@seriesは PHPと mySQLをベースにするCGI系ウェブ・プログラムで、
すべての利用者に次のような規定が適用されます。

n@seriesの著作権及び配布権は作者(navyism)にあり、
著作権表記の上、誰もが利用、改造出来ます。
ただし、作者との事前の協議がないまま、著作権表記を訂正又は削除出来ません。

n@seriesの使用による、いかなる損害に対しても作者及び配布者は責任を負いません。
また、作者及び配布者に維持・補修の義務はありません。

n@seriesは個人、企業及び団体などのサイトで自由に設置し、使用出来ますが、
作者と協議をせず、n@seriesを目的とした有料貸し及び販売のような商業行為は出来ません。

n@seriesは誰もが自由に自分のサイトで配布出来ますが、
原作者を表記しない再配布は出来ません。";


$lang[install_license_ask]		= "<center>利用規約に同意しますか？</center><br>";
$lang[install_license_agree]		= "はい、同意します";
$lang[install_license_decline]		= "いいえ、同意出来ません";


###################################################################################
//			Setup MySQL Connection (install_er.php)
###################################################################################
$lang[install_mysql_title]		= "MySQL 接続情報設定";
$lang[install_mysql_text]		= "n@log 5は <b>MySQL database</b>を利用して情報を保存します。<br><b>MySQL database</b>を利用するには<b>MySQLアカウント</b>が必要です。<br>
MySQLアカウントに関する詳しい内容については、情報はサーバー管理者に問い合わせ下さい。<br><br>
<font color=tomato>(MySQLアカウントはFTPアカウントとは違います。)</font>";

$lang[install_mysql_account_mysql]	= "MySQL ユーザーアカウント情報入力";
$lang[install_mysql_account_nalog]	= "n@log 5 管理者アカウント作成";

$lang[install_mysql_input_db_host]	= "ホスト名";
$lang[install_mysql_input_db_id]	= "DB ID";
$lang[install_mysql_input_db_pass]	= "DB パスワード";
$lang[install_mysql_input_db_name]	= "DB名";
$lang[install_mysql_input_admin_id]	= "管理者 ID";
$lang[install_mysql_input_admin_pass]	= "パスワード";
$lang[install_mysql_input_admin_repass]	= "パスワード再入力";

$lang[install_mysql_error_db_host]	= "ホスト名を入力して下さい";
$lang[install_mysql_error_db_id]	= "DB IDを入力して下さい";
$lang[install_mysql_error_db_pass]	= "DB パスワードを入力して下さい";
$lang[install_mysql_error_db_name]	= "DB名を入力して下さい";
$lang[install_mysql_error_admin_id]	= "管理者 IDを入力して下さい";
$lang[install_mysql_error_admin_pass]	= "管理者 IDを入力して下さい";
$lang[install_mysql_error_admin_repass]	= "管理者 IDをもう一度入力して下さい";
$lang[install_mysql_error_admin_match]	= "管理者パスワードが一致しません";


###################################################################################
//			When Installing... (install_ing.php)
###################################################################################
$lang[install_ing_error_db_id]		= "DBに接続出来ません\\nDB IDとパスワードを確認して下さい";
$lang[install_ing_error_db_name]	= "DBに接続出来ません\\nDB名を確認して下さい";
$lang[install_ing_error_permission1]	= "n@logのインストールを中止されました\\nフォルダーのパーミションが707又は777でないか、n@logのファイルが適切でない方法でコピーされたと思われます\\n\\nまず、フォルダーのパーミションを確認し、nalog_connect.phpを削除してから再インストールして下さい";
$lang[install_ing_error_permission2]	= "n@logのインストールが中止されました\\nフォルダーのパーミションが707又は777でないか、n@logのファイルが適切でない方法でコピーされたと思われます\\n\\nまず、フォルダーのパーミションを確認し、nalog_connect.phpを削除してから再インストールして下さい";

$lang[install_ing_finish]		= "n@log analyzerのインストールが完了しました";


###################################################################################
//			Version Info Check (check.php)
###################################################################################
$lang[version_check_title]		= "最新バージョン情報";
$lang[version_check_this_version]	= "現在のバージョン: ";
$lang[version_check_latest_version]	= "最新バージョン: ";
$lang[version_check_update_button]	= "アップデート";
$lang[version_check_close_button]	= "閉じる";


###################################################################################
//			Change Administration Account (change.php)
###################################################################################
$lang[change_admin_title]		= "管理者アカウント変更";
$lang[change_admin_text]		= "新しい管理者アカウント";
$lang[change_admin_change_button]	= "変更";
$lang[change_admin_close_button]	= "閉じる";

$lang[change_admin_id]			= "管理者 ID";
$lang[change_admin_pass]		= "パスワード";
$lang[change_admin_repass]		= "パスワード再入力";

$lang[change_admin_error_admin_id]	= "変更する管理者IDを入力して下さい";
$lang[change_admin_error_admin_pass]	= "変更する管理者パスワードを入力して下さい";
$lang[change_admin_error_admin_repass]	= "変更する管理者IDを入力して下さいをもう１度入力して下さい";
$lang[change_admin_error_admin_match]	= "変更する管理者パスワードが一致しません";

$lang[change_admin_finish]		= "管理者アカウントが変更されました";


###################################################################################
//			Program Uninstallation (uninstall.php)
###################################################################################
$lang[uninstall_finish]			= "n@log analyzerのすべての情報とテーブルを削除しました\\n\\n再度使う場合は install.phpを実行して下さい";


###################################################################################
//			Administrator Login Page (login.php)
###################################################################################
$lang[login_title]			= "n@log 管理者 ログイン";
$lang[login_id]				= "ID";
$lang[login_pass]			= "パスワード";
$lang[login_auto]			= "自動ログイン";

$lang[login_warning_auto]		= "自動ログインを使うとブラウザを閉じた後でも\\nログイン状態を維持するため\\nパソコンを共有する場合は注意して下さい\\n\\n自動ログインを使いますか？";
$lang[login_error_id]			= "IDを入力して下さい";
$lang[login_error_pass]			= "パスワードを入力して下さい";

$lang[login_error_id_wrong]		= "IDが正しくありません";
$lang[login_error_pass_wrong]		= "パスワードが正しくありません";


###################################################################################
//			Root Manager (root.php)
###################################################################################
$lang[root_title]			= "管理者メニュー";
$lang[root_alt_counter_manager]		= "カウンタ管理";
$lang[root_alt_version_check]		= "最新バージョン確認";
$lang[root_alt_navyism_com]		= "n@log 5 オフィシャルサイト";
$lang[root_alt_change_admin]		= "管理者アカウント変更";
$lang[root_alt_uninstall]		= "n@log 5 削除";
$lang[root_warning_uninstall]		= "n@log analyzerを削除すると、\\nすべてのカウンタのログ記録と設定が削除されます\\n\\n 削除しますか？";

$lang[root_change_language_button]	= "言語変更";


###################################################################################
//			Counter Manager (admin.php)
###################################################################################
$lang[counter_manager_title]		= "カウンタ管理";
$lang[counter_manager_paging1]		= "&nbsp;&nbsp;計 ";
$lang[counter_manager_paging2]		= "個のカウンタ, 現在 ";
$lang[counter_manager_paging3]		= "ページ, 計 ";
$lang[counter_manager_paging4]		= "ページ";
$lang[counter_manager_view]		= "表示するカウンタの数";
$lang[counter_manager_view_button]	= "確認";
$lang[counter_manager_view_error]	= "半角数字で入力して下さい";

$lang[counter_manager_table_no]		= "番号";
$lang[counter_manager_table_name]	= "カウンタ名";
$lang[counter_manager_table_config]	= "環境設定";
$lang[counter_manager_table_example]	= "サンプル";
$lang[counter_manager_table_drop]	= "削除";
$lang[counter_manager_table_clean]	= "初期化";
$lang[counter_manager_table_total]	= "合計";
$lang[counter_manager_table_today]	= "今日";
$lang[counter_manager_table_today_peak] = "最大";
$lang[counter_manager_table_peak]	= "最大同時接続";
$lang[counter_manager_tablecell_view]	= "サンプル";
$lang[counter_manager_tablecell_drop]	= "削除";
$lang[counter_manager_tablecell_clean]	= "初期化";

$lang[counter_manager_warning_drop]	= "選択されたカウンタを削除します\\n一度削除された情報は元に戻せません\\n\\n続けますか？";
$lang[counter_manager_warning_clean]	= "選択されたカウンタを初期化します\\nカウンタの設定は変わりません\\n\\n続けますか？";

$lang[counter_manager_create_button]	= "カウンタ作成";
$lang[counter_manager_error_create]	= "作成するカウンタ名を入力して下さい";


###################################################################################
//			Creating Counter (admin_ing.php)
###################################################################################
$lang[counter_create_error_name]	= "作成するカウンタ名を入力して下さい";
$lang[counter_create_error_char]	= "カウンタ名にはローマ字、数字、 _ 　を除いた記号などは使えません";
$lang[counter_create_error_exist]	= "存在するカウンタ名です";
$lang[counter_create_error_blank]	= "カウンタ名には空白があってはいけません";


###################################################################################
//			Counter Manager - Overall (admin_counter.php)
###################################################################################
$lang[counter_main_plug_in]		= "プラグインを選択して下さい";

$lang[counter_main_date_format1]	= "Y-m-d H:i:s (D)";
$lang[counter_main_not_exist]		= "存在しないカウンタです";

$lang[counter_main_title]		= "カウンタ確認";
$lang[counter_main_title_hour]		= "時間別統計";
$lang[counter_main_title_day]		= "日別";
$lang[counter_main_title_week]		= "曜日別";
$lang[counter_main_title_month]		= "月別";
$lang[counter_main_title_year]		= "年別";
$lang[counter_main_title_refer]		= "リンクアドレス統計 (サーバー名)";
$lang[counter_main_title_refer_detail]	= "リンクアドレス統計 (URL)";
$lang[counter_main_title_os]		= "OS & ブラウザ";
$lang[counter_main_title_visitor]	= "訪問者情報確認";
$lang[counter_main_title_config]	= "カウンタ設定";

$lang[counter_main_menu_hour]		= "時間別";
$lang[counter_main_menu_day]		= "日別";
$lang[counter_main_menu_week]		= "曜日別";
$lang[counter_main_menu_month]		= "月別";
$lang[counter_main_menu_year]		= "年別";
$lang[counter_main_menu_refer]		= "リンクされたサーバー";
$lang[counter_main_menu_refer_detail]	= "リンクされたページ";
$lang[counter_main_menu_os]		= "OS & ブラウザ";
$lang[counter_main_menu_visitor]	= "訪問者";
$lang[counter_main_menu_config]		= "環境設定";

$lang[counter_main_year]		= "年";
$lang[counter_main_month]		= "月";
$lang[counter_main_day]			= "日";

$lang[counter_main_button_view]		= "確認";
$lang[counter_main_button_view_all]	= "全部";
$lang[counter_main_button_print]	= "印刷";
$lang[counter_main_button_back]		= "戻る";
$lang[counter_main_button_check_all]	= "すべて選択";
$lang[counter_main_button_cancel_all]	= "選択キャンセル";
$lang[counter_main_button_search]	= "検索";
$lang[counter_main_button_delete]	= "選択されたログを削除";


###################################################################################
//			Counter Manager - Part 1 (by Hour)
###################################################################################
$lang[counter_main_1_date_format]	= "Y年 n月 j日";
$lang[counter_main_1_date]		= "日付: ";
$lang[counter_main_1_today]		= "今日";
$lang[counter_main_1_sum]		= "トータル";
$lang[counter_main_1_total]		= " , 合計: ";
$lang[counter_main_1_total_visitor]	= "人の訪問者";
$lang[counter_main_1_hour_format]	= "H時";
$lang[counter_main_1_hour]		= "時";
$lang[counter_main_1_visitor]		= "人";
$lang[counter_main_1_view_visitor]	= "{yy}年 {mm}月 {dd}日 {hh}時の訪問者リスト確認";


###################################################################################
//			Counter Manager - Part 2 (by Day)
###################################################################################
$lang[counter_main_2_date_format]	= "Y年 n月";
$lang[counter_main_2_month]		= "月: ";
$lang[counter_main_2_this_month]	= "今月";
$lang[counter_main_2_sum]		= "トータル";
$lang[counter_main_2_total]		= " , 合計: ";
$lang[counter_main_2_total_visitor]	= "人の訪問者";
$lang[counter_main_2_day_format]	= "j日";
$lang[counter_main_2_visitor]		= "人";
$lang[counter_main_2_view_visitor]	= "{yy}年 {mm}月 {dd}日の時間統計確認";


###################################################################################
//			Counter Manager - Part 3 (by Week)
###################################################################################
$lang[counter_main_3_sum]		= "トータル";
$lang[counter_main_3_total]		= " , 合計: ";
$lang[counter_main_3_total_visitor]	= "人の訪問者";
$lang[counter_main_3_average]		= " , 平均１週間: ";
$lang[counter_main_3_average_visitor]	= "人の訪問者";
$lang[counter_main_3_visitor]		= "人";

$lang[counter_main_3_day_name0]		= "日曜日";
$lang[counter_main_3_day_name1]		= "月曜日";
$lang[counter_main_3_day_name2]		= "火曜日";
$lang[counter_main_3_day_name3]		= "水曜日";
$lang[counter_main_3_day_name4]		= "木曜日";
$lang[counter_main_3_day_name5]		= "金曜日";
$lang[counter_main_3_day_name6]		= "土曜日";


###################################################################################
//			Counter Manager - Part 4 (by Month)
###################################################################################
$lang[counter_main_4_year]		= "年: ";
$lang[counter_main_4_this_year]		= "今年";
$lang[counter_main_4_sum]		= "トータル";
$lang[counter_main_4_total]		= ", 合計: ";
$lang[counter_main_4_total_visitor]	= "人の訪問者";
$lang[counter_main_4_month_format]	= "n月";
$lang[counter_main_4_visitor]		= "人";
$lang[counter_main_4_view_visitor]	= "{yy}年 {mm}月の日別統計確認";


###################################################################################
//			Counter Manager - Part 5 (by Year)
###################################################################################
$lang[counter_main_5_sum]		= "トータル";
$lang[counter_main_5_total]		= ", 合計: ";
$lang[counter_main_5_total_visitor]	= "人の訪問者";
$lang[counter_main_5_year_format]	= "Y年";
$lang[counter_main_5_visitor]		= "人";
$lang[counter_main_5_view_visitor]	= "{yy}年の月別統計確認";


###################################################################################
//			Counter Manager - Part 6 (by Referers - Host & URL)
###################################################################################
$lang[counter_main_6_date_format]	= "Y年 m月 d日 H時 i分 s秒";
$lang[counter_main_6_total]		= "合計: ";
$lang[counter_main_6_total_url]		= "つの URL, ";
$lang[counter_main_6_total_visitor]	= "人の訪問者";
$lang[counter_main_6_total_zero]	= "ログファイルがありません";
$lang[counter_main_6_total_delete]	= "選択したログファイルを削除しますか？";

$lang[counter_main_6_today_only]	= "今日のログのみ";
$lang[counter_main_6_sort_by]		= "並べ換え";

$lang[counter_main_6_sort_1]		= "訪問者順";
$lang[counter_main_6_sort_2]		= "訪問者逆順";
$lang[counter_main_6_sort_3]		= "時間順";
$lang[counter_main_6_sort_4]		= "時間逆順";
$lang[counter_main_6_sort_5]		= "URL順";
$lang[counter_main_6_sort_6]		= "URL逆順";

$lang[counter_main_6_search_negative]	= "検索用";
$lang[counter_main_6_search_and]	= "and";
$lang[counter_main_6_search_or] 	= "or";

$lang[counter_main_6_table_url]		= "接続サーバー (ホスト名 又は URL、最後の接続時間)";
$lang[counter_main_6_table_hit]		= "接続者数";

$lang[counter_main_6_url_remember]	= "URL 記録";
$lang[counter_main_6_url_forget]	= "URL 記録キャンセル";

$lang[counter_main_6_url_remember_button]="<span lang=ja style=font-size:8pt>[ 記録 ]</font>";
$lang[counter_main_6_url_forget_button]	= "<span lang=ja style=font-size:8pt;color:#F7418C>[キャンセル]</span>";

$lang[counter_main_6_direct_connect]	= "アドレス直接入力 又は お気に入りを利用した訪問";
$lang[counter_main_6_view_detail_url]	= "詳細接続ルート";
$lang[counter_main_6_delete_button]	= "ログファイル削除";
$lang[counter_main_6_delete_question]	= "本当に削除してよろしいですか？";

$lang[counter_main_6_error_pagenum]	= "数字を入力して下さい";


###################################################################################
//			Counter Manager - Part 7 (by Visitors' OS & Browser)
###################################################################################
$lang[counter_main_7_total]		= "合計: ";
$lang[counter_main_7_total_os]		= "種類のOS, ";
$lang[counter_main_7_total_browser]	= "種類のブラウザ, ";
$lang[counter_main_7_total_visitor]	= "人の訪問者";
$lang[counter_main_7_visitor]		= "人";
$lang[counter_main_7_total_zero]	= "ログファイルがありません";

$lang[counter_main_7_title_os]		= "訪問者のOS";
$lang[counter_main_7_title_browser]	= "訪問者のブラウザ";

$lang[counter_main_7_error_pagenum]	= "数字で入力して下さい";


###################################################################################
//			Counter Manager - Part 8 (by Visitors' Information)
###################################################################################
$lang[counter_main_8_date_format]	= "Y年 m月 d日 H時 i分 s秒";
$lang[counter_main_8_total]		= "合計: ";
$lang[counter_main_8_total_visitor]	= "人の訪問者";
$lang[counter_main_8_total_zero]	= "ログファイルがありません";
$lang[counter_main_8_today_only]	= "今日のログのみ";
$lang[counter_main_8_member_only]	= "会員記録のみ";
$lang[counter_main_8_sort_by]		= "並べ換え";

$lang[counter_main_8_sort_1]		= "時間順";
$lang[counter_main_8_sort_2]		= "時間逆順";
$lang[counter_main_8_sort_3]		= "会員ID順";
$lang[counter_main_8_sort_4]		= "会員ID逆順";

$lang[counter_main_8_title_1]		= "訪問者の ID / リンクされたページ / OS / ブラウザ";
$lang[counter_main_8_title_2]		= "訪問者の IP / 訪問時刻";

$lang[counter_main_8_right_arrow]	= "<span style=font-size:6pt>&#9654;</span> ";
$lang[counter_main_8_direct_connect]	= "アドレス直接入力 又は お気に入りを利用した訪問";
$lang[counter_main_8_not_login]		= "未確認";
$lang[counter_main_8_unknown_os]	= "不明なOS";
$lang[counter_main_8_unknown_browser]	= "不明なブラウザ";
$lang[counter_main_8_search]		= "訪問記録検索";

$lang[counter_main_8_error_pagenum]	= "数字で入力して下さい";


###################################################################################
//			Counter Manager - Part 9 (Configuration)
###################################################################################
$lang[counter_config_total]		= "合計　訪問者数";
$lang[counter_config_skin]		= "スキン設定";
$lang[counter_config_skin_pattern]	= "スキンパターンファイル使用";
$lang[counter_config_skin_pattern_use]	= "スキンパターンファイルを使用する";
$lang[counter_config_reconnect]		= "再接続設定";
$lang[counter_config_reconnect_always]	= "常にカウンタが増える (クッキー使用無し)";
$lang[counter_config_reconnect_new_open]= "ブラウザ再起動時、カウンタが増える (クッキー時間 : 0 sec)";
$lang[counter_config_reconnect_by_time1]= "指定された時間後、カウンタが増える (クッキー時間 : ";
$lang[counter_config_reconnect_by_time2]= " sec)";
$lang[counter_config_reconnect_once]	= "一日に一回のみ増える";
$lang[counter_config_time_zone1]	= "記録時間帯変更";
$lang[counter_config_time_zone2]	= "時間 + サーバーの現地時間 [お勧め出来ません]";
$lang[counter_config_admin_check]	= "管理者接続チェック";
$lang[counter_config_admin_check_not]	= "管理者の接続はカウンタから外す";
$lang[counter_config_now_check]		= "現在接続者チェック";
$lang[counter_config_now_check_use]	= "現在接続者をチェックする";
$lang[counter_config_now_time]		= "接続維持時間";
$lang[counter_config_now_time_use1]	= "";
$lang[counter_config_now_time_use2]	= " 秒間、接続されていると設定 (10秒以上)";
$lang[counter_config_admin_data]	= "統計資料管理";
$lang[counter_config_admin_data_delete1]= "統計記録削除";
$lang[counter_config_admin_data_delete2]= " 日別、曜日別、月別、年別統計記録を削除する";
$lang[counter_config_admin_os]		= "OS & Browser 資料管理";
$lang[counter_config_admin_os_delete1]	= "OS & Browser 記録削除";
$lang[counter_config_admin_os_delete2]	= " OS & Browser 統計を削除する";
$lang[counter_config_visitor_check]	= "接続資料チェック";
$lang[counter_config_visitor_check_use]	= "訪問者記録チェック";
$lang[counter_config_visitor_limit]	= "接続資料制限";
$lang[counter_config_visitor_delete1]	= "接続資料削除";
$lang[counter_config_visitor_delete2]	= " 接続資料を削除する";
$lang[counter_config_visitor_limit_set1]= "";
$lang[counter_config_visitor_limit_set2]= " 人分の記録だけ保存 (0で無制限)";
$lang[counter_config_log_check]		= "ログファイルチェック";
$lang[counter_config_log_check_use]	= "訪問者のログをチェクする";
$lang[counter_config_log_limit]		= "ログファイル制限";
$lang[counter_config_log_delete1]	= "ログファイル削除";
$lang[counter_config_log_delete2]	= " ログファイルを削除する";
$lang[counter_config_log_limit_set1]	= "";
$lang[counter_config_log_limit_set2]	= " 個のログ記録のみ保存 (0で無制限)";
$lang[counter_config_member_cookie]	= "会員区分　クッキー名";
$lang[counter_config_member_cookie_is]	= "(<b>n@board 3:</b> na3_member)";
$lang[counter_config_permission]	= "権限設定";
$lang[counter_config_permission1]	= "管理者のみ、時間別統計確認可";
$lang[counter_config_permission2]	= "管理者のみ、日別統計確認可";
$lang[counter_config_permission3]	= "管理者のみ、曜日別統計確可";
$lang[counter_config_permission4]	= "管理者のみ、月別統計確認可";
$lang[counter_config_permission5]	= "管理者のみ、年別統計確認可";
$lang[counter_config_permission6]	= "管理者のみ、ログ統計確認可";
$lang[counter_config_permission7]	= "管理者のみ、詳細ログ統計確認可";
$lang[counter_config_permission8]	= "管理者のみ、OS/ブラウザ 統計確認可";
$lang[counter_config_permission9]	= "管理者のみ、訪問者統計確認可";

$lang[counter_config_warning_data]	= "統計記録を削除すると\\n日別、曜日別、月別、年別統計がすべて削除されます\\n\\n続けますか？";
$lang[counter_config_warning_os]	= "OS & Browser 記録を削除すると\\n保存されている OS & Browser 関連記録がすべて削除されます\\n\\n続けますか？";
$lang[counter_config_warning_visitor]	= "訪問者記録を削除すると\\n保存されている訪問者記録がすべて削除されます\\n\\n続けますか？";
$lang[counter_config_warning_log]	= "ログ記録を削除すると\\nサーバー及び詳細接続記録がすべて削除されます\\n\\n続けますか？";

$lang[counter_config_button_save]	= " 保存 ";
$lang[counter_config_button_reset]	= "キャンセル";

$lang[counter_manager_error_not_exist]	= "存在しないカウンタです";
$lang[counter_manager_error_total_is]	= "合計訪問者数は半角数字で入力して下さい";
$lang[counter_manager_error_cookie_time]= "クッキー時間は半角数字で入力して下さい";
$lang[counter_manager_error_connect_time]="接続維持時間は半角数字で入力して下さい";
$lang[counter_manager_error_log_limit]	= "ログ資料制限は半角数字で入力して下さい";


###################################################################################
//			IP Address Information Check (check_ip.php)
###################################################################################
$lang[check_ip_title]			= "IP情報照会 : ";
$lang[check_ip_support]			= "質問 及び 関連情報";
$lang[check_ip_close]			= "閉じる";
$lang[check_ip_false_msg]		= "whois サーバーとの接続が出来ませんでした。<br>しばらくしてから自動に http://www.apnic.netの IP情報確認ページに移動します<br>自動に移らない場合は次のリンクをクリックし、IP情報を確認して下さい<br><br><a href=http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip>http://www.apnic.net/apnic-bin/whois.pl?searchtext=$ip</a>";
$lang[check_ip_right_arrow]		= "<span style=font-size:6pt>&#9654;</span>";
?>
