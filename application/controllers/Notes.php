<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Note_model');
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
        $notes = $this->Note_model->list_notes(false);

        // Auto-select first note if exists
        $selected = null;
        if (!empty($notes)) {
            $selected = $this->Note_model->get($notes[0]['id']);
        }

        $data = [
            'notes' => $notes,
            'selected' => $selected,
        ];

        $this->load->view('notes/index', $data);
    }

    public function view($id)
    {
        $notes = $this->Note_model->list_notes(false);
        $selected = $this->Note_model->get($id);

        if (!$selected || (int) $selected['is_deleted'] === 1) {
            redirect('notes');
            return;
        }

        $data = [
            'notes' => $notes,
            'selected' => $selected,
        ];

        $this->load->view('notes/index', $data);
    }

    public function create()
    {
        $id = $this->Note_model->create_empty();
        redirect('notes/' . $id);
    }

    public function save()
    {
        $id = (int) $this->input->post('id');
        $title = trim((string) $this->input->post('title'));
        $content = (string) $this->input->post('content');

        if ($title === '')
            $title = 'Untitled';

        $note = $this->Note_model->get($id);
        if (!$note || (int) $note['is_deleted'] === 1) {
            redirect('notes');
            return;
        }

        $this->Note_model->save($id, $title, $content);
        redirect('notes/' . $id);
    }

    public function delete($id)
    {
        $this->Note_model->soft_delete((int) $id);
        redirect('notes');
    }

    public function pin($id)
    {
        $this->Note_model->toggle_pin((int) $id);
        redirect($this->agent->referrer() ? $this->agent->referrer() : 'notes');
    }
}
