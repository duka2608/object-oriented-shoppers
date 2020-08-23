<?php
    namespace app\Controllers;

    class AboutController extends Controller {
        public function index()
        {
            $this->view("about");
        }
    }