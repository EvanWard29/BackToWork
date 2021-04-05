<?php


class RewardRequest
{
    private $requestID;
    private $rewardID;
    private $familyID;
    private $userID;
    private $status;
    private $date;

    public function __construct($requestID, $rewardID, $familyID, $userID, $status, $date)
    {
        $this->requestID = $requestID;
        $this->rewardID = $rewardID;
        $this->familyID = $familyID;
        $this->userID = $userID;
        $this->status = $status;
        $this->date = $date;
    }

    /** Request ID **/
    public function getRequestID()
    {
        return $this->requestID;
    }

    public function setRequestID($requestID)
    {
        $this->requestID = $requestID;
    }

    /** Reward ID **/
    public function getRewardID()
    {
        return $this->rewardID;
    }

    public function setRewardID($rewardID)
    {
        $this->rewardID = $rewardID;
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

    /** User ID  **/
    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /** Status  **/
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    /** Date  **/
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
}