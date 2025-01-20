<?php
/**
 * 팝업
 * @property PopupModel $PopupModel
 */
// $position = (isWordInString($_SERVER['REQUEST_URI'], 'login'))? "0" : "1";
// $popupList = (new \App\Models\PopupModel())->getTodayPopup($position);

?>
<?php
foreach ($popupList AS $key=>$pp) {
    $imgPath = UPLOAD_FOLDERS['POPUP'] . $pp['file_nm'];
    if (!file_exists($imgPath)) continue;

    $imgSrc = ASSETS_URL.'/'.uploadFileRemoveServerPath($imgPath);
    $zIndex = 999-$key;
    $hour = (int)$pp['hide_duration_hour'];
    $layerId = 'layer'.$pp['idx'];
?>
<div id="popup" class="inside pp" data-id="<?=$layerId?>" style="top:<?=$pp['layer_top']?>px; left: <?=$pp['layer_left']?>px; z-index: <?=$zIndex?>;">
    <div class="cont_pop" style="width: auto;">
        <img src="<?=$imgSrc?>">
    </div>
    <div class="btn_pop">
        <button type="button" class="btn" onclick="closePopup(this, <?=$hour?>);"><?=$hour?>시간 동안 닫기</button>
        <button type="button" class="btn" onclick="closePopup(this);">닫기</button>
    </div>
</div>
<?php } ?>

<script>
    // 팝업 체크
    const popups = document.querySelectorAll('#popup.pp');
    popups.forEach(layer => {
        const layerId = layer.getAttribute('data-id');
        // console.log(getCookie(layerId));
        if (getCookie(layerId) != 'off') {
            layer.style.display = 'block';
        }
    });

    // 팝업 닫기
    const closePopup = (element, hour) => {
        const layer = element.closest('div#popup');
        layer.style.display = 'none';
        if (hour) {
            const layerId = layer.getAttribute('data-id');
            setCookie(layerId, 'off', hour);
        }
    }
</script>