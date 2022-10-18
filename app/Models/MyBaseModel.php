<?php namespace App\Models;

use CodeIgniter\Model;

class MyBaseModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function escapeDataXSS(array $data)
    {
        return esc($data);
    }

    protected function setSQLMode()
    {
        $this->db->simpleQuery("set session sql_mode=''");
    }
}
