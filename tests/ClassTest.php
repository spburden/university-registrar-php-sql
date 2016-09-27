<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    //TO RUN TESTS IN TERMINAL:
    //export PATH=$PATH:./vendor/bin
    //phpunit tests

    require_once "src/City.php";
    require_once "src/Flight.php";
    $server = 'mysql:host=localhost;dbname=airline_planner_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CityTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          City::deleteAll();
          Flight::deleteAll();
        }
            function test_getYearCode()
            {
                //Arrange
                $test_Classs = new Classs;
                $year = 2016;

                //Act
                $output = $test_DayOfWeek->getYearCode($year);

                //Assert
                $this->assertEquals(6, $output);
            }

    }
?>
