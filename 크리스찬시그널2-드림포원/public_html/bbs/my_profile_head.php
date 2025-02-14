<?php

$uri = $_SERVER["REQUEST_URI"];
?>
<ul class="profilecate cf">
    <li <?php if(strpos($uri, 'my_profile01') == true){ echo "class='active'"; } ?>><a href="javascript:void(0);" onclick="save('my_profile01.php');">배우자 정보</a></li>
    <li <?php if(strpos($uri, 'my_profile02') == true){ echo "class='active'"; } ?>><a href="javascript:void(0);" onclick="save('my_profile02.php');">신앙정보</a></li>
    <li <?php if(strpos($uri, 'my_profile04') == true){ echo "class='active'"; } ?>><a href="javascript:void(0);" onclick="save('my_profile04.php');">사진정보</a></li>
    <li <?php if(strpos($uri, 'my_profile03') == true){ echo "class='active'"; } ?>><a href="javascript:void(0);" onclick="save('my_profile03.php');">나의정보</a></li>
    <li <?php if(strpos($uri, 'my_profile05') == true){ echo "class='active'"; } ?>><a href="javascript:void(0);" onclick="save('my_profile05.php');">학벌/연봉/재산정보</a></li>
    <li <?php if(strpos($uri, 'file_upload_form') == true){ echo "class='active'"; } ?>><a href="javascript:void(0);" onclick="save('file_upload_form.php');">서류정보</a></li>
    <!--
    <li <?php if(strpos($uri, 'my_profile06') == true){ echo "class='active'"; } ?>><a href="javascript:void(0);" onclick="save('my_profile06.php');">서류정보</a></li>
    -->
</ul>
