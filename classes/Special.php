<?php
class Special extends Table
{
    public $special_id = 0;
    public $subject_id = 0;
    public $time_begin = '';
    public $time_end = '';
    function validate()
    {
        if (
            !empty ($this->subject_id) &&
            !empty ($this->time_begin) &&
            !empty ($this->time_end)
        ) {
            return true;
        }
        return false;
    }
}
