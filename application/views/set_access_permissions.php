<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Dashboard | Dooo - Movie & Web Series Portal App</title>

    <?php include("partials/header.php"); ?>

</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php include("partials/topbar.php"); ?>


        <?php include("partials/sidebar.php"); ?>


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

                <div class="container-fluid">



                    <!-- start page title -->

                    <div class="row align-items-center">

                        <div class="col-sm-6">

                            <div class="page-title-box">

                                <h4 class="font-size-18">Set access permissions</h4>

                                <ol class="breadcrumb mb-0">

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dooo</a></li>

                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sub Admin Manager</a></li>

                                    <li class="breadcrumb-item active">Set access permissions</li>

                                </ol>

                            </div>

                        </div>
                        <div class="col-12">
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= htmlspecialchars($this->session->flashdata('success'), ENT_QUOTES, 'UTF-8') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>

                    <!-- end page title -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card p-4">
                                <form action="<?= site_url('save_permissions') ?>" method="post">
                                    <input type="hidden" name="role_id" value="<?= htmlspecialchars($role_id, ENT_QUOTES, 'UTF-8') ?>">
                                    <div class="row">
                                        <?php foreach ($menus as $index => $menu): ?>
                                            <div class="col-sm-6">
                                                <label class="form-check-label me-3" for=""><?= htmlspecialchars($menu['name'], ENT_QUOTES, 'UTF-8') ?></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="switch">
                                                    <input type="checkbox" class="toggleclass" id="menu_<?= $menu['id'] ?>"
                                                        name="permissions[]" value="<?= $menu['id'] ?>"
                                                        <?= in_array($menu['id'], $permissions) ? 'checked' : '' ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                                </form>

                            </div>
                        </div>
                    </div>





                </div> <!-- container-fluid -->

            </div>


            <?php include("partials/footer_rights.php"); ?>


        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php include("partials/footer.php"); ?>

    <script>
        var Onesignal_Api_Key = "<?php echo $config->onesignal_api_key ?>";
        var Onesignal_Appid = "<?php echo $config->onesignal_appid ?>";

        $('#datatable').dataTable({
            "order": [],
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": '<?= site_url('Admin_api/get_all_sub_admins') ?>',
            "columns": [{
                    "data": "1",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "data": "2",
                    render: function(data) {
                        return '<div class="btn-group mr-1" data-container="body"> <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options <i class="mdi mdi-chevron-down"></i></button> <div class="dropdown-menu" style="" data-container="body"><a class="dropdown-item" href="<?= site_url('set_permissions') ?>">Set Access Permissions</a> <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#send_Notification_Modal" onclick="initNotification(' +
                            data + ')" href="#">Send Notification</a> <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Edit_this_User_Modal" onclick="Load_User_Data(' +
                            data + ')" href="#">Edit Sub Admin</a> <a class="dropdown-item" onclick="Delete_User(' +
                            data + ')" href="#">Delete SubAdmin</a> </div> </div>';
                    }
                },
                {
                    "data": "3"
                },
                {
                    "data": "4"
                },
                {
                    "data": "5",
                    render: function(data) {
                        if (data == 0) {
                            return 'User';
                        } else if (data == 1) {
                            return 'Admin';
                        } else if (data == 2) {
                            return 'SubAdmin';
                        } else if (data == 3) {
                            return 'Editor';
                        } else if (data == 4) {
                            return 'Editor';
                        }
                    }
                },
                {
                    "data": "6",
                    render: function(data) {
                        return data;
                    }
                }
            ]

        });