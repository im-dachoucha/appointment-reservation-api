<?php
class User extends Model
{
    public function __construct()
    {
        parent::__construct("user", "uuid");
    }

    public function get_users()
    {
        return $this->execute("SELECT * FROM `$this->table`");
    }

    public function get_user($uuid)
    {
        return $this->execute("SELECT * FROM `$this->table` WHERE `uuid` = ?", [$uuid]);
    }

    public function create_user($data)
    {
        $this->execute("INSERT INTO `$this->table` (`uuid`, `firstname`, `lastname`, `birthdate`) VALUES (?, ?, ?, ?)", $data);
    }
}
