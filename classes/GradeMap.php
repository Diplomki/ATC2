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

    public function findBySubjectId($date, $subject_id, $gruppa_id)
    {
        $query = "SELECT CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) as fio, 
        subject.name as subject, 
        grade_accept.grade as grade, 
        grade_accept.date as date, grade_accept.branch_id, gruppa.name FROM grade_accept
        INNER JOIN user ON user.user_id = grade_accept.user_id
        INNER JOIN student ON student.user_id = user.user_id
        INNER JOIN gruppa ON student.gruppa_id = gruppa.gruppa_id
        INNER JOIN subject ON subject.subject_id = grade_accept.subject_id
        WHERE grade_accept.grade != 0 and grade_accept.subject_id = :subject_id 
        and grade_accept.branch_id = {$_SESSION['branch']} 
        and date = :date and gruppa.gruppa_id = :gruppa_id";
        $res = $this->db->prepare($query);
        $res->execute([
            'subject_id' => $subject_id,
            'date' => $date,
            'gruppa_id' => $gruppa_id
        ]);
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
}