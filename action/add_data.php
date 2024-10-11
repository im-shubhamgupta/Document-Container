<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$data = executeSelectSingle('record_data', array(), array('id' => $id));

$user_type = executeSelect('user_type', array(), array());
$category_data = executeSelect('category', array(), array());

$text =  $data['text'] ?? '';
$source =  $data['source'] ?? '';
$category_id =  $data['category_id'] ?? array();
$is_encrypt = $data['is_encrypt'] ?? 0 ;
//get last selected category
$last_data = executeSelectSingle('record_data', array(), array(), 'id desc');

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
<main id="add_data" role="main" class="page-content d-none">
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
                                                  <strong></strong>
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
                        
                            <!--  url('?controller=form-controller') ?> -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab_default-1" role="tabpanel">
                                <form action="" method="POST" id="add_data_form" name="add_data_form">
                                    <!-- <input type="hidden" name='submit_action' value="add_form"> -->
                                    <input type="hidden" name='id' value="<?= $id ?>" >
                                    <!-- <input type="user_type" name='id' value="<?= $id ?>"> -->
                                    <!-- <div class="form-group">
                                        <label>Choose user </label>
                                        
                                        <div class="">
                                            <div class="radio-toolbar">
                                                <?php
                                                /*foreach ($user_type as $k => $val) {

                                                    echo '<input required type="radio" id="radio_' . $val['id'] . '" name="user_type" value="' . $val['id'] . '" ' . (((isset($data['user_type'])) && $data['user_type'] == $val['id']) ? 'checked' : '') . '>
                                                    <label for="radio_' . $val['id'] . '">' . $val['user_type_name'] . '</label>';
                                                }*/ 
                                                 ?>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                    
                                        <div class="col-6">
                                            <div  class="form-group">
                                            <label>Choose category</label>
                                            <!-- <div class="">
                                                <div class="radio-toolbar">
                                                    <?php
                                                    foreach ($category_data as $k => $val) {
                                                        echo '<input  onclick="change_category(this)" type="radio" id="radio_' . $val['category_id'] . '" name="category_id" value="' . $val['category_id'] . '" ' . ((isset($data['category_id']) && $data['category_id'] == $val['category_id']) ? 'checked' : '') . '>
                                                        <label for="radio_' . $val['category_id'] . '">' . $val['category_name'] . '</label>';
                                                    }  ?>
                                                </div>
                                            </div> -->
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
                                    
                                        <div class="col-6">
                                            <div  class="form-group">
                                                <label>Encrypt/Decrypt</label>
                                        <div class="custom-control custom-switch mr-2 mt-2" >

                                            <input type="checkbox" class="custom-control-input" id="is_encrypt"  name='is_encrypt' value="1"     <?=((isset($data['is_encrypt']) && $data['is_encrypt'] == 1) ? 'checked' : ''  )?>>
                                            <label class="custom-control-label" data-toggle="tooltip" title="Encrypt/Decrypt"  for="is_encrypt"> </label>
                                        </div>
                                        </div>
                                    </div> 
                                    </div>              
                                    <div class="form-group">
                                        <label class="form-label" for="text">Text</label>
                                        <input data-toggle="tooltip" id="text" title="Enter text"  required data-toggle="tooltip" title="" type="text" name="text" class="form-control" value="<?= $text ?>">
                                        <p class="text-danger" id="error-text"></p>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="js-summernote" name="source"
                                         id="source"><?php 
                                        // if(isset($data['is_encrypt']) && $data['is_encrypt'] == 1){
                                        //     echo $enc->decrypt($source);
                                        // }else{
                                        //     echo $source;
                                        // }
                                        ?>
                                    </textarea>
                                        <div class="mt-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="autoSave">
                                                <label class="custom-control-label" for="autoSave">Autosave changes to LocalStorage <span class="fw-300">(every 3 seconds)</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group d-none">
                                        <label class="form-label">File (Browser)</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="files">
                                            <label class="custom-file-label" for="files">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="">
                                            <button type="button" class="mode-btn btn btn-primary waves-effect waves-themed" id="button" onclick="add_form_data(this)">Submit</button>
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
<script>
    
    window.onload = function() {
        var  urlParams = new URLSearchParams(location.search);
        var page_action = urlParams.get('action');
        var edit_id = urlParams.get('id');
        var is_encrypt = "<?=$is_encrypt?>";
        change_user_type();  
        //auto call for set into session
        // $('[data-toggle="tooltip"]').tooltip();
        if(page_action == 'add_data' && edit_id && is_encrypt == 1){
            $pass = window.prompt("Please Enter Profile Password");
            if(parseInt($pass) == '8527'){
                load_source_data(edit_id);
                // $('#add_data').removeClass('d-none');
            }else{
                console.log('wrong password');
            }
        }else{
            load_source_data(edit_id);
            // $('#add_data').removeClass('d-none');
        }
        //$('#user_type').removeClass('d-none'); 

    }
    

</script>
<?php
// die('stop');

?> 