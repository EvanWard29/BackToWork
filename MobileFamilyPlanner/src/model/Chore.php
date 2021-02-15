<?php

class Chore
{
    private $choreID;
    private $choreName;
    private $choreDescription;

    public function __construct($choreID, $choreName, $choreDescription)
    {
        $this->choreID = $choreID;
        $this->choreName = $choreName;
        $this->choreDescription = $choreDescription;
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
}