<?php

class CalendarEvent
{
    private $eventID;
    private $eventName;
    private $eventDescription;
    private $eventType;
    private $eventDate;
    private $familyID;
    private $assignedChoreID;

    public function __construct($eventID, $eventName, $eventDescription, $eventType, $eventDate, $familyID, $assignedChoreID)
    {
        $this->eventID = $eventID;
        $this->eventName = $eventName;
        $this->eventDescription = $eventDescription;
        $this->eventType = $eventType;
        $this->eventDate = $eventDate;
        $this->familyID = $familyID;
        $this->assignedChoreID = $assignedChoreID;
    }

    /** Event ID **/
    public function getEventID()
    {
        return $this->eventID;
    }

    public function setEventID($eventID)
    {
        $this->eventID = $eventID;
    }

    /** Event Name **/
    public function getEventName()
    {
        return $this->eventName;
    }

    public function setEventName($eventName)
    {
        $this->eventName = $eventName;
    }

    /** Event Description **/
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    public function setEventDescription($eventDescription)
    {
        $this->eventDescription = $eventDescription;
    }

    /** Event Type **/
    public function getEventType()
    {
        return $this->eventType;
    }

    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
    }

    /** Event Date **/
    public function getEventDate()
    {
        return $this->eventDate;
    }

    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;
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

    /** Assigned Chore ID **/
    public function getAssignedChoreID()
    {
        return $this->assignedChoreID;
    }

    public function setAssignedChoreID($assignedChoreID)
    {
        $this->assignedChoreID = $assignedChoreID;
    }


}