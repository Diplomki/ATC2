<?php

class AdminMap extends BaseMap
{
    public function findById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT user_id, branch_id
        FROM admin WHERE user_id = $id");
            $admin = $res->fetchObject("Admin");
            if ($admin) {
                return $admin;
            }
        }
        return new Admin();
    }

    public function save($user = User, $admin = Admin)
    {
        if ($user->validate() && (new UserMap())->save($user)) {
            if ($admin->user_id == 0) {
                $admin->user_id = $user->user_id;
                return $this->insert($admin);
            } else {
                return $this->update($admin);
            }
        }
        return false;
    }

    private function insert($admin = Admin)
    {
        if (
            $this->db->exec("INSERT INTO admin(user_id, branch_id) VALUES($admin->user_id, $admin->branch_id)") == 1
        ) {
            return true;
        }
        return false;
    }
    public function insertNotice($admin = Admin)
    {

        $query = "INSERT INTO `notice` (`text`, `user_id`, `date`) VALUES (:text, :user_id, :date)";
        $res = $this->db->prepare($query);
        if (
            $res->execute([
                'text' => $admin->text,
                'user_id' => $admin->user_id,
                'date' => $admin->date
            ]) == 1
        )
            return true;
        return false;
    }
    private function update($admin = Admin)
    {
        if (
            $this->db->exec("UPDATE admin
        INNER JOIN user ON admin.branch_id = user.branch_id
        SET admin.branch_id = $admin->branch_id, user.branch_id = $admin->branch_id
        WHERE user.user_id = $admin->user_id") == 1
        ) {
            return true;
        }
        return false;
    }
    public function findAll($ofset = 0, $limit = 30)
    {
        $res = $this->db->query("SELECT user.user_id,  CONCAT(user.lastname,' ', user.firstname, ' ', user.patronymic) AS fio, user.birthday, gender.name AS gender, role.name AS role, branch.id AS branch, branch.branch AS branch_name FROM user 
        INNER JOIN admin ON user.user_id=admin.user_id 
        INNER JOIN gender ON user.gender_id=gender.gender_id 
        INNER JOIN role ON user.role_id=role.role_id
        INNER JOIN branch ON branch.id=user.branch_id
            LIMIT $ofset, $limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
    public function count()
    {
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM admin");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }
    public function findProfileById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT admin.user_id, branch.branch FROM admin 
            INNER JOIN branch ON admin.branch_id = branch.id
            WHERE admin.user_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
}