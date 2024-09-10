<?php
defined('BASEPATH') or exit('No direct script access allowed');
include "AES.php";

class Console extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('Admin_model', 'userrole');
        $this->load->model('Pegawai_model', 'pegawai');
        $this->load->model('Berkas_model', 'berkas');
        $this->load->model('Pengaduan_model', 'pengaduan');
        $this->load->model('RSA', 'rsa');
    }
    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('admin/vw_login');
        $this->load->view('layout/footer');
    }
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->userrole->get_user($username);
        if ($user && hash('sha256', $password) === $user['password']) {
            $this->session->set_userdata('username', $user['username']);
            redirect('Console/dashboard');
        } else {
            var_dump($password);
            redirect('Console');
        }
    }
    public function dashboard()
    {
        $data['user'] = $this->userrole->getBy();
        $data['pegawai'] = $this->pegawai->tpegawai();
        $data['enkripsi'] = $this->berkas->tberkas_enkripsi();
        $data['dekripsi'] = $this->berkas->tberkas_dekripsi();
        $data['pengaduan'] = $this->pengaduan->tpengaduan();
        $this->load->view('layout/session_header', $data);
        $this->load->view('admin/vw_dashboard', $data);
        $this->load->view('layout/session_footer', $data);
    }
    public function pegawai()
    {
        $data['user'] = $this->userrole->getBy();
        $data['pegawai'] = $this->pegawai->get();
        $this->load->view('layout/session_header', $data);
        $this->load->view('admin/vw_pegawai', $data);
        $this->load->view('layout/session_footer', $data);
    }
    public function add_pegawai()
    {
        $data['user'] = $this->userrole->getBy();
        $this->form_validation->set_rules(
            'nama',
            'name',
            'required',
        );
        $this->form_validation->set_rules(
            'username',
            'username',
            'required',
        );
        $this->form_validation->set_rules(
            'password',
            'password',
            'required',
        );
        $this->form_validation->set_rules(
            'divisi',
            'divisi',
            'required',
        );
        $this->form_validation->set_rules(
            'jabatan',
            'jabatan',
            'required',
        );


        if ($this->form_validation->run() == false) {
            $this->load->view("layout/session_header", $data);
            $this->load->view("admin/vw_tambah_pegawai", $data);
            $this->load->view("layout/session_footer");
        } else {

            $pegawai = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'password' => hash('sha256', $this->input->post('password')),
                'divisi' => $this->input->post('divisi'),
                'jabatan' => $this->input->post('jabatan'),

            ];

            $this->pegawai->insert($pegawai);
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
            redirect('Console/pegawai');
        }
    }

    function edit_pegawai($id)
    {
        $data['user'] = $this->userrole->getBy();
        $data['pegawai'] = $this->pegawai->getById($id);
        $this->form_validation->set_rules(
            'nama',
            'name',
            'required',
        );
        $this->form_validation->set_rules(
            'username',
            'username',
            'required',
        );
        $this->form_validation->set_rules(
            'password',
            'password',
            'required',
        );
        $this->form_validation->set_rules(
            'divisi',
            'divisi',
            'required',
        );
        $this->form_validation->set_rules(
            'jabatan',
            'jabatan',
            'required',
        );


        if ($this->form_validation->run() == false) {
            $this->load->view("layout/session_header", $data);
            $this->load->view("admin/vw_edit_pegawai", $data);
            $this->load->view("layout/session_footer");
        } else {
            $pegawai = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'password' => hash('sha256', $this->input->post('password')),
                'divisi' => $this->input->post('divisi'),
                'jabatan' => $this->input->post('jabatan'),
            ];

            $id = $this->input->post('id');
            $this->pegawai->update(['id' => $id], $pegawai);
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
            redirect('Console/pegawai');
        }
    }
    public function delete_pegawai($id)
    {
        $this->pegawai->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Cannot delete the data!", "Error!", "error");</script>');
        } else {
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Data Deleted!", "Success!", "success");</script>');
        }
        redirect('Console/pegawai');
    }
    public function berkas()
    {
        $data['user'] = $this->userrole->getBy();
        $data['berkas'] = $this->berkas->get();
        $this->load->view('layout/session_header', $data);
        $this->load->view('admin/vw_berkas', $data);
        $this->load->view('layout/session_footer', $data);
    }
    public function add_berkas()
    {
        $data['user'] = $this->userrole->getBy();
        $data['berkas'] = $this->berkas->get();
        $this->load->view('layout/session_header', $data);
        $this->load->view('admin/vw_enkripsi', $data);
        $this->load->view('layout/session_footer', $data);
    }

    public function encryptFile()
    {
        // Ambil data dari inputan
        $user = $_SESSION['username'];
        $key = substr(md5($this->input->post('password')), 0, 16);
        $deskripsi = $this->input->post('keterangan');

        $fileTmpName = $_FILES['file']['tmp_name'];

        // Validasi ekstensi berkas
        $allowedExtensions = array('txt', 'docx', 'pptx', 'pdf', 'xlsx');
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        if (!in_array($ext, $allowedExtensions)) {
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Maaf, file yang bisa dienkrip hanya word, excel, text, ppt ataupun pdf", "Error!", "error");</script>');
            redirect('Console/berkas');
        }

        // Validasi ukuran berkas
        $maxFileSize = 3 * 1024; // 3 MB
        $fileSize = filesize($fileTmpName) / 1024;

        if ($fileSize > $maxFileSize) {
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Maaf, file tidak bisa lebih besar dari 3MB", "Error!", "error");</script>');
            redirect('Console/berkas');
        }

        // Generate nama file unik

        $filename = rand(1000, 100000) . "-" . pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
        $newFilename = strtolower(str_replace(' ', '-', $filename));

        $encryptedFilename = $newFilename . '.rda';
        $fileUrl = FCPATH . "hasil_enkripsi/$encryptedFilename";

        // Append the original file extension to $newFilename
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $newFilenameWithExt = $newFilename . '.' . $ext;

        $this->berkas->insertFile($user, $newFilenameWithExt, $encryptedFilename, $fileUrl, $fileSize, $key, $deskripsi);

        // Enkripsi dan simpan berkas
        $this->encryptAndSaveFile($fileTmpName, $fileUrl, $key);

        $this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
        redirect('Console/berkas');
    }

    private function encryptAndSaveFile($sourceFile, $destinationFile, $key)
    {
        $fileSource = fopen($sourceFile, 'rb');
        $fileOutput = fopen($destinationFile, 'wb');
        $aes = new AES($key);

        while (!feof($fileSource)) {
            $data = fread($fileSource, 16);
            $cipher = $aes->encrypt($data);
            fwrite($fileOutput, $cipher);
        }

        fclose($fileSource);
        fclose($fileOutput);
    }
    public function delete_berkas($id)
    {
        $this->berkas->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Cannot delete the data!", "Error!", "error");</script>');
        } else {
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Data Deleted!", "Success!", "success");</script>');
        }
        redirect('Console/berkas');
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        redirect('Console');
    }
    public function pengaduan()
    {
        $data['user'] = $this->userrole->getBy();
        $encryptedDataArray = $this->pengaduan->get();
        $decryptedDataArray = array();

        foreach ($encryptedDataArray as $encryptedData) {
            $decryptedStrings = [];

            foreach ($encryptedData as $key => $value) {
                if (is_string($value)) {
                    $decryptedValue = $this->rsa->rsaDecrypt($value);
                    $decodedValue = json_decode($decryptedValue);
                    $decryptedStrings[$key] = $decodedValue !== null ? $decodedValue : $decryptedValue;
                } else {
                    $decryptedStrings[$key] = $value;
                }
            }

            $idFromDatabase = $this->pengaduan->getIdFromEncryptedData($encryptedData);
            $decryptedStrings['id'] = $idFromDatabase;
            array_push($decryptedDataArray, $decryptedStrings);
        }
        $data['pengaduan'] = $decryptedDataArray;
        $this->load->view('layout/session_header', $data);
        $this->load->view('admin/vw_pengaduan', $data);
        $this->load->view('layout/session_footer', $data);
    }
    public function delete_pengaduan($id)
    {
        $this->pengaduan->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Cannot delete the data!", "Error!", "error");</script>');
        } else {
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Data Deleted!", "Success!", "success");</script>');
        }
        redirect('Console/pengaduan');
    }
}
