<?php
class Admin extends Table
{
    public $user_id = 0;
    function validate()
    {
        if (!empty($this->user_id)) {
            return true;
        }
        return false;
    }
}
