<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 */
class User_model extends CI_Model
{
    public int $id;

    public string $nama;

    public string $email;

    public string $role;

    public string $password;

    private string $table_name = 'user';

    public function to_array()
    {
        return array(
            'id' => $this->id,
            'nama' => $this->nama,
            'email' => $this->email,
            'role' => $this->role,
            'password' => $this->password,
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

        return $this->update_user($this->id, $data);
    }

    public function delete()
    {
        return $this->delete_user($this->id);
    }

    public function create_user(array $data)
    {
        $model = new User_model;

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

    public function update_user(int $id, array $data)
    {
        return $this->db->update($this->table_name, $data, array('id' => $id));
    }

    public function delete_user(int $id)
    {
        return $this->db->delete($this->table_name, array('id' => $id));
    }

    public function find_user(array $where)
    {
        $model = new User_model;
        $data = $this->db->where($where)->get($this->table_name, 1)->first_row('array');

        if (!$data) {
            return NULL;
        }

        foreach ($data as $key => $value) {
            $model->{$key} = $value;
        }

        return $model;
    }

    public function search_user(array $where = NULL)
    {
        if (!is_null($where)) {
            $this->db->where($where);
        }

        $data = $this->db->get($this->table_name)->result_array();
        $user = array_map(function ($item) {
            $model = new User_model;

            foreach ($item as $key => $value) {
                $model->{$key} = $value;
            }

            return $model;
        }, $data);

        return $user;
    }
}