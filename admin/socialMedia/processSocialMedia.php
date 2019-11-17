<?php

require_once '../app/start.php';

use Codecourse\Repositories\Session as Session;
use Codecourse\Repositories\SocialMedia as SocialMedia;

$socialMedia = new SocialMedia();

Session::init();
$tableSocialMedia = 'tbl_social_sites';

switch ($_POST['submit']) {
    case 'insert':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'verify') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        $site_name = $socialMedia->validate($_POST['site_name']);
                        // Sanitizing string data

                        $fields = [
                            'site_name' => $site_name
                        ];
                        if (!empty($site_name)) {
                            $site_name = filter_var($site_name, FILTER_SANITIZE_STRING);
                        }
                        if (empty($_POST['site_name'])) {
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Site name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'addSocialMedia.php';
                            $socialMedia->redirect($home_url);
                        } else {
                            // Will store data in database with photo
                            $insertSocialMedia = $socialMedia->store($fields, $tableSocialMedia);
                            if ($insertSocialMedia) {
                                $message = '<div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> WOW !</strong>Social media data inserted successfully !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'socialMediaIndex.php';
                                $socialMedia->redirect($home_url);
                            }
                        }
                    }
                }
            }
        }

        break;
    case 'update':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'update') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        //  Received id form edit student page
                        $id = $socialMedia->validate($_POST['id']);
                        $site_name = $socialMedia->validate($_POST['site_name']);
                        $fields = [
                            'site_name' => $site_name
                        ];
                        if (!empty($site_name)) {
                            $site_name = filter_var($site_name, FILTER_SANITIZE_STRING);
                        }
                        if (empty($_POST['site_name'])) {
                            $message = '<div class="alert alert-danger alert-dismissible" role="alert"">
                                Site name field remained blank!!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'editSocialMedia.php';
                            $socialMedia->redirect("$home_url");
                        } else {
                            // Will update database
                            $dataUpdated = $socialMedia->updateWithoutPhoto($fields, $id, $tableSocialMedia);
                            if ($dataUpdated) {
                                $message = '<div class="alert alert-info alert-dismissible " role="alert">
                                    <strong> WOW !</strong> Header updated successfully with the newly selected photo !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                Session::set('message', $message);
                                $home_url = 'socialMediaIndex.php';
                                $socialMedia->redirect($home_url);
                            }
                        }
                    }
                }
            }
        }
        break;
    case 'delete':
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'delete') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        $id = $socialMedia->validate($_POST['id']);
                        $dataDeleted = $socialMedia->delete($id, $tableSocialMedia);
                        if ($dataDeleted) {
                            $message = '<div class="alert alert-danger alert-dismissible " role="alert">
                                <strong> WOW !</strong> Data has been deleted from database !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            Session::set('message', $message);
                            $home_url = 'socialMediaIndex.php';
                            $socialMedia->redirect($home_url);
                        }
                    }
                }
            }
        }
        break;

    default:
        // code...
        break;
}
