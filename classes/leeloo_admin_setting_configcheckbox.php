<?php

class leeloo_admin_setting_configtext extends admin_setting_configtext {
    public function write_setting($data) {
        $status = parent::write_setting($data);
        if ($status === '') {
            $this->get_install_data($data);
        }
        return $status;
    }

    private function get_install_data($data) {
        global $CFG;

        require_once($CFG->libdir . '/filelib.php');

        $curl = new curl;

        $url = 'https://mootools.epic1academy.com/api/get_install.php';

        $payload = array(
            'moodleurl' => $CFG->wwwroot
        );

        $jsonPayload = json_encode($payload);

        $headers = array('Content-Type: application/json');

        $result = $curl->post($url, $jsonPayload, array('CURLOPT_HTTPHEADER' => $headers));

        $res_arr = json_decode($result);

        if (isset($res_arr->status) && isset($res_arr->status) != '') {
            if ($res_arr->status == 'true') {
                set_config('leeloourl', $res_arr->url, 'local_leeloolxpcontentapi');
                return;
            }
        }

        set_config('leeloourl', '', 'local_leeloolxpcontentapi');
    }

    public function output_html($data, $query = '') {
        return '<input type="hidden" size="'
            . $this->size .
            '" id="' .
            $this->get_id() .
            '" name="' .
            $this->get_full_name() .
            '" value="' . s($data) . '" />';
    }
}
