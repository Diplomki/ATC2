<?php
class Student extends Table
{
    public $user_id = 0;
    public $gruppa_id = 0;
    public $subject_id = 0;
    public $subject_count = 0;
    public $subject_price = 0;
    public $tab = '';

    public $num_zach = 0;
    function validate()
    {
        if (!empty($this->gruppa_id)) {
            return true;
        }
        return false;
    }
}
