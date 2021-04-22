<?php

class Chore
{
    private $choreID;
    private $choreName;
    private $choreDescription;
    private $points;
    private $penalty;
    private $groupID;

    public function __construct($choreID, $choreName, $choreDescription, $points, $penalty, $groupID)
    {
        $this->choreID = $choreID;
        $this->choreName = $choreName;
        $this->choreDescription = $choreDescription;
        $this->points = $points;
        $this->penalty = $penalty;
        $this->groupID = $groupID;
    }

    /** ChoreID **/
    public function getChoreID()
    {
        return $this->choreID;
    }

    public function setChoreID($choreID)
    {
        $this->choreID = $choreID;
    }

    /** ChoreName **/
    public function getChoreName()
    {
        return $this->choreName;
    }

    public function setChoreName($choreName)
    {
        $this->choreName = $choreName;
    }

    /** ChoreDescription **/
    public function getChoreDescription()
    {
        return $this->choreDescription;
    }

    public function setChoreDescription($choreDescription)
    {
        $this->choreDescription = $choreDescription;
    }

    /** Points **/
    public function getPoints()
    {
        return $this->points;
    }

    public function setPoints($points)
    {
        $this->points = $points;
    }

    /** Penalty **/
    public function getPenalty()
    {
        return $this->penalty;
    }

    public function setPenalty($penalty)
    {
        $this->penalty = $penalty;
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
}