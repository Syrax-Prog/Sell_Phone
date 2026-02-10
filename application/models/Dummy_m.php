<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dummy_m extends CI_Model
{

    public $id;
    public $name;

    public function load_dummy_data($row_id)
    {
        // Simulate data from database
        $dummy = [
            1 => ['id' => 1, 'name' => 'Ali'],
            2 => ['id' => 2, 'name' => 'Bakar'],
            3 => ['id' => 3, 'name' => 'Charlie'],
        ];

        if (!isset($dummy[$row_id])) {
            return false;
        }

        // Set model properties dynamically like access_m does
        foreach ($dummy[$row_id] as $k => $v) {
            $this->{$k} = $v;
        }

        return true;
    }

    public function arrayQuery()
    {
        $i = 0;
        $test = array(
            'username' => "test $i",
            'password' => md5($i),
            'email' => "$i@gmail.com",
            'role' => 'User',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s')
        );

        foreach ($test as $k => $v) {
            $insert["`" . $k . "`"] = $this->db->escape($v);
        }


        $sql = "INSERT INTO `user` (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
        // return $this->db->query($sql);
        $data['sql'] = $sql;
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit;
    }
}
