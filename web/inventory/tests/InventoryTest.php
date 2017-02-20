<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Inventory.php";

    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class InventoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Inventory::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $description = "posters";
            $test_inventory = new Inventory($description);

            //Act
            $test_inventory->save();

            //Assert
            $result = Inventory::getAll();
            $this->assertEquals($test_inventory, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $description = "posters";
            $description2 = "books";
            $test_inventory = new Inventory($description);
            $test_inventory->save();
            $test_inventory2 = new Inventory($description2);
            $test_inventory2->save();

            //Act
            $result = Inventory::getAll();

            //Assert
            $this->assertEquals([$test_inventory, $test_inventory2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $description = "posters";
            $description2 = "books";
            $test_inventory = new Inventory($description);
            $test_inventory->save();
            $test_inventory2 = new Inventory($description2);
            $test_inventory2->save();

            //Act
            Inventory::deleteAll();

            //Assert
            $result = Inventory::getAll();
            $this->assertEquals([], $result);
        }
    }
?>
