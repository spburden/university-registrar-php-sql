<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    //TO RUN TESTS IN TERMINAL:
    //export PATH=$PATH:./vendor/bin
    //phpunit tests

    require_once "src/Course.php";
    require_once "src/Student.php";
    require_once "src/Department.php";
    $server = 'mysql:host=localhost;dbname=university_registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DepartmentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Course::deleteAll();
          Student::deleteAll();
          Department::deleteAll();
        }
        function testGetDepartmentName()
        {
            //Arrange
            $department_name = "Dept of Welsh History";
            $test_department = new Department($department_name);

            //Act
            $result = $test_department->getDepartmentProperty("department_name");
            //Assert
            $this->assertEquals($department_name, $result);
        }

        function testSave()
        {
            //Arrange
            $department_name = "Dept of Welsh History";
            $test_department = new Department($department_name);
            $test_department->save();
            //Act
            $result = Department::getAll();
            //Assert
            $this->assertEquals($test_department, $result[0]);
        }

        function testGetStudents()
        {
            //Arrange
            $name = "Stephen Burden";
            $enroll_date = "2014-11-22";
            $test_student = new Student($name, $enroll_date);
            $test_student->save();

            $course_name = "History of Wales";
            $course_number = "Wales101";
            $test_course = new Course($course_name, $course_number);
            $test_course->save();

            $department_name = "Dept of Welsh History";
            $test_department = new Department($department_name);
            $test_department->save();

            //Act
            $test_department->addCourseNStudent($test_course, $test_student);

            //Assert
            $this->assertEquals($test_department->getStudents(), [$test_student]);
        }
        
        function testGetCourses()
        {
            //Arrange
            $name = "Stephen Burden";
            $enroll_date = "2014-11-22";
            $test_student = new Student($name, $enroll_date);
            $test_student->save();

            $course_name = "History of Wales";
            $course_number = "Wales101";
            $test_course = new Course($course_name, $course_number);
            $test_course->save();

            $department_name = "Dept of Welsh History";
            $test_department = new Department($department_name);
            $test_department->save();

            //Act
            $test_department->addCourseNStudent($test_course, $test_student);

            //Assert
            $this->assertEquals($test_department->getCourses(), [$test_course]);
        }
    }
?>
