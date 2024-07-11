<html>
<head>
<title>PHP Example</title>
</head>

<body>

<?php

  $filename = "50_1_20180408_090041.jpg120.jpg";

  // ���Ͽ� EXIF ������ ��ϵǾ� �ִ��� Ȯ��
  if (exif_read_data($filename, 'IFD0'))
    echo "EXIF ������ �߰�<br />\n";
  else
    echo "EXIF ����<br />\n";



  echo "<br /><br /><br />\n\n\n"; // �ٹٲ�



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
