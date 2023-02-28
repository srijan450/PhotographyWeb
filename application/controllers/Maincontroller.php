<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maincontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->view('components/links.php');
        $this->load->model("Mainmodel_model");
        // $_GLO = 
        $GLOBALS['res'] = $this->Mainmodel_model->getOne(array('what' => 'category'));
    }
    public function index()
    {

        $this->load->view('components/menu.php', array('menu' => $GLOBALS['res'], 'home' => 'text-warning'));
        $res = $this->Mainmodel_model->getHome();
        $this->load->view('website/category.php', array('data' => $res));
        // $this->Mainmodel_model->newupload(array('order' => '121', 'category' => 'Payal', 'path' => 'c/asasa', 'title' => 'hello world'));
    }
    public function categories()
    {
        if (isset($_GET['data'])) {

            // $res = $this->Mainmodel_model->getOne(array('what' => 'category'));
            if (in_array(array('category' => $_GET['data']), $GLOBALS['res'])) {
                $this->load->view('components/menu.php', array('menu' => $GLOBALS['res'], 'category' => 'text-warning', "active" => $_GET['data']));

                // $_GET['data']
                $res = $this->Mainmodel_model->getCategory($_GET['data']);
                $this->load->view('website/category.php', array('data' => $res));
            } else {
                header("location: error404");
            }
        }
    }
    public function about()
    {
        $this->load->view('components/menu.php', array('menu' => $GLOBALS['res'], 'about' => 'text-warning'));
        $this->load->view('website/about');
    }

    public function login()
    {
        $this->load->view('components/menu.php', array('menu' => $GLOBALS['res'], 'login' => 'text-warning'));
        $this->load->view('website/loginpage');
    }

    public function uploadimage()
    {

        if (isset($_SESSION['adminonline'])) {
            $this->load->view('components/menu.php', array('menu' => $GLOBALS['res'], 'upload' => 'text-warning'));
            $this->load->view('website/upload.php');
        } else {
            header('location: error404');
        }
    }

    public function Profile()
    {
        if (isset($_SESSION['adminonline'])) {
            $this->load->view('components/menu.php', array('menu' => $GLOBALS['res'], 'profile' => 'text-warning'));
            $this->load->view('website/edit');
        } else {
            header('location: error404');
        }
    }

 
    public function editabout()
    {
        if (isset($_SESSION['adminonline'])) {
            $this->load->view('components/menu.php', array('menu' => $GLOBALS['res'], 'editAbout' => 'text-warning'));
            $this->load->view('website/editabout');
        } else {
            header('location: error404');
        }
    }
    public function logout()
    {
        if (isset($_SESSION['adminonline'])) {
            session_destroy();
        }
        header('location: login');
    }
    public function Error404()
    {

        $this->load->view("website/error_404");
    }
    public function err()
    {
        $this->load->view('website/unsupported');
    }
}
