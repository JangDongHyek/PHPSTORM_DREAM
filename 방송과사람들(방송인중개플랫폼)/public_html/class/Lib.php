<?php
class JL {
    private $root_dir = "public_html";
    private $JS = "/js/jang.js";
    public  $URL;
    public  $ROOT;

    function __construct() {
        $this->INIT();
    }

    function vueLoad($app_name = "app") {
        echo "<script>";
        echo "const JL_app_name = '{$app_name}';";
        echo "const JL_base_url = '{$this->URL}';";
        echo "</script>";
        echo '<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>';
        echo "<script src='{$this->URL}{$this->JS}?name={$app_name}'></script>";
    }

    function includeDir($dir_name) {
        $files = $this->getDir($dir_name);

        foreach ($files as $file) include_once($file);
    }

    function getDir($dir_name, $dirs = false, $root_path = true)
    {
        $dir = $dir_name;
        if (!strpos($dir_name, "public_html")) $dir = $this->ROOT . $dir_name;
        $ffs = scandir($dir);
        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);
        if (count($ffs) < 1) return;

        $result = array();
        foreach ($ffs as $ff) {
            if (!$dirs && !strpos($ff, ".php")) continue;

            if ($root_path) $filename = $dir;
            $filename .= "/".$ff;


            array_push($result,$filename);
        }

        return $result;
    }

    function INIT() {
        //ROOT 위치 찾기
        $root = __FILE__;
        $position = strpos($root, $this->root_dir);

        if ($position !== false) {
            $this->ROOT = substr($root, 0, $position).$this->root_dir;
        }else {
            throw new Exception("ROOT 위치를 찾을 수 없습니다.");
        }

        //URL 구하기
        $http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '') . '://';
        $user = str_replace(str_replace($this->ROOT, '', $_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']);
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
        if(isset($_SERVER['HTTP_HOST']) && preg_match('/:[0-9]+$/', $host))
            $host = preg_replace('/:[0-9]+$/', '', $host);
        $this->URL = $http.$host.$user;

        //js파일 찾기
        if(!file_exists($this->ROOT.$this->JS)) throw new Exception("JS 위치를 찾을 수 없습니다.");
    }
}

?>
