<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Illuminate\Database\Capsule\Manager as DB;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\CodeigniterAdapter;
use Illuminate\Support\Carbon;

class Pegawai extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->TABLE_PEGAWAI = $this->M_Pegawai->getTable();
        $this->TABLE_USER = $this->M_User->getTable();
    }
    public function index()
    {
        return view('pegawai.index', $this->response);
    }
    public function getData()
    {
        $this->jGetDataTable();
    }
    private function jGetDataTable()
    {
        $dt = new Datatables(new CodeigniterAdapter);
        $dt->query('SELECT
            id,
            nama,
            tempat_lahir,
            tanggal_lahir,
            email,
            alamat,
            no_hp,
            file_foto
            FROM pegawai

            ');
          $dt->add('file_foto_html', function ($data) {
            $image = $this->uploadmanager->getFullPathFotoPegawai($data['file_foto']);
            $html = '<img src="'.$image.'" style="width: 80px">';
            return $html;
        });
        $dt->add('action', function ($data) {
            $html = '
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" onClick="showModal(' . $data['id'] . ',1)"><i class="fas fa-edit"></i> Ubah</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" onClick="showModal(' . $data['id'] . ',2)"><i class="fas fa-trash"></i> Hapus</a>';
            return $html;
        });
        $dt->add('tempat_tanggal_lahir', function ($data) {
            $tanggal_lahir = indoDate($data['tanggal_lahir'], 'j F Y');
            $tempat_lahir = $data['tempat_lahir'];
            $output = "{$tempat_lahir}, {$tanggal_lahir}";
            return $output;
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

        $this->form_validation->set_rules('input-nama', 'NAMA', 'trim|required');
        $this->form_validation->set_rules('input-tanggal_lahir', 'TANGGAL LAHIR', 'trim|required');
        $this->form_validation->set_rules('input-tempat_lahir', 'TEMPAT LAHIR', 'trim|required');
        $this->form_validation->set_rules('input-email', 'EMAIL', 'trim|required');
        $this->form_validation->set_rules('input-alamat', 'ALAMAT', 'trim|required');
        $this->form_validation->set_rules('input-username', 'USERNAME', 'trim|required');
        $this->form_validation->set_rules('input-password', 'PASSWORD', 'trim|required');


        if (!$this->form_validation->run()) {
            $inputs= array( 
                'input-nama',
                'input-tanggal_lahir',
                'input-tempat_lahir',
                'input-email',
                'input-alamat',
                'input-username',
                'input-password',
            );
            foreach ($inputs as $key => $value) {
                $this->response['messages'][$value] = form_error($value, '<p class="mt-3 text-danger">', '</p>');
            }

            $this->response['messages'] = array_filter($this->response['messages']);
            $this->response['success']  = 0;
        } else {

            $post_pegawai = array(
                'nama'           => $post['input-nama'],
                'tanggal_lahir' => $post['input-tanggal_lahir'],
                'tempat_lahir'        => $post['input-tempat_lahir'],
                'email'         => $post['input-email'],
                'alamat'      => $post['input-alamat'],
            );
            $post_pengguna = array(
                'username' => $post['input-username'],
                'password' => $post['input-password'],
                'role_id'  => 3,
            );

            $responseUploadFoto = $this->uploadmanager->uploadFotoPegawai('input-file_foto');

            if ($responseUploadFoto['success'] == 'Y') {
                $post_pegawai['file_foto'] = $responseUploadFoto['upload_data']['file_name'];
            }
            DB::beginTransaction();
            try {

                $pegawai_id                   = DB::table($this->TABLE_PEGAWAI)->insertGetId($post_pegawai);
                $post_pengguna['reference_user_id'] = $pegawai_id;
                $info_user                = DB::table($this->TABLE_USER)->insert($post_pengguna);

                DB::commit();


            } catch (Exception $e) {
                var_dump($e->getMessage());
                DB::rollback();
                if ($responseUploadFoto['success'] == 'Y') {
                    $this->uploadmanager->removeFotoPegawai($responseUploadFoto['file_name']);
                }
                $this->response['success'] = 0;
            }
        }
        unset($this->response['account']);
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
        $this->form_validation->set_rules('input-nama', 'NAMA', 'trim|required');
        $this->form_validation->set_rules('input-tanggal_lahir', 'TANGGAL LAHIR', 'trim|required');
        $this->form_validation->set_rules('input-tempat_lahir', 'TEMPAT LAHIR', 'trim|required');
        $this->form_validation->set_rules('input-email', 'EMAIL', 'trim|required');
        $this->form_validation->set_rules('input-no_hp', 'NO HP', 'trim|required');
        $this->form_validation->set_rules('input-alamat', 'ALAMAT', 'trim|required');
        $inputs= array( 
            'input-nama',
            'input-tanggal_lahir',
            'input-tempat_lahir',
            'input-email',
            'input-alamat',
        );
        if (!$this->form_validation->run()) {
            foreach ($inputs as $key => $value) {
                $this->response['messages'][$value] = form_error($value, '<p class="mt-3 text-danger">', '</p>');
            }

            $this->response['messages'] = array_filter($this->response['messages']);
            $this->response['success']  = 0;
        } else {
            $post_pegawai = array(
                'nama'           => $post['input-nama'],
                'tanggal_lahir' => $post['input-tanggal_lahir'],
                'tempat_lahir'        => $post['input-tempat_lahir'],
                'email'         => $post['input-email'],
                'alamat'      => $post['input-alamat'],
                'no_hp'      => $post['input-no_hp'],
            );
            $data_pegawai   = $this->M_Pegawai->findOrFail($post['input-id']);
            $update_pegawai = $data_pegawai->update($post_pegawai);
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
        DB::beginTransaction();
        try {
            $data_pegawai     = $this->M_Pegawai->findOrFail($id);
            $id              = $data_pegawai->id;
            $delete_pengguna = DB::table($this->TABLE_USER)->where('role_id', 3)->where('reference_user_id', $id)->delete();
            $delete_pegawai   = DB::table($this->TABLE_PEGAWAI)->delete($id);
            $this->uploadmanager->removeFotoPegawai($data_pegawai['file_foto']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
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
        $data = $this->M_Pegawai->findOrFail($id);
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
    }


}
/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */
