// function ajax_url(){
// 	return
// }
"use strict"; 
$(document).ready(function(){
    //login form validate
    $("#js-login-btn").click(function(event){
        // Fetch form to apply custom Bootstrap validation
        var form = $("#js-login")
        if (form[0].checkValidity() === false)
        {
            event.preventDefault()
            event.stopPropagation()
        }
        form.addClass('was-validated');
        // Perform ajax submit here...
    });
    //show image
    $(document).on('click', '.multi_img', function(){
        var src = $(this).find('img').attr('src');
        Swal.fire(
            {
                // title: "Sweet!",
                // text: "Image",
                imageUrl: src,
                imageWidth: 400,
                imageHeight: 500,
                imageAlt: "Custom image",
                animation: false
            });
    });
    
});        
	
function all_documents_datatable(){
    $('#document_datatable').dataTable({
        "lengthMenu": [ [10, 25, 50, 100,-1], [10, 25, 50, 100,'All'] ],
        'order':[0,'DESC'],
        responsive: true,
        lengthChange: false,
        dom:
            "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                titleAttr: 'Generate PDF',
                className: 'btn-outline-danger btn-sm mr-1'
            },
            {
                extend: 'excelHtml5',
                text: 'Excel',
                titleAttr: 'Generate Excel',
                className: 'btn-outline-success btn-sm mr-1'
            },
            {
                extend: 'csvHtml5',
                text: 'CSV',
                titleAttr: 'Generate CSV',
                className: 'btn-outline-primary btn-sm mr-1'
            },
            {
                extend: 'copyHtml5',
                text: 'Copy',
                titleAttr: 'Copy to clipboard',
                className: 'btn-outline-primary btn-sm mr-1'
            },
            {
                extend: 'print',
                text: 'Print',
                titleAttr: 'Print Table',
                className: 'btn-outline-primary btn-sm'
            }
        ],
        "processing": true,
            "serverSide": true,
            "scrollX": true,
            "ajax":{
                'url' :site_url + 'ajax/ajaxHandller.php', 
                'type': "post",
                'data' : {
                    'ajax_action' : 'fetch_document_data' 
                }
                // 'data': function(d){
                // // // ClassType: classtype,
                // // d.custom = custom_params() 
                // },
        },
    });
    
}    

function all_data_datatable(){
    $('#datas_datatable').dataTable({
        "lengthMenu": [ [10, 25, 50, 100,-1], [10, 25, 50, 100,'All'] ],
        'order':[0,'DESC'],
        responsive: true,
        lengthChange: false,
        dom:
            /*  --- Layout Structure 
                --- Options
                l   -   length changing input control
                f   -   filtering input
                t   -   The table!
                i   -   Table information summary
                p   -   pagination control
                r   -   processing display element
                B   -   buttons
                R   -   ColReorder
                S   -   Select                          
                */
            "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

        buttons: [
            /*{
                extend:    'colvis',
                text:      'Column Visibility',
                titleAttr: 'Col visibility',
                className: 'mr-sm-3'
            },*/
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                titleAttr: 'Generate PDF',
                className: 'btn-outline-danger btn-sm mr-1'
            },
            {
                extend: 'excelHtml5',
                text: 'Excel',
                titleAttr: 'Generate Excel',
                className: 'btn-outline-success btn-sm mr-1'
            },
            {
                extend: 'csvHtml5',
                text: 'CSV',
                titleAttr: 'Generate CSV',
                className: 'btn-outline-primary btn-sm mr-1'
            },
            {
                extend: 'copyHtml5',
                text: 'Copy',
                titleAttr: 'Copy to clipboard',
                className: 'btn-outline-primary btn-sm mr-1'
            },
            {
                extend: 'print',
                text: 'Print',
                titleAttr: 'Print Table',
                className: 'btn-outline-primary btn-sm'
            }
        ],
        "processing": true,
            "serverSide": true,
            "scrollX": true,
            "ajax":{
                'url' :site_url + 'ajax/ajaxHandller.php', 
                'type': "post",
                'data' : {
                    'ajax_action' : 'fetch_all_data' 
                }
                // 'data': function(d){
                // // // ClassType: classtype,
                // // d.custom = custom_params() 
                // },
        },
    });
}
// // alert(123);
// // function custom_params() {
// //     let new_form_data = {
// //     classtype : $("#ClassType").val(),
// //     section : $("#search_sect").val(),
// //     }	    
// //     return new_form_data;
// // }  
        	
// 	$("#datas_datatable").DataTable({
//         "lengthMenu": [ [10, 25, 50, 100,'All'], [10, 25, 50, 100,-1] ],	
//         // 'order':[0,'ASC'],
//         dom: 'Blfrtip',
//          responsive: true,
//         lengthChange: false,
//         // dom:
//         "pageLength":25,
//         // buttons: [
//         // 'copy', 'csv', 'excel', 'print'
//         // ],
//         "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
//         "<'row'<'col-sm-12'tr>>" +
//         "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
//          buttons: [
//                         /*{
//                         	extend:    'colvis',
//                         	text:      'Column Visibility',
//                         	titleAttr: 'Col visibility',
//                         	className: 'mr-sm-3'
//                         },*/
//                         {
//                             extend: 'pdfHtml5',
//                             text: 'PDF',
//                             titleAttr: 'Generate PDF',
//                             className: 'btn-outline-danger btn-sm mr-1'
//                         },
//                         {
//                             extend: 'excelHtml5',
//                             text: 'Excel',
//                             titleAttr: 'Generate Excel',
//                             className: 'btn-outline-success btn-sm mr-1'
//                         },
//                         {
//                             extend: 'csvHtml5',
//                             text: 'CSV',
//                             titleAttr: 'Generate CSV',
//                             className: 'btn-outline-primary btn-sm mr-1'
//                         },
//                         {
//                             extend: 'copyHtml5',
//                             text: 'Copy',
//                             titleAttr: 'Copy to clipboard',
//                             className: 'btn-outline-primary btn-sm mr-1'
//                         },
//                         {
//                             extend: 'print',
//                             text: 'Print',
//                             titleAttr: 'Print Table',
//                             className: 'btn-outline-primary btn-sm'
//                         }
//                     ],
// 		"processing": true,
// 		"serverSide": true,
//         "scrollX": true,
// 		"ajax":{
// 			'url' :site_url + 'ajax/ajaxHandller.php', 
// 			'type': "post",
// 			'data' : {
// 				'ajax_action' : 'fetch_all_data' 
// 			}
// 			// 'data': function(d){
// 			// // // ClassType: classtype,
//             // // d.custom = custom_params() 
// 			// },
// 		},
// 		// console.log(this);
//         // $('.dataTables_wrapper').addClass();
		

		
// 	});
//     // $('.dt-buttons').addClass('col-md-6 d-flex align-items-center justify-content-start');
//     // $('.dataTables_wrapper.dt-bootstrap4').append("<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
//          "<'row'<'col-sm-12'tr>>" +
//          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>");
    


//                         	--- Markup
//                         	< and >				- div element
//                         	<"class" and >		- div with a class
//                         	<"#id" and >		- div with an ID
//                         	<"#id.class" and >	- div with an ID and a class

//                         	--- Further reading
//                         	https://datatables.net/reference/option/dom
//                         	--------------------------------------
//                          */
                        

// // }*/

