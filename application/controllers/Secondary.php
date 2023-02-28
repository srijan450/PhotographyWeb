<?php
class Secondary extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mainmodel_model');
    }

    public function downloadFile()
    {
        if (isset($_GET['file']) && isset($_GET['name'])) {
            echo file_exists($_GET['file']);
            $res = $_GET['file'];
            $category = $_GET['name'];
            $ext = explode('.', $res);
            // header("Content-Disposition: attachment; filename=$category.$ext[1]");
            // echo readfile($res);
        } else {
            header("location: ../maincontroller/error404");
        }
    }

    public function login()
    {
        if (isset($_POST['email']) && isset($_POST['pass'])) {
            $res = $this->Mainmodel_model->verifyuser(array('adminemail' => $_POST['email']));
            if ($res) {
                $res = $res = $this->Mainmodel_model->verifyuser(array('adminemail' => $_POST['email'], 'adminpassword' => $_POST['pass']));
                if ($res) {
                    $_SESSION['superemail'] = $_POST['email'];
                    $_SESSION['sessionpass'] = $_POST['pass'];
                    $_SESSION['adminonline'] = 'online';
                    $res = array('location' =>  base_url() . 'maincontroller/uploadimage', 'msg' => '😘Welcome Miss Universe😘');
                } else {
                    $res = array('location' =>  '', 'msg' => 'Invalid Password');
                }
            } else {
                $res = array('location' => '', 'msg' => 'Only admin can login.');
            }
            echo json_encode($res);
        }
    }

    public function uploadImage()
    {
        if (isset($_SESSION['adminonline']) && isset($_FILES['file']) && isset($_POST['category']) && isset($_POST['order']) && isset($_POST['title'])) {
            extract($_POST);
            if ($order === '') {
                $order = '1';
            }
            $res = array();
            $temp = explode('/', $_FILES['file']['type']);
            $imageFileType = $temp[0];
            if ($imageFileType === 'image') {

                $temp = explode('.', $_FILES['file']['name']);
                $_FILES['file']['name'] = date('dmyhis') . '.' . $temp[count($temp) - 1];
                move_uploaded_file($_FILES['file']['tmp_name'], 'assets/img/' . $_FILES['file']['name']);

                $data = array(
                    'order' => $order,
                    'category' => strtolower($category),
                    'title' => strtolower($title),
                    'path' => base_url() . 'assets/img/' . $_FILES['file']['name']
                );
                $this->Mainmodel_model->newupload($data);
                $res['status'] = 'success';
                $res['msg'] = 'Successfully Uploaded';
            } else {
                $res['status'] = 'failed';
                $res['msg'] = 'Only images can be uploaded';
            }
        } else {
            $res['status'] = 'danger';
            $res['msg'] = base_url() . 'maincontroller/error404';
            header("location: ../maincontroller/error404");
        }
        echo json_encode($res);
    }

    public function editUploaded()
    {
        if (isset($_SESSION['adminonline']) && isset($_POST['category']) && isset($_POST['order']) && isset($_POST['title']) && isset($_POST['path'])) {
            print_r($_POST);
            $this->Mainmodel_model->updatePhotoInfo($_POST);
        }
    }
    public function addnewAdmin()
    {
        if (isset($_SESSION['adminonline']) && isset($_POST['email']) && isset($_POST['pass'])) {
            $res = $this->Mainmodel_model->verifyuser(array('adminemail' => $_POST['email']));
            if (!$res) {
                $this->Mainmodel_model->adduser(array('adminemail' => $_POST['email'], 'adminpassword' => $_POST['pass']));
                $res = array('status' => 'success', 'msg' => $_POST['email'] . ' is now admin.');
            } else {
                $res = array('status' => 'falied', 'msg' => $_POST['email'] . ' is Already An Admin.');
            }
            echo json_encode($res);
        }
    }

    public function deleteUploaded()
    {
        if (isset($_SESSION['adminonline']) && isset($_POST['patha'])) {
            $str = str_replace(base_url(), '', $_POST['patha']);
            if (file_exists($str)) {
                unlink($str);
                $this->Mainmodel_model->deleteUploaded(array('path' => $_POST['patha']));
                echo "hello";
            }
        }
    }


    public function dismissAdmin()
    {
        if (isset($_SESSION['adminonline']) && isset($_POST['email']) && isset($_POST['pass'])) {
            if ($_SESSION['superemail'] !== $_POST['email']) {
                $res = $this->Mainmodel_model->verifyuser(array('adminemail' => $_POST['email']));
                if ($res) {
                    $res = $this->Mainmodel_model->verifyuser(array('adminemail' => $_SESSION['superemail'], 'adminpassword' => $_POST['pass']));
                    if ($res) {
                        $this->Mainmodel_model->removeuser(array('adminemail' => $_POST['email']));
                        $res = array('location' => '', 'status' => 'success', 'msg' => $_POST['email'] . ' is no more admin.');
                    } else {
                        $res = array('location' => '', 'status' => 'falied', 'msg' => 'Incorrect Password');
                        isset($_SESSION['danger']) ? $_SESSION['danger'] = 1 : $_SESSION['danger'] = $_SESSION['danger'] + 1;
                        if (isset($_SESSION['danger'])) {
                            if ($_SESSION['danger'] > 3) {
                                session_destroy();
                            }
                        }
                    }
                } else {
                    $res = array('location' => '', 'status' => 'falied', 'msg' => $_POST['email'] . ' is not an admin email.');
                }
            } else {
                $res = array('location' => '', 'status' => 'falied', 'msg' => "You cannot remove yourself");
            }
        } else {
            $res = array('location' => base_url() . 'maincontroller/login', 'status' => 'falied', 'msg' => 'please reload the page');
            header("location: ../maincontroller/error404");
        }
        echo json_encode($res);
    }

    public function editAdmin()
    {
        if (isset($_SESSION['adminonline']) && isset($_POST['email']) && isset($_POST['pass'])) {
            $res = $this->Mainmodel_model->verifyuser(array('adminemail' => $_POST['email']));
            if ($res != '1' || ($_SESSION['superemail'] == $_POST['email'])) {
                $this->Mainmodel_model->updateEdited(array('adminemail' => $_POST['email'], 'adminpassword' => $_POST['pass']));
                $_SESSION['superemail'] = $_POST['email'];
                $res = array('location' => '', 'status' => 'success', 'msg' => 'Profile Updated.');
            } else {
                $res = array('location' => '', 'status' => 'success', 'msg' => $_POST['email'] . ' is already an admin.');
            }
        } else {
            $res = array('location' => base_url() . 'maincontroller/login', 'status' => 'falied', 'msg' => 'please reload the page');
            header("location: ../maincontroller/error404");
        }
        echo json_encode($res);
    }

    public function createAboutContent()
    {
        if (isset($_SESSION['adminonline']) && isset($_POST['text'])) {
            $f = fopen('assets/pages/test.txt', 'w');
            $str = $_POST['text'];
            fwrite($f, $str);
            fclose($f);
            $res = array("status" => "success", "msg" => "Successfully changed about page content.", "loc" => "");
        } else {
            $res = array("status" => "failed", "msg" => "Not allowed.", "loc" => base_url() . "maincontroller/error404");
            header("location: ../maincontroller/error404");
        }
        echo json_encode($res);
    }
}
