<?php
//$arrData = executeSelect('category',array(),array(),'id desc');
?>
<!-- js-page-content -->
<main id="category" role="main" class="page-content">
                        <div class="row">
                            <div class="col-xl-12">
                                <!-- <button type="button" onclick="mod_day_wise_referral.setdata()">open</button> -->
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Example <span class="fw-300"><i>Table</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <!-- tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active p-3" data-toggle="tab" href="#tab_default-1" role="tab">
                                                        <i class="fal fa-table text-success"></i>
                                                        <span class="hidden-sm-down ml-1">Alt-Editor Example</span>
                                                    </a>
                                                </li>
                                                <!-- <li class="nav-item">
                                                    <a class="nav-link p-3" data-toggle="tab" href="#tab_default-2" role="tab">
                                                        <i class="fal fa-cog text-info"></i>
                                                        <span class="hidden-sm-down ml-1">Supported Modifiers</span>
                                                    </a>
                                                </li> -->
                                            </ul>
                                            <!-- end tabs -->
                                            <!-- tab content -->
                                            <div class="tab-content pt-4">
                                                <div class="tab-pane fade show active" id="tab_default-1" role="tabpanel">
                                                    <!-- row -->
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <!-- datatable start -->
                                                            <table id="category_datatable" class="table table-bordered table-hover table-striped w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th>#ID</th>
                                                                    <th>Type</th>
                                                                    <th>Category Name</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            </table>
                                                        </div>
                                                        <!-- <div class="col-xl-12">
                                                            <hr class="mt-5 mb-5">
                                                            <h5>Event <i>logs (AJAX Calls)</i></h5>
                                                            <div id="app-eventlog" class="alert alert-primary p-1 h-auto my-3"></div>
                                                        </div> -->
                                                    </div>
                                                    <!-- end row -->
                                                </div>
                                            </div>
                                            <!-- end tab content -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                 
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
        fetch_all_category();
    });
</script>                     