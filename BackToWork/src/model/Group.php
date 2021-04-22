<?php

class Group
{
    private $groupID;
    private $groupName;
    private $numMembers;

    public function __construct($groupID, $groupName, $numMembers)
    {
        $this->groupID = $groupID;
        $this->groupName = $groupName;
        $this->numMembers = $numMembers;
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

    /** Group Surname **/
    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
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