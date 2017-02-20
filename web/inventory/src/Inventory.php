<?php
    class Inventory
    {
        private $description;

        function __construct($description)
        {
            $this->description = $description;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO items (description) VALUES ('{$this->getDescription()}');");
        }

        static function getAll()
        {
            $returned_inventory = $GLOBALS['DB']->query("SELECT * FROM items;");
            $items = array();
            foreach($returned_inventory as $item) {
                $description = $item['description'];
                $new_item = new Inventory($description);
                array_push($items, $new_item);
            }
            return $items;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM items;");
        }

    }
?>
