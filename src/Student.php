<?php
    class Student
    {
        private $name;
        private $enroll_date;
        private $id;

        function __construct($name, $enroll_date, $id = null)
        {
            $this->name = $name;
            $this->enroll_date = $enroll_date;
            $this->id = $id;
        }

        function getStudentProperty($property_id)
        {
            switch($property_id){
                case "name":
                    return $this->name;
                    break;
                case "enroll_date":
                    return $this->enroll_date;
                    break;
                case "id":
                    return $this->id;
                    break;
                default:
                    return "Choose a value";
            }
        }

        function setStudentProperty($property_id, $new_value)
        {
            switch($property_id){
                case "name":
                    $this->name = $new_value;
                    break;
                case "enroll_date":
                    $this->enroll_date = $new_value;
                    break;
                case "id":
                    $this->id = $new_value;
                    break;
                default:
                    return "Choose a value";
            }
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students (name, enroll_date) VALUES ('{$this->getStudentProperty("name")}', {$this->getStudentProperty("enroll_date")})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach($returned_students as $student) {
                $name = $student['name'];
                $enroll_date = $student['enroll_date'];
                $id = $student['id'];
                $new_student = new Student($name, $enroll_date, $id);
                array_push($tasks, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
         $GLOBALS['DB']->exec("DELETE FROM students;");
        }

        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach($students as $student) {
                $student_id = $student->getId();
                if ($student_id == $search_id) {
                    $found_student = $student;
                }
            }
            return $found_student;
        }

        function update($new_name, $new_enroll_date)
        {
           $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}', enroll_date = {$new_enroll_date} WHERE id = {$this->getStudentProperty('id')};");
           $this->setStudentProperty('name', $new_name);
           $this->setStudentProperty('enroll_date', $new_enroll_date);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getStudentProperty('id')};");
        }









    }
?>
