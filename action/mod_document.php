<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';

$data = executeSelectSingle('document',array(),array('id' => $id));
$user_type = executeSelect('user_type', array(), array());
$category_data = executeSelect('category', array(), array());
$sub_category = executeSelect('sub_category', array(), array());

$name =  $data['name'] ?? '';
$source =  $data['source'] ?? '';
$category =  $data['category']?? '';
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

<main id="<?=ACTION?>" role="main" class="page-content">
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
                <?php 
                if(isset($_SESSION['flash'])){?>
                    <div class="row mrg-top">
                        <div class="col-md-12 col-sm-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                                <strong><?=sessionFlash()?></strong>
                            </div>
                        </div>
                    </div> 
                <?php 
                } ?>   
                <div class="panel-container show">
                    <div class="panel-content">
                        <form action="<?=urlController('doc_controller')?>" method="POST" enctype="multipart/form-data" name="mod_document_form" id="mod_document_form" >
                            <!-- <input type="hidden" name='request_action' value="add_document"> -->
                            <input type="hidden" name='id' value="<?=$id?>">
                            <!-- <div class="form-group">
                                        <label>Choose user </label>
                                        
                                        <div class="">
                                            <div class="radio-toolbar">
                                                <?php
                                                foreach ($user_type as $k => $val) {

                                                    echo '<input type="radio" id="radio_' . $val['id'] . '" name="user_type" value="' . $val['id'] . '" ' . (((isset($data['user_type'])) && $data['user_type'] == $val['id']) ? 'checked' : '') . '>
                                                    <label for="radio_' . $val['id'] . '">' . $val['user_type_name'] . '</label>';
                                                }  ?>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Choose category</label>
                                        <div class="col-6">
                                            <div class="radio-toolbar">
                                                <?php
                                                // foreach ($category_data as $k => $val) {
                                                //     echo '<input type="radio" id="radio_' . $val['category_id'] . '" name="category_id" value="' . $val['category_id'] . '" ' . ((isset($data['category_id']) && $data['category_id'] == $val['category_id']) ? 'checked' : '') . '>
                                                //     <label for="radio_' . $val['category_id'] . '">' . $val['category_name'] . '</label>';
                                                // }  
                                                ?>
                                                <select class="form-control single-select2"  onchange="change_category(this)" name="category_id" id="category_id">
                                                    <option value="">---choose category---</option>
                                                    <?php
                                                        foreach ($category_data as $k => $val) {
                                                            $selected =  ((isset($data['category_id']) && $data['category_id'] == $val['category_id']) ? 'selected' : '');
                                                            $last_selected =  ((!isset($data['category_id']) && $last_data['category_id'] == $val['category_id']) ? 'selected' : '');
                                                            echo "<option value='".$val['category_id']."' ".$selected." ".$last_selected." >
                                                            ".$val['category_name']." </option>";

                                                        }  ?>
                                            </select>
                                            <p class="text-danger" id="error-category"></p>
                                            </div>
                                        </div>
                                    </div>
                            <!-- <div class="form-group">
                                <label class="form-label">Category</label>
                                <select class="custom-select form-control" name="category"  required>
                                    <?php
                                    //print_R(CAT);
                                        foreach(CAT as $key => $val){
                                            $selected = ($category== $key) ? 'selected' : '';
                                            echo "<option value='".$key."' ".$selected." >".$val."</option>";     
                                        }
                                    ?>
                                </select>
                            </div>         -->
                            <!-- <div class="form-group">
                                <label class="form-label" for="simpleinput">Sub Category</label>
                                <input required type="text" id="sub_category_name" name="sub_category_name" class="form-control" value="<?=$sub_category['sub_category_name']?>">
                            </div> -->

                            <div class="form-group">
                                <label class="form-label" for="simpleinput">Document Name</label>
                                <input required type="text" id="title" name="title" class="form-control" value="<?=$name?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Documents (Browser)</label>
                                <div class="custom-file">
                                    <input type="file" name="image[]"  onblur="uploadDocument(this)"  class="custom-file-input" multiple id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            
                            <!-- <div class="form-group mb-0">
                                <label class="form-label">File (Browser)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div> -->
                            <div class="form-group mb-0">
                                <div class="">
                                    <button type="button" onclick="submit_document(this)" class="btn btn-primary waves-effect waves-themed" id="customFile">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
       // $('#user_type').removeClass('d-none'); 
    });
</script>