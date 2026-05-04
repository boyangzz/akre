<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Dashboard
$route['dashboard'] = 'dashboard/index';

// Auth
$route['auth/login']  = 'auth/login';
$route['auth/do_login'] = 'auth/do_login';
$route['auth/logout'] = 'auth/logout';

// Identitas
$route['identitas']        = 'identitas/index';
$route['identitas/update'] = 'identitas/update';

// Master Data — Dosen
$route['master_data/dosen']               = 'master_data/dosen';
$route['master_data/dosen_form']          = 'master_data/dosen_form';
$route['master_data/dosen_form/(:num)']   = 'master_data/dosen_form/$1';
$route['master_data/dosen_save']          = 'master_data/dosen_save';
$route['master_data/dosen_save/(:num)']   = 'master_data/dosen_save/$1';
$route['master_data/dosen_delete/(:num)'] = 'master_data/dosen_delete/$1';

// Master Data — Mahasiswa
$route['master_data/mahasiswa']                 = 'master_data/mahasiswa';
$route['master_data/mahasiswa_form']            = 'master_data/mahasiswa_form';
$route['master_data/mahasiswa_form/(:num)']     = 'master_data/mahasiswa_form/$1';
$route['master_data/mahasiswa_save']            = 'master_data/mahasiswa_save';
$route['master_data/mahasiswa_save/(:num)']     = 'master_data/mahasiswa_save/$1';
$route['master_data/mahasiswa_delete/(:num)']   = 'master_data/mahasiswa_delete/$1';

// Master Data — Mata Kuliah
$route['master_data/matakuliah']                  = 'master_data/matakuliah';
$route['master_data/matakuliah_form']             = 'master_data/matakuliah_form';
$route['master_data/matakuliah_form/(:num)']      = 'master_data/matakuliah_form/$1';
$route['master_data/matakuliah_save']             = 'master_data/matakuliah_save';
$route['master_data/matakuliah_save/(:num)']      = 'master_data/matakuliah_save/$1';
$route['master_data/matakuliah_delete/(:num)']    = 'master_data/matakuliah_delete/$1';

// Kerjasama
$route['kerjasama']              = 'kerjasama/index';
$route['kerjasama/form']         = 'kerjasama/form';
$route['kerjasama/form/(:num)']  = 'kerjasama/form/$1';
$route['kerjasama/save']         = 'kerjasama/save';
$route['kerjasama/save/(:num)']  = 'kerjasama/save/$1';
$route['kerjasama/delete/(:num)']= 'kerjasama/delete/$1';

// Kemahasiswaan
$route['kemahasiswaan/seleksi']               = 'kemahasiswaan/seleksi';
$route['kemahasiswaan/seleksi_save']          = 'kemahasiswaan/seleksi_save';
$route['kemahasiswaan/seleksi_delete/(:num)'] = 'kemahasiswaan/seleksi_delete/$1';
$route['kemahasiswaan/mhs_asing']             = 'kemahasiswaan/mhs_asing';
$route['kemahasiswaan/mhs_asing_save']        = 'kemahasiswaan/mhs_asing_save';
$route['kemahasiswaan/mhs_asing_delete/(:num)'] = 'kemahasiswaan/mhs_asing_delete/$1';

// Sumber Daya
$route['sumber_daya/ewmp']                    = 'sumber_daya/ewmp';
$route['sumber_daya/ewmp_form']               = 'sumber_daya/ewmp_form';
$route['sumber_daya/ewmp_form/(:num)']        = 'sumber_daya/ewmp_form/$1';
$route['sumber_daya/ewmp_save']               = 'sumber_daya/ewmp_save';
$route['sumber_daya/ewmp_save/(:num)']        = 'sumber_daya/ewmp_save/$1';
$route['sumber_daya/ewmp_delete/(:num)']      = 'sumber_daya/ewmp_delete/$1';
$route['sumber_daya/rekognisi']               = 'sumber_daya/rekognisi';
$route['sumber_daya/rekognisi_form']          = 'sumber_daya/rekognisi_form';
$route['sumber_daya/rekognisi_form/(:num)']   = 'sumber_daya/rekognisi_form/$1';
$route['sumber_daya/rekognisi_save']          = 'sumber_daya/rekognisi_save';
$route['sumber_daya/rekognisi_save/(:num)']   = 'sumber_daya/rekognisi_save/$1';
$route['sumber_daya/rekognisi_delete/(:num)'] = 'sumber_daya/rekognisi_delete/$1';
$route['sumber_daya/penelitian']              = 'sumber_daya/penelitian';
$route['sumber_daya/penelitian_save']         = 'sumber_daya/penelitian_save';
$route['sumber_daya/pkm']                     = 'sumber_daya/pkm';
$route['sumber_daya/pkm_save']                = 'sumber_daya/pkm_save';
$route['sumber_daya/publikasi']               = 'sumber_daya/publikasi';
$route['sumber_daya/publikasi_save']          = 'sumber_daya/publikasi_save';
$route['sumber_daya/hki']                     = 'sumber_daya/hki';
$route['sumber_daya/hki_save']                = 'sumber_daya/hki_save';
$route['sumber_daya/sitasi']                  = 'sumber_daya/sitasi';
$route['sumber_daya/sitasi_save']             = 'sumber_daya/sitasi_save';

// Kode tabel numeric-prefixed → mapped ke method yang benar
$route['sumber_daya/3a1'] = 'sumber_daya/dosen_tetap';
$route['sumber_daya/3a2'] = 'sumber_daya/pembimbing_ta';
$route['sumber_daya/3a3'] = 'sumber_daya/ewmp';
$route['sumber_daya/3a4'] = 'sumber_daya/dosen_tidak_tetap';
$route['sumber_daya/3a5'] = 'sumber_daya/dosen_industri';
$route['sumber_daya/3b1'] = 'sumber_daya/rekognisi';
$route['sumber_daya/3b2'] = 'sumber_daya/penelitian';
$route['sumber_daya/3b3'] = 'sumber_daya/pkm';
$route['sumber_daya/3b4'] = 'sumber_daya/publikasi';
$route['sumber_daya/3b5'] = 'sumber_daya/hki';
$route['sumber_daya/3b6'] = 'sumber_daya/sitasi';
$route['sumber_daya/3b7'] = 'sumber_daya/luaran_lain';
$route['sumber_daya/3b7-1'] = 'sumber_daya/luaran_lain';
$route['sumber_daya/3b7-2'] = 'sumber_daya/luaran_lain';
$route['sumber_daya/pembimbing_save']  = 'sumber_daya/pembimbing_save';
$route['sumber_daya/luaran_lain_save'] = 'sumber_daya/luaran_lain_save';

// Luaran
$route['luaran/ipk_lulusan']           = 'luaran/ipk_lulusan';
$route['luaran/ipk_save']              = 'luaran/ipk_save';
$route['luaran/masa_studi']            = 'luaran/masa_studi';
$route['luaran/masa_studi_save']       = 'luaran/masa_studi_save';
$route['luaran/waktu_tunggu']          = 'luaran/waktu_tunggu';
$route['luaran/waktu_tunggu_save']     = 'luaran/waktu_tunggu_save';
$route['luaran/kepuasan_pengguna']     = 'luaran/kepuasan_pengguna';
$route['luaran/kepuasan_save']         = 'luaran/kepuasan_save';

// Kode tabel numeric-prefixed → mapped ke method yang benar
$route['luaran/8a']    = 'luaran/ipk_lulusan';
$route['luaran/8b1']   = 'luaran/prestasi_akademik';
$route['luaran/8b2']   = 'luaran/prestasi_nonakademik';
$route['luaran/8c']    = 'luaran/masa_studi';
$route['luaran/8d1']   = 'luaran/waktu_tunggu';
$route['luaran/8d2']   = 'luaran/kesesuaian_bidang';
$route['luaran/8e1']   = 'luaran/tempat_kerja';
$route['luaran/8e2']   = 'luaran/kepuasan_pengguna';
$route['luaran/8f1']   = 'luaran/publikasi_mahasiswa';
$route['luaran/8f1t']  = 'luaran/publikasi_mahasiswa';  // Terapan
$route['luaran/8f2']   = 'luaran/sitasi_mahasiswa';
$route['luaran/8f3']   = 'luaran/produk_mahasiswa';
$route['luaran/8f4']   = 'luaran/hki_mahasiswa';
$route['luaran/8f4-1'] = 'luaran/hki_mahasiswa';
$route['luaran/8f4-2'] = 'luaran/hki_mahasiswa';
$route['luaran/8f4-3'] = 'luaran/hki_mahasiswa';
$route['luaran/8f4-4'] = 'luaran/hki_mahasiswa';

// Save methods
$route['luaran/prestasi_save']       = 'luaran/prestasi_save';
$route['luaran/tempat_kerja_save']   = 'luaran/tempat_kerja_save';
$route['luaran/luaran_mhs_save']     = 'luaran/luaran_mhs_save';

// Setup
$route['setup/borang']                = 'setup/borang';
$route['setup/borang_form/(:num)']    = 'setup/borang_form/$1';
$route['setup/borang_save/(:num)']    = 'setup/borang_save/$1';
