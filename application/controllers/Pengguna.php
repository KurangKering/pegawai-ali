<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;

class Pengguna extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->response['data']['roles'] = $this->M_Role->get();
        return view('pengguna.index', $this->response);
    }

    public function getData()
    {
        $this->jGetDataTable();
    }
    private function jGetDataTable()
    {
        $dt = new Datatables(new CodeigniterAdapter);
        $dt->query('SELECT
           pengguna.id,
           pengguna.username,
           pengguna.role_id,
           role.name as role_nama
           FROM user as pengguna
           JOIN role ON pengguna.role_id = role.id

           ');

        $dt->add('action', function ($data) {
            $isBoleh = in_array($data['role_id'], [1]);
            $html = '   
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" onClick="showModal(' . $data['id'] . ',1)"><i class="fas fa-edit"></i> Ubah</a>';
            $html .= "
            <button type=\"button\" class=\"btn  btn-sm btn-outline-danger\"";  
            if (!$isBoleh) {
                $html .= "disabled";
            }
            $html .= " onClick=\"showModal('{$data['id']}',2)\">
            <i class=\"fas fa-trash\"></i> Hapus</button>
            ";

            return $html;
        });

        echo $dt->generate();
    }

    public function insert()
    {
        $this->jInsert();
    }

    private function jInsert()
    {
        $auth = $this->auth;
        $this->load->library('form_validation');
        $post = $this->input->post();
        $this->form_validation->set_rules('role_id', 'Role', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->response['messages'] = array(
                'input-role_id'     => form_error('role_id', '<p class="mt-3 text-danger">', '</p>'),
                'input-username' => form_error('username', '<p class="mt-3 text-danger">', '</p>'),
                'input-password' => form_error('password', '<p class="mt-3 text-danger">', '</p>'),
            );
            $this->response['messages'] = array_filter($this->response['messages']);
            $this->response['success']  = 0;
        } else {

            $post_pengguna = array(
                'role_id'     => $post['role_id'],
                'username' => $post['username'],
                'password' => $post['password'],
            );

            $insert_data = $this->M_User->insert($post_pengguna);
        }

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->response));
    }

    public function update()
    {
        $this->jUpdate();
    }

    private function jUpdate()
    {
        $this->load->library('form_validation');
        $post = $this->input->post();
        $auth = $this->auth;
        $this->form_validation->set_rules('username', 'Username', 'trim|required');

        if (!$this->form_validation->run()) {
            $this->response['messages'] = array(
                'input-username' => form_error('username', '<p class="mt-3 text-danger">', '</p>'),
            );
            $this->response['messages'] = array_filter($this->response['messages']);
            $this->response['success']  = 0;

        } else {
            $post_pengguna = array(
                'username' => $post['username'],

            );
            if ($post['role_id'] != "null" && $post['role_id'] != null) {
                $post_pengguna['role_id'] = $post['role_id'];
            }

            if ($post['password']) {
                $post_pengguna['password'] = ($post['password']);
            }

            $data       = $this->M_User->findOrFail($post['id']);
            $data_update = $data->update($post_pengguna);
        }
        unset($this->response['account']);
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->response));
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->jDelete($id);
    }
    private function jDelete($id)
    {
        $data        = $this->M_User->findOrFail($id);
        $delete_data = $data->delete();

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($this->response));
    }

    public function detail()
    {
        $id = $this->input->post('id');
        $this->jGetDetail($id);
    }

    private function jGetDetail($id)
    {
        $data = $this->M_User->findOrFail($id);
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }

}

/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */
