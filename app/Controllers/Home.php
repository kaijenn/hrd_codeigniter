<?php

namespace App\Controllers;
Use App\Models\M_siapake;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Home extends BaseController
{


	public function dashboard()
{
    $model = new M_siapake();
    $where = array('id_setting' => '1');
    $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

    // Ambil nama pengguna dari session
    $session = session();
    $data['username'] = $session->get('username');

    $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Dashboard',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
    echo view('header', $data);
    echo view('menu');
    echo view('dashboard', $data);
    echo view('footer');
}
	public function login()
	{
		$model= new M_siapake();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
        $activityLog = [
            'id_user' => $id_user,
            'menu' => 'Masuk ke Login',
            'time' => date('Y-m-d H:i:s')
        ];
        $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('login');
	}




public function aksi_login()
{
    // Periksa koneksi internet
    if (!$this->checkInternetConnection()) {
        // Jika tidak ada koneksi, cek CAPTCHA gambar
        $captcha_code = $this->request->getPost('captcha_code');
        if (session()->get('captcha_code') !== $captcha_code) {
            session()->setFlashdata('toast_message', 'Invalid CAPTCHA');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    } else {
        // Jika ada koneksi, cek Google reCAPTCHA
        $recaptchaResponse = trim($this->request->getPost('g-recaptcha-response'));
        $secret = '6LefTYMqAAAAAC1hYWZVpC0-nPwlZkdDZaDXlKi1'; // Ganti dengan Secret Key Anda
        $credential = array(
            'secret' => $secret,
            'response' => $recaptchaResponse
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        curl_close($verify);

        $status = json_decode($response, true);

        if (!$status['success']) {
            session()->setFlashdata('toast_message', 'Captcha validation failed');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    }


    
    // Proses login seperti biasa
    $u = $this->request->getPost('username');
    $p = $this->request->getPost('password');

    $where = array(
        'username' => $u,
        'password' => md5($p),
    );
    $model = new M_siapake;
    $cek = $model->getWhere('user', $where);

    if ($cek) {
        session()->set('nama', $cek->username);
        session()->set('id', $cek->id_user);
        session()->set('level', $cek->id_level);
        return redirect()->to('home/dashboard');
    } else {
        session()->setFlashdata('toast_message', 'Invalid login credentials');
        session()->setFlashdata('toast_type', 'danger');
        return redirect()->to('home/login');
    }
}



public function generateCaptcha()
{
    // Create a string of possible characters
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captcha_code = '';
    
    // Generate a random CAPTCHA code with letters and numbers
    for ($i = 0; $i < 6; $i++) {
        $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    // Store CAPTCHA code in session
    session()->set('captcha_code', $captcha_code);
    
    // Create an image for CAPTCHA
    $image = imagecreate(120, 40); // Increased size for better readability
    $background = imagecolorallocate($image, 200, 200, 200);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    $line_color = imagecolorallocate($image, 64, 64, 64);
    
    imagefilledrectangle($image, 0, 0, 120, 40, $background);
    
    // Add some random lines to the CAPTCHA image for added complexity
    for ($i = 0; $i < 5; $i++) {
        imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
    }
    
    // Add the CAPTCHA code to the image
    imagestring($image, 5, 20, 10, $captcha_code, $text_color);
    
    // Output the CAPTCHA image
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
}




public function checkInternetConnection()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    } else {
        return false;
    }
}



public function register()
	{
		$model= new M_siapake();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Register',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('register');
	}


	public function aksi_t_register()
{
    if(session()->get('id') > 0) {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $email = $this->request->getPost('email');
        $nohp = $this->request->getPost('nohp');
        
        // Hash the password using MD5
        $hashedPassword = md5($password);

        $darren = array(
            'username' => $username,
            'password' => $hashedPassword, 
            'email' => $email, 
            'nohp' => $nohp, 
        );

        // Initialize the model
        $model = new M_siapake;
        $model->tambah('user', $darren);

        // Redirect to the 'tb_user' page
        return redirect()->to('home/login');
    } else {
        // If no session or user is logged in, redirect to the login page
        return redirect()->to('home/login');
    }
}

public function lowongan()
	{
		$model= new M_siapake();

        $data['oke'] = $model->tampil('lowongan');
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Lowongan',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('lowongan');
    echo view('footer');
	}


    public function t_lowongan()
	{
		$model= new M_siapake();

		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Lowongan',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('t_lowongan');
	}

    public function aksi_t_lowongan()
{
    if(session()->get('id') > 0) {
        $nama_lowongan = $this->request->getPost('nama_lowongan');
        $deskripsi = $this->request->getPost('deskripsi');
        
        // Hash the deskripsi using MD5

        $darren = array(
            'nama_lowongan' => $nama_lowongan,
            'deskripsi' => $deskripsi, 
        );

        // Initialize the model
        $model = new M_siapake;
        $model->tambah('lowongan', $darren);

        // Redirect to the 'tb_user' page
        return redirect()->to('home/lowongan');
    } else {
        // If no session or user is logged in, redirect to the login page
        return redirect()->to('home/login');
    }
}


public function e_lowongan($id_lowongan)
	{
		$model= new M_siapake();
        $whereuser = array('id_lowongan' => $id_lowongan);
        $data['oke'] = $model->getWhere1('lowongan', $whereuser)->getRow();
		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Lowongan',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('e_lowongan');
	}


    public function aksi_e_lowongan()
    {
        if(session()->get('id') > 0) {
            $nama_lowongan = $this->request->getPost('nama_lowongan');
            $deskripsi = $this->request->getPost('deskripsi');
            $id = $this->request->getPost('id_lowongan');
            // Hash the deskripsi using MD5
            $where = array('id_lowongan' => $id);


            $yoga = array(
                'nama_lowongan' => $nama_lowongan,
                'deskripsi' => $deskripsi, 
            );
    
            // Initialize the model
            $model = new M_siapake;
            $model->edit('lowongan', $yoga, $where);
    
            // Redirect to the 'tb_user' page
            return redirect()->to('home/lowongan');
        } else {
            // If no session or user is logged in, redirect to the login page
            return redirect()->to('home/login');
        }
    }

    public function hapus_lowongan($id)
    {
        $model = new M_siapake();
        // $this->logUserActivity('Menghapus Pemesanan Permanent');
        $where = array('id_lowongan' => $id);
        $model->hapus('lowongan', $where);
    
        return redirect()->to('home/lowongan');
    }



    public function lamaran()
	{
		$model= new M_siapake();

       // Mengambil ID dari session
$where = array('id_user' => session()->get('id'));

$data['oke'] = $model->tampilwherepelamar('pelamar', $where);
// $data['oke'] = $model->tampil('pelamar');


		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Lowongan',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('lamaran');
    echo view('footer');
	}





    public function aksi_t_lamaran()
{
    if (session()->get('id') > 0) {
        // Mengambil data dari input
        $nama_pelamar = $this->request->getPost('nama_pelamar');
        $umur = $this->request->getPost('umur');
        $alamat = $this->request->getPost('alamat');
        
        // Mengambil file CV dan Surat
        $cvFile = $this->request->getFile('cv');
        $suratFile = $this->request->getFile('surat');

        // Menyimpan file ke dalam folder uploads
        $cvFileName = null;
        $suratFileName = null;

        if ($cvFile->isValid() && !$cvFile->hasMoved()) {
            $cvFileName = $cvFile->getRandomName(); // Nama file acak untuk CV
            $cvFile->move(FCPATH . 'uploads', $cvFileName); // Memindahkan file CV
        }

        if ($suratFile->isValid() && !$suratFile->hasMoved()) {
            $suratFileName = $suratFile->getRandomName(); // Nama file acak untuk Surat
            $suratFile->move(FCPATH . 'uploads', $suratFileName); // Memindahkan file Surat
        }

        // Mendapatkan id_lowongan dari permintaan
        $id_lowongan = $this->request->getPost('id_lowongan');
        $id_user = session()->get('id');

        // Membuat array data untuk disimpan
        $yoga = array(
            'nama_pelamar' => $nama_pelamar,
            'umur' => $umur, 
            'alamat' => $alamat, 
            'cv' => $cvFileName,  // Nama file CV
            'surat' => $suratFileName,  // Nama file Surat
            'id_user' => $id_user,
            'id_lowongan' => $id_lowongan, 
            'status' => 'Pending',
        );

        // Inisialisasi model
        $model = new M_siapake;
        $model->tambah('pelamar', $yoga); // Menyimpan data ke database

        // Redirect ke halaman 'lowongan'
        return redirect()->to('home/lamaran');
    } else {
        // Redirect ke halaman login jika session tidak ada
        return redirect()->to('home/login');
    }
}


public function e_lamaran($id_pelamar)
	{
		$model= new M_siapake();
        $whereuser = array('id_pelamar' => $id_pelamar);
        $data['oke'] = $model->getWhere1('pelamar', $whereuser)->getRow();

		$where = array('id_setting' => '1');
		$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Edit Lamaran',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
    echo view('e_lamaran');
	}

    public function aksi_e_lamaran()
{
    if(session()->get('id') > 0) {
        $nama_pelamar = $this->request->getPost('nama_pelamar');
        $umur = $this->request->getPost('umur');
        $alamat = $this->request->getPost('alamat');
        $id = $this->request->getPost('id_pelamar');

        // Ambil data pelamar sebelumnya
        $model = new M_siapake;
        $pelamarLama = $model->get_detail('pelamar', ['id_pelamar' => $id]);

        $cvFile = $this->request->getFile('cv');
        $suratFile = $this->request->getFile('surat');

        // Menyimpan file ke dalam folder uploads
        $cvFileName = $pelamarLama->cv; // Gunakan CV lama sebagai default
        $suratFileName = $pelamarLama->surat; // Gunakan surat lama sebagai default

        // Proses file CV baru jika ada
        if ($cvFile->isValid() && !$cvFile->hasMoved()) {
            $cvFileName = $cvFile->getRandomName(); // Nama file acak untuk CV
            $cvFile->move(FCPATH . 'uploads', $cvFileName); // Memindahkan file CV

            // Hapus file CV lama jika ada
            if (!empty($pelamarLama->cv)) {
                $oldCvPath = FCPATH . 'uploads/' . $pelamarLama->cv;
                if (file_exists($oldCvPath)) {
                    unlink($oldCvPath);
                }
            }
        }

        // Proses file surat baru jika ada
        if ($suratFile->isValid() && !$suratFile->hasMoved()) {
            $suratFileName = $suratFile->getRandomName(); // Nama file acak untuk Surat
            $suratFile->move(FCPATH . 'uploads', $suratFileName); // Memindahkan file Surat

            // Hapus file surat lama jika ada
            if (!empty($pelamarLama->surat)) {
                $oldSuratPath = FCPATH . 'uploads/' . $pelamarLama->surat;
                if (file_exists($oldSuratPath)) {
                    unlink($oldSuratPath);
                }
            }
        }

        $where = array('id_pelamar' => $id);

        $yoga = array(
            'nama_pelamar' => $nama_pelamar,
            'umur' => $umur, 
            'alamat' => $alamat, 
            'cv' => $cvFileName, 
            'surat' => $suratFileName,  
        );

        $model->edit('pelamar', $yoga, $where);

        // Redirect to the 'lamaran' page
        return redirect()->to('home/lamaran');
    } else {
        // If no session or user is logged in, redirect to the login page
        return redirect()->to('home/login');
    }
}
public function kirim_pengumuman_diterima($id_lamaran)
{
    $model = new M_siapake;

    // 1. Ambil data pelamar
    $pelamar = $model->get_pelamar_by_id($id_lamaran);

    // 2. Ambil email dari user
    $user = $model->get_user_by_id($pelamar->id_user);

    // 3. Update status pelamar menjadi Diterima
    $model->edit('pelamar', 
        ['status' => 'Diterima'], 
        ['id_pelamar' => $id_lamaran]
    );

    // 4. Kirim email dengan nama_pelamar
    $email_terkirim = $this->kirim_email_penerimaan($user->email, $pelamar->nama_pelamar);

    // 5. Berikan respon
    if ($email_terkirim) {
        session()->setFlashdata('success', 'Email penerimaan berhasil dikirim');
    } else {
        session()->setFlashdata('error', 'Gagal mengirim email penerimaan');
    }

    // 6. Redirect kembali
    return redirect()->back();
}

public function kirim_pengumuman_ditolak($id_lamaran)
{


$model = new M_siapake;

$pelamar = $model->get_pelamar_by_id($id_lamaran);

// Ambil email dari user
$user = $model->get_user_by_id($pelamar->id_user);

$model->edit('pelamar', 
['status' => 'Ditolak'], 
['id_pelamar' => $id_lamaran]
);

// Kirim email dengan nama_pelamar
$email_terkirim = $this->kirim_email_penerimaan_ditolak($user->email, $pelamar->nama_pelamar);

    // 4. Berikan respon
    if ($email_terkirim) {
        session()->setFlashdata('success', 'Email penerimaan berhasil dikirim');
    } else {
        session()->setFlashdata('error', 'Gagal mengirim email penerimaan');
    }

    // 5. Redirect kembali
    return redirect()->back();
}

private function kirim_email_penerimaan($email, $nama)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kaizenesia@gmail.com';
        $mail->Password   = 'kjmc gjkt bzuh qglc';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('kaizenesia@gmail.com', 'PT. Matcha Qiong');
        $mail->addAddress($email, $nama);

        $mail->isHTML(true);
        $mail->Subject = 'Selamat! Anda Diterima di PT. Matcha Qiong';
        $mail->Body    = "
            <html>
            <body>
                <h2>Selamat, $nama!</h2>
                <p>Kami dengan senang hati mengumumkan bahwa Anda DITERIMA bekerja di PT. Matcha Qiong.</p>
                <p>Silakan menunggu informasi lebih lanjut untuk proses selanjutnya.</p>
                <br>
                <p>Salam hangat,<br>Tim Rekrutmen PT. Matcha Qiong</p>
            </body>
            </html>
        ";

        $mail->send();
        return true;
    } catch (\Exception $e) {
        log_message('error', 'Gagal mengirim email: ' . $e->getMessage());
        return false;
    }
}


private function kirim_email_penerimaan_ditolak($email, $nama)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kaizenesia@gmail.com';
        $mail->Password   = 'kjmc gjkt bzuh qglc';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('kaizenesia@gmail.com', 'PT. Matcha Qiong');
        $mail->addAddress($email, $nama);

        $mail->isHTML(true);
        $mail->Subject = 'Informasi Hasil Seleksi Lamaran di PT. Matcha Qiong';
        $mail->Body    = "
            <html>
            <body>
                <h2>Kepada Yth. $nama,</h2>
                <p>Terima kasih atas minat Anda untuk bergabung dengan PT. Matcha Qiong.</p>
                <p>Setelah melalui proses seleksi yang komprehensif, kami sampaikan bahwa saat ini lamaran Anda belum dapat kami terima.</p>
                <p>Kami menghargai waktu dan usaha yang telah Anda berikan dalam proses lamaran ini.</p>
                <br>
                <p>Kami mendorong Anda untuk terus mengembangkan kemampuan dan tidak menyerah. Kesempatan lain mungkin akan datang di masa depan.</p>
                <br>
                <p>Terima kasih,<br>Tim Rekrutmen PT. Matcha Qiong</p>
            </body>
            </html>
        ";

        $mail->send();
        return true;
    } catch (\Exception $e) {
        log_message('error', 'Gagal mengirim email: ' . $e->getMessage());
        return false;
    }
}




public function log_activity(){

	$model = new M_siapake;
	$data['users'] = $model->getAllUsers();

	$userId = $this->request->getGet('user_id');

	// Fetch logs with optional filtering
	if (!empty($userId)) {
		$data['logs'] = $model->getLogsByUser($userId);
	} else {
		$data['logs'] = $model->getLogs();
	}
	$where = array('id_setting' => '1');
	$data['yogi'] = $model->getWhere1('setting', $where)->getRow();
	$id_user = session()->get('id');
	$activityLog = [
		'id_user' => $id_user,
		'menu' => 'Masuk ke Log Activity',
		'time' => date('Y-m-d H:i:s')
	];
	$model->logActivity($activityLog);
	echo view('header', $data);
	echo view('menu');
	echo view('log_activity', $data);
	echo view('footer');
}


public function setting()
    {
      
                $model = new M_siapake;
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

                $id_user = session()->get('id');
    $activityLog = [
        'id_user' => $id_user,
        'menu' => 'Masuk ke Setting',
        'time' => date('Y-m-d H:i:s')
    ];
    $model->logActivity($activityLog);
                echo view('header', $data);
                echo view('menu');
                echo view('setting', $data);
                echo view('footer');
           
    }

    public function aksi_e_setting()
    {
        $model = new M_siapake();
        // $this->logUserActivity('Melakukan Setting');
        $namaWebsite = $this->request->getPost('namawebsite');
        $id = $this->request->getPost('id');
        $id_user = session()->get('id');
        $where = array('id_setting' => '1');

        $data = array(
            'nama_website' => $namaWebsite,
            'update_by' => $id_user,
            'update_at' => date('Y-m-d H:i:s')
        );

        // Cek apakah ada file yang diupload untuk favicon
        $favicon = $this->request->getFile('img');
        if ($favicon && $favicon->isValid() && !$favicon->hasMoved()) {
            // Beri nama file unik
            $faviconNewName = $favicon->getRandomName();
            // Pindahkan file ke direktori public/images
            $favicon->move(WRITEPATH . '../public/images', $faviconNewName);

            // Tambahkan nama file ke dalam array data
            $data['tab_icon'] = $faviconNewName;
        }

        // Cek apakah ada file yang diupload untuk logo
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            // Beri nama file unik
            $logoNewName = $logo->getRandomName();
            // Pindahkan file ke direktori public/images
            $logo->move(WRITEPATH . '../public/images', $logoNewName);

            // Tambahkan nama file ke dalam array data
            $data['logo_website'] = $logoNewName;
        }

        // Cek apakah ada file yang diupload untuk logo
        $login = $this->request->getFile('login');
        if ($login && $login->isValid() && !$login->hasMoved()) {
            // Beri nama file unik
            $loginNewName = $login->getRandomName();
            // Pindahkan file ke direktori public/images
            $login->move(WRITEPATH . '../public/images', $loginNewName);

            // Tambahkan nama file ke dalam array data
            $data['login_icon'] = $loginNewName;
        }

        $model->edit('setting', $data, $where);

        // Optionally set a flash message here
        return redirect()->to('home/setting');
    }
}
