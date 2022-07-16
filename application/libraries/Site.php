<?php defined('BASEPATH') or exit('No direct script access alloed');
class Site
{
    function is_logged_in()
    {
        $_this = &get_instance();
        $user_session = $_this->session->userdata;
        if ($_this->uri->segment(1) == 'Welcome') {
        } else if ($_this->uri->segment(1) == 'Service') {
        } else if ($_this->uri->segment(2) == 'login' && isset($user_session['level'])) {
            if ($user_session['level'] == 'User') {
                redirect(base_url("User"));
            } else if ($user_session['level'] == 'Admin') {
                redirect(base_url("Admin"));
            } else {
            }
        } else if ($_this->uri->segment(1) == ''  && isset($user_session['level'])) {
            if ($user_session['level'] == 'User') {
                redirect(base_url("User"));
            } else if ($user_session['level'] == 'Admin') {
                redirect(base_url("Admin"));
            } else {
            }
        } else if ($_this->uri->segment(1) == 'Admin'  && $user_session['level'] != 'Admin') {
            redirect(base_url("Auth/login"));
        } else if ($_this->uri->segment(1) == 'User'  && $user_session['level'] != 'User') {
            redirect(base_url("Auth/login"));
        }

        if ($_this->uri->segment(1) == 'Ambil' || $_this->uri->segment(1) == 'Ubah' || $_this->uri->segment(1) == 'Tambah' || $_this->uri->segment(1) == 'Hapus' ||  $_this->uri->segment(1) == 'Tabel') {
            if ($user_session['level'] != 'User' && $user_session['level'] != 'Admin') {
                redirect(base_url("Auth/login"));
            }
        }
    }

    function be_array($data)
    {
        return json_decode(json_encode($data), true);
    }
}