<?php
class GradeMap extends BaseMap
{
    public function findById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT grade_id, user_id,
        subject_id, grade, date"
                . "FROM grades WHERE grade_id = $id");
            return $res->fetchObject("Grade");
        }
        return new Grade();
    }

    public function findBySubjectId($id = null)
    {
        if ($id != 0) {
            $query = "SELECT CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) as fio, subject.name as subject, 
            grade_accept.grade as grade, 
            grade_accept.date as date, grade_accept.branch_id FROM grade_accept 
        INNER JOIN user ON user.user_id = grade_accept.user_id
        INNER JOIN subject ON subject.subject_id = grade_accept.subject_id
        WHERE grade_accept.grade != 0 and grade_accept.subject_id = :id and grade_accept.branch_id = {$_SESSION['branch']}";
            $res = $this->db->prepare($query);
            $res->execute(['id' => $id]);
            return $res->fetchAll(PDO::FETCH_OBJ);
        } else {
            $query = "SELECT CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) as fio, subject.name as subject, 
            grade_accept.grade as grade, 
            grade_accept.date as date FROM grade_accept 
        INNER JOIN user ON user.user_id = grade_accept.user_id
        INNER JOIN subject ON subject.subject_id = grade_accept.subject_id
        WHERE grade_accept.grade != 0 and grade_accept.branch_id = {$_SESSION['branch']}";
            $res = $this->db->prepare($query);
            $res->execute();
            return $res->fetchAll(PDO::FETCH_OBJ);
        }
    }
}