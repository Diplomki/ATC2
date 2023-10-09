<?php
class Procreator extends Table
{
    public $user_id = 0;
    public $child_id = 0;
    function validate()
    {
        if (!empty($this->child_id)) {
            return true;
        }
        return false;
    }
}