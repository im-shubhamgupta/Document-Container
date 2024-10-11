<main id="users" role="main" class="page-content">
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            All <span class="fw-300"><i>Users</i></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- <div class="panel-tag">
                                <p>
                                    Datatable accepts the following callback functions as arguments: <code>onAddRow(datatable, rowdata, success, error)</code>, <code>onEditRow(datatable, rowdata, success, error)</code>, <code>onDeleteRow(datatable, rowdata, success, error)</code>
                                </p>
                                <p>
                                    In the most common case, these function should call <code>$.ajax </code>as expected by the webservice. The two functions success and error should be passed as arguments to <code>$.ajax</code>. Webservice must return the modified row in JSON format, because the success() function expects this. Otherwise you have to write your own success() callback (e.g. refreshing the whole table).
                                </p>
                            </div> -->
                            <!-- tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active p-3" data-toggle="tab" href="#tab_default-1" role="tab">
                                        <i class="fal fa-table text-success"></i>
                                        <span class="hidden-sm-down ml-1">Alt-Editor Example</span>
                                    </a>
                                </li>
                                
                            </ul>
                            <!-- end tabs -->
                            <!-- tab content -->
                            <div class="tab-content pt-4">
                                <div class="tab-pane fade show active" id="tab_default-1" role="tabpanel">
                                    <!-- row -->
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <!-- datatable start -->
                                            <table id="users_datatable" class="table table-bordered table-hover table-striped w-100">
                                            <thead>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Users Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            </table>
                                        </div>
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
        fetch_all_users();
    });
</script>                     