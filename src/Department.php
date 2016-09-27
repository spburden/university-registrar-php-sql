<?php
    class Department
    {
        private $department_name;
        private $id;

        function __construct($department_name, $id = null)
        {
            $this->department_name = $department_name;
            $this->id = $id;
        }

        function getDepartmentProperty($property_id)
        {
            switch($property_id){
                case "department_name":
                    return $this->department_name;
                    break;
                case "id":
                    return $this->id;
                    break;
                default:
                    return "Choose a value";
            }
        }

        function setDepartmentProperty($property_id, $new_value)
        {
            switch($property_id){
                case "department_name":
                    $this->department_name = $new_value;
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
            $GLOBALS['DB']->exec("INSERT INTO departments (department_name) VALUES ('{$this->getDepartmentProperty('department_name')}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_departments = $GLOBALS['DB']->query("SELECT * FROM departments;");
            $departments = array();
            foreach($returned_departments as $department) {
                $department_name = $department['department_name'];
                $id = $department['id'];
                $new_department = new Department($department_name, $id);
                array_push($departments, $new_department);
            }
            return $departments;
        }

        static function deleteAll()
        {
         $GLOBALS['DB']->exec("DELETE FROM departments;");
        }

        static function find($search_id)
        {
            $found_department = null;
            $departments = Department::getAll();
            foreach($departments as $department) {
                $department_id = $department->getId();
                if ($department_id == $search_id) {
                    $found_department = $department;
                }
            }
            return $found_department;
        }

        function update($new_department_name)
        {
           $GLOBALS['DB']->exec("UPDATE departments SET department_name = '{$new_department_name}' WHERE id = {$this->getDepartmentProperty('id')};");
           $this->setDepartmentProperty('department_name', $new_department_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM departments WHERE id = {$this->getDepartmentProperty('id')};");
            $GLOBALS['DB']->exec("DELETE FROM departments_courses_students WHERE department_id = {$this->getDepartmentProperty('id')};");
        }

        function addCourseNStudent($new_course, $new_student)
        {
           $GLOBALS['DB']->exec("INSERT INTO departments_courses_students (department_id, course_id, student_id) VALUES ({$this->getDepartmentProperty('id')}, {$new_course->getCourseProperty('id')}, {$new_student->getStudentProperty('id')});");
        }

        function getCourses()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT courses.* FROM departments
                 JOIN departments_courses_students ON (departments_courses_students.department_id = departments.id)
                 JOIN courses ON (courses.id = departments_courses_students.course_id)
                 WHERE departments.id = {$this->getDepartmentProperty('id')};");
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

        function getStudents()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM departments
                 JOIN departments_courses_students ON (departments_courses_students.department_id = departments.id)
                 JOIN students ON (students.id = departments_courses_students.student_id)
                 WHERE departments.id = {$this->getDepartmentProperty('id')};");
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
