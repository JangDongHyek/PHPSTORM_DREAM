<?
	$site_path = exec("pwd");

	$handle = opendir($site_path);

	//echo "시작<br>";
	trans_flash($handle, $site_path);

	function trans_flash($handle, $site_path)
	{
		while($file = readdir($handle))
		{
			if ($file == '.' || $file == '..' || $file == "trans_flash.php")
				continue;

			/*if(is_dir($site_path."/".$file))
			{
				trans_flash(opendir($site_path."/".$file), $site_path."/".$file);
				continue;
			}*/

			if(is_file($site_path."/".$file) && $file == "index.php")
			{
				if(eregi("\.htm",$file)||eregi("\.php",$file))
				{
					//echo $site_path."/".$file." 변경중 -> ";
					trans_file($site_path."/".$file);
					//echo " 변경 완료.<br>";
				}
			}
		}
	}

	function trans_file($file)
	{
		$i = 0;
		$fd = fopen ($file."", "r");

		while (!feof ($fd))
		{
			$data = fgets($fd, 4096);

			if(eregi("<object.*clsid:D27CDB6E-AE6D-11cf-96B8-444553540000.*>", $data))
			{
				$data = rtrim($data);
				$a_object = split("/[\s]+/", $data);
				for($i=0; $i<count($a_object); $i++)
					echo "$a_object[$i]<br>";
				$script_start = "<script>mEmbed(";
				$trans = true;
			}

			if(eregi("<param.*name=(\"|\')?movie", $data) && $trans)
			{
				$data = eregi_replace("<param.*name=(\"|\')?movie(\"|\')?.*value=(\"|\')?", "'src=", $data);
				$data= eregi_replace('(\"|\')?>', "'", $data);
				$data = trim($data);
			}

			if(eregi('<param.*name=(\"|\')?', $data) && $trans)
			{
				$param_name = eregi_replace('<param(.|^>)*name=(\"|\')?', "", $data);

				$data = eregi_replace('">', "'", $data);
				$data = trim($data);
			}

			if(eregi('<param name="wmode" value="', $data) && $trans)
			{
				$data = eregi_replace('<param name="wmode" value="', ",'wmode=", $data);
				$data = eregi_replace('">', "'", $data);
				$data = rtrim($data);
			}

			if(eregi('<param name="menu" value="', $data) && $trans)
			{
				$data = eregi_replace('<param name="menu" value="', ",'menu=", $data);
				$data = eregi_replace('">', "'", $data);
				$data = rtrim($data);
			}

			if(eregi("<embed", $data) && $trans)
			{
				$data = eregi_replace("<embed.*width=\"",",'width=",$data);
				$data = eregi_replace("\" height=\"","', 'height=",$data);
				$data = eregi_replace("\"></embed>", "')", $data);
				$data = rtrim($data);
			}

			if(eregi("</object>", $data) && $trans)
			{
				$data = eregi_replace("</object>","</script>",$data);
				$trans = false;
			}

			echo $data;
		}
		fclose ($fd);

		//$fd = fopen ($file."", "w");
		//fwrite($fd, $newfile);
		//fclose ($fd);
	}

?>
