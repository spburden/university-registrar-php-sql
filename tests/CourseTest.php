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
    $server = 'mysql:host=localhost;dbname=university_registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Course::deleteAll();
          Student::deleteAll();
        }
        function testGetCourseName()
        {
            //Arrange
            $course_name = "History of Wales";
            $course_number = "Wales101";
            $test_course = new Course($course_name, $course_number);

            //Act
            $result = $test_course->getCourseProperty("course_name");
            //Assert
            $this->assertEquals($course_name, $result);
        }

        function testSave()
        {
            //Arrange
            $course_name = "History of Wales";
            $course_number = "Wales101";
            $id = 23;
            $test_course = new Course($course_name, $course_number, $id);
            $test_course->save();
            //Act
            $result = Course::getAll();
            //Assert
            $this->assertEquals($test_course, $result[0]);
        }

        function testGetStudents()
        {
            //Arrange
            $name = "Stephen Burden";
            $enroll_date = "2014-11-22";
            $id = 1;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();

            $course_name = "History of Wales";
            $course_number = "Wales101";
            $id2 = 3;
            $test_course = new Course($course_name, $course_number, $id2);
            $test_course->save();

            //Act
            $test_course->addStudent($test_student);

            //Assert
            $this->assertEquals($test_course->getStudents(), [$test_student]);
        }
    }
?>
