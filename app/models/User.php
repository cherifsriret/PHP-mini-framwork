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

	public function getUsername()
	{
		return $this->username;
	}

    public function setUsername($value)
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
}
