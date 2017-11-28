<?php


if(isset($header) && $header)
    $this->load->view('layout/header');

if(isset($_view) && $_view)
    $this->load->view($_view);

if(isset($footer) && $footer)
    $this->load->view('layout/footer');

?>