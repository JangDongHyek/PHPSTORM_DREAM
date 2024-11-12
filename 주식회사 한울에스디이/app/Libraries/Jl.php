<?php
/*
    해당 모듈은 5.4부터 최적화 되어있습니다.
    4.* 은 사용이 아예 불가능하고 5.2는 부분적으로 사용가능하나 바꿔줘야할 부분이 꽤 있습니다.

    CI3
    CI3 에 적용시킬려면 namespace 를 사용하지않고 컨트롤러 상위에
    require_once APPPATH.'libraries/Jl.php'; 추가시켜주면 됩니다.
    $CI 를 true 직접 바꿔줘야합니다

    CI4
    CI4 에 적용시킬려면 밑에 namespace 를 지정해주면 됩니다.
    JlModel, JlFile 모두 namespace 를 추가해주셔야 합니다.
 */
namespace App\Libraries;
require_once("JlDefine.php");
class Jl {
    private $root_dir;
    private $JS;
    public $EDITOR_JS;
    public $EDITOR_HTML;
    public $CI;
    public $COMPONENT;


    protected $PHP;                         // JlFile 에서 사용
    private $DEV = false;                   //해당값이 false 이면 로그가 안찍힙니다. INIT()에서 자동으로 바뀝니다.
    private $DEV_IP = array();
    public  $ROOT;
    public  $DB;
    public  $URL;
    public static $LOAD = false;            // vue 두번 로드 되는거 방지용 static 변수는 페이지 변경시 초기화됌

    function __construct() {
        if(!defined("JL_CHECK")) $this->error("Define 파일이 로드가 안됐습니다.");
        array_push($this->DEV_IP,"121.140.204.65"); // 드림포원 내부 IP
        array_push($this->DEV_IP,"59.19.201.109"); // 아이티포원 내부 IP

        $this->root_dir = JL_ROOT_DIR;
        $this->JS = JL_JS;
        $this->EDITOR_JS = JL_EDITOR_JS;
        $this->EDITOR_HTML = JL_EDITOR_HTML;
        $this->CI = JL_CI;
        $this->COMPONENT = JL_COMPONENT;

        $this->INIT();
    }

    function error($msg) {
        $trace = debug_backtrace();
        $trace = array_reverse($trace);
        $er = array(
            "success" => false,
            "message" => $msg
        );

        if($this->DEV) {
            foreach($trace as $index => $t) {
                $er['file_'.$index] = $t['file'];
                $er['line_'.$index] = $t['line'];
            }
        }

        echo json_encode($er,JSON_UNESCAPED_UNICODE,JSON_UNESCAPED_SLASHES);
        die();
        //throw new \Exception($msg);
    }

    function jsonDecode($origin_json,$encode = true) {
        $str_json = stripslashes($origin_json);

        $obj = json_decode($str_json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $json = str_replace('\\n', '###NEWLINE###', $origin_json); // textarea 값 그대로 저장하기위한 변경
            $json = str_replace('\"', '###NEWQUOTATION###', $json);
            $json = str_replace('\\', '', $json);
            $json = str_replace('\\\\', '', $json);
            $json = str_replace('###NEWLINE###', '\\n', $json);
            $json = str_replace('###NEWQUOTATION###', '\"', $json);

            $obj = json_decode($json, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $msg = "Jl jsonDecode()";
                if($this->DEV) {
                    $msg .= "\norigin : $origin_json";
                    $msg .= "\nstripslashes : $str_json";
                    $msg .= "\nreplace : $json";
                }
                $this->error("Jl jsonDecode()\norigin : ".$origin_json."\nreplace : $json");
            }
        }

        // 오브젝트 비교할때가있어 파라미터가 false값일땐 모든값 decode
        if($encode) {
            // PHP 버전에 따라 decode가 다르게 먹히므로 PHP단에서 Object,Array,Boolean encode처리
            foreach ($obj as $key => $value) {
                if (is_array($obj[$key])) $obj[$key] = json_encode($obj[$key], JSON_UNESCAPED_UNICODE);
                if (is_object($obj[$key])) $obj[$key] = json_encode($obj[$key], JSON_UNESCAPED_UNICODE);
            }
        }

        return $obj;
    }

    function jsLoad() {
        //js파일 찾기
        if(!file_exists($this->ROOT.$this->JS."/Jl.js")) $this->error("Jl INIT() : Jl.js 위치를 찾을 수 없습니다.");

        echo "<script>";
        echo "const Jl_base_url = '{$this->URL}';";
        echo "const Jl_dev = ".json_encode($this->DEV).";";     // false 일때 빈값으로 들어가 jl 에러가 나와 encode처리
        echo "const Jl_editor = '{$this->EDITOR_HTML}';";
        echo "const Jl_editor_js = '{$this->EDITOR_JS}';";
        //Vue 데이터 연동을 위한 변수
        echo "let Jl_data = {};";
        echo "let Jl_methods = {};";
        echo "let Jl_watch = {};";
        echo "let Jl_components = {};";
        echo "let Jl_computed = {};";
        echo "</script>";
        echo "<script src='{$this->URL}{$this->JS}/Jl.js'></script>";
        if(file_exists($this->ROOT.$this->JS."/JlJavascript.js")) echo "<script src='{$this->URL}{$this->JS}/JlJavascript.js'></script>";
        if(file_exists($this->ROOT.$this->JS."/JlVue.js")) echo "<script src='{$this->URL}{$this->JS}/JlVue.js'></script>";
        echo "<script>";
        echo "const jl = new Jl();";
        echo "</script>";
    }

    function vueLoad($app_name = "app",$plugins = array()) {
        if(!self::$LOAD) {
            $this->jsLoad();
            echo '<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>';

            if(in_array('drag',$plugins)) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>';
                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>';
            }
            self::$LOAD = true;
        }
        echo "<script>";
        echo "document.addEventListener('DOMContentLoaded', function(){";
        echo "vueLoad('$app_name')";
        echo "}, false);";
        echo "</script>";
    }

    function componentLoad($path) {
        if($path[0] != "/") $path = "/".$path;
        $path = $this->ROOT.$this->COMPONENT.$path;

        if(is_file($path)) {
            include_once($path);
        }else if(is_file($path.".php")){
            include_once($path.".php");
        }else if(is_dir($path)) {
            $this->includeDir($path);
        }else {
            $this->error("Jl componentLoad() : $path 가 존재하지않습니다.");
        }
    }

    function includeDir($dir_name) {
        $files = $this->getDir($dir_name);

        foreach ($files as $file) include_once($file);
    }

    function isAssociativeArray(array $array) {
        // 배열이 비어 있는 경우, 연관 배열이 아닌 것으로 간주합니다.
        if (empty($array)) {
            return false;
        }

        // 모든 키를 검사하여, 하나라도 연관된 키(비연속적이거나 문자열)가 있는지 확인합니다.
        return array_keys($array) !== range(0, count($array) - 1);
    }

    function deleteDir($path) {
        if($path == "") {
            $this->error("Jl deleteDir() : 삭제 할려는 폴더가 빈값입니다.");
        }
        if($path == $this->ROOT) {
            $this->error("Jl deleteDir() : 삭제 할려는 폴더가 루트 디렉토리입니다.");
        }
        if(strpos($path,$this->ROOT) !== false) $dir = $path;
        else $dir = $this->ROOT.$path;


        if (!file_exists($dir)) {
            $this->error("Jl deleteDir() : 삭제 할려는 폴더가 존재하지 않습니다.");
        }

        $files = array_diff(scandir($dir), array('.', '..'));

        foreach ($files as $file) {
            $filePath = $dir."/".$file;

            if (is_dir($filePath)) {
                //$this->deleteDir($filePath); // 해당부분은 너무 위험해서 주석처리
                $this->error("Jl deleteDir() : 삭제 할려는 폴더안에 폴더가 또 있습니다 폴더부터 지운후 진행해주세요.");
            } else {
                unlink($filePath);
            }
        }
        rmdir($dir);
    }

    function getDirPermission($dir) {
        if (strpos($dir, $this->ROOT) === false) $dir = $this->ROOT . $dir;

        $permissions = fileperms($dir);

        if ($permissions === false) {
            $this->error("Jl getDirPermission() : 권한을 확인할 수 없습니다. 경로가 올바른지 확인하세요.");
        }

        // 권한 비트를 추출하여 8진수 문자열로 변환
        return substr(sprintf('%o', $permissions & 0777), -4); // 4자리 8진수 문자열 반환
    }

    function getDir($dir_name, $dirs = false, $root_path = true)
    {
        $dir = $dir_name;
        if (strpos($dir_name, $this->ROOT) === false) $dir = $this->ROOT . $dir_name;
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

    function stringDateToDate($dateString) {
        // 월과 일을 추출
        preg_match('/(\d+)월 (\d+)일/', $dateString, $matches);

        if (isset($matches[1]) && isset($matches[2])) {
            $month = $matches[1];
            $day = $matches[2];

            // 현재 연도를 가져옵니다. 필요에 따라 수정할 수 있습니다.
            $year = date('Y');

            // 변환된 날짜 문자열 생성
            $formattedDate = sprintf('%04d-%02d-%02d', $year, $month, $day);

            // DateTime 객체 생성
            $date = new DateTime($formattedDate);

            return $date;
        } else {
            return "";
        }
    }

    function bytesToMB($bytes) {
        if ($bytes < 0) {
            $this->error("Jl bytesToMB() : 파일 사이즈는 음수일 수 없습니다.");
        }

        // 1MB는 1024 * 1024 바이트
        $result = $bytes / (1024 * 1024);
        return round($result,2);
    }

    function getClientIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    function INIT() {
        // namespace 가 있는지 확인 존재한다면 CI를 사용한다고 인식
        $reflection = new \ReflectionClass($this);
        if ($reflection->getNamespaceName()) {
            $this->CI = true;
        }

        // 개발 허용 IP 확인
        if(in_array($this->getClientIP(),$this->DEV_IP)) $this->DEV = true;

        if($this->CI) {
            //ROOT 위치 찾기
            //$this->ROOT = ROOTPATH;
            $this->ROOT = FCPATH;

            //URL 구하기
            $this->URL = base_url();
            //resource 경로 지정
            $resource_path = FCPATH.$this->JS;
        }else {
            //ROOT 위치 찾기
            $root = __FILE__;
            $position = strpos($root, $this->root_dir);

            if ($position !== false) {
                $this->ROOT = substr($root, 0, $position).$this->root_dir;
            }else {
                $this->error("Jl INIT() : ROOT 위치를 찾을 수 없습니다.");
            }

            //URL 구하기
            $http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '') . '://';
            $user = str_replace(str_replace($this->ROOT, '', $_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']);
            $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
            if(isset($_SERVER['HTTP_HOST']) && preg_match('/:[0-9]+$/', $host))
                $host = preg_replace('/:[0-9]+$/', '', $host);
            $this->URL = $http.$host.$user;

            //resource 경로 지정
            $resource_path = $this->ROOT.$this->JS;
        }

        //DB 설정
        $this->DB = array(
            "hostname" => JL_HOSTNAME,
            "username" => JL_USERNAME,
            "password" => JL_PASSWORD,
            "database" => JL_DATABASE
        );

        //resource 폴더 생성
        if(!is_dir($resource_path)) $this->error("Jl INIT() : jl 폴더가 없습니다.");
        if($this->getDirPermission($resource_path) != "777") {
            if(!chmod($resource_path, 0777)) {
                $this->error("Jl INIT() : jl 폴더의 권한이 777이 아닙니다.");
            }
        }
        $dir = $resource_path."/jl_resource";
        if(!is_dir($dir)) {
            mkdir($dir, 0777);
            chmod($dir, 0777);
        }

        //PHP INI 설정가져오기
        $this->PHP = ini_get_all();


    }
}

?>
