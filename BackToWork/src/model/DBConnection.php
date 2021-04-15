<?php
include_once "Chore.php";
include_once "User.php";
include_once "AssignedChore.php";
include_once "Family.php";
include_once "Reward.php";
include_once "RewardRequest.php";
include_once "CalendarEvent.php";

class DBConnection {
    private $db_server = 'family-planner.celxijdauxzq.eu-west-2.rds.amazonaws.com';
    private $dbUser = 'admin';
    private $dbPassword = '2B^SnH&a7&Mn7vJbQ!Zm';
    private $dbDatabase = 'family-planner';
    private $dataSourceName;
    private $connection;

    public function __construct(PDO $connection = null) {
        $this->connection = $connection;
        try {
            if ($this->connection === null) {
                $this->dataSourceName = 'mysql:dbname=' . $this->dbDatabase . ';host=' . $this->db_server . ';charset=utf8';
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

    public function getAllChores($familyID){
        $sql = "SELECT * FROM chore WHERE familyID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$familyID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $chores = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $chore = new Chore($row['choreID'], $row['choreName'], $row['choreDescription'], $row['points'], $row['penalty'], $row['familyID']);
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
                $assignedChore = new AssignedChore($row['userChoreID'], $row['userID'], $row['choreID'], $row['familyID'], $row['deadline'], $row['status']);
                $assignedChores[] = $assignedChore;
            }
        }
        return $assignedChores;
    }

    public function getUserChores($userID, $familyID){
        $sql = "SELECT * FROM assigned_chore WHERE userID = ? AND familyID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$userID, $familyID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $assignedChores = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $assignedChore = new AssignedChore($row['userChoreID'], $row['userID'], $row['choreID'], $row['familyID'], $row['deadline'], $row['status']);
                $assignedChores[] = $assignedChore;
            }
        }
        return $assignedChores;
    }

    public function assignChore($chore, $user){
        $sql = "call AssignChore(:choreID, :user, :familyID, :deadline)";

        $statement = $this->connection->prepare($sql);

        $choreID = $chore->getChoreID();
        $familyID = $chore->getFamilyID();
        $deadline = $chore->getDeadline();

        $statement->bindParam(':choreID',$choreID, PDO::PARAM_INT);
        $statement->bindParam(':user',$user, PDO::PARAM_STR);
        $statement->bindParam(':familyID',$familyID, PDO::PARAM_INT);
        $statement->bindParam(':deadline',$deadline, PDO::PARAM_STR);

        $statement->execute();
    }

    public function editChore($choreID, $choreName, $choreDescription, $chorePoints){

        $sql = "call EditChore(:choreID, :choreName, :choreDescription, :points)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':choreID',$choreID, PDO::PARAM_INT);
        $statement->bindParam(':choreName',$choreName, PDO::PARAM_STR);
        $statement->bindParam(':choreDescription',$choreDescription, PDO::PARAM_STR);
        $statement->bindParam(':points',$chorePoints, PDO::PARAM_INT);

        $statement->execute();
    }

    public function addChore($chore){
        $sql = "call AddChore(:choreName, :choreDescription, :points, :penalty, :familyID)";

        $choreName = $chore->getChoreName();
        $choreDescription = $chore->getChoreDescription();
        $chorePoints = $chore->getPoints();
        $chorePenalty = $chore->getPenalty();
        $familyID = $chore->getFamilyID();

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':choreName',$choreName, PDO::PARAM_STR);
        $statement->bindParam(':choreDescription', $choreDescription, PDO::PARAM_STR);
        $statement->bindParam(':points', $chorePoints, PDO::PARAM_INT);
        $statement->bindParam(':penalty', $chorePenalty, PDO::PARAM_INT);
        $statement->bindParam(':familyID', $familyID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function deleteChore($choreID){
        $sql = "call DeleteChore(:choreID)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':choreID',$choreID, PDO::PARAM_STR);

        $statement->execute();
    }

    public function getUsers($familyID){
        $sql = "SELECT * FROM user WHERE familyID = ? ORDER BY points DESC";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$familyID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        if($resultSet){
            foreach($resultSet as $result){
                $user = new User($result['userID'], $result['firstName'], $result['lastName'], $result['type'],
                    $result['email'], $result['password'], $result['points'], $result['choresCompleted'], $result['familyID']);
                $users[] = $user;
            }
        }
        return $users;
    }

    public function addUser($user){
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $type = $user->getAccountType();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $points = $user->getPoints();
        $choresCompleted = $user->getChoresCompleted();
        $familyID = $user->getFamilyID();

        $sql = "call AddUser(:firstName, :lastName, :type, :email, :password, :points, :choresCompleted, :familyID)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':firstName',$firstName, PDO::PARAM_STR);
        $statement->bindParam(':lastName',$lastName, PDO::PARAM_STR);
        $statement->bindParam(':type',$type, PDO::PARAM_INT);
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
        $sql = "SELECT password, userID, familyID, type, points FROM user WHERE email = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$email]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function completeChore($assignedChoreID, $familyID){
        $sql = "call CompleteChore(:userChoreID, :familyID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':userChoreID',$assignedChoreID, PDO::PARAM_INT);
        $statement->bindParam(':familyID',$familyID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function reassignChore($assignedChoreID, $user, $familyID){
        $sql = "call ReassignChore(:userChoreID, :user, :familyID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':userChoreID',$assignedChoreID, PDO::PARAM_INT);
        $statement->bindParam(':user',$user, PDO::PARAM_STR);
        $statement->bindParam(':familyID',$familyID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function getUserDetails($userID){
        $sql = "SELECT firstName, lastName, email, points, choresCompleted FROM user WHERE userID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$userID]);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $user = null;
        foreach($results as $detail){
            $user = new User(null, $detail['firstName'], $detail['lastName'], null,$detail['email'],
                null, $detail['points'], $detail['choresCompleted'], null);
        }

        return $user;
    }

    public function changeEmail($currentEmail, $newEmail){
        $sql = "call ChangeEmail(:currentEmail, :newEmail)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':currentEmail',$currentEmail, PDO::PARAM_STR);
        $statement->bindParam(':newEmail',$newEmail, PDO::PARAM_STR);

        $statement->execute();
    }

    public function changePassword($email, $password){
        $sql = "call ChangePassword(:email, :password)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':email',$email, PDO::PARAM_STR);
        $statement->bindParam(':password',$password, PDO::PARAM_STR);

        $statement->execute();
    }

    public function getRewards($familyID){
        $sql = "SELECT * FROM rewards WHERE familyID = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$familyID]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $rewards = [];

        foreach($results as $reward){
            $newReward = new Reward($reward['rewardID'], $reward['rewardName'], $reward['rewardPoints']);
            $rewards[] = $newReward;
        }

        return $rewards;
    }

    public function requestReward($rewardID, $familyID, $userID){
        $sql = "call RequestReward(:rewardID, :familyID, :userID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':rewardID',$rewardID, PDO::PARAM_INT);
        $statement->bindParam(':familyID',$familyID, PDO::PARAM_INT);
        $statement->bindParam(':userID',$userID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function getRewardRequests($familyID){
        $sql = "SELECT * FROM reward_request WHERE familyID = ? AND requestStatus = 'PROCESSING'";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$familyID]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $requests = [];

        foreach($results as $request){
            $newRequest = new RewardRequest($request['requestID'], $request['rewardID'], $request['familyID'], $request['userID'], $request['requestStatus'], $request['date']);
            $requests[] = $newRequest;
        }

        return $requests;
    }

    public function approveRequest($requestID){
        $sql = "call ApproveRequest(:requestID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':requestID',$requestID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function declineRequest($requestID){
        $sql = "UPDATE reward_request SET requestStatus = 'DECLINED' WHERE requestID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$requestID]);
    }

    public function getPastRewards($familyID, $userID){
        $sql = "SELECT * FROM reward_request WHERE familyID = ? AND userID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$familyID, $userID]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $requests = [];

        foreach($results as $request){
            $newRequest = new RewardRequest($request['requestID'], $request['rewardID'], $request['familyID'], $request['userID'], $request['requestStatus'], $request['date']);
            $requests[] = $newRequest;
        }

        return $requests;
    }

    public function addNewReward($rewardName, $pointsCost, $familyID){
        $sql = "call AddReward(:rewardName, :pointsCost, :familyID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':rewardName',$rewardName, PDO::PARAM_STR);
        $statement->bindParam(':pointsCost',$pointsCost, PDO::PARAM_INT);
        $statement->bindParam(':familyID',$familyID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function getEvents($familyID){
        $sql = "SELECT * FROM event WHERE familyID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$familyID]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $events = [];
        foreach($results as $event){
            $newEvent = new CalendarEvent($event['eventID'], $event['eventName'], $event['eventDescription'],
                $event['eventType'], $event['eventDate'], $event['familyID'], $event['assignedChoreID']);
            $events[] = $newEvent;
        }

        return $events;
    }

    public function addEvent($eventName, $eventDescription, $eventDate, $familyID){
        $sql = "call AddEvent(:eventName, :eventDescription, :eventType, :eventDate, :familyID)";
        $eventType = 'EVENT';

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':eventName',$eventName, PDO::PARAM_STR);
        $statement->bindParam(':eventDescription',$eventDescription, PDO::PARAM_STR);
        $statement->bindParam(':eventType',$eventType, PDO::PARAM_STR);
        $statement->bindParam(':eventDate',$eventDate, PDO::PARAM_STR);
        $statement->bindParam(':familyID',$familyID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function getUserChore($familyID, $assignedChoreID){
        $sql = "call GetUserChore(:familyID, :assignedChoreID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':familyID',$familyID, PDO::PARAM_INT);
        $statement->bindParam(':assignedChoreID',$assignedChoreID, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchColumn();
    }

    public function getPenalty($assignedChoreID){
        $sql = "call GetPenalty(:assignedChoreID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':assignedChoreID',$assignedChoreID, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchColumn();
    }

    public function getUserPoints($assignedChoreID){
        $sql = "call GetUserPoints(:assignedChoreID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':assignedChoreID',$assignedChoreID, PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchColumn();
    }

    public function updatePoints($assignedChoreID, $points){
        $sql = "call UpdatePoints(:assignedChoreID, :points)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':assignedChoreID',$assignedChoreID, PDO::PARAM_INT);
        $statement->bindParam(':points',$points, PDO::PARAM_INT);

        $statement->execute();
    }

    public function incompleteChore($assignedChoreID, $familyID){
        $sql = "call IncompleteChore(:assignedChoreID, :familyID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':assignedChoreID',$assignedChoreID, PDO::PARAM_INT);
        $statement->bindParam(':familyID',$familyID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function checkEmail($email){
        $sql = "SELECT email FROM user WHERE email = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$email]);

        return $statement->fetchColumn();
    }
}