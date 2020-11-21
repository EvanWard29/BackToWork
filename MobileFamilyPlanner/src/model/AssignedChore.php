<?php

class AssignedChore
{
    private $assignedChoreID;
    private $choreID;
    private $userID;

    public function __construct($assignedChoreID, $choreID, $userID)
    {
        $this->assignedChoreID = $assignedChoreID;
        $this->choreID = $choreID;
        $this->userID = $userID;
    }

    /** Assigned Chore ID **/
    public function getAssignedChoreID()
    {
        return $this->assignedChoreID;
    }

    public function setAssignedChoreID($assignedChoreID)
    {
        $this->assignedChoreID = $assignedChoreID;
    }

    /** Chore ID **/
    public function getChoreID()
    {
        return $this->choreID;
    }

    public function setChoreID($choreID)
    {
        $this->choreID = $choreID;
    }

    /** User ID **/
    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }


}