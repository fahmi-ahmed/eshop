<?php
class Chart extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Chart_model');
    }
    public function index()
    {
        $data['report'] = $this->Chart_model->report();
        $this->load->view('staff/report', $data);
    }
}
?>
