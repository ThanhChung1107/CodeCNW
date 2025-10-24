<?php

class E_Student {
    public $id;
    public $name;
    public $age;
    public $university;

    public function __construct($id = null, $name = null, $age = null, $university = null) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->university = $university;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getUniversity() {
        return $this->university;
    }

    public function setUniversity($university) {
        $this->university = $university;
    }
}