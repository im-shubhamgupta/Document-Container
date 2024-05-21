
function fetch_all_users(){
    $('#users_datatable').dataTable().fnDestroy();
    
    $('#users_datatable').dataTable({
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

            "lengthMenu": [ [10, 25, 50, 100,-1], [10, 25, 50, 100,'All'] ],
            // 'order':[0,'DESC'],
            'order':[],
            responsive: true,
            "columnDefs" : [ {"targets": '_all', "className": "text-center", },
                //  {"targets": 1, "className": "text-center"},
                //  {"targets": 2, "className": "text-center"},
                //  {"targets": 3, "className": "text-center"}
                ],
            // "drawCallback": function(){ 
            //     $('.i-checks').iCheck({ checkboxClass: 'icheckbox_square-green', radioClass: 'iradio_square-green', }); 
            //     $('#check_all input').on('ifChecked', function(event){ 
            //         $('input[type="checkbox"]').iCheck('check'); }); 
            //         $('#check_all input').on('ifUnchecked', function(event){ 
            //         $('input[type="checkbox"]').iCheck('uncheck'); });
            //         $('[data-toggle="tooltip"]').tooltip({ container: 'body', boundary: 'viewport' }); 
            // },    
            // lengthChange: false,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            // "scrollX": true,
            "ajax":{
                'url' :ajax_url("ajaxDatatable.php "),
                'type': "post",
                'dataType': 'json',
                'data' : {
                    'ajax_action' : 'fetch_all_users' 
                }
            }, 
            select: 'single',
            altEditor: true,
            responsive: true,
            buttons: [
                {
                    text: '<i class="fal fa-edit mr-1"></i> Add',
                    name: 'add_category',
                    className: 'btn-primary btn-sm mr-1',
                    action: function (e, dt, node, config) {
                        mod_users.set_data();
                    }
                },
            ],
            // onAddRow: function(dt, rowdata, success, error){
            //     add_category(rowdata);
            //         //events.prepend('<p class="text-success fw-500">' + JSON.stringify(rowdata, null, 4) + '</p>');
            // },
            // onEditRow: function(dt, rowdata, success, error){
            //     add_category(rowdata);
            //     //events.prepend('<p class="text-info fw-500">' + JSON.stringify(rowdata, null, 4) + '</p>');
            // },
        });
}
