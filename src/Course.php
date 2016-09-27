<?php
    class Course
    {
        private $course_name;
        private $course_number;
        private $id;

        function __construct($course_name, $course_number, $id = null)
        {
            $this->course_name = $course_name;
            $this->course_number = $course_number;
            $this->id = $id;
        }

        function getCourseProperty($property_id)
        {
            switch($property_id){
                case "course_name":
                    return $this->course_name;
                    break;
                case "course_number":
                    return $this->course_number;
                    break;
                case "id":
                    return $this->id;
                    break;
                default:
                    return "Choose a value";
            }
        }

        function setCourseProperty($property_id, $new_value)
        {
            switch($property_id){
                case "course_name":
                    $this->course_name = $new_value;
                    break;
                case "course_number":
                    $this->course_number = $new_value;
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
            $GLOBALS['DB']->exec("INSERT INTO courses (course_name, course_number) VALUES ('{$this->getCourseProperty('course_name')}', '{$this->getCourseProperty('course_number')}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
            $courses = array();
            foreach($returned_courses as $course) {
                $course_name = $course['course_name'];
                $course_number = $course['course_number'];
                $id = $course['id'];
                $new_course = new Course($course_name, $course_number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function deleteAll()
        {
         $GLOBALS['DB']->exec("DELETE FROM courses;");
        }

        static function find($search_id)
        {
            $found_course = null;
            $courses = Course::getAll();
            foreach($courses as $course) {
                $course_id = $course->getId();
                if ($course_id == $search_id) {
                    $found_course = $course;
                }
            }
            return $found_course;
        }

        function update($new_course_name, $new_course_number)
        {
           $GLOBALS['DB']->exec("UPDATE courses SET course_name = '{$new_course_name}', course_number = {$new_course_number} WHERE id = {$this->getCourseProperty('id')};");
           $this->setCourseProperty('course_name', $new_course_name);
           $this->setCourseProperty('course_number', $new_course_number);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getCourseProperty('id')};");
            $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE course_id = {$this->getCourseProperty('id')};");
        }

        function addStudent($new_student)
        {
            $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$this->getCourseProperty('id')}, {$new_student->getStudentProperty('id')});");
        }

        function getStudents()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses
                 JOIN courses_students ON (courses_students.course_id = courses.id)
                 JOIN students ON (students.id = courses_students.student_id)
                 WHERE courses.id = {$this->getCourseProperty('id')};");
            $students = array();
            foreach($returned_students as $student) {
                $name = $student['name'];
                $enroll_date = $student['enroll_date'];
                $id = $student['id'];
                $new_student = new Student($name, $enroll_date, $id);
                array_push($students, $new_student);
            }
            return $students;
        }
    }


?>
