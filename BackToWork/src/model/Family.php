<?php

class Family
{
    private $familyID;
    private $familyName;
    private $numMembers;

    public function __construct($familyID, $familyName, $numMembers)
    {
        $this->familyID = $familyID;
        $this->familyName = $familyName;
        $this->numMembers = $numMembers;
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

    /** Family Surname **/
    public function getFamilyName()
    {
        return $this->familyName;
    }

    public function setFamilyName($familyName)
    {
        $this->familyName = $familyName;
    }

    /** Number of Members **/
    public function getNumMembers()
    {
        return $this->numMembers;
    }

    public function setNumMembers($numMembers)
    {
        $this->numMembers = $numMembers;
    }


}