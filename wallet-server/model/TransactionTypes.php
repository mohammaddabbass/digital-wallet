<?php
class TransactionTypes {
    private $type_id;
    private $type_name;

    public function __construct($type_id = null, $type_name = null) {
        $this->type_id = $type_id;
        $this->type_name = $type_name;
    }

    public function getTypeId() {
        return $this->type_id;
    }

    public function getTypeName() {
        return $this->type_name;
    }

    public function setTypeId($type_id) {
        $this->type_id = $type_id;
    }

    public function setTypeName($type_name) {
        $this->type_name = $type_name;
    }

    public function toArray() {
        return [
            'type_id' => $this->type_id,
            'type_name' => $this->type_name
        ];
    }
}
?>