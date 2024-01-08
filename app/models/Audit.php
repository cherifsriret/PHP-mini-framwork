<?php

/**
* The Audit class
*/
class Audit
{
    // Attributes
    private $id;

	private $course_id;

	private $average;

	private $updated_at;

    // Getters and Setters
    public function getId()
	{
		return $this->id;
	}

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getCourseId()
	{
		return $this->course_id;
	}

    public function setCourseId($value)
    {
        $this->course_id = $value;
    }

    public function getAverage()
	{
		return $this->average;
	}

    public function setAverage($value)
    {
        $this->average = $value;
    }

    public function getUpdatedAt()
	{
		return $this->updated_at;
	}

    public function setUpdatedAt($value)
    {
        $this->updated_at = $value;
    }

    public static function fetchAllByCourseId(int $course_id){
        $dbh = App::get('dbh');
        $statement = $dbh->prepare("SELECT * FROM `audits` WHERE `course_id` = ? ORDER BY `updated_at` DESC");
        $statement->bindParam(1, $course_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Audit');
    }

    
}
