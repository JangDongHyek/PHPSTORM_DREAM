<html>
<head>
<title>PHP Example</title>
</head>

<body>

<?php

  $filename = "50_1_20180408_090041.jpg120.jpg";

  // 파일에 EXIF 정보가 기록되어 있는지 확인
  if (exif_read_data($filename, 'IFD0'))
    echo "EXIF 데이터 발견<br />\n";
  else
    echo "EXIF 없음<br />\n";



  echo "<br /><br /><br />\n\n\n"; // 줄바꿈



  $exif = exif_read_data($filename, 0, true);

  foreach ($exif as $key => $section) {
    foreach ($section as $name => $val) {
      if ($key == "EXIF") {
        if ($name == "MakerNote" ||
            $name == "ComponentsConfiguration" ||
            $name == "FileSource" ||
            $name == "SceneType" ||
            $name == "CFAPattern"
            )
          continue;
      }
      echo "$key.$name: $val<br />\n";
    }
  }



?>

</body>
</html>
