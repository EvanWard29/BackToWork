<?php
include_once "Chore.php";
include_once "User.php";
include_once "AssignedChore.php";
include_once "Group.php";
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

    /** Constructor */
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

    /** Methods **/

    //region Chores
    public function getAllChores($groupID){
        $sql = "SELECT * FROM chore WHERE groupID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$groupID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $chores = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $chore = new Chore($row['choreID'], $row['choreName'], $row['choreDescription'], $row['points'], $row['penalty'], $row['groupID']);
                $chores[] = $chore;
            }
        }
        return $chores;
    }

    public function getAssignedChores($groupID){
        $sql = "SELECT * FROM assigned_chore WHERE groupID = ? AND status = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$groupID, 'INCOMPLETE']);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $assignedChores = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $assignedChore = new AssignedChore($row['userChoreID'], $row['userID'], $row['choreID'], $row['groupID'], $row['deadline'], $row['status']);
                $assignedChores[] = $assignedChore;
            }
        }
        return $assignedChores;
    }

    public function getUserChores($userID, $groupID){
        $sql = "SELECT * FROM assigned_chore WHERE userID = ? AND groupID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$userID, $groupID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $assignedChores = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $assignedChore = new AssignedChore($row['userChoreID'], $row['userID'], $row['choreID'], $row['groupID'], $row['deadline'], $row['status']);
                $assignedChores[] = $assignedChore;
            }
        }
        return $assignedChores;
    }

    public function assignChore($chore, $user){
        $sql = "call AssignChore(:choreID, :user, :groupID, :deadline)";

        $statement = $this->connection->prepare($sql);

        $choreID = $chore->getChoreID();
        $groupID = $chore->getgroupID();
        $deadline = $chore->getDeadline();

        $statement->bindParam(':choreID',$choreID, PDO::PARAM_INT);
        $statement->bindParam(':user',$user, PDO::PARAM_STR);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);
        $statement->bindParam(':deadline',$deadline, PDO::PARAM_STR);

        $statement->execute();
    }

    public function editChore($choreID, $choreName, $choreDescription, $chorePoints, $groupID){

        $sql = "call EditChore(:choreID, :choreName, :choreDescription, :points, :groupID)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':choreID',$choreID, PDO::PARAM_INT);
        $statement->bindParam(':choreName',$choreName, PDO::PARAM_STR);
        $statement->bindParam(':choreDescription',$choreDescription, PDO::PARAM_STR);
        $statement->bindParam(':points',$chorePoints, PDO::PARAM_INT);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function addChore($chore){
        $sql = "call AddChore(:choreName, :choreDescription, :points, :penalty, :groupID)";

        $choreName = $chore->getChoreName();
        $choreDescription = $chore->getChoreDescription();
        $chorePoints = $chore->getPoints();
        $chorePenalty = $chore->getPenalty();
        $groupID = $chore->getgroupID();

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':choreName',$choreName, PDO::PARAM_STR);
        $statement->bindParam(':choreDescription', $choreDescription, PDO::PARAM_STR);
        $statement->bindParam(':points', $chorePoints, PDO::PARAM_INT);
        $statement->bindParam(':penalty', $chorePenalty, PDO::PARAM_INT);
        $statement->bindParam(':groupID', $groupID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function deleteChore($choreID, $groupID){
        $sql = "call DeleteChore(:choreID, :groupID)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':choreID',$choreID, PDO::PARAM_STR);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function completeChore($assignedChoreID, $groupID){
        $sql = "call CompleteChore(:userChoreID, :groupID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':userChoreID',$assignedChoreID, PDO::PARAM_INT);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function reassignChore($assignedChoreID, $user, $groupID){
        $sql = "call ReassignChore(:userChoreID, :user, :groupID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':userChoreID',$assignedChoreID, PDO::PARAM_INT);
        $statement->bindParam(':user',$user, PDO::PARAM_STR);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function getUserChore($groupID, $assignedChoreID){
        $sql = "call GetUserChore(:groupID, :assignedChoreID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);
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

    public function incompleteChore($assignedChoreID, $groupID){
        $sql = "call IncompleteChore(:assignedChoreID, :groupID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':assignedChoreID',$assignedChoreID, PDO::PARAM_INT);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function getChoreValue($assignedChoreID){
        $sql = "call GetChoreValue(:assignedChoreID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':assignedChoreID',$assignedChoreID, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchColumn();
    }
    //endregion

    //region Users
    public function getUsers($groupID){
        $sql = "SELECT * FROM user WHERE groupID = ? ORDER BY points DESC";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$groupID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        if($resultSet){
            foreach($resultSet as $result){
                $user = new User($result['userID'], $result['firstName'], $result['lastName'], $result['type'], $result['DOB'],
                    $result['email'], $result['password'], $result['points'], $result['choresCompleted'], $result['groupID']);
                $users[] = $user;
            }
        }
        return $users;
    }

    public function addUser($user, $groupName){
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $type = $user->getAccountType();
        $DOB = $user->getDOB();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $points = $user->getPoints();
        $choresCompleted = $user->getChoresCompleted();
        $groupID = $user->getgroupID();

        $sql = "call AddUser(:firstName, :lastName, :groupName, :type, :DOB, :email, :password, :points, :choresCompleted, :groupID)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':firstName',$firstName, PDO::PARAM_STR);
        $statement->bindParam(':lastName',$lastName, PDO::PARAM_STR);
        $statement->bindParam(':groupName', $groupName, PDO::PARAM_STR);
        $statement->bindParam(':type',$type, PDO::PARAM_INT);
        $statement->bindParam(':DOB',$DOB, PDO::PARAM_STR);
        $statement->bindParam(':email',$email, PDO::PARAM_STR);
        $statement->bindParam(':password',$password, PDO::PARAM_STR);
        $statement->bindParam(':points',$points, PDO::PARAM_INT);
        $statement->bindParam(':choresCompleted',$choresCompleted, PDO::PARAM_INT);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);

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
        $sql = "SELECT password, userID, groupID, type, points FROM user WHERE email = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$email]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function getUserDetails($userID){
        $sql = "SELECT firstName, lastName, DOB, email, points, choresCompleted FROM user WHERE userID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$userID]);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $user = null;
        foreach($results as $detail){
            $user = new User(null, $detail['firstName'], $detail['lastName'], null, $detail['DOB'], $detail['email'],
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

    public function checkEmail($email){
        $sql = "SELECT email FROM user WHERE email = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$email]);

        return $statement->fetchColumn();
    }

    public function deleteAccount($userID, $groupID){
        $sql = "DELETE FROM user WHERE groupID = ? AND userID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$groupID, $userID]);

        $sql = "UPDATE userGroup SET numMembers = numMembers - 1 WHERE groupID = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$groupID]);
    }

    public function disbandGroup($groupID){
        $sql = "call DisbandGroup(:groupID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);
        $statement->execute();
    }

    public function getGroupName($groupID){
        $sql = "SELECT groupName FROM userGroup WHERE groupID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$groupID]);

        return $statement->fetchColumn();
    }
    //endregion

    //region Rewards
    public function getRewards($groupID){
        $sql = "SELECT * FROM rewards WHERE groupID = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$groupID]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $rewards = [];

        foreach($results as $reward){
            $newReward = new Reward($reward['rewardID'], $reward['rewardName'], $reward['rewardPoints']);
            $rewards[] = $newReward;
        }

        return $rewards;
    }

    public function requestReward($rewardID, $groupID, $userID){
        $sql = "call RequestReward(:rewardID, :groupID, :userID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':rewardID',$rewardID, PDO::PARAM_INT);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);
        $statement->bindParam(':userID',$userID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function getRewardRequests($groupID){
        $sql = "SELECT * FROM reward_request WHERE groupID = ? AND requestStatus = 'PROCESSING'";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$groupID]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $requests = [];

        foreach($results as $request){
            $newRequest = new RewardRequest($request['requestID'], $request['rewardID'], $request['groupID'], $request['userID'], $request['requestStatus'], $request['date']);
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

    public function getPastRewards($groupID, $userID){
        $sql = "SELECT * FROM reward_request WHERE groupID = ? AND userID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$groupID, $userID]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $requests = [];

        foreach($results as $request){
            $newRequest = new RewardRequest($request['requestID'], $request['rewardID'], $request['groupID'], $request['userID'], $request['requestStatus'], $request['date']);
            $requests[] = $newRequest;
        }

        return $requests;
    }

    public function addNewReward($rewardName, $pointsCost, $groupID){
        $sql = "call AddReward(:rewardName, :pointsCost, :groupID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':rewardName',$rewardName, PDO::PARAM_STR);
        $statement->bindParam(':pointsCost',$pointsCost, PDO::PARAM_INT);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);

        $statement->execute();
    }
    //endregion

    //region Calendar
    public function getEvents($groupID){
        $sql = "SELECT * FROM event WHERE groupID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$groupID]);

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $events = [];
        foreach($results as $event){
            $newEvent = new CalendarEvent($event['eventID'], $event['eventName'], $event['eventDescription'],
                $event['eventType'], $event['eventDate'], $event['groupID'], $event['assignedChoreID']);
            $events[] = $newEvent;
        }

        return $events;
    }

    public function addEvent($eventName, $eventDescription, $eventDate, $groupID){
        $sql = "call AddEvent(:eventName, :eventDescription, :eventType, :eventDate, :groupID)";
        $eventType = 'EVENT';

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':eventName',$eventName, PDO::PARAM_STR);
        $statement->bindParam(':eventDescription',$eventDescription, PDO::PARAM_STR);
        $statement->bindParam(':eventType',$eventType, PDO::PARAM_STR);
        $statement->bindParam(':eventDate',$eventDate, PDO::PARAM_STR);
        $statement->bindParam(':groupID',$groupID, PDO::PARAM_INT);

        $statement->execute();
    }
    //endregion
}