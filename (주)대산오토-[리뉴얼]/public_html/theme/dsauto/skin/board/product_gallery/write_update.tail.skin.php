<?php
include_once(G5_BBS_PATH.'/watermark.php');
 
// 업로드한 이미지(첨부파일)에 워터마크 삽입
$sql_bo_file = sql_query(" select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
for ($i=0; $rows_bo_file=sql_fetch_array($sql_bo_file); $i++) {
    
    $uploaded_bo_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$rows_bo_file['bf_file'];
 
    if( file_exists($uploaded_bo_file) ){
 
        // 워터마크 삽입 함수 (텍스트, 이미지 둘 중 필요한 것을 넣으면 됩니다)
        # add_watermark_text($uploaded_bo_file, "- 워터마크 삽입 테스트. . 조용한 웹 개발자 -", G5_PATH.'/font/폰트파일.TTF');
         add_watermark_image($uploaded_bo_file, G5_THEME_PATH.'/img/watermark2.png');
    }
}

?>
