<?php
class Admin extends Table
{
    public $user_id = 0;
    public $child_id = 0;
    public $branch_id = 0;
    public $text = '';
    public $subject_id = 0;
    public $role_id = 0;
    public $date = "";

    function validate()
    {
        if (!empty($this->branch_id)) {
            return true;
        }
        return false;
    }
}
