<?php
class Address_m extends CI_Model
{
    //reset all address to 0 if theres new default about to be assigned
    private function reset_default()
    {
        $this->db->query("UPDATE user_address SET is_default = 0 WHERE user_id = " . $this->db->escape($this->id));
    }

    public function getAddress()
    {
        $sql = "SELECT `address`, `ua_id`, `is_default` FROM `user_address` WHERE `user_id` = " . $this->db->escape($this->id) . " ORDER BY `is_default` DESC";
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function add_address($data = array())
    {
        $this->db->trans_begin();

        //kalau ada req default baru
        if (!empty($data['is_default'])) { 
            $this->reset_default();
            $data['is_default'] = 1;
        }

        //check is there any default value assigned yet
        $sql = "SELECT `is_default` FROM `user_address` WHERE `user_id` = " . $this->db->escape($this->id) . " AND `is_default` = 1 LIMIT 1";
        $rows = $this->db->query($sql)->num_rows();

        if ($rows == 0) {
            $data['is_default'] = 1;
        }

        $sql = "INSERT INTO `user_address` (`user_id`, `address`, `is_default`, `created_at`, `updated_at`) 
                VALUES  (" . $this->db->escape($this->id) . "," . $this->db->escape(trim($data['address'])) . "," . (int) $data['is_default'] . ", NOW(), NOW())";
        $this->db->query($sql);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return TRUE;
    }

    public function edit_address($data)
    {
        $this->db->trans_begin();

        //Make sure the address exists
        $sql = "SELECT `user_id`, `is_default` FROM `user_address` WHERE `ua_id` = " . $this->db->escape($data['ua_id']) . " LIMIT 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            return FALSE;
        }

        //Update address text if provided
        if (!empty($data['new_address'])) {
            $sql = "UPDATE `user_address` SET address = " . $this->db->escape(trim($data['new_address'])) . " WHERE ua_id = " . $this->db->escape($data['ua_id']);
            $this->db->query($sql);
        }

        if (!empty($data['is_default']) && $data['is_default'] == 1) {
            $this->reset_default();

            // Set the chosen one as default
            $sql = "UPDATE user_address SET is_default = 1 WHERE ua_id = " . $this->db->escape($data['ua_id']);
            $this->db->query($sql);
        }

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return TRUE;
    }

    public function delete_address($ua_id = '')
    {
        $this->db->trans_begin();

        //check targeted delete address is default or not
        $sql = "SELECT `is_default` FROM `user_address` WHERE `ua_id` = " . $this->db->escape($ua_id) . " AND `user_id` = " . $this->db->escape($this->id);
        $row = $this->db->query($sql)->row();
        $is_default = $row ? $row->is_default : 0;

        $sql = "DELETE FROM `user_address` WHERE `ua_id` = " . $this->db->escape($ua_id);
        $this->db->query($sql);

        if ($is_default == 1) {
            $sql = "SELECT `ua_id` FROM `user_address` WHERE `user_id` = " . $this->db->escape($this->id) . " LIMIT 1";
            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                $new_default_id = $query->row()->ua_id;

                $sql_set = "UPDATE `user_address` SET `is_default` = 1 WHERE `ua_id` = $new_default_id";
                $this->db->query($sql_set);
            }
        }

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return array(
                'status' => false,
                'message' => 'Address delete unsuccessful.'
            );
        }

        $this->db->trans_commit();
        return array(
            'status' => true,
            'message' => 'Address deleted successfully.'
        );
    }

    public function set_default($data = array())
    {
        $this->db->trans_begin();

        $this->reset_default();

        $sql = "UPDATE `user_address` SET `is_default` = 1 WHERE `ua_id` = " . $this->db->escape(trim($data['id'])) . "";
        $this->db->query($sql);

        if ($this->db->trans_status() == FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $this->db->trans_commit();
        return TRUE;
    }
}
