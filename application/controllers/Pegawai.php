<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model', 'pegawai');
        $this->load->model('Berkas_model', 'berkas');
        $this->load->model('Pengaduan_model', 'pengaduan');
        $this->load->model('RSA', 'rsa');
        $this->load->helper(array('url', 'download'));
    }
    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('pegawai/vw_login');
        $this->load->view('layout/footer');
    }
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->pegawai->get_user($username);
        if ($user && hash('sha256', $password) === $user['password']) {
            $this->session->set_userdata('username', $user['username']);
            redirect('Pegawai/dashboard');
        } else {
            print_r($password);
            die;
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        redirect('Pegawai');
    }
    public function dashboard()
    {
        $data['user'] = $this->pegawai->getBy();
        $this->load->view('layout/pegawai_header', $data);
        $this->load->view('pegawai/vw_dashboard', $data);
        $this->load->view('layout/session_footer', $data);
    }
    public function berkas()
    {
        $data['user'] = $this->pegawai->getBy();
        $data['berkas'] = $this->berkas->get();
        $this->load->view('layout/pegawai_header', $data);
        $this->load->view('pegawai/vw_berkas', $data);
        $this->load->view('layout/session_footer', $data);
    }
    public function dekripsi($id)
    {
        $data['user'] = $this->pegawai->getBy();
        $data['berkas'] = $this->berkas->getById($id);
        $this->load->view('layout/pegawai_header', $data);
        $this->load->view('pegawai/vw_dekripsi', $data);
        $this->load->view('layout/session_footer', $data);
    }
    public function decryptFile()
    {
        $idfile = $this->input->post('id_file');
        $pwdfile = $this->input->post('password');
        // Hash the password
        $pwdfile = substr(md5($pwdfile), 0, 16);

        // Database query - Password check
        $result = $this->berkas->checkPassword($idfile, $pwdfile);

        if ($result) {
            // Retrieve file information
            $fileData = $this->berkas->getFileData($idfile);

            if ($fileData) {
                // Update file status
                $this->berkas->updateFileStatus($idfile);

                // Decryption process
                include 'AES.php'; // Adjust the path as needed

                $key = $fileData['password'];
                $file_path = $fileData['file_url'];
                $file_name = $fileData['file_name_source'];

                $file_size = filesize($file_path);
                $mod = $file_size % 16;

                $aes = new AES($key);
                $fopen1 = fopen($file_path, "rb");
                $plain = "";
                $cache = "hasil_dekripsi/$file_name";
                $fopen2 = fopen($cache, "wb");

                if ($mod == 0) {
                    $banyak = $file_size / 16;
                } else {
                    $banyak = ($file_size - $mod) / 16;
                    $banyak = $banyak + 1;
                }

                ini_set('max_execution_time', -1);
                ini_set('memory_limit', -1);
                for ($bawah = 0; $bawah < $banyak; $bawah++) {
                    $filedata = fread($fopen1, 16);
                    $plain = $aes->decrypt($filedata);
                    fwrite($fopen2, $plain);
                }

                // Set session for download
                $this->session->set_userdata('download', $cache);

                // Redirect or display success message
                $this->session->set_flashdata('message', '<script type="text/javascript">swal("Berkas berhasil didekripsi, silakan di download!", "Success!", "success");</script>');
                redirect('Pegawai/berkas');
            } else {
                // Redirect or display error message
                echo "error";
            }
        } else {
            // Redirect or display password mismatch error message
            $this->session->set_flashdata('message', '<script type="text/javascript">swal("Maaf, file tidak bisa dekripsi karena kunci salah", "Error!", "error");</script>');
            redirect('Pegawai/berkas');
        }
    }
    public function download($idFile)
    {
        $fileInfo = $this->berkas->getFileById($idFile);
        //for $file_id (all details are stored in DB)
        // $data = file_get_contents($fileInfo->full_path); // Read the file's contents
        // $name = $fileInfo->file_name;

        // print_r($data);die;\
        redirect('/hasil_dekripsi/'. $fileInfo['file_name_source']);
        // force_download($name, $data);

        // force_download("../berkas_dekripsi/" . $fileInfo['file_name_source'], NULL);
        // header('Content-Type: application/octet-stream');
        // header('Content-Disposition: attachment; filename="' . $fileInfo['file_name_source'] . '"');
        // header('Content-Length: ' . filesize($fileInfo['file_url']));
        // readfile($fileInfo['file_url']);
        // exit();
    }
    public function pengaduan()
    {
        $data['user'] = $this->pegawai->getBy();

        $this->form_validation->set_rules(
            'nama',
            'name',
            'required',
        );
        $this->form_validation->set_rules(
            'pengaduan',
            'pengaduan',
            'required',
        );


        if ($this->form_validation->run() == false) {
            $this->load->view("layout/pegawai_header", $data);
            $this->load->view("pegawai/vw_pengaduan", $data);
            $this->load->view("layout/session_footer");
        } else {

            $nama = $this->rsa->rsaEncrypt($this->input->post('nama'));
            $pengaduan = $this->rsa->rsaEncrypt($this->input->post('pengaduan'));
            $currentTime = $this->rsa->rsaEncrypt(date('Y-m-d H:i:s'));
            $data = [
                'nama' => $nama,
                'pengaduan' => $pengaduan,
                'tanggal' => $currentTime,

            ];
            if ($data === false) {
                $error = openssl_error_string();
                echo "Gagal mengenkripsi data. Kesalahan: $error";
            } else {

                $this->pengaduan->insert($data);
                // $test = 'd4OEkqfH0lHu8CCc2sUWMInj8ckMYaNay9uOAOM5T9y3W2ulhmN4oFqkJG8wBXQ43yXyXA9R1bOlA095WvLOHiuvB7KoJfO+XuGpMyIxMIm5gq0Dk9uiFtwhxKNgyER7Ao8N/FAHOlyl1X8A0X4c5Wdgl1Ew3HHHcxedlQbRQrVNgBaEGlSCs55u/vt1XVoJrnmeewYH98yyhv/0cMV6NecejBlv03z9V6vtA7CyP2hKNOuSXasJ47SRSZX6AMlv6NLhNJ/5cyGSiswkP1k5vLK4zgFVtZ/PZC7xFLrmQw8LKC6szmCgB/Z1xXLdIKdggcwaExvPta024Y818e/F0g==';
                // $DecryptedData = $this->rsa->rsaDecrypt($test);
                // var_dump($DecryptedData); die;
                $this->session->set_flashdata('message', '<script type="text/javascript">swal("Pengaduan berhasil diajukan!", "Success!", "success");</script>');
                redirect('Pegawai/pengaduan');
            }
        }
    }

}
