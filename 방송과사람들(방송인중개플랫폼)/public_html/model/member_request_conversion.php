<?php
class Car_Engine {

    // 프로퍼티(멤버 변수)
    private $_displacement;
    public $engineName;

    // 메소드
    public function getDisplacement() {
        return $this->_displacement;
    }

    public function setDisplacement($displacement) {
        $this->_displacement = $displacement;
    }
}
?>
