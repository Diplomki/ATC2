<?php

class TeacherMap extends BaseMap
{
    public function findById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) as fio, teacher.user_id, otdel_id FROM teacher
            INNER JOIN user ON teacher.user_id = user.user_id WHERE teacher.user_id = $id");
            $teacher = $res->fetchObject("Teacher");
            if ($teacher) {
                return $teacher;
            }
        }
        return new Teacher();
    }

    public function save($user = User, $teacher = Teacher)
    {
        if ($user->validate() && $teacher->validate() && (new UserMap())->save($user)) {
            if ($teacher->user_id == 0) {
                $teacher->user_id = $user->user_id;
                return $this->insert($teacher);
            } else {
                return $this->update($teacher);
            }
        }
        return false;
    }

    private function insert($teacher = Teacher)
    {
        if (
            $this->db->exec("INSERT INTO teacher(user_id,
        otdel_id) VALUES($teacher->user_id, $teacher->otdel_id)") == 1
        ) {
            return true;
        }
        return false;
    }

    private function update($teacher = Teacher)
    {
        if ($this->db->exec("UPDATE teacher SET otdel_id = $teacher->otdel_id WHERE user_id=" . $teacher->user_id) == 1) {
            return true;
        }
        return false;
    }
    public function findAll($ofset = 0, $limit = 30)
    {
        if ($_SESSION['branch'] != 999) {
            $res = $this->db->query("SELECT user.user_id,  CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio, user.birthday, gender.name AS gender, otdel.name AS otdel, role.name AS role, branch.id AS branch FROM user 
        INNER JOIN teacher ON user.user_id=teacher.user_id 
        INNER JOIN gender ON user.gender_id=gender.gender_id 
        INNER JOIN otdel ON teacher.otdel_id=otdel.otdel_id
        INNER JOIN role ON user.role_id=role.role_id
        INNER JOIN branch ON branch.id=user.branch_id
        WHERE branch.id = {$_SESSION['branch']}
        LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        } else {
            $res = $this->db->query("SELECT user.user_id,  CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio, user.birthday, gender.name AS gender, otdel.name AS otdel, role.name AS role, branch.id AS branch, branch.branch AS branch_name FROM user 
            INNER JOIN teacher ON user.user_id=teacher.user_id 
            INNER JOIN gender ON user.gender_id=gender.gender_id 
            INNER JOIN otdel ON teacher.otdel_id=otdel.otdel_id
            INNER JOIN role ON user.role_id=role.role_id
            INNER JOIN branch ON branch.id=user.branch_id
            LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }
    }
    public function count()
    {
        if ($_SESSION['branch'] != 999) {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM teacher
        INNER JOIN user ON user.user_id = teacher.user_id
        WHERE user.branch_id = {$_SESSION['branch']}");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        } else {
            $res = $this->db->query("SELECT COUNT(*) AS cnt FROM teacher");
            return $res->fetch(PDO::FETCH_OBJ)->cnt;
        }
    }
    public function findProfileById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT teacher.user_id, otdel.name AS otdel, user.user_id, branch.branch FROM teacher 
            INNER JOIN user ON user.user_id=teacher.user_id 
            INNER JOIN branch ON branch.id=user.branch_id
            INNER JOIN otdel ON teacher.otdel_id=otdel.otdel_id WHERE teacher.user_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

    public function findOtdel()
    {
        $res = $this->db->query("SELECT user.user_id, otdel.otdel_id AS otdel_id FROM user 
        INNER JOIN teacher ON user.user_id=teacher.user_id 
        INNER JOIN otdel ON teacher.otdel_id=otdel.otdel_id WHERE teacher.user_id = {$_SESSION['id']}");
        return $res->fetch(PDO::FETCH_OBJ);
    }

    public function createHomework(Teacher $teacher)
    {

        $query = "INSERT INTO `homework_teacher` (`name`, `user_id`, `gruppa_id`, 
            `date_begin`, `date_end`, `subject_id`, `file`) 
            VALUES (:name, :user_id, :gruppa_id, :date_begin, :date_end, :subject_id, :file)";
        $res = $this->db->prepare($query);
        if (
            $res->execute(
                [
                    'name' => $teacher->name,
                    'user_id' => $_SESSION['id'],
                    'gruppa_id' => $teacher->gruppa_id,
                    'date_begin' => $teacher->date_begin,
                    'date_end' => $teacher->date_end,
                    'subject_id' => $teacher->subject_id,
                    'file' => $teacher->file
                ]
            ) == 1
        ) {
            return true;
        }
        return false;
    }


    public function findHomeworkByGruppaIdAndTeacherId($id)
    {
        $query = "SELECT 
        homework_parent.id as homework_id, 
        homework_parent.name as name, 
        homework_parent.teacher_id as teacher_id,
        CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) as student_fio,
        homework_parent.gruppa_id as gruppa_id 
        FROM homework_parent
        INNER JOIN user ON homework_parent.student_id = user.user_id
        WHERE homework_parent.gruppa_id = :id and homework_parent.teacher_id = :teacher_id";
        $res = $this->db->prepare($query);
        $res->execute([
            'id' => $id,
            'teacher_id' => $_SESSION['id']
        ]);
        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    public function findHomeworkById($id)
    {
        $query = "SELECT homework_parent.id as id,homework_parent.name as name, gruppa.name as gruppa, homework_parent.student_id as student_id, 
        CONCAT(user.lastname, ' ', user.firstname, ' ', user.patronymic) as student_fio,
        homework_parent.date_begin as date_begin, homework_parent.date_end as date_end,
        homework_parent.subject_id as subject_id,
        subject.name as subject,
        homework_parent.file as file,
        homework_parent.file_prepared as file_prepared
        FROM homework_parent
        INNER JOIN gruppa ON homework_parent.gruppa_id = gruppa.gruppa_id
        INNER JOIN user ON homework_parent.student_id = user.user_id
        INNER JOIN subject ON homework_parent.subject_id = subject.subject_id
        WHERE id = :id";
        $res = $this->db->prepare($query);
        $res->execute(['id' => $id]);
        return $res->fetch(PDO::FETCH_OBJ);
    }

    public function insertGradeFromHomework(Teacher $teacher)
    {
        $query1 = "INSERT INTO grades (user_id, subject_id, grade, date) VALUES (:user_id, :subject_id, :grade, NOW())";
        $res1 = $this->db->prepare($query1);
        if (
            $res1->execute([
                'user_id' => $teacher->user_id,
                'subject_id' => $teacher->subject_id,
                'grade' => $teacher->grade
            ])
        ) {
            $query2 = "DELETE FROM `homework_parent` WHERE `homework_parent`.`id` = :id";
            $res2 = $this->db->prepare($query2);
            if ($res2->execute(['id' => $teacher->id])) {
                return true;
            }
        }
        return false;
    }

    public function deleteTeacherById($id)
    {
        $query = "DELETE FROM teacher WHERE user_id = :id";
        $res = $this->db->prepare($query);
        $res->execute([
            'id' => $id
        ]);

        $query = "DELETE FROM user WHERE user_id = :id";
        $res = $this->db->prepare($query);
        $res->execute([
            'id' => $id
        ]);
    }
}