<?php

/**
* The Course class
*/
class Course
{
    // Attributes
    private $id;

	private $name;

	private $description;

	private $coeficient;

	private $average;

	private $notes;


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

    public function getCoeficient()
	{
		return $this->coeficient;
	}

    public function setCoeficient($value)
    {
        $this->coeficient = $value;
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

    public static function fetchAll(){
        $dbh = App::get('dbh');
        $statement = $dbh->prepare("SELECT * FROM `courses` ORDER BY `name` ASC");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Course');
    }
}
