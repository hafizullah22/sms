<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result_model extends CI_Model {

    public function get_all_results()
    {
        $this->db->select('results.*, students.name as student_name, classes.class_name, subjects.subject_name');
        $this->db->from('results');
        $this->db->join('students', 'students.id = results.student_id');
        $this->db->join('classes', 'classes.id = results.class_id');
        $this->db->join('subjects', 'subjects.id = results.subject_id');

        return $this->db->get()->result();
    }

    public function insert_result($data)
    {
        return $this->db->insert('results', $data);
    }

    public function get_result($id)
    {
        return $this->db->get_where('results', ['id' => $id])->row();
    }

    public function update_result($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('results', $data);
    }

    public function delete_result($id)
    {
        return $this->db->delete('results', ['id' => $id]);
    }
}