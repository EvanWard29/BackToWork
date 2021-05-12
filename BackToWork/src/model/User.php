<?php

class User
{
    private $userID;
    private $firstName;
    private $lastName;
    private $type;
    private $DOB;
    private $email;
    private $password;
    private $points;
    private $choresCompleted;
    private $groupID;

    public function __construct($userID, $firstName, $lastName, $type, $DOB, $email, $password, $points, $choresCompleted, $groupID)
    {
        $this->userID = $userID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->type = $type;
        $this->DOB = $DOB;
        $this->email = $email;
        $this->password = $password;
        $this->points = $points;
        $this->choresCompleted = $choresCompleted;
        $this->groupID = $groupID;
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

    /** First Name **/
    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /** Lastname **/
    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /** Account Type **/
    public function getAccountType()
    {
        return $this->type;
    }

    public function setAccountType($type)
    {
        $this->type = $type;
    }

    /** Date of Birth **/
    public function getDOB(){
        return $this->DOB;
    }

    public function setDOB($DOB){
        $this->DOB = $DOB;
    }

    /** Email **/
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    /** Password **/
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
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

    /** Chores Completed **/
    public function getChoresCompleted()
    {
        return $this->choresCompleted;
    }

    public function setChoresCompleted($choresCompleted)
    {
        $this->choresCompleted = $choresCompleted;
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