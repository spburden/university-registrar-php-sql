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

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Course::deleteAll();
          Student::deleteAll();
        }
        function testGetStudentEnrollDate()
        {
            //Arrange
            $name = "Stephen Burden";
            $enroll_date = 2014-11-22;
            //$id = 1;
            $test_student = new Student($name, $enroll_date);
            $test_student->save();

            //Act
            $result = $test_student->getStudentProperty("enroll_date");
            //Assert
            $this->assertEquals($enroll_date, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Stephen Burden";
            $enroll_date = "2014-11-22";
            //$id = 1;
            $test_student = new Student($name, $enroll_date);
            $test_student->save();
            //Act
            $result = Student::getAll();
            //Assert
            $this->assertEquals($test_student, $result[0]);
        }

        function testGetCourses()
        {
            //Arrange
            $name = "Stephen Burden";
            $enroll_date = "2014-11-22";
            //$id = 1;
            $test_student = new Student($name, $enroll_date);
            $test_student->save();

            $course_name = "History of Wales";
            $course_number = "Wales101";
            //$id2 = 3;
            $test_course = new Course($course_name, $course_number);
            $test_course->save();

            //Act
            $test_student->addCourse($test_course);

            //Assert
            $this->assertEquals($test_student->getCourses(), [$test_course]);
        }

        function testGetStatus()
        {
            //Arrange
            $name = "Stephen Burden";
            $enroll_date = "2014-11-22";
            //$id = 1;
            $test_student = new Student($name, $enroll_date);
            $test_student->save();

            $course_name = "History of Wales";
            $course_number = "Wales101";
            //$id2 = 3;
            $test_course = new Course($course_name, $course_number);
            $test_course->save();

            //Act
            // $test_student->setStatus(1);
            $test_student->addCourse($test_course);
            $result = $test_student->getStatus($test_course->getCourseProperty('id'));

            //Assert
            $this->assertEquals(0, $result);
        }

        function testSetStatus()
        {
            //Arrange
            $name = "Stephen Burden";
            $enroll_date = "2014-11-22";
            //$id = 1;
            $test_student = new Student($name, $enroll_date);
            $test_student->save();

            $course_name = "History of Wales";
            $course_number = "Wales101";
            //$id2 = 3;
            $test_course = new Course($course_name, $course_number);
            $test_course->save();

            //Act
            $test_student->addCourse($test_course);
            $test_student->setStatus(1);
            $result = $test_student->getStatus($test_course->getCourseProperty('id'));

            //Assert
            $this->assertEquals(1, $result);
        }

    }
?>
