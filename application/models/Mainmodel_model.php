<?php
class Mainmodel_model extends CI_Model
{
    public function getOne($data)
    {
        $this->db->select('DISTINCT(' . $data['what'] . ')');

        return $this->db->get('photograph')->result_array();
    }
    public function verifyuser($data)
    {
        $res = $this->db->get_where('logindb', $data)->num_rows();
        return $res === 1 ? true : false;
    }
    public function newupload($data)
    {
        $this->db->insert('photograph', $data);
    }
    public function getCategory($data)
    {
        $this->db->select('title, path, order, category');
        $this->db->where('category', $data);
        $this->db->order_by('order');
        return $this->db->get('photograph')->result_array();
    }
    public function getHome()
    {
        $this->db->select('title, path, order, category');
        $this->db->order_by('order');
        return $this->db->get('photograph')->result_array();
    }
    public function updatePhotoinfo($data)
    {
        $this->db->where('path', $data['path']);
        echo $this->db->update('photograph', $data);
    }

    public function deleteUploaded($data)
    {
        $this->db->delete('photograph', $data);
    }

    public function adduser($data)
    {
        $this->db->insert('logindb', $data);
    }

    public function removeuser($data)
    {
        $this->db->delete('logindb', $data);
    }

    public function updateEdited($data)
    {
        $this->db->where('adminemail', $_SESSION['superemail']);
        $this->db->update('logindb', $data);
    }
}
