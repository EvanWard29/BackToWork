<?php

class User
{
    private $userID;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $points;
    private $familyID;

    public function __construct($userID, $firstName, $lastName, $email, $password, $points, $familyID)
    {
        $this->userID = $userID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->points = $points;
        $this->familyID = $familyID;
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

    /** Family ID **/
    public function getFamilyID()
    {
        return $this->familyID;
    }

    public function setFamilyID($familyID)
    {
        $this->familyID = $familyID;
    }


}