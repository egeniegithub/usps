<?php defined('PATH') or die('NO DIRECT ACCESS');

class App_model
{
    /**
     * Hostname
     * @var string
     */
    private $host;
    /**
     * Username
     * @var string
     */
    private $username;
    /**
     * Password
     * @var string
     */
    private $password;
    /**
     * Database name
     * @var string
     */
    private $db;

    /**
     * Conenction
     * @var resource
     */
    private $con;

    public function __construct()
    {
        //
        $this->host = 'mysql8';
        $this->username = 'usps';
        $this->password = 'password';
        $this->db = 'usps';
        // Connect to MySQLi
        $this->connect();
    }

    /**
     * Insert
     */
    public function insert(
        string $table,
        array $data
    ) {
        //
        $sql = '';
        $sql .= "INSERT INTO `{$table}`";
        $columns = "";
        $values = "";
        //
        foreach ($data as $column => $value) {
            //
            $columns .= "`$column`, ";
            $values .= '"' . ($value) . '", ';
        }
        //
        $columns = rtrim($columns, ', ');
        $values = rtrim($values, ', ');
        //
        $sql .= " ($columns) VALUES ($values)";
        //
        return mysqli_query(
            $this->con,
            $sql
        );
    }

    /**
     * Connect to database
     */
    private function connect()
    {
        //
        $this->con = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->db
        );
        //
        if ($this->con->connect_error) {

            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
    }
}
