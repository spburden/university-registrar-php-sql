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
            $id = 1;
            $test_student = new Student($name, $enroll_date, $id);
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
            $id = 1;
            $test_student = new Student($name, $enroll_date, $id);
            $test_student->save();
            //Act
            $result = Student::getAll();
            //Assert
            $this->assertEquals($test_student, $result[0]);
        }

    }
?>
