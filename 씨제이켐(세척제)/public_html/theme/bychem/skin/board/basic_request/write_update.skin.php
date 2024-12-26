<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
echo "<script type='text/javascript' src='//wcs.naver.net/wcslog.js'></script>";
echo "<script type='text/javascript'>                                         ";
echo "if (!wcs_add) var wcs_add={};                                           ";
echo "wcs_add['wa'] = 's_eb12e45ce07';                                        ";
echo "if (!_nasa) var _nasa={};                                               ";
echo "_nasa['cnv'] = wcs.cnv('4','1');                                        ";
echo "wcs_do(_nasa);                                                          ";
echo "</script>                                                               ";
alert('문의글이 접수되었습니다. 최대한 빠른답변 드리겠습니다. 감사합니다.', G5_URL);
?>


