<?php

class StudentMap extends BaseMap
{
    public function findById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT user_id, gruppa_id
        FROM student WHERE user_id = $id");
            $student = $res->fetchObject("Student");
            if ($student) {
                return $student;
            }
        }
        return new Student();
    }
    public function save($user = User, $student = Student)
    {
        if ($user->validate() && $student->validate() && (new UserMap())->save($user)) {
            if ($student->user_id == 0) {
                $student->user_id = $user->user_id;
                return $this->insert($student);
            } else {
                return $this->update($student);
            }
        }
        return false;
    }
    public function savePayment($student = Student)
    {

        return $this->insertPayment($student);
    }

    private function insertPayment($student = Student)
    {
        if (
            $this->db->exec("INSERT INTO payment(parent_id, child_id, subject_id, count, price) VALUES({$_SESSION['id']}, $student->user_id, 
            $student->subject_id, $student->subject_count, $student->subject_price)") == 1
        ) {
            return true;
        }
        return false;
    }

    private function insert($student = Student)
    {
        if (
            $this->db->exec("INSERT INTO student(user_id,
        gruppa_id, num_zach) VALUES($student->user_id, $student->gruppa_id, $student->num_zach)") == 1
        ) {
            return true;
        }
        return false;
    }

    private function update($student = Student)
    {
        if ($this->db->exec("UPDATE student SET gruppa_id = $student->gruppa_id WHERE user_id=" . $student->user_id) == 1) {
            return true;
        }
        return false;
    }
    public function findAll($ofset = 0, $limit = 30)
    {
        if ($_SESSION['branch'] != 999) {
            $res = $this->db->query("SELECT user.user_id, CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio, user.birthday, gender.name AS gender, gruppa.name AS gruppa, role.name AS role, branch.id AS branch FROM user 
            INNER JOIN student ON user.user_id=student.user_id 
            INNER JOIN gender ON user.gender_id=gender.gender_id 
            INNER JOIN gruppa ON student.gruppa_id=gruppa.gruppa_id 
            INNER JOIN role ON user.role_id=role.role_id
            INNER JOIN branch ON user.branch_id = branch.id
            WHERE branch.id = {$_SESSION['branch']}
            LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        } else {
            $res = $this->db->query("SELECT user.user_id, CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio, user.birthday, gender.name AS gender, gruppa.name AS gruppa, role.name AS role, branch.id AS branch, branch.branch AS branch_name FROM user 
            INNER JOIN student ON user.user_id=student.user_id 
            INNER JOIN gender ON user.gender_id=gender.gender_id 
            INNER JOIN gruppa ON student.gruppa_id=gruppa.gruppa_id 
            INNER JOIN role ON user.role_id=role.role_id
            INNER JOIN branch ON user.branch_id = branch.id
            LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }

    }
    public function findStudentsFromGroup($id = null, $ofset = 0, $limit = 30)
    {
        if ($id) {
            $res = $this->db->query("SELECT user.user_id, CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio, user.birthday, gender.name AS gender, gruppa.name AS gruppa, 
            role.name AS role, branch.id as branch FROM user 
            INNER JOIN student ON user.user_id=student.user_id 
            INNER JOIN gender ON user.gender_id=gender.gender_id 
            INNER JOIN gruppa ON student.gruppa_id=gruppa.gruppa_id 
            INNER JOIN role ON user.role_id=role.role_id 
            INNER JOIN branch ON user.branch_id = branch.id 
            WHERE gruppa.gruppa_id = $id AND branch.id = {$_SESSION['branch']} LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }
    }

    public function findStudentsFromGrades($id = null, $ofset = 0, $limit = 30)
    {
        if ($id) {
            $res = $this->db->query("SELECT user.user_id, CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio,  
            branch.id as branch FROM user 
            INNER JOIN student ON user.user_id=student.user_id 
            INNER JOIN branch ON user.branch_id = branch.id 
            WHERE branch.id = {$_SESSION['branch']} LIMIT $ofset, $limit");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }
    }

    public function findStudentsFromParent($ofset = 0, $limit = 30)
    {
        $res = $this->db->query("SELECT user.user_id, CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio FROM parent
        INNER JOIN user ON user.user_id = parent.child_id
        WHERE parent.user_id = {$_SESSION['id']}
        LIMIT $ofset, $limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }


    public function count()
    {
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM student
        INNER JOIN user ON user.user_id = student.user_id
        INNER JOIN branch ON  user.branch_id = branch.id
        WHERE branch.id = {$_SESSION['branch']}");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }
    public function findProfileById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT student.user_id, gruppa.name AS gruppa, user.user_id, branch.branch FROM student 
            INNER JOIN user ON user.user_id=student.user_id 
            INNER JOIN branch ON branch.id=user.branch_id 
            INNER JOIN gruppa ON student.gruppa_id=gruppa.gruppa_id WHERE student.user_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

    public function findStudentById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT student.user_id, CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio FROM student 
            INNER JOIN user ON user.user_id=student.user_id
            WHERE student.user_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
}