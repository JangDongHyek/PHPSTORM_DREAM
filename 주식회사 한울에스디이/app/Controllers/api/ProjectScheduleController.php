<?php
namespace App\Libraries;

namespace App\Controllers\api;
use App\Controllers\BaseController;

use App\Libraries\Jl;
use App\Libraries\JlModel;
use App\Libraries\JlFile;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

/*
 주의사항
 use Exception 을 하는순간 try catch 문 작동 안합니다.
 */

class ProjectScheduleController extends BaseController
{
    public $models = [];
    public $jl_response = array("message" => ""); // BaseController 내 response 란 객체가 존재해 변수명 변경
    public $join_table = '';
    public $get_tables = [];

    public $table = "project_schedule";
    public $file_use = false;
    public $file;

    public function __construct() {
        $this->models[$this->table] = new JlModel(array("table" => $this->table));
        $this->models['user'] = new JlModel(array("table" => 'user'));
        if($this->file_use) {
            $this->file = new JlFile("/jl/jl_resource/{$this->table}");
        }

        array_push($this->get_tables,array("table"=> "user", "get_key" => "user_idx" ));
    }

    public function method() {
        $_method = $this->request->getPost('_method');

        switch (strtolower($_method)) {
            case "get" : {
                $this->get();
                break;
            }
            case "insert" : {
                $this->insert();
                break;
            }
            case "update" : {
                $this->update();
                break;
            }
            case "remove" : {
                $this->delete();
                break;
            }
            case "delete" : {
                $this->delete();
                break;
            }

            case "distinct" : {
                $this->distinct();
                break;
            }

            case "group_category" : {
                $this->groupCategory();
                break;
            }

            case "csv_insert" : {
                $this->csv_insert();
                break;
            }

            default : {
                $this->models[$this->table]->error("method 설정이 안되어있습니다.");
                break;
            }
        }
    }

    public function get() {
        $obj = $this->models[$this->table]->jsonDecode($this->request->getPost('obj'));

        //필터링
        $this->models[$this->table]->setFilter($obj);

        //join
        if ($this->join_table) {
            $this->models[$this->table]->join($this->join_table,"origin_key","join_key");
            // 조인 필터링
            //$model->where("join_column","value","AND",$join_table);
            //$model->between("join_column","start","end","AND",$join_table);
            //$model->in("join_column",array("value1","value2"),"AND",$join_table);
            //$model->like("join_column","value","AND",$join_table);
        }

        $object = $this->models[$this->table]->where($obj)->get(array(
            "page" => $obj['page'],
            "limit" => $obj['limit'],
            //"source" => "joinTable",
            //"select" => "joinTable.SearchColumn AS alias",
            "sql" => true
        ));

        //getKey ex) 고유키로 필요한 테이블데이터를 조인대신 한번 더 조회해서 가져오는형식 속도는 join이랑 비슷하거나 빠름
        foreach($this->get_tables as $index => $info) {
            $joinModel = new JlModel(array(
                "table" => $info['table'],
            ));



            foreach ($object["data"] as $index => $data) {
                if(!$data[$info['get_key']]) continue;
                $joinModel->where($joinModel->primary, $data[$info['get_key']]);
                $join_data = $joinModel->get()['data'][0];

                //Join시 변수명은 무조건 대문자로 진행 데이터 업데이트시 문제발생함 대문자 필드 삭제 처리는 JS에 있음
                $object["data"][$index]["$".$info['table']] = $join_data;
            }
        }

        $this->jl_response['data'] = $object['data'];
        $this->jl_response['count'] = $object['count'];
        $this->jl_response['filter'] = $object['filter'];
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function insert() {
        $obj = $this->models[$this->table]->jsonDecode($this->request->getPost('obj'));

        if($this->file_use) {
            foreach ($_FILES as $key => $file_data) {
                $file_result = $this->file->bindGate($file_data);
                $obj[$key] = $file_result;
            }
        }

        $this->models[$this->table]->insert($obj);
        $this->jl_response['obj'] = $obj;
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);



    }

    public function update() {
        $obj = $this->models[$this->table]->jsonDecode($this->request->getPost('obj'));

        if($this->file_use) {
            //업데이트는 기존 사진 데이터 가져와서 머지를 해줘야하기때문에 값 가져오기
            $getData = $this->models[$this->table]->where($this->models[$this->table]->primary,$obj[$this->models[$this->table]->primary])->get()['data'][0];

            foreach ($_FILES as $key => $file_data) {
                $file_result = $this->file->bindGate($file_data);
                if(!$file_result) continue;

                if(is_array($file_data['name'])) {
                    //바인드의 리턴값은 encode되서 오기때문에 decode
                    $file_result = json_decode($file_result, true);
                    $result = array_merge($getData[$key],$file_result);
                    //문자열로 저장되어야하기떄문에 encode
                    $obj[$key] = json_encode($result,JSON_UNESCAPED_UNICODE);
                }else {
                    $obj[$key] = $file_result;
                }
            }
        }


        $this->models[$this->table]->update($obj);
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function delete() {
        $obj = $this->models[$this->table]->jsonDecode($this->request->getPost('obj'));

        if($obj['primary']) $obj[$this->models[$this->table]->primary] = $obj['primary'];

        if($this->file_use) {
            $getData = $this->models[$this->table]->where($this->models[$this->table]->primary,$obj[$this->models[$this->table]->primary])->get()['data'][0];
            $this->file->deleteDirGate($getData['data_column']);
        }

        $this->models[$this->table]->delete($obj);

        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function distinct() {
        $jl = new Jl();
        $obj = $this->models[$this->table]->jsonDecode($this->request->getPost('obj'));

        $this->models[$this->table]->setFilter($obj);

        //$obj['column'] 값으로 가져옴
        $data = $this->models[$this->table]->where($obj)->distinct($obj);

        $this->jl_response['success'] = true;
        $this->jl_response['data'] = $data['data'];
        $this->jl_response['sql'] = $data['sql'];
        $this->jl_response['obj'] = $obj;
        echo json_encode($this->jl_response);
    }

    public function groupCategory() {
        $obj = $this->models[$this->table]->jsonDecode($this->request->getPost('obj'));
        $this->models[$this->table]->setFilter($obj);

        $category_a = $this->models[$this->table]->where($obj)->distinct($obj)['data'];

        foreach ($category_a as $ca_index => $ca) {
            $filter = array(
                "project_idx" => $obj['project_idx'],
                "category_a" => $ca['category_a'],
                "column" => "group_a",
                "order_by_asc" => "group_a"
            );
            $this->models[$this->table]->setFilter($filter);
            $group_a = $this->models[$this->table]->where($filter)->distinct($filter)['data'];
            $category_a[$ca_index]['visible'] = true;
            $category_a[$ca_index]['group_a'] = $group_a;

            foreach ($group_a as $ga_index => $ga) {
                $filter = array(
                    "project_idx" => $obj['project_idx'],
                    "category_a" => $ca['category_a'],
                    "group_a" => $ga['group_a'],
                    "column" => "group_b",
                    "order_by_asc" => "group_b"
                );
                $this->models[$this->table]->setFilter($filter);
                $group_b = $this->models[$this->table]->where($filter)->distinct($filter)['data'];
                $category_a[$ca_index]['group_a'][$ga_index]['visible'] = true;
                $category_a[$ca_index]['group_a'][$ga_index]['group_b'] = $group_b;

                foreach ($group_b as $gb_index => $gb) {
                    $filter = array(
                        "project_idx" => $obj['project_idx'],
                        "category_a" => $ca['category_a'],
                        "group_a" => $ga['group_a'],
                        "group_b" => $gb['group_b'],
                        "column" => "group_c",
                        "order_by_asc" => "group_c"
                    );
                    $this->models[$this->table]->setFilter($filter);
                    $group_c = $this->models[$this->table]->where($filter)->distinct($filter)['data'];
                    $category_a[$ca_index]['group_a'][$ga_index]['group_b'][$gb_index]['visible'] = true;
                    $category_a[$ca_index]['group_a'][$ga_index]['group_b'][$gb_index]['group_c'] = $group_c;

                    foreach ($group_c as $gc_index => $gc) {
                        $filter = array(
                            "project_idx" => $obj['project_idx'],
                            "category_a" => $ca['category_a'],
                            "group_a" => $ga['group_a'],
                            "group_b" => $gb['group_b'],
                            "group_c" => $gc['group_c'],
                            "column" => "category_b",
                            "order_by_asc" => "category_b"
                        );
                        $this->models[$this->table]->setFilter($filter);
                        $category_b = $this->models[$this->table]->where($filter)->distinct($filter)['data'];
                        $category_a[$ca_index]['group_a'][$ga_index]['group_b'][$gb_index]['group_c'][$gc_index]['visible'] = true;
                        $category_a[$ca_index]['group_a'][$ga_index]['group_b'][$gb_index]['group_c'][$gc_index]['category_b'] = $category_b;

                        foreach ($category_b as $cb_index => $cb) {
                            $filter = array(
                                "project_idx" => $obj['project_idx'],
                                "category_a" => $ca['category_a'],
                                "group_a" => $ga['group_a'],
                                "group_b" => $gb['group_b'],
                                "group_c" => $gc['group_c'],
                                "category_b" => $cb['category_b'],
                                "order_by_asc" => "idx"
                            );
                            $this->models[$this->table]->setFilter($filter);
                            $data = $this->models[$this->table]->where($filter)->get()['data'];

                            foreach ($data as $data_index => $d) {
                                if(!$d['user_idx']) continue;

                                $user = $this->models['user']->where($this->models['user']->primary,$d['user_idx'])->get()['data'][0];
                                $data[$data_index]['$user'] = $user;
                            }


                            $category_a[$ca_index]['group_a'][$ga_index]['group_b'][$gb_index]['group_c'][$gc_index]['category_b']
                            [$cb_index]['visible'] = true;
                            $category_a[$ca_index]['group_a'][$ga_index]['group_b'][$gb_index]['group_c'][$gc_index]['category_b']
                                [$cb_index]['data'] = $data;
                        }
                    }
                }
            }
        }

        $this->jl_response['success'] = true;
        $this->jl_response['data'] = $category_a;
        $this->jl_response['obj'] = $obj;
        echo json_encode($this->jl_response);
    }

    public function csv_insert() {
        $obj = $this->models[$this->table]->jsonDecode($this->request->getPost('obj'));

        if(!count($_FILES)) $this->models[$this->table]->error("파일이없습니다.");

        $file = $_FILES['upfile']['tmp_name'];

        try {
            // PHPSpreadsheet 네임스페이스 로드
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

            $headers = ["group_a","group_b","group_c",
                "category_b",
                "content","schedule_start_date","schedule_end_date",
                "memo"
            ];

            foreach ($spreadsheet->getSheetNames() as $sheetIndex => $sheetName) {
                $sheet = $spreadsheet->getSheet($sheetIndex);

                // 데이터 읽기
                foreach ($sheet->getRowIterator() as $row) {
                    $currentRowIndex = $row->getRowIndex();
                    if($currentRowIndex == 1) continue;

                    $rowData = [];
                    foreach ($row->getCellIterator() as $cell) {
                        $value = $cell->getValue();
                        if (Date::isDateTime($cell)) {
                            $value = Date::excelToDateTimeObject($value)->format('Y-m-d'); // 원하는 포맷
                        }
                        $rowData[] = $value;


                    }

                    // 빈 데이터 행 건너뛰기
                    if (empty(array_filter($rowData))) {
                        continue;
                    }

                    $data = array_combine($headers,$rowData);
                    $data['category_a'] = $sheetName;
                    $data['project_idx'] = $obj['project_idx'];
                    $this->models[$this->table]->insert($data);
                }
            }





            $this->jl_response['success'] = true;
            $this->jl_response['$obj'] = $obj;
            $this->jl_response['$_FILES'] = $_FILES;
            $this->jl_response['$datas'] = $datas;
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            $this->jl_response['success'] = false;
            $this->jl_response['error'] = "엑셀 파일을 읽는 도중 에러가 발생했습니다: " . $e->getMessage();
        }

        echo json_encode($this->jl_response);
    }

}