<?php
class ProcreatorMap extends BaseMap
{
    public function findById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT user_id, child_id"
                . "FROM parent WHERE user_id = $id");
            return $res->fetchObject("Paren");
        }
        return new Procreator();
    }
}