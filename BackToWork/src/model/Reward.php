<?php

class Reward{
    private $rewardID;
    private $rewardName;
    private $points;

    public function __construct($rewardID, $rewardName, $points)
    {
        $this->rewardID = $rewardID;
        $this->rewardName = $rewardName;
        $this->points = $points;
    }

    /** Reward ID **/
    public function getRewardID(){
        return $this->rewardID;
    }

    public function setRewardID($rewardID){
        $this->rewardID = $rewardID;
    }

    /** Reward Name **/
    public function getRewardName(){
        return $this->rewardName;
    }

    public function setRewardName($rewardName){
        $this->rewardName = $rewardName;
    }

    /** Points **/
    public function getPoints(){
        return $this->points;
    }

    public function setPoints($points){
        $this->points = $points;
    }
}