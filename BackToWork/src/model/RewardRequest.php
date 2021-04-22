<?php


class RewardRequest
{
    private $requestID;
    private $rewardID;
    private $groupID;
    private $userID;
    private $status;
    private $date;

    public function __construct($requestID, $rewardID, $groupID, $userID, $status, $date)
    {
        $this->requestID = $requestID;
        $this->rewardID = $rewardID;
        $this->groupID = $groupID;
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

    /** Group ID **/
    public function getGroupID()
    {
        return $this->groupID;
    }

    public function setGroupID($groupID)
    {
        $this->groupID = $groupID;
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