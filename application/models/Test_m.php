<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Test_m extends CI_Model
{
    public function test_user($id = '')
    {
        $sql = "SELECT * FROM user WHERE user_id = " . $this->db->escape($id);
        $query = $this->db->query($sql);

        if (!empty($query->row())) {
            foreach ($query->row() as $k => $v) {
                $this->{$k} = $v;
            }

            return true;
        }

        return false;
    }
}