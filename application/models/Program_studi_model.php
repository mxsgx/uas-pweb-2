<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program_studi_model extends CI_Model
{
    public int $id;

    public string $nama;

    private string $table_name = 'program_studi';

    public function to_array()
    {
        return array(
            'id' => $this->id,
            'nama' => $this->nama,
        );
    }

    public function update(array $data)
    {
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }

            $this->{$key} = $value;
        }

        return $this->update_program_studi($this->id, $data);
    }

    public function delete()
    {
        return $this->delete_program_studi($this->id);
    }

    public function create_program_studi(array $data)
    {
        $model = new Program_studi_model;

        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }

            $model->{$key} = $value;
        }

        $this->db->insert($this->table_name, $data);

        $model->id = (int) $this->db->insert_id();

        return $model;
    }

    public function update_program_studi(int $id, array $data)
    {
        return $this->db->update($this->table_name, $data, array('id' => $id));
    }

    public function delete_program_studi(int $id)
    {
        return $this->db->delete($this->table_name, array('id' => $id));
    }

    public function find_program_studi(array $where)
    {
        $model = new Program_studi_model;
        $data = $this->db->where($where)->get($this->table_name, 1)->first_row('array');

        if (!$data) {
            return NULL;
        }

        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }

        return $model;
    }

    public function search_program_studi(array $where = NULL)
    {
        if (!is_null($where)) {
            $this->db->where($where);
        }

        $data = $this->db->get($this->table_name)->result_array();
        $program_studi = array_map(function ($item) {
            $model = new Program_studi_model;

            foreach ($item as $key => $value) {
                $model->{$key} = $value;
            }

            return $model;
        }, $data);

        return $program_studi;
    }
}