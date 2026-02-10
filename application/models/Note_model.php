<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note_model extends CI_Model
{

    private $table = 'notes';

    public function list_notes($include_deleted = false)
    {
        if (!$include_deleted) {
            $this->db->where('is_deleted', 0);
        }
        $this->db->order_by('is_pinned', 'DESC');
        $this->db->order_by('updated_at', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => (int) $id])->row_array();
    }

    public function create_empty()
    {
        $data = [
            'title' => 'Untitled',
            'content' => '',
            'is_pinned' => 0,
            'is_deleted' => 0,
        ];
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function save($id, $title, $content)
    {
        $data = [
            'title' => $title,
            'content' => $content,
        ];
        $this->db->where('id', (int) $id);
        return $this->db->update($this->table, $data);
    }

    public function soft_delete($id)
    {
        $this->db->where('id', (int) $id);
        return $this->db->update($this->table, ['is_deleted' => 1]);
    }

    public function toggle_pin($id)
    {
        $note = $this->get($id);
        if (!$note)
            return false;

        $newVal = $note['is_pinned'] ? 0 : 1;
        $this->db->where('id', (int) $id);
        return $this->db->update($this->table, ['is_pinned' => $newVal]);
    }
}
