<?php

class Chore
{
    private $choreID;
    private $choreName;
    private $choreDescription;
    private $points;

    public function __construct($choreID, $choreName, $choreDescription, $points)
    {
        $this->choreID = $choreID;
        $this->choreName = $choreName;
        $this->choreDescription = $choreDescription;
        $this->points = $points;
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
}