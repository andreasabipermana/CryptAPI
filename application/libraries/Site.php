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
            }
        } else if ($_this->uri->segment(1) == 'Admin'  && isset($user_session['level'])) {
            if ($user_session['level'] != 'Admin') {
                redirect(base_url("Auth/login"));
            }
        } else if ($_this->uri->segment(1) == 'User'  && isset($user_session['level'])) {
            if ($user_session['level'] != 'User') {
                redirect(base_url("Auth/login"));
            }
        } else {
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

    function visitor_log()
    {
        $_this = &get_instance();
        $_this->load->library(['user_agent']);
        $_this->load->model(['Statistik_model']);

        if (!$_this->session->userdata('user_online')) {
            $sessId = session_id();

            $ip = $_SERVER['REMOTE_ADDR'];
            $ip = '112.215.36.142';
            // $ip = '1.1.1.1';
            //$ip = '127.0.0.1';
            $date = date('Y-m-d H:i:s');
            $agent = $_this->agent->agent_string();
            (!empty($_SERVER['HTTP_REFERER'])) ? $reff = $_SERVER['HTTP_REFERER'] : $reff = '';

            @$var = file_get_contents("http://ip-api.com/json/$ip");
            $var = json_decode($var);
            $visitorLogs = [
                'visitor_IP' => $var->query,
                'visitor_IP' => $ip,
                'visitor_referer' => $reff,
                'visitor_date' => $date,
                'visitor_agent' => $agent,
                'visitor_session' => $sessId,
                'visitor_city' => @$var->city,
                'visitor_region' => @$var->regionName,
                'visitor_country' => @$var->country,
                'visitor_os' => $_this->agent->platform(),
                'visitor_browser' => $_this->agent->browser() . ' ' . $_this->agent->version(),
                'visitor_isp' => @$var->isp
            ];

            $_this->Statistik_model->insert($visitorLogs);

            $_this->session->set_userdata(array('user_online' => session_id()));
        }
        return TRUE;
    }
}