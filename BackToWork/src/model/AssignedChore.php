<?php

class AssignedChore
{
    private $assignedChoreID;
    private $userID;
    private $choreID;
    private $familyID;
    private $deadline;
    private $status;

    public function __construct($assignedChoreID, $userID, $choreID, $familyID, $deadline, $status)
    {
        $this->assignedChoreID = $assignedChoreID;
        $this->userID = $userID;
        $this->choreID = $choreID;
        $this->familyID = $familyID;
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

    /** Family ID **/
    public function getFamilyID()
    {
        return $this->familyID;
    }

    public function setFamilyID($familyID)
    {
        $this->familyID = $familyID;
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