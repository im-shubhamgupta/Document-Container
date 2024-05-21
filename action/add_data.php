<?php
// if(isset($_GET['id'])){
$id = isset($_GET['id']) ? $_GET['id'] : '';
$data = executeSelectSingle('record_data', array(), array('id' => $id));

$user_type = executeSelect('user_type', array(), array());
$category_data = executeSelect('category', array(), array());
// echoPrint($user_type); 

$text =  $data['text'] ?? '';
$source =  $data['source'] ?? '';
$category =  $data['category'] ?? array();
// $user_type =  $data['user_type'] ?? array();
?>
<style>
    .choose_user {
        display: block;
        padding: 6px;
        background-color: #383833;
        border: 2px solid #4e3939;
        border-radius: 3px;
    }

    .radio-toolbar input[type="radio"] {
        display: none;
    }

    .radio-toolbar label {
        display: inline-block;
        background-color: #603d3d;
        padding: 4px 18px;
        font-family: Arial;
        font-size: 16px;
        cursor: pointer;
        margin-left: 15px;
        border-radius: 10px;
    }

    .radio-toolbar input[type="radio"]:checked+label {
        background-color: #661010;
    }
</style>
<main id="js-page-content" role="main" class="page-content">
    <!-- <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
                            <li class="breadcrumb-item">Form Stuff</li>
                            <li class="breadcrumb-item active">Basic Inputs</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol> -->
    <!--    -->

    <!-- <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active p-3" data-toggle="tab" href="#tab_default-1" role="tab">
                                    <i class="fal fa-table text-success"></i>
                                    <span class="hidden-sm-down ml-1">Alt-Editor Example</span>
                                </a>
                            </li>
                        </ul> -->
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        General <span class="fw-300"><i>inputs</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>

                <!--  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                  <strong><?= $_SESSION['msg'] ?></strong>
                                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div> -->
                <?php
                if (isset($_SESSION['flash'])) { ?>
                    <div class="row mrg-top">
                        <div class="col-md-12 col-sm-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                                <strong><?= sessionFlash() ?></strong>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>

                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- <ul class="nav nav-tabs d-flex justify-content-around" role="tablist">
                                            <?php
                                            foreach ($user_type as $k => $val) { ?>
                                                <li class="nav-item">
                                                    <a class="nav-link p-3" data-toggle="tab" href="#tab_default-<?= $val['id'] ?>" role="tab">
                                                        <i class="fal fa-table text-success"></i>
                                                        <span class="hidden-sm-down ml-1"><?= $val['user_type_name'] ?></span>
                                                    </a>
                                                </li>
                                            <?php }  ?>
                                            </ul> -->
                        <div class="form-group">
                            <label>Choose user </label>
                            <!-- choose_user -->
                            <div class="">
                                <div class="radio-toolbar">
                                    <?php
                                    foreach ($user_type as $k => $val) {

                                        echo '<input type="radio" id="radio_' . $val['id'] . '" name="user_type" value="' . $val['id'] . '" ' . (((isset($data['user_type'])) && $data['user_type'] == $val['id']) ? 'checked' : '') . '>
                                        <label for="radio_' . $val['id'] . '">' . $val['user_type_name'] . '</label>';
                                    }  ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Choose category</label>
                            <div class="">
                                <div class="radio-toolbar">
                                <?php
                                foreach ($category_data as $k => $val) {
                                    echo '<input type="radio" id="radio_' . $val['id'] . '" name="category" value="' . $val['id'] . '" ' . ((isset($data['category']) && $data['category'] == $val['id']) ? 'checked' : '') . '>
                                        <label for="radio_' . $val['id'] . '">' . $val['category_name'] . '</label>';
                                }  ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-content pt-4">
                            <div class="tab-pane fade show active" id="tab_default-1" role="tabpanel">
                                <form action="<?= url('?controller=form-controller') ?>" method="POST" id="add_data">
                                    <input type="hidden" name='submit_action' value="add_form">
                                    <input type="hidden" name='id' value="<?= $id ?>">

                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Text</label>
                                        <input required type="text" id="text" name="text" class="form-control" value="<?= $text ?>">
                                    </div>
                                    <!-- <textarea name="text" id="textarea"></textarea> -->

                                    <!-- <div class="form-group">
                                                        
                                                            <label class="form-label" for="example-textarea">Text area</label>
                                                            <textarea class="form-control" id="source" name="source" rows="5"><?= $source ?></textarea>
                                                        </div> -->
                                    <!-- <div class="form-group">
                                                            <label class="form-label">Category</label>
                                                            <select class="custom-select form-control" name="category"  required>
                                                                <?php
                                                                //print_R(CAT);
                                                                foreach (CAT as $key => $val) {
                                                                    $selected = ($category == $key) ? 'selected' : '';
                                                                    echo "<option value='" . $key . "' " . $selected . " >" . $val . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div> -->
                                    <div class="form-group">
                                        <textarea class="js-summernote" name="source" id="saveToLocal"></textarea>
                                        <!-- <div class="js-summernote" name="source" id="saveToLocal"></div> -->
                                        <div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="autoSave" checked="checked">
                                                <label class="custom-control-label" for="autoSave">Autosave changes to LocalStorage <span class="fw-300">(every 3 seconds)</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="form-label">File (Browser)</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="files">
                                            <label class="custom-file-label" for="files">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary waves-effect waves-themed" id="customFile">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>