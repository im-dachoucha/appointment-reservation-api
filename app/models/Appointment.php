<?php
class Appointment extends Model
{
    public function __construct()
    {
        parent::__construct("appointment", "appid");
    }

    public function reserve_appointment($values){
        $this->execute("INSERT INTO `{$this->table}` (`uuid`, `appdate`, `timeslot`) VALUES (?, ?, ?)", $values);
    }

    public function get_reserved_appointments($uuid){
        return $this->execute("SELECT * FROM `{$this->table}` WHERE `uuid` = ?", [$uuid]);
    }

    public function delete_appointment($appid){
        $this->execute("DELETE FROM `{$this->table}` WHERE `appid` = ?", [$appid]);
    }
}