<?php
$arrData = executeSelect('record_data',array(),array(),'id desc');
?>
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="all_data" role="main" class="page-content d-none">
                        <!-- <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
                            <li class="breadcrumb-item">Datatables</li>
                            <li class="breadcrumb-item active">Buttons</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol> -->
                       
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Example <span class="fw-300"><i>Table</i></span>
                                        </h2>
                                        <div>
                                            <!-- //**/urlAction('form') -->
                                            <!-- <a href="javascript:void(0);" onclick="showPanel('all_data')" class="btn btn-info btn-sm waves-effect waves-themed">Add Data</a> -->
                                            <button type="button" onclick="showPanel('add_data')"; class="btn btn-info btn-sm waves-effect waves-themed mode-btn">Add Data</button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <!-- <div class="panel-tag">
                                                <code>hello</code>
                                            </div> -->
                                            <!-- datatable start -->
                                            <!-- dt-basic-example -->
                                            <table id="datas_datatable" class="table table-bordered table-hover table-striped w-100">
                                                <thead>
                                                    <tr>
                                                        <th>#ID</th>
                                                         <th>Category</th>
                                                        <th>Text</th>
                                                        <th>value</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                   /* foreach($arrData as $val){
                                                       echo "<tr>
                                                        <td>".$val['id']."</td>
                                                        <td>".$val['category_id']."</td>
                                                        <td>".$val['text']."</td>
                                                        <td>".$val['source']."</td>
                                                        <td></td>
                                                        </tr>";

                                                    }*/
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#ID</th>
                                                         <th>Category</th>
                                                        <th>Text</th>
                                                        <th>value</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <!-- datatable end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
<script>
    //
    document.addEventListener("DOMContentLoaded", function(event) { 
        all_data_datatable();
    });
</script>   
<?php
//die('stop');

?>                 