<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- BEGIN HEAD-->

<head>

    <meta charset="UTF-8" />
    <title><?php echo title; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/style.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/main.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/theme.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/MoneAdmin.css" />
    <link rel="stylesheet" href="<?php echo asset_url(); ?>plugins/Font-Awesome/css/font-awesome.css" /> -->
    <link rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-fileupload.min.css" />
    <script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
    <?php echo $updatelogin; ?>
    <style type="text/css">
        .mininwidth {
            width: 120px;
        }

        .mininwidth1 {
            width: 80px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {

            // restrict phone input
            $('#limit').keypress(function(key) {
                if (key.charCode == 0) return true;
                if (key.charCode < 48 || key.charCode > 57) return false;
            });



        });
    </script>



</head>
<!-- END  HEAD-->
<!-- BEGIN BODY-->

<body class="padTop53 ">

    <!-- MAIN WRAPPER -->
    <div id="wrap">
        <div id="main-wrapper">

            <!-- HEADER SECTION -->
            <?php echo $header; ?>
            <!-- END HEADER SECTION -->



            <!-- MENU SECTION -->
            <?php echo $left; ?>
            <!--END MENU SECTION -->

            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-12 align-self-center">
                        <h3 class="text-themecolor mb-0">Category</h3>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Masters</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-12 align-self-center d-none d-md-block">

                    </div>
                </div>

                <div class="container-fluid" id="content">
                    <div class="inner" style="min-height:1200px;">
                        <div class="row">
                            <div class="col-lg-12">

                                <?php if ($type == 'edit') { 
                                    //echo "<pre>";print_r($details);
                                    ?>


                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Edit Category</h5>
                                                 
                                            </div>
                                            <div id="collapseOne" class="card-body">
                                                <form action="<?php echo base_url() . 'master/category_edit'; ?>" class="form-horizontal form-material" enctype="multipart/form-data" id="brand-validate" method="post">
                                                    <input type="hidden" value="<?php echo $details[0]->id ?>" name="aid">

                                                    <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Order No.<font style="color: red;">*</font></label>
                                                            <input type="text" id="order_no" name="order_no" maxlength="3" required class="form-control onlynumbers" value="<?php echo $details[0]->order_no ?>" />
                                                        </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Category<font style="color: red;">*</font></label>
                                                            <input type="text" id="name" name="name" required class="form-control" value="<?php echo $details[0]->name ?>" />
                                                        </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Description<font style="color: red;">*</font></label>
                                                            <textarea  id="desc" name="desc" required class="form-control"> <?php echo $details[0]->description; ?> </textarea>
                                                        </div>

                                                        </div>
                                                        <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label class="control-label">Image</label>
                                                            <div class="fileupload fileupload-exists" data-provides="fileupload">
                                                                <div class="fileupload-preview thumbnail"><img src="<?php echo front_url(). $details[0]->image_path; ?>"></div>
                                                                <div>

                                                                    <span class="btn btn-file btn-info"><span class="fileupload-new selimage" uid="1">Select image</span><span class="fileupload-exists">Change</span>
                                                                        <input type="file" name="imag" id="imag" /></span>
                                                                    <input type="hidden" id="imgstat" name="imgstat" value="1">
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                        <label class="control-label">Banner Image</label>
                                                         
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-preview thumbnail" ><img src="<?php echo front_url(). $details[0]->banner_img; ?>"></div>
                                                                <div>

                                                                    <span class="btn btn-file btn-info"><span class="fileupload-new selimage" uid="1">Select image</span><span class="fileupload-exists">Change</span>
                                                                        <input type="file" name="bimage" id="bimage" /></span>


                                                                    <input type="hidden" id="bimage" name="bimage" value="1">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-12">


                                                        <div class="form-actions" style="text-align:center;">

                                                            <a href="<?php echo base_url() . 'master/category'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i> Save Changes</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php } else { ?>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Add Category</h5>
                                            </div>
                                            <div id="collapseOne" class="card-body">
                                                <form action="<?php echo base_url() . 'master/category_save'; ?>" class="form-horizontal form-material" enctype="multipart/form-data" id="brand-validate" method="post">
                                                    <input type="hidden" value="" name="aid">
                                                    <?php $oc = $this->master_db->getcontent('category', ''); ?>
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label ">Order No.<font style="color: red;">*</font></label>
                                                         
                                                            <input type="text" id="order_no" name="order_no" maxlength="3" required class="form-control onlynumbers" value="<?php if (is_array($oc)) {
                                                                                                                                                                                echo count($oc) + 1;
                                                                                                                                                                            } else {
                                                                                                                                                                                echo 1;
                                                                                                                                                                            } ?>" />
                                                        </div>
                                                    </div>
<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Category<font style="color: red;">*</font></label>
                                                         

                                                            <input type="text" id="name" name="name" required class="form-control" value="" />
                                                         
                                                    </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Description<font style="color: red;">*</font></label>
                                                         
                                                            <textarea rows="4" cols="50" id="desc" name="desc" required class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Image</label>
                                                         
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                                                <div>

                                                                    <span class="btn btn-file btn-info"><span class="fileupload-new selimage" uid="1">Select image</span><span class="fileupload-exists">Change</span>
                                                                        <input type="file" name="imag" id="imag" /></span>


                                                                    <input type="hidden" id="imgstat" name="imgstat" value="1">
                                                                </div>

                                                            </div>
                                                        </div>
                                                                 

                                                                     <div class="form-group">
                                                        <label class="control-label">Banner Image</label>
                                                         
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                                                <div>

                                                                    <span class="btn btn-file btn-info"><span class="fileupload-new selimage" uid="1">Select image</span><span class="fileupload-exists">Change</span>
                                                                        <input type="file" name="bimage" id="bimage" /></span>


                                                                    <input type="hidden" id="bimage" name="bimage" value="1">
                                                                </div>

                                                            </div>
                                                        </div>
                                                                                                                                                                        </div>
                                                       <div class="col-md-12">

                                                        <div class="form-actions no-margin-bottom" style="text-align:center;">

                                                            <a href="<?php echo base_url() . 'master/category'; ?>" class="btn btn-primary"><i class="mdi mdi-arrow-left "></i> Back</a>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info"><i class="mdi mdi-check "></i> Save Changes</button>
                                                        </div>
                                                        </div>
 </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                         



                    </div>

                </div>
                <!--END PAGE CONTENT -->


            </div>

            <!--END MAIN WRAPPER -->

            <!-- FOOTER -->
            <div id="footer">
                <p>&copy; <?php echo fottertitle; ?> </p>
            </div>
            <!--END FOOTER -->
            <!-- GLOBAL SCRIPTS -->
            <script src="<?php echo asset_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script>
            <script src="<?php echo asset_url(); ?>plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
            <!-- END GLOBAL SCRIPTS -->
            <?php echo $jsfile; ?>

            <script src="<?php echo asset_url(); ?>plugins/validationengine/js/jquery.validationEngine.js"></script>
            <script src="<?php echo asset_url(); ?>plugins/jasny/js/bootstrap-fileupload.js"></script>
            <script src="<?php echo asset_url(); ?>plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
            <script src="<?php echo asset_url(); ?>plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>


            <script src="<?php echo asset_url(); ?>libs/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap tether Core JavaScript -->
            <script src="<?php echo asset_url(); ?>libs/popper.js/dist/umd/popper.min.js"></script>
            <script src="<?php echo asset_url(); ?>libs/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- apps -->
            <script src="<?php echo asset_url(); ?>dist/js/app.min.js"></script>
            <script src="<?php echo asset_url(); ?>dist/js/app.init.js"></script>
            <!-- slimscrollbar scrollbar JavaScript -->
            <script src="<?php echo asset_url(); ?>libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
            <!--Wave Effects -->
            <script src="<?php echo asset_url(); ?>dist/js/waves.js"></script>
            <!--Menu sidebar -->
            <script src="<?php echo asset_url(); ?>dist/js/sidebarmenu.js"></script>
            <!--Custom JavaScript -->
            <script src="<?php echo asset_url(); ?>dist/js/custom.min.js"></script>
            <!--This page JavaScript -->
            <!-- Chart JS -->
            <script src="<?php echo asset_url(); ?>dist/js/pages/dashboards/dashboard1.js"></script>

            <script src="<?php echo asset_url(); ?>libs/datatables/media/js/jquery.dataTables.min.js"></script>
            <script src="<?php echo asset_url(); ?>dist/js/pages/datatable/custom-datatable.js"></script>
            <script src="<?php echo asset_url(); ?>dist/js/pages/datatable/datatable-basic.init.js"></script>

            <script>
                $(function() {

                    var v = $("#brand-validate").validate({
                        errorClass: "help-block",
                        errorElement: 'span',
                        onkeyup: false,
                        onblur: false,
                        rules: {

                            desc: {

                                minlength: 20,
                                maxlength: 140
                            }
                        },
                        errorElement: 'span',
                        highlight: function(element, errorClass, validClass) {
                            $(element).parents('.form-group').addClass('has-error');
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).parents('.form-group').removeClass('has-error');
                        }

                    });
                });
            </script>

</body>
<!-- END BODY-->

</html>