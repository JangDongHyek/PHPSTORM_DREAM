<?php
class JL {
    private $root_dir = "public_html";
    private $JS = "/js/JL.js";
    private $EDITOR_JS = "/plugin/editor/smarteditor2/js/HuskyEZCreator.js";
    private $EDITOR_HTML = "/plugin/editor/smarteditor2/SmartEditor2Skin.html";

    private $DEV = true;                //해당값이 false 이면 로그가 안찍힙니다.
    public  $DB;
    public  $URL;
    public  $ROOT;
    public static $vue_load = false;    // vue 두번 로드 되는거 방지용 static 변수는 페이지 변경시 초기화됌

    function __construct() {
        $this->INIT();
    }

    function jsonDecode($json,$encode = true) {
        // PHP 버전에 따라 json_decode가 다르게 먹힘. 버전방지
        $json = addslashes($json);
        $obj = str_replace('\\', '', $json);
        $obj = str_replace('\\\\', '', $obj);

        $obj = json_decode($obj, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("JL : ".json_last_error_msg());
        }

        // 오브젝트 비교할때가있어 파라미터가 false값일땐 모든값 decode
        if($encode) {
            // PHP 버전에 따라 decode가 다르게 먹히므로 PHP단에서 Object,Array,Boolean encode처리
            foreach ($obj as $key => $value) {
                if (is_array($obj[$key])) $obj[$key] = json_encode($obj[$key], JSON_UNESCAPED_UNICODE);
            }
        }

        return $obj;
    }

    function vueLoad($app_name = "app",$plugins = array()) {
        if(!self::$vue_load) {
            echo "<script>";
            echo "const JL_base_url = '{$this->URL}';";
            echo "const JL_dev = {$this->DEV};";
            echo "const JL_editor = '{$this->EDITOR_HTML}';";
            echo "</script>";
            echo '<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>';
            echo '<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>';
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>';
            echo "<script src='{$this->URL}{$this->JS}'></script>";

            if(in_array('editor',$plugins)) {
                echo "<script src='{$this->URL}{$this->EDITOR_JS}'></script>";
            }
            self::$vue_load = true;
        }
        echo "<script>";
        echo "document.addEventListener('DOMContentLoaded', function(){";
        echo "vueLoad('$app_name')";
        echo "}, false);";
        echo "</script>";
    }

    function includeDir($dir_name) {
        $files = $this->getDir($dir_name);

        foreach ($files as $file) include_once($file);
    }

    function deleteDir($path) {
        if(strpos($path,$this->ROOT) !== false) $dir = $path;
        else $dir = $this->ROOT.$path;

        if (!file_exists($dir)) {
            return;
        }

        $files = array_diff(scandir($dir), array('.', '..'));

        foreach ($files as $file) {
            $filePath = $dir."/".$file;

            // 파일인 경우 삭제하고, 디렉토리인 경우 재귀적으로 삭제합니다.
            if (is_dir($filePath)) {
                $this->deleteDir($filePath);
            } else {
                unlink($filePath);
            }
        }

        rmdir($dir);
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
            throw new \Exception("JL : ROOT 위치를 찾을 수 없습니다.");
        }

        //URL 구하기
        $http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '') . '://';
        $user = str_replace(str_replace($this->ROOT, '', $_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']);
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
        if(isset($_SERVER['HTTP_HOST']) && preg_match('/:[0-9]+$/', $host))
            $host = preg_replace('/:[0-9]+$/', '', $host);
        $this->URL = $http.$host.$user;

        //js파일 찾기
        if(!file_exists($this->ROOT.$this->JS)) throw new \Exception("JL : JS 위치를 찾을 수 없습니다.");

        //DB 설정
        $this->DB = array(
            "hostname" => "localhost",
            "username" => "example",
            "password" => "",
            "database" => "example"
        );
    }
}

?>
