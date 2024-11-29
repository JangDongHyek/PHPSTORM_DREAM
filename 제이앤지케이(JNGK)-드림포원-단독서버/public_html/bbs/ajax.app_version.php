<?php
include_once("./_common.php");
/**
 * 앱 버전정보
 * code = versionCode
 * name = versionName
 */
echo $code;
echo $name;
exit;
if($member['mb_id'] == 'test66') {
    $info = sql_fetch(" select * from g5_member where mb_id = '{$member['mb_id']}' ");
    if($info['version_code'] != $code) { // 저장된 버전 정보와 현재 사용 중인 앱의 버전 정보가 다르면
        sql_query(" update g5_member set version_code = '{$code}', version_name = '{$name}' where mb_id = '{$member['mb_id']}' ");
    }
}
