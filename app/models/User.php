<?php

/**
* The User class
*/
class User
{
    // Attributes
    private $id;

	private $username;

	private $email;

	private $password;

    private $first_name;

	private $last_name;

    // Getters and Setters
    public function getId()
	{
		return $this->id;
	}

    public function setId($value)
    {
        $this->id = $value;
    }

	public function getUserName()
	{
		return $this->username;
	}

    public function setUserName($value)
    {
        $this->username = $value;
    }

    public function getEmail()
	{
		return $this->email;
	}

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getPassword()
	{
		return $this->password;
	}

    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getFirstName()
	{
		return $this->first_name;
	}

    public function setFirstName($value)
    {
        $this->first_name = $value;
    }

    public function getLastName()
	{
		return $this->last_name;
	}

    public function setLastName($value)
    {
        $this->last_name = $value;
    }

    
}
