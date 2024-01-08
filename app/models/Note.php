<?php

/**
* The Note class
*/
class Note
{
    // Attributes
    private $id;

    private $course_id;

	private $user_id ;
    
	private $coeficient;

	private $note;

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

	public function getUserId()
	{
		return $this->user_id;
	}

    public function setUserId($value)
    {
        $this->user_id = $value;
    }

    public function getNote()
	{
		return $this->note;
	}

    public function setNote($value)
    {
        $this->note = $value;
    }

    public function getCoeficient()
	{
		return $this->coeficient;
	}

    public function setCoeficient($value)
    {
        $this->coeficient = $value;
    }

    public static function fetchAll($course_id){
        $dbh = App::get('dbh');
        $user_id =Helper::getCurrentUserId();
        $statement = $dbh->prepare("SELECT *  FROM `notes` WHERE `user_id` = ?  AND  `course_id` = ?  ");
        $statement->bindParam(1, $user_id, PDO::PARAM_INT);
        $statement->bindParam(2, $course_id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'NOTE');
    }
    
    public function update()
    {
        $dbh = App::get('dbh');

        // prepared statement with question mark placeholders (marqueurs de positionnement)
        $req = "UPDATE notes SET user_id = ?, course_id = ?, note = ? WHERE id = ?";

        $statement = $dbh->prepare($req);
        $statement->bindParam(1, $this->user_id, PDO::PARAM_INT);
        $statement->bindParam(2, $this->course_id, PDO::PARAM_INT);
        $statement->bindParam(3, $this->note, PDO::PARAM_STR);
        $statement->bindParam(4, $this->id, PDO::PARAM_INT);

        // use exec() because no results are returned
        $statement->execute();
    }

    public function create()
    {
        $dbh = App::get('dbh');

        // prepared statement with question mark placeholders (marqueurs de positionnement)
        $req = "INSERT INTO notes (user_id, course_id, note , coeficient) VALUES (?, ?, ?, ?)";

        $statement = $dbh->prepare($req);
        $statement->bindParam(1, $this->user_id, PDO::PARAM_INT);
        $statement->bindParam(2, $this->course_id, PDO::PARAM_INT);
        $statement->bindParam(3, $this->note, PDO::PARAM_STR);
        $statement->bindParam(4, $this->coeficient, PDO::PARAM_INT);
        // use exec() because no results are returned
        $statement->execute();

        //push to log
        Helper::logAction("create a note id: ".$dbh->lastInsertId());

    }
}
