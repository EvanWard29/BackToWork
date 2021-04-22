<?php

class AssignedChore
{
    private $assignedChoreID;
    private $userID;
    private $choreID;
    private $groupID;
    private $deadline;
    private $status;

    public function __construct($assignedChoreID, $userID, $choreID, $groupID, $deadline, $status)
    {
        $this->assignedChoreID = $assignedChoreID;
        $this->userID = $userID;
        $this->choreID = $choreID;
        $this->groupID = $groupID;
        $this->deadline = $deadline;
        $this->status = $status;
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

    /** Group ID **/
    public function getGroupID()
    {
        return $this->groupID;
    }

    public function setGroupID($groupID)
    {
        $this->groupID = $groupID;
    }

    /** Deadline **/
    public function getDeadline()
    {
        return $this->deadline;
    }

    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    /** Status **/
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}