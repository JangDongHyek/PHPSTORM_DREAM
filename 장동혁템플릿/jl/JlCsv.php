<?php
include_once("Jl.php");

class JlCsv extends Jl{
    private     $header;
    private     $data;
    private     $field;
    private     $path;

    public function __construct($header,$field,$data,$path = "") {
        //부모 생성자
        parent::__construct();

        $this->header = $header;
        $this->field = $field;
        $this->data = $data;
        $name = date('Ymd')."_";
        $name .= uniqid().str_pad(rand(0, 99), 2, "0", STR_PAD_LEFT);


        if($path) $this->path = $this->ROOT.$path."/{$name}.csv";
    }

    public function createCsv() {
        ob_start();
        $this->output = fopen($this->path ? $this->path : "php://output", 'w');

        foreach ($this->header as $row) {
            fputcsv($this->output, $row);
        }

        foreach ($this->data['data'] as $index => $row) {
            $array = [];

            foreach ($this->field as $item) {
                array_push($array,$row[$item]);
            }

            fputcsv($this->output, $array);
        }

        fclose($this->output);
        $content = ob_get_clean();

        // 파일에 저장해야 하는 경우, 저장된 경로를 반환
        if ($this->path) {
            file_put_contents($this->path, $content); // 파일에 내용을 저장
            return $this->path; // 저장된 파일 경로 반환
        }

        return $content;
    }

    public function getCsv() {
        if (!$this->path) {
            $filename = "download.csv"; // 기본 파일명 설정
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            echo $this->createCsv(); // CSV 콘텐츠를 출력
            exit;
        }else {
            $this->createCsv();

            if (file_exists($this->path)) {
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename="' . basename($this->path) . '"');
                readfile($this->path);
                exit;
            } else {
                $this->error("파일이 존재하지 않습니다.");
            }
        }


    }
}
?>