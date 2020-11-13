<?php


class DBConnection {
    private $db_server = '34.89.45.239:3306';
    private $dbUser = 'family-planner';
    private $dbPassword = '2LFngKIzu9o3iP1G';
    private $dbDatabase = 'FamilyPlanner';
    private $dataSourceName;
    private $connection;

    public function __construct(PDO $connection = null) {
        $this->connection = $connection;
        try {
            if ($this->connection === null) {
                $this->dataSourceName = 'mysql:dbname=' . $this->dbDatabase . ';host=' . $this->db_server;
                $this->connection = new PDO($this->dataSourceName, $this->dbUser, $this->dbPassword);
                $this->connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            }
        }catch (PDOException $err)
        {
            echo 'Connection failed: ', $err->getMessage();
        }
    }

    public function databaseTest(){
        $sql = "SELECT * FROM family";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }
}