<?php
/*
    해당 모듈은 5.2부터 최적화 되어있습니다.
    5.2 미만은 사용이 아예 불가능합니다.
 */
namespace App\Libraries;
require_once("JlDefine.php");
require_once("JlModel.php");
class Jl {
    private $root_dir;
    private $JS;
    public $EDITOR_JS;
    public $EDITOR_HTML;
    public $ENV;
    public $COMPONENT;


    protected $PHP;                         // JlFile 에서 사용
    public $DEV = false;                   //해당값이 false 이면 로그가 안찍힙니다. INIT()에서 자동으로 바뀝니다.
    private $DEV_IP = array();
    public  $ROOT;
    public  $URL;
    public $RESOURCE;

    public static $TRACE = false;
    public static $JS_LOAD = false;            // js 두번 로드 되는거 방지용 static 변수는 페이지 변경시 초기화됌
    public static $VUE_LOAD = false;            // vue 두번 로드 되는거 방지용 static 변수는 페이지 변경시 초기화됌
    public static $PLUGINS = array();

    function __construct($load = true) {
        if(!defined("JL_CHECK")) $this->error("Define 파일이 로드가 안됐습니다.");
        if(!defined("JL_SESSION_TABLE_COLUMNS")) $this->error("Jl_session 테이블 컬럼 값이 존재하지 않습니다.");
        array_push($this->DEV_IP,"121.140.204.65"); // 드림포원 내부 IP
        array_push($this->DEV_IP,"59.19.201.109"); // 아이티포원 내부 IP

        $this->root_dir = JL_ROOT_DIR;
        $this->JS = JL_JS;
        $this->EDITOR_JS = JL_EDITOR_JS;
        $this->EDITOR_HTML = JL_EDITOR_HTML;
        $this->COMPONENT = JL_COMPONENT;
        $this->ENV = $this->getEnv();
        $this->RESOURCE = $this->getJlPath()."/jl_resource";

        if($load) {
            $this->INIT();
        }
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

        echo $this->jsonEncode($er);
        die();
        //throw new \Exception($msg);
    }

    //
    function log($content,$path = "") {
        $content = $content." at ".$this->getTime();

        if($path) {
            if (substr($path, -4) !== '.txt') {
                $this->error("log() : 확장자는 .txt 이여야합니다.");
            }

            if(strpos($path,$this->ROOT) !== false) $path = $path;
            else $path = $this->ROOT.$path;

            file_put_contents($path, $content . PHP_EOL, FILE_APPEND);
        }else {
            file_put_contents("Jl_log.txt", $content . PHP_EOL, FILE_APPEND);
        }

        if (($error = error_get_last()) !== null) {
            $this->error($error['message']);
        }
    }

    // 5.2에 주로 사용하며 유니코드 형태로 인코드된 한글데이터를 디코딩 함수
    function decodeUnicode($str) {
        while (preg_match('/\\\\u([0-9a-fA-F]{4})/', $str, $matches)) {
            $char = pack('H*', $matches[1]); // 16진수 값을 바이너리로 변환
            $utf8Char = mb_convert_encoding($char, 'UTF-8', 'UCS-2BE'); // UCS-2를 UTF-8로 변환
            $str = str_replace($matches[0], $utf8Char, $str); // 변환된 문자열 대체
        }
        return $str;
    }

    //해당 문자열이 jsonDecode가 가능하면 true를 반환
    function isJson($string) {
        // 정규식 패턴 정의
        $pattern = '/^\s*(\{.*\}|\[.*\])\s*$/';

        // 문자열이 비어있으면 false
        if (empty($string)) {
            return false;
        }

        // 정규식 검사
        if (!preg_match($pattern, $string)) {
            return false;
        }

        // json_decode로 실제 JSON 유효성 확인
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }

    //jsonEncode 한글깨짐 방지설정넣은
    function jsonEncode($data) {
        if($this->isVersion()) $value = json_encode($data,JSON_UNESCAPED_UNICODE);
        else $value = $this->decodeUnicode(json_encode($data));

        $value = str_replace('\\/', '/', $value);
        return $value;
    }

    //상황에 필요한 로직들을 넣은 Jsondecode 함수
    function jsonDecode($origin_json,$encode = true) {
        $str_json = str_replace('\\n', '###NEWLINE###', $origin_json); // textarea 값 그대로 저장하기위한 변경
        $str_json = stripslashes($str_json);
        $str_json = str_replace('###NEWLINE###', '\\n', $str_json);

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
                if (is_array($obj[$key])) $obj[$key] = $this->jsonEncode($obj[$key]);
                if (is_object($obj[$key])) $obj[$key] = $this->jsonEncode($obj[$key]);
            }
        }

        return $obj;
    }

    // 필요한 파일들을 로드하고 변수를 선언하는 기본함수
    function jsLoad($plugin = array()) {
        $plugins = $this->convertToArray($plugin);

        if(!self::$JS_LOAD) {
            //js파일 찾기
            if(!file_exists($this->ROOT.$this->JS."/Jl.js")) $this->error("Jl INIT() : Jl.js 위치를 찾을 수 없습니다.");
            $session_model = new JlModel('jl_session');
            $token = $session_model->where(array("client_ip" => $this->getClientIP(),"name" => "token"))->get()['data'][0];
            echo "<script>";
            echo "const Jl_base_url = '{$this->URL}';";
            echo "const Jl_dev = ".json_encode($this->DEV).";";     // false 일때 빈값으로 들어가 jl 에러가 나와 encode처리
            echo "const Jl_editor = '{$this->EDITOR_HTML}';";
            echo "const Jl_editor_js = '{$this->EDITOR_JS}';";
            echo "const Jl_token = '{$token['content']}';";
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
            if(file_exists($this->ROOT.$this->JS."/JlPlugin.js")) echo "<script src='{$this->URL}{$this->JS}/JlPlugin.js'></script>";

            self::$JS_LOAD = true;
            echo "<script>";
            echo "const jl = new Jl();";
            echo "</script>";
        }

        $this->pluginLoad($plugins);


    }

    function pluginLoad($plugin = array()) {
        $plugins = array();
        if (is_string($plugin)) array_push($plugins,$plugin);
        else $plugins = $plugin;

        if(in_array('drag',$plugins)) {
            if(!in_array("drag",self::$PLUGINS)) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>';
                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>';
                array_push(self::$PLUGINS,"drag");
            }
        }

        if(in_array('swal',$plugins)) {
            if(!in_array("swal",self::$PLUGINS)) {
                echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>';
                array_push(self::$PLUGINS,"swal");
            }
        }

        if(in_array('jquery',$plugins)) {
            if(!in_array("jquery",self::$PLUGINS)) {
                echo '<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>';
                array_push(self::$PLUGINS,"jquery");
            }
        }

        if(in_array('summernote',$plugins)) {
            if(!in_array("summernote",self::$PLUGINS)) {
                echo '<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">';
                echo '<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>';
                array_push(self::$PLUGINS,"summernote");
            }
        }

        if(in_array('bootstrap',$plugins)) {
            if(!in_array("bootstrap",self::$PLUGINS)) {
                echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-o3pO8HUlU1KpMy2X8CCatUcsDD3T4PAtdU1sK3c4R33zE0M7nb9xr5+eTMVRGz+g" crossorigin="anonymous">';
                echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-v06KyMCIhVXp1qWiMHLKP8o+AKZCL+a59W8KJrC6V+5jMEjOemLEdZomKsm9FmQz" crossorigin="anonymous"></script>';
                array_push(self::$PLUGINS,"bootstrap");
            }
        }
    }

    // vue 사용할시 vue에 필요한 파일들을 로드하고 JS 필수함수를 실행시키는 함수
    function vueLoad($app_name = "app",$plugin = array()) {
        $plugins = $this->convertToArray($plugin);

        if(!self::$VUE_LOAD) {
            $this->jsLoad($plugins);
            echo '<script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>';

            if(in_array('drag',$plugins)) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>';
                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>';
            }
            self::$VUE_LOAD = true;
        }

        $this->pluginLoad($plugins);


        echo "<script>";
        echo "document.addEventListener('DOMContentLoaded', function(){";
        echo "vueLoad('$app_name')";
        echo "}, false);";
        echo "</script>";
    }
    // Vue 컴포넌트를 로드하는 함수
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

    // 파일이 있는지 없는지 확인하는 함수
    function isFileExists($path) {
        if(strpos($path,$this->ROOT) !== false) $file = $path;
        else $file = $this->ROOT.$path;

        return file_exists($file);
    }

    // 연관 배열인지 확인하는 함수
    function isAssociativeArray(array $array) {
        if (!is_array($array)) {
            return false; // 배열이 아니면 false 반환
        }

        // 배열이 비어 있는 경우, 연관 배열이 아닌 것으로 간주합니다.
        if (empty($array)) {
            return false;
        }

        // 모든 키를 검사하여, 하나라도 연관된 키(비연속적이거나 문자열)가 있는지 확인합니다.
        return array_keys($array) !== range(0, count($array) - 1);
    }

    function getUserAgent() {
        // User-Agent 헤더 확인
        if (!isset($_SERVER['HTTP_USER_AGENT'])) {
            return [
                'user_agent' => 'Unknown User-Agent',
                'browser' => 'Unknown Browser',
                'browser_version' => 'Unknown Version',
                'platform' => 'Unknown Platform',
                'is_mobile' => false,
                'in_app_browser' => 'None',
            ];
        }

        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        $browser = 'Unknown Browser';
        $browserVersion = 'Unknown Version';
        $platform = 'Unknown Platform';
        $isMobile = false;
        $inAppBrowser = 'None';

        // 모바일 여부 감지
        if (preg_match('/Mobile|Android|iPhone|iPad|iPod/', $userAgent)) {
            $isMobile = true;
        }

        // 플랫폼 감지 (정확한 순서로 우선 적용)
        if (preg_match('/Android/', $userAgent)) {
            $platform = 'Android';
        } elseif (preg_match('/iPhone|iPad|iPod/', $userAgent)) {
            $platform = 'iOS';
        } elseif (preg_match('/Windows NT/', $userAgent)) {
            $platform = 'Windows';
        } elseif (preg_match('/Macintosh|Mac OS/', $userAgent)) {
            $platform = 'Mac';
        } elseif (preg_match('/Linux/', $userAgent)) {
            $platform = 'Linux';
        } elseif (preg_match('/CrOS/', $userAgent)) { // ChromeOS
            $platform = 'ChromeOS';
        }

        // 브라우저 감지
        if (preg_match('/Chrome\/([0-9\.]+)/', $userAgent, $matches)) {
            $browser = 'Chrome';
            $browserVersion = $matches[1];
        } elseif (preg_match('/Safari\/([0-9\.]+)/', $userAgent) && !preg_match('/Chrome/', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/Firefox\/([0-9\.]+)/', $userAgent, $matches)) {
            $browser = 'Firefox';
            $browserVersion = $matches[1];
        }

        // 앱 내부 브라우저 감지
        if (preg_match('/KAKAOTALK/', $userAgent)) {
            $inAppBrowser = 'KakaoTalk';
        } elseif (preg_match('/Instagram/', $userAgent)) {
            $inAppBrowser = 'Instagram';
        } elseif (preg_match('/FBAN|FBAV/', $userAgent)) {
            $inAppBrowser = 'Facebook';
        }

        return [
            'user_agent' => $userAgent,
            'browser' => $browser,
            'browser_version' => $browserVersion,
            'platform' => $platform,
            'is_mobile' => $isMobile,
            'in_app_browser' => $inAppBrowser,
        ];
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

    function convertToArray($array) {
        // 문자열인지 확인
        if (is_string($array)) {
            // 문자열에 ','가 포함되어 있다면 분리
            if (strpos($array, ',') !== false) {
                return explode(',', $array);
            } else {
                // ','가 없는 단일 문자열이라면 배열에 담아 반환
                return [$array];
            }
        }

        // 이미 배열이라면 그대로 반환
        if (is_array($array)) {
            return $array;
        }

        // 다른 타입이라면 빈 배열 반환
        return [];
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

    //현재 시간 반환하는 함수
    function getTime($hour = 0) {
        // 현재 시간 가져오기
        $currentTime = time();

        // 시간 추가
        if ($hour !== 0) {
            $currentTime += $hour * 3600; // 1시간 = 3600초
        }

        // 포맷된 시간 반환
        return date('Y-m-d H:i:s', $currentTime);
    }

    //현재 개발환경을 알아내는 함수
    function getEnv() {
        if (class_exists('CodeIgniter\\CodeIgniter')) {
            return 'ci4';
        }

        if (defined('CI_VERSION')) {
            return 'ci3';
        }

        return 'php';
    }

    // 5.3 이상일시 true 반환 그 이하는 false 를 반환한다
    function isVersion() {
        $phpVersion = phpversion();

        if (version_compare($phpVersion, '5.3.0', '>=')) return true;

        return false;
    }

    function getJlPath() {
        if(strpos($this->ENV, 'ci') !== false) {
            //ROOT 위치 찾기
            //$this->ROOT = ROOTPATH;
            $this->ROOT = FCPATH;

            //URL 구하기
            $this->URL = base_url();
            //resource 경로 지정
            return FCPATH.$this->JS;
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
            return $this->ROOT.$this->JS;
        }
    }

    function getCurrentUrl() {
        // 프로토콜 확인 (http/https)
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";

        // 호스트 (도메인)
        $host = $_SERVER['HTTP_HOST']; // 도메인 또는 IP 주소

        // 요청된 URI (경로 + 쿼리)
        $uri = $_SERVER['REQUEST_URI']; // "/path/to/page?query=1"

        // 경로 (쿼리스트링 제외)
        $path = parse_url($uri, PHP_URL_PATH); // "/path/to/page"

        // 쿼리스트링
        $queryString = $_SERVER['QUERY_STRING'] ?? ''; // "query=1"

        // 포트 (기본 포트 제외)
        $port = $_SERVER['SERVER_PORT'];
        $portInfo = ($port === "80" && $protocol === "http") || ($port === "443" && $protocol === "https") ? "" : ":$port";

        // 전체 URL
        $fullUrl = "$protocol://$host$portInfo$uri";

        return [
            'protocol' => $protocol,          // http 또는 https
            'host' => $host,                  // 도메인 (example.com)
            'port' => $port,                  // 포트 (80, 443 등)
            'path' => $path,                  // 경로 (/path/to/page)
            'query_string' => $queryString,   // 쿼리스트링 (query=1)
            'full' => $fullUrl,           // 전체 URL (https://example.com:443/path/to/page?query=1)
        ];
    }

    function sessionTrace($message = "") {
        $current_url = $this->getCurrentUrl()['full'];
        $referrer_url = $_SERVER['HTTP_REFERER'];

        $content = array(
            "current_url" => $current_url,
            "referrer_url" => $referrer_url,
        );
        if($message) $content['message'] = $message;
        $agent = $this->getUserAgent();

        $session_model = new JlModel("jl_session");

        $session_model->insert(array(
            "client_ip" => $this->getClientIP(),
            "name" => "trace",
            "status" => "expired",
            "content" => $this->jsonEncode($content),
            "user_agent" => $agent['user_agent'],
            "browser" => $agent['browser'],
            "browser_version" => $agent['browser_version'],
            "platform" => $agent['platform'],
            "is_mobile" => $agent['is_mobile'],
            "in_app_browser" => $agent['in_app_browser'],
            "delete_date" => $this->getTime(),
        ));
    }

    function INIT() {
        // 개발 허용 IP 확인
        if(in_array($this->getClientIP(),$this->DEV_IP)) $this->DEV = true;

        // Jl 폴더 권한 확인
        if(!is_dir($this->getJlPath())) $this->error("Jl INIT() : jl 폴더가 없습니다.");
        if($this->getDirPermission($this->RESOURCE) != "777") {
            if(!chmod($this->RESOURCE, 0777)) {
                $this->error("Jl INIT() : jl 폴더의 권한이 777이 아닙니다.");
            }
        }

        //resource 폴더 생성
        $dir = $this->RESOURCE;
        if(!is_dir($dir)) {
            mkdir($dir, 0777);
            chmod($dir, 0777);
        }

        //PHP INI 설정가져오기
        $this->PHP = ini_get_all();

        // 세션 테이블 생성 및 모델 인스턴스 생성
        $jl_session_table_columns = $this->jsonDecode(JL_SESSION_TABLE_COLUMNS);
        $session_model = new JlModel(array(
            "table" => "jl_session",
            "create" => true,
            "columns" => $jl_session_table_columns
        ));

        //만료된 세션 상태값 변경
        $tokens = $session_model->where(array("status" => "active"))->get();
        foreach ($tokens['data'] as $token) {
            if(strtotime($this->getTime()) > strtotime($token['delete_date'])) {
                $update_token = array("idx" => $token['idx'],"status" => "expired");
                $session_model->update($update_token);
            }
        }

        // 만료된 세션 오늘날짜가 아니면 백업 및 데이터 삭제
        $sessions = $session_model->where("status","expired")->addWhere(" AND DATE(delete_date) != CURDATE() ")->get();
        if($sessions['count']) {
            $target_date = explode(' ',$sessions['data'][0]['delete_date'])[0];
            $sessions = $session_model->where("status","expired")->addWhere(" AND DATE(delete_date) = '$target_date' ")->get();
            $session_model->backup("jl_session",$sessions['data'],$target_date);
            $session_model->addWhere(" AND DATE(delete_date) = '$target_date' ")->whereDelete();
        }


        // 토큰 세션 생성
        $token = $session_model->where(array("client_ip" => $this->getClientIP(),"name" => "token","status" => "active"))->get()['data'][0];
        if(!$token) {
            $agent = $this->getUserAgent();
            $session_model->insert(array(
                "client_ip" => $this->getClientIP(),
                "name" => "token",
                "status" => "active",
                "content" => uniqid().str_pad(rand(0, 99), 2, "0", STR_PAD_LEFT),
                "user_agent" => $agent['user_agent'],
                "browser" => $agent['browser'],
                "browser_version" => $agent['browser_version'],
                "platform" => $agent['platform'],
                "is_mobile" => $agent['is_mobile'],
                "in_app_browser" => $agent['in_app_browser'],
                "delete_date" => $this->getTime(4),
            ));
        }

        if(!self::$TRACE) {
           //$this->sessionTrace();
            self::$TRACE = true;
        }

    }
}

?>
