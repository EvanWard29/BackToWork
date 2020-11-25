<?php
include_once "Chore.php";
include_once "User.php";
include_once "AssignedChore.php";
include_once "Family.php";

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

    public function getAllChores(){
        $sql = "SELECT * FROM chore";

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $chores = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $chore = new Chore($row['choreID'], $row['choreName'], $row['choreDescription']);
                $chores[] = $chore;
            }
        }
        return $chores;
    }

    public function getAssignedChores($familyID){
        $sql = "SELECT * FROM assigned_chore WHERE familyID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$familyID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $assignedChores = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $assignedChore = new AssignedChore($row['userChoreID'], $row['userID'], $row['choreID'], $row['familyID'], $row['status']);
                $assignedChores[] = $assignedChore;
            }
        }
        return $assignedChores;
    }

    public function editChore($choreID, $choreName, $choreDescription){

        $sql = "call EditChore(:choreID, :choreName, :choreDescription)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':choreID',$choreID, PDO::PARAM_INT);
        $statement->bindParam(':choreName',$choreName, PDO::PARAM_STR);
        $statement->bindParam(':choreDescription',$choreDescription, PDO::PARAM_STR);

        $statement->execute();
    }

    public function addChore($chore){
        $sql = "call AddChore(:choreName, :choreDescription)";

        $choreName = $chore->getChoreName();
        $choreDescription = $chore->getChoreDescription();

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':choreName',$choreName, PDO::PARAM_STR);
        $statement->bindParam(':choreDescription', $choreDescription, PDO::PARAM_STR);

        $statement->execute();
    }

    public function getUsers($familyID){
        $sql = "SELECT * FROM user WHERE familyID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$familyID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        if($resultSet){
            foreach($resultSet as $result){
                $user = new User($result['userID'], $result['firstName'], $result['lastName'],
                    $result['email'], $result['password'], $result['points'], $result['familyID']);
                $users[] = $user;
            }
        }
        return $users;
    }

    public function assignChore($userID, $choreID){

    }
}