<?php
require "app/models/Audit.php";
/**
* The Course class
*/
class Course
{
    // Attributes
    private $id;

	private $name;

	private $description;

	private $average;

	private $notes;

	private $audits;

    // Getters and Setters
    public function getId()
	{
		return $this->id;
	}

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getName()
	{
		return $this->name;
	}

    public function setName($value)
    {
        $this->name = $value;
    }

	public function getDescription()
	{
		return $this->description;
	}

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getAverage()
	{
		return $this->average;
	}

    public function setAverage($value)
    {
        $this->average = $value;
    }

    public function getNotes()
	{
		return $this->notes;
	}

    public function setNotes($value)
    {
        $this->notes = $value;
    }

    
    public function getAudits()
	{
		return $this->audits;
	}

    public function setAudits($value)
    {
        $this->audits = $value;
    }

    public static function fetchAll(){
        $dbh = App::get('dbh');
        $statement = $dbh->prepare("SELECT * FROM `courses` ORDER BY `name` ASC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Course');
    }


    public static function fetchId(int $id){
        $dbh = App::get('dbh');
        $statement = $dbh->prepare("SELECT * FROM `courses` WHERE `id` = ? ");
        $statement->bindParam(1, $id, PDO::PARAM_INT);
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Course');
        $statement->execute();
        $course = $statement->fetch();
        //set audits
        $course->setAudits(Audit::fetchAllByCourseId($id));
        return $course;
    }

    
}
