<?php
class Teacher extends Table
{
  public $name = '';
  public $user_id = 0;
  public $gruppa_id = 0;
  public $date_begin = '';
  public $date_end = '';
  public $subject_id = 0;
  public $file = '';
  public $otdel_id = 0;
  function validate()
  {
    if (!empty($this->otdel_id)) {
      return true;
    }
    return false;
  }
}
