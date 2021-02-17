<?php
include_once "Chore.php";
include_once "User.php";
include_once "AssignedChore.php";
include_once "Family.php";

class DBConnection {
    private $db_server = '192.168.0.11:9999';
    private $dbUser = 'erward';
    private $dbPassword = 'LoL0200!!';
    private $dbDatabase = 'familyplanner';
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

    public function assignChore($chore, $user){
        $sql = "call AssignChore(:choreID, :user, :familyID)";

        $statement = $this->connection->prepare($sql);

        $choreID = $chore->getChoreID();
        $familyID = $chore->getFamilyID();

        $statement->bindParam(':choreID',$choreID, PDO::PARAM_INT);
        $statement->bindParam(':user',$user, PDO::PARAM_STR);
        $statement->bindParam(':familyID',$familyID, PDO::PARAM_INT);

        $statement->execute();
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

    public function getNextChoreID(){
        $sql = "call NewChoreID()";

        $statement = $this->connection->prepare($sql);

        $statement->execute();
        $choreID = $statement->fetchColumn();

        return $choreID;
    }

    public function deleteChore($choreID){
        $sql = "call DeleteChore(:choreID)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':choreID',$choreID, PDO::PARAM_STR);

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
                    $result['email'], $result['password'], $result['points'], $result['choresCompleted'], $result['familyID']);
                $users[] = $user;
            }
        }
        return $users;
    }

    public function addUser($user){
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $points = $user->getPoints();
        $choresCompleted = $user->getChoresCompleted();
        $familyID = $user->getFamilyID();

        $sql = "call AddUser(:firstName, :lastName, :email, :password, :points, :choresCompleted, :familyID)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':firstName',$firstName, PDO::PARAM_STR);
        $statement->bindParam(':lastName',$lastName, PDO::PARAM_STR);
        $statement->bindParam(':email',$email, PDO::PARAM_STR);
        $statement->bindParam(':password',$password, PDO::PARAM_STR);
        $statement->bindParam(':points',$points, PDO::PARAM_INT);
        $statement->bindParam(':choresCompleted',$choresCompleted, PDO::PARAM_INT);
        $statement->bindParam(':familyID',$familyID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function updateUser($userID, $firstName, $choresCompleted, $points){
        $sql = "call UpdateUser(:userID, :firstName, :choresCompleted, :points)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':userID',$userID, PDO::PARAM_INT);
        $statement->bindParam(':firstName',$firstName, PDO::PARAM_STR);
        $statement->bindParam(':choresCompleted',$choresCompleted, PDO::PARAM_INT);
        $statement->bindParam(':points',$points, PDO::PARAM_INT);

        $statement->execute();
    }

    public function getPassword($email){
        $sql = "SELECT password, userID FROM user WHERE email = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$email]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }
}