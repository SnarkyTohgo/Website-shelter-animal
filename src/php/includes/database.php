<?php
  
  class Database {
    private static $instance = NULL;
    private $db = NULL;

    // MySQL attr
    private $username = "root";
    private $password = "";

    /* 
     * Constructor for SQLite
     */
    private function __construct() {
      $this->db = new PDO('sqlite:../../database/database.db');
      $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
      $this->db->query('PRAGMA foreign_keys = ON');
     
      if (NULL == $this->db) 
        throw new Exception("Failed to open database");
    }


    /*
     * Constructor for MySql
     *
    private function __construct()
    {
        $this->db = new PDO('mysql:host=127.0.0.1;dbname=ltw;', $this->username, $this->password);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

        if (NULL == $this->db)
            throw new Exception("Failed to open database");
    }
    */

    /**
     * Returns the database connection.
     */
    public function db() {
      return $this->db;
    }

    /**
     * Returns this singleton instance. Creates it if needed.
     */
    static function instance() {
      if (NULL == self::$instance) {
        self::$instance = new Database();
      }
      return self::$instance;
    }
  }

?>