<?php
class Gamedb {
// The database connection
    protected static $connection;

    public function connect() {    
        // Try and connect to the database
        if(!isset(self::$connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('../webconf/db.ini'); 
            self::$connection = new mysqli($config['hostname'],$config['username'],$config['password'],$config['dbname']);
        }

        // If connection was not successful
        if(self::$connection === false) {
            return false;
        }
        return self::$connection;
    }

    public function close() {
        // Close DB connection
	self::$connection->close();
    }



    // Query the database
    public function query($query) {
        // Connect to the database
        $connection = $this -> connect();

        // Query the database
        $result = $connection -> query($query);

        return $result;
    }

    // Fetch rows from the database (SELECT query)
    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    // Quote and escape value for use in a database query
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }
}
?>
