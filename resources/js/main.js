// $(document).ready({
//     $(function () {
//       $('[data-toggle="tooltip"]').tooltip();
//     })

// });
// var  urlParams = new URLSearchParams(location.search);
// var page_action = urlParams.get('action');
const currentUrl = window.location.href;
const urlWithoutQueryString = currentUrl.split('?')[0];
const urlWithoutAction = currentUrl.split('?')[0] + '?action=';
const validExtensions = ['jpg', 'jpeg', 'png', 'gif']; 
"use strict";
// https://www.npmjs.com/package/izitoast
iziToast.settings({
    timeout: 5000, // Default time before the toast disappears (5 seconds)
    resetOnHover: true, // Reset the timeout when the toast is hovered
    position: 'topRight', // Default position of the toast
    transitionIn: 'fadeInUp', // Default animation for showing the toast
    transitionOut: 'fadeOut', // Default animation for hiding the toast
    progressBar: true, // Show progress bar by default
    close: true, // Show close button by default
    pauseOnHover: true, // Pause the toast when hovered
    closeOnClick: true, // Close the toast if clicked
    icon: 'icon-info', // Default icon for notifications
    titleSize: '16px', // Default title font size
    messageSize: '14px', // Default message font size
    // icon: '', // icon class
    transitionIn: 'flipInX',
    transitionOut: 'flipOutX',
    position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
    onOpen: function () {
      console.log('callback abriu!');
    },
    onClose: function () {
      console.log("callback fechou!");
    }
});
function successToast(options = {}) {
    iziToast.success({
        title: 'Success',
        message: 'Operation completed successfully!',
        position: 'topRight',
        timeout: 4000,
        progressBar: true,
        closeOnClick: true,
        pauseOnHover: true,
        transitionIn: 'fadeInUp',
        transitionOut: 'fadeOut',
        icon: 'icon-check',
        ...options //overwrite the data
    });
}
function errorToast(options = {}) {
    iziToast.error({
        title: 'Error',
        message: 'Opps something error!',
        position: 'topRight',
        timeout: 5000,
        progressBar: true,
        closeOnClick: true,
        pauseOnHover: true,
        transitionIn: 'fadeInUp',
        transitionOut: 'fadeOut',
        icon: 'icon-check',
        ...options //overwrite the data
    });
}
function valid(data){
    if(data== null || data == undefined || isNaN(data) || $.trim(data) == '' ){//|| (!data)//isFinite()
        return '';
    }else{
        return data;
    }
}
function is_valid_number(val){
    if(Number.isInteger(val)) {
        return true;
    }else{
        return false;
    }
}
function getUrl(data){
    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);
    const check = params.get(data);
    if(valid(check)){
        return check;
    }else{
        return '';
    }
}
function getSpinner(){
    return '<i class="fa fa-spinner fa-spin"></i>';
}

function ajax_url(url){  //provide url for ajax for .php
    if(getUrl('debugTest') == 1){
        return site_url+'ajax/'+url+'?debugTest=1';
    }else{
        console.log(site_url+'/ajax/'+url);
        return site_url+'ajax/'+url;
    }
}
function get_ajax(file_name){  //for calling same page  index.php index_ajax
    if(getUrl('debugTest') == 1){
        return site_url + '?get_ajax='+file_name+'&debugTest=1';
    }else{
        return site_url + '?get_ajax='+file_name;
    }
}
function onSignIn(googleUser) {
    alert(12);
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  }
// var delete = {
/*
function deleteConfirm(self){

    return new Promise(resolve => {
        setTimeout(() => { resolve('resolved'); }, 5000);
           
        });
    var result = await Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    })
    // return result;
    // .then((result) => {
    //     if (result.value) {
    //         alert(1);
    //         delete_category(self);
    //         return true;
    //     } else if (result.dismiss === Swal.DismissReason.cancel) {
    //         return false;
            
    //     }
    // });
      
    if (result.value) {
        alert(12);
       
       return true;
    } else if (result.dismiss === Swal.DismissReason.cancel) {
        return false;
    }
//   .then((result) => {
//         if (result.value) {
//             alert(1);
//             return true;
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//             return false;
           
//         }
//       });

}*/

function uploadImageByPromise(file){

    if (validExtensions.includes(file.type.split('/')[1])) {
        return new Promise(function(myResolve, myReject) { 
            //  let renameIndex = 1;
            // let fileExtension = file.name.split('.').pop().toLowerCase();
            // let newFileName = `image_${renameIndex++}.${fileExtension}`;
            var form_data = new FormData();
            form_data.append('file', file);//, newFileName
            form_data.append('ajax_action', 'upload_document_file');

            fetch(ajax_url('ajaxHandller.php'), {
                method: 'POST',
                body: form_data
            })
            .then(response => response.json())
            .then(data => {
                if(data.check){
                    myResolve(data);
                }else{
                    console.log('error');
                }
                // document.getElementById('status').innerHTML += data;
            })
            .catch(error => {
                console.log(error);
                myReject("Error");
            }); 
        });
    } else {
        console.log(`Invalid file type for ${file.name}<br>`);
    }
}
function setup_summernote_editor(){
  //  var content = $('.js-summernote').summernote('code');
  
    // $('.js-summernote').summernote('destroy');
    disable_tab_key_for_summernote();
    // get_summer_note_hints();
    var autoSave = $('#autoSave');
    var interval;
    var timer = function() {
        interval = setInterval(function() {
            //start slide...
            if (autoSave.prop('checked'))   saveToLocal();
            clearInterval(interval);
        }, 3000);
    };
    //save
    var saveToLocal = function() {
        localStorage.setItem('summernoteData', $('#source').summernote("code"));
        // console.log("saved");
    }
    //delete 
    var removeFromLocal = function() {
        localStorage.removeItem("summernoteData");
        $('#source').summernote('reset');
    }
    //init default
    $('.js-summernote').summernote({
        lineHeights: ['1.0', '1.5', '2.0', '2.5', '3.0'],
        height: 300,
        defaultFontSize: '14px',
        defaultLineHeight: 1.0,
        tabsize: 2,
        placeholder: "Type here...",
        dialogsFade: true,
        toolbar: [
            ['style', ['style']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            // ['table', ['table']],
            ['insert', ['link', 'picture', 'video', 'table']],
            ['view', ['fullscreen', 'codeview', 'help']],
            ['history', ['undo', 'redo']]
            // ['codeview', ['code']],
        ],
        // math: {
        //     engine: 'katex',
        //     delimiters: {
        //         inline: ['$', '$'],
        //         block: ['$$', '$$']
        //     }
        // },
        callbacks: {
            onInit: function(e) {//after load summernote
                // $('.js-summernote').summernote("code", localStorage.getItem("summernoteData"));
                $('.note-editable').css('background-color', '#272822');//#000'
                /*/*$('button[data-event="foreColor"]').spectrum({
                    color: '#f00',
                    showPalette: true,
                    palette: [
                        ['#000', '#444', '#666', '#999', '#ccc', '#eee', '#f3f3f3', '#fff'],
                        ['#f00', '#f90', '#ff0', '#0f0', '#0ff', '#00f', '#90f', '#f0f']
                    ]
                });*/
            },
            onChange: function(contents, $editable) {//onkeyup
                clearInterval(interval);
                timer();
            },
            onImageUpload: function(files) {
                // for (let i = 0; i < files.length; i++) {
                //     uploadImage(files[i]);
                // }
                uploadImage(files);
                 // return false;
            }
        }
    });//.summernote('code', content); 'add data from other side'
}
function uploadDocument(self){
    var imageInput = document.getElementById("customFile");
    imageInput.addEventListener("change", function(event) {
    var files = event.target.files;
        uploadImage(files);
    });
}

async function uploadImage(files) {
    var file_resp = [];
    var files_arr = Array.from(files);//convert like array 
    files_arr.forEach( (ev) => {
        var file_name = new Date().getTime();
        var file_arr = [];
        file_resp.push(uploadImageByPromise(ev));
    });
    var file_result = await Promise.all(file_resp);
    if(file_result){
        // var form = document.getElementById("add_data_form");
        var form = document.getElementById("mod_document_form");
        file_result.forEach((ev) => {
            var x = document.createElement("INPUT");
            x.setAttribute("type", "hidden");
            x.setAttribute("name", "fileToUpload[]");
            x.setAttribute("value", ev.file_name);
            form.appendChild(x);
        });
        // successToast({
        //     title: 'Success',
        //     message: 'Uploaded successfully!'
        // }); 
        console.log('Uploaded successfully!');
    }else{
        errorToast({
            message: 'Error on Uploading',
            onClosed: function () {
                location.reload();
            }
        }); 
    }
}
function submit_document(self){
    var title = $('#title').val().trim();
    var category_id = $('select[name="category_id"]').val();
    var user_type = $('#user_type').val();
    if(!category_id){
        $('#error-category_id').html('Please select Category');
        $('#category_id').focus();
        return false;
    }
    if(!title){
        $('#error-title').html('Please select Category');
        $('#title').focus();
        return false;
    }
    var btn_name = $(self).text();
    var data_string = new FormData($('form[name="mod_document_form"]')[0]);
    console.log(data_string);
    data_string.append('user_type', user_type);
    data_string.append('ajax_action', 'submit_add_document');
    $.ajax({
        url : ajax_url("ajaxHandller.php"),
        type : "POST",
        data : data_string,
        dataType: 'JSON',
        // cache : false; //it's need when we frequently chage data from get to post viceversa
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(self).attr('disabled',true).append('  '+getSpinner());
        },
        complete: function() {
            $(self).attr('disabled',false).html(btn_name);
        },
        success:function(data) {
            console.log(data);
            if(data.check == 'success' ){
                window.location.href='index.php?action=all_document';
                successToast({
                    message  : 'Document uploaded Sucessfully'
                });
            }else{
                errorToast({
                    title: 'Error',
                    message: data.msg,
                    position: 'topRight',
                    timeout: 5000,
                });
                // swal({
                //     title: "Warning!",
                //     text: data.msg,
                //     type: "error",
                //     // timer: 2000,
                // });
            }
        }
    });


}
function disable_tab_key_for_summernote(){
    // Enable the Tab key in Code View
    $(document).on('keydown', '.note-editable', function(e) {
        if (e.key === 'Tab') {
            e.preventDefault();  // Prevent default tab behavior
            console.log(this);
            // var $this = $(this);
            var start = this.selectionStart;
            var end = this.selectionEnd;

            // Insert 4 spaces for tabbing
            $(this).val(function(index, value) {
                return value.substring(0, start) + "    " + value.substring(end);
            });
            this.selectionStart = this.selectionEnd = start + 4;
        //var spaces = "    ";  // 4 spaces for a tab
        //$this.val($this.val().substring(0, start) + spaces + $this.val().substring(end));
        //this.selectionStart = this.selectionEnd = start + spaces.length;
        }
    });
    /*$(document).on('keydown', function(e) {
        if (e.key === 'Tab' && $('.note-editable').is(':visible')) {  // Check if code view is active
            e.preventDefault();  // Prevent the default tab behavior

            // Get the textarea (code editor)
            var textarea = $('.note-editable')[0];

            // Get current cursor position
            var start = textarea.selectionStart;
            var end = textarea.selectionEnd;

            // Insert 4 spaces (you can adjust this)
            var spaces = "    ";  // 4 spaces

            // Update the value of the textarea (insert spaces at the cursor position)
            textarea.value = textarea.value.substring(0, start) + spaces + textarea.value.substring(end);

            // Move the cursor to the correct position after the inserted spaces
            textarea.selectionStart = textarea.selectionEnd = start + spaces.length;
        }
    });*/

}
function add_form_data(self){
    var textValue = $('#text').val().trim();
    $('#text').toggleClass('is-invalid', !textValue);
    $('#error-text').focus().html(!textValue ? 'Please enter text' : '');
    if (!textValue) return false;
    // var category_id = $('input[name="category_id"]').is(':checked');
    var category_id = $('select[name="category_id"]').val();
    $('#error-category').html(!category_id ? 'Please choose category' : '').focus();
    if (!category_id) return false;

    var btn_name = $(self).text();
    // var data_string = new FormData($('#add_data_form')[0]);
    var data_string = new FormData($('form[name="add_data_form"]')[0]);
    data_string.append('ajax_action', 'submit_form_data');
    console.log('test');
    $.ajax({
        url : ajax_url("ajaxHandller.php"),
        type : "POST",
        data : data_string,
        dataType: 'JSON',
        // cache : false; //it's need when we frequently chage data from get to post viceversa
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(self).attr('disabled',true).append('  '+getSpinner());
        },
        complete: function() {
            $(self).attr('disabled',false).html(btn_name);
        },
        success:function(data) {
            console.log(data);
                if(data.check == 'success' ){
                    window.location.href='index.php?action=all_data';
                // swal({
                //     title: "Success",
                //     text: "Now, you can Create your Meeting with Doctor ",
                //     type: "success"
                // },function(){
                //      // window.location.href = "index.php?payment_status=success";
                //      window.location.href = data.url;
                // });
            }else{
                errorToast({
                    title: 'Error',
                    message: data.msg,
                    position: 'topRight',
                    timeout: 5000,
                });
                // swal({
                //     title: "Warning!",
                //     text: data.msg,
                //     type: "error",
                //     // timer: 2000,
                // });
            }
        }
    }); 
}  
var universal_modal = {
    set_data: function(self){
        this.close_modal();
        this.render(); 
        this.appendModal(); 
        this.open_modal();
        // this.modal_id = 'categoryModal';
    },
    render: function(){
        var html = 
               `<div class="modal inmodal" id="universalModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                   <div class="modal-dialog modal-md">
                       <div class="modal-content">
                       
                       `;
            
            html +=`<div id="append_div"></div>`;         
            
            html +=`</div>
                   </div>
               </div>`;
       $('body').append(html);
    //    setTimeout(function() {
    //    mod_day_wise_referral.render_referral_details_html(); }, 200);
    },
    appendModal(){
        $('#append_div').append($('#prepared_data').html());
    },
    open_modal: function(){ 
           $('#universalModal').modal('show').fadeIn(800);
        },
    close_modal: function(){
        this.id = 0;
        $('#universalModal').modal('hide'); 
        $('#universalModal').remove(); 
    },
}
var mod_users = {
    id: 0,
    user_type_name :'',
    set_data: function(self){
        $("#prepared_data").remove();
        var data = ($(self).data('user_data'))? $(self).data('user_data') : '';
        if(data){
            this.id = data.hasOwnProperty('id') ? data.id : '';
            this.user_type_name = data.hasOwnProperty('user_type_name') ?  data.user_type_name : '';
        }
        this.render(); 
    universal_modal.set_data();
    },
    render: function(){
        html =`<div id="prepared_data"> 
                <div class="modal-header">
                <h4 class="modal-title">Add Users</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="universal_modal.close_modal();"><span aria-hidden="true">&times;</span></button> 
                </div> 
    
                <form action="#" id="userTypeForm" name="userTypeForm">       
                <div class="modal-body">
                    <div class="progress" id="modal_loader" style="display:none;"></div>
                        <div class="row">
                            <div class="col-sm-12"><label><strong>User Name:</strong></label> 
                            <input required class="form-control" type="text" name="user_type_name" id="user_type_name" value="`+this.user_type_name+`" >
                            <input required type="hidden" name="id" id="id" value="`+this.id+`" ></div>
                        </div>
                        <br> 
                    </div>`;
              
        html +=`
            <div class="modal-footer">
                <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary border" onclick="universal_modal.close_modal();">Close</button> 
            </div>
            </form>               
        </div>`;
       $('body').append(html);
   },
    trigger_js(){

    },
}
$(document).on('submit','#userTypeForm', function (e) {
    e.preventDefault();
    var form_data = new FormData(this); //new FormData(this);//;//
    form_data.append("ajax_action", "add_user_type");
    var btn_name = $('#submit_btn').text();
    $.ajax({ 
        // url: ajax_url('ajaxHandller.php'),
        url :get_ajax('ajaxHandller'),
        type: 'POST',
        data: form_data,
        dataType: 'JSON',
        contentType:false,
        cache:false,
        processData:false,
        beforeSend: function(){ 
            // $('#modal_loader').show();
            $('#append_div #submit_btn').html('  <i class="fa fa-spinner fa-spin"></i>');//.attr('disabled',true)
        },
        complete: function(){ $('#append_div #submit_btn').html(btn_name);//.attr('disabled',false);
        }, 
        success: function (data) {
            if(data.check=='success'){
                // fetch_all_category();
                $('#users_datatable').DataTable().ajax.reload();
                iziToast.success({
                    title: 'Success',
                    message: data.msg,
                    onClosed: function () {
                        // redirect('all_orders');
                    }
                });
                universal_modal.close_modal();
            }else{
                iziToast.error({
                    title: 'error',
                    message: data.msg,
                });
            }
        },
    });
});


// }
function deleteConfirm(self){

    return new Promise(resolve => {
        var result = Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        })
    if (result.value) {
        alert(12);
        
        return true;
    } else if (result.dismiss === Swal.DismissReason.cancel) {
        return false;
    }
           
    });
    
    // return result;
    // .then((result) => {
    //     if (result.value) {
    //         alert(1);
    //         delete_category(self);
    //         return true;
    //     } else if (result.dismiss === Swal.DismissReason.cancel) {
    //         return false;
            
    //     }
    // });
      
    
//   .then((result) => {
//         if (result.value) {
//             alert(1);
//             return true;
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//             return false;
           
//         }
//       });

}
function go_back(back=''){
    if(back < 0){
        history.go(back);
    }else{
        window.history.back();
    }
}
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

$(document).on('submit','#add_data',function(){

    // var data = $('.note-editable').html();
    // $('#textarea').html(JSON.stringify(data));

    return true;
});
	
function all_documents_datatable(){
    $('#document_datatable').dataTable({
        "lengthMenu": [ [10, 25, 50, 100,-1], [10, 25, 50, 100,'All'] ],
        'order':[0,'DESC'],
        // 'order':[],

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
                'url' : get_ajax('ajaxHandller'), 
                // 'url' :site_url + get_ajax('ajaxHandller'), 
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
        pageLength: 50, 
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
                // 'url' :site_url + 'ajax/ajaxHandller.php', 
                'url' :get_ajax('ajaxHandller'), 
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

function fetch_all_category(){
    $('#category_datatable').dataTable().fnDestroy();
    // alert(12);
        /*var columnSet = [{
            title: "id",
            id: "id",
            data: "id",
            type: "text"
        },
        {
            title: "category",
            id: "category",
            data: "category",
            type: "text",
            placeholderMsg: "Enter Category Name",
            unique: true,
            // "visible": false,
            // "searchable": false,
            // type: "readonly"
            required: true,
            uniqueMsg: "This category is already used"
        },
        {
            title: "type",
            id: "type",
            data: "type",
            type: "select",
            "options": [
                "form",
                "document",
            ]
        },
        ]*/
         
    $('#category_datatable').dataTable({
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                // dom: 'Bfrtip',    
            // "language" : { 
            //     // "processing" : "<i class='fa fa-spinner fa-4x fa-spin text-success'></i>",
            //  },   
            //  "language": {
            //     "url": "//cdn.datatables.net/plug-ins/1.11.0/i18n/es_es.json"
            // }, 

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
                // 'url' :site_url + 'ajax/ajaxHandller.php', 
                'url' :get_ajax('ajaxHandller'),
                'type': "post",
                'dataType': 'json',
                'data' : {
                    'ajax_action' : 'get_all_category_data' 
                }
            }, 
            // ajax: "library/server-demo.json",
            // columns: columnSet,
            select: 'single',
            altEditor: true,
            responsive: true,
            // buttons: [
            //     'copyHtml5',
            //     'excelHtml5',
            //     'csvHtml5',
            //     {
            //         text: 'Custom Button',
            //         action: function (e, dt, node, config) {
            //             // Custom function when the button is clicked
            //             alert('Custom button clicked!');
            //         }
            //     }
            // ]
            
            buttons: [
                // 'copyHtml5',
                // 'excelHtml5',
                // 'csvHtml5',
                {
                    text: '<i class="fal fa-edit mr-1"></i> Add',
                    name: 'add_category',
                    className: 'btn-primary btn-sm mr-1',
                    action: function (e, dt, node, config) {
                        mod_wise_category.set_data(this);
                    }
                },
                
                // {
                //     // extend: 'selected',
                //     text: '<i class="fal fa-edit mr-1"></i> Edit',
                //     name: 'edit',
                //     className: 'btn-primary btn-sm mr-1',
                //     action: function (e, dt, node, config) {
                       
                //         alert('Custom button clicked!');
                //     }
                //     // Id:'btn_modal'
                // },
                // {
                //     text: '<i class="fal fa-plus mr-1"></i> Add',
                //     name: 'add',
                //     className: 'btn-success btn-sm mr-1',
                //     action: function (e, dt, node, config) {
                //         // Custom function when the button is clicked
                //         alert('Custom button clicked!');
                //     }
                // },
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
function add_category(data){
    var form_data = new FormData($("form[name=altEditor-form]")[0]);
    form_data.append("ajax_action", "add_category_data");
    fetch('ajax/ajaxHandller.php',{
        method : "POST",
        // body: JSON.stringify( // convert obj. to json
        body: form_data,
        header:{
          'Content-Type':'application/json; charset=UTF-8', //if json data
        //   'Content-Type' : 'application/x-www-form-urlencoded'  //when send form data
        },
    })
    .then(response=> response.json())
    .then(function(result){
        console.log(result);
    })
    .catch(function(error){//return server error
        console.log(error);
    });
}

async function delete_category(self){
    
    // console.log(self);
    var id = $(self).data('id');
    if(!is_valid_number(id)){
        return false;
    }
    var result = await Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      })
    //   .then((result) => {
    if(result.value) {
        $.ajax({
            // url:ajax_url("ajaxHandller.php "),
            url :get_ajax('ajaxHandller'),
            type:"POST",
            data:{
                id : id,
                ajax_action: "delete_category"
            },
            dataType: 'JSON',
            success:function(data) {
                if(data.check == 'success' ){
                    $('#category_datatable').DataTable().ajax.reload();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      );
                }else{
                    Swal.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                      );
                }
            }
        });
    }
        // });
    //}
    
    // if(confirm("Are you sure want to delete")){
    //     if(!is_valid_number(id)){
    //         return false;
    //     }
    //     $.ajax({
    //             url:ajax_url("ajaxHandller.php "),
    //             type:"POST",
    //             data:{
    //                 id : id,
    //                 ajax_action: "delete_banner"
    //             },
    //             dataType: 'JSON',
    //             success:function(data) {
    //                 if(data.check == 'success' ){
    //                     $('#category_datatable').DataTable().ajax.reload();
    //                 }else{
    //                     Command: toastr["error"](data.msg);
    //                 }
    //             }
    //     });
    // }    
}
function delete_user(self){
    var id = $(self).data('id');
    if(!is_valid_number(id)){
        alert("Something Error");
        return false;
    }
    Swal.fire(
        {
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then(function(result)
        {
            if (result.value)
            {
                $.ajax({
                    // url:ajax_url("ajaxHandller.php "),
                    url :get_ajax('ajaxHandller'),
                    type:"POST",
                    data:{
                        id : id,
                        ajax_action: "delete_user"
                    },
                    dataType: 'JSON',
                    success:function(data) {
                        if(data.check == 'success' ){
                            $('#users_datatable').DataTable().ajax.reload();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                              );
                        }else{
                            Swal.fire(
                                'Cancelled',
                                'Your imaginary file is safe :)',
                                'error'
                              );
                        }
                    }
                });
            }
        });
     
    // console.log(self);
    
    /*Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      },*/
      
      
}


var mod_wise_category = {
    referral_id: 0, 
    modal_id: 0,
    id: 0,
    // title: Category;
    category_name:'',
    set_data: function(self){
        // console.log(self);
        this.close_modal();
        var data = ($(self).data('cat_data'))? $(self).data('cat_data') : '';
        // var json_data = JSON.parse(data);
        // mod_wise_category.title = json_data.title
        
        if(data){
            this.id = data.hasOwnProperty('id') ? data.id : '';
            this.category_name = data.hasOwnProperty('category_name') ?  data.category_name : '';
        }
        this.render(); 
        this.open_modal();
        // this.modal_id = 'categoryModal';
    },
    render: function(){
        var html = 
               `<div class="modal inmodal" id="categoryModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                   <div class="modal-dialog modal-md">
                       <div class="modal-content">`;
            html +=` <form action="#" id="ModalForm" name="ModalForm">
                        <div class="modal-header">
                        <h4 class="modal-title"> Category</h4>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="mod_wise_category.close_modal();"><span aria-hidden="true">&times;</span></button> 
                           </div>           
                        <div class="modal-body">
                            <div class="progress" id="modal_loader" style="display:none;"></div>
                                <div class="row">
                                    <div class="col-sm-12"><label><strong>Category Name:</strong></label> 
                                    <input required class="form-control" type="text" name="category_name" id="category_name" value="`+this.category_name+`" >
                                    <input required type="hidden" name="id" id="id" value="`+this.id+`" ></div>
                                </div>
                                <br> 
                        </div>
                    <div class="modal-footer">
                    <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary border" onclick="mod_wise_category.close_modal();">Close</button> 
                    </div>
                </form>
                    `;
            html +=`</div>
                   </div>
               </div>`;
               //Modal Footer//  onclick="mod_wise_category.submit_form(this);"
       $('body').append(html);
    //    setTimeout(function() {
    //    mod_day_wise_referral.render_referral_details_html(); }, 200);
   
   },
    open_modal: function(){ 
        // console.log(this);
           $('#categoryModal').modal('show').fadeIn(800);
        },
    close_modal: function(){
        this.id = 0;
        $('#categoryModal').modal('hide'); 
        $('#categoryModal').remove(); 
    },
    trigger_js(){

    },
    submit_form: function(self){
        // $('#ModalForm').submit(function(e){
        //     e.preventDefault();
        // });
        // $('#ModalForm').submit();
    }
}
$(document).on('submit','#ModalForm', function (e) {
    e.preventDefault();
    var form_data = new FormData($("#ModalForm")[0]); //new FormData(this);//;//
    form_data.append("ajax_action", "add_category_data");
    var btn_name = $('#submit_btn').text();
    $.ajax({ 
        // url: ajax_url('ajaxHandller.php'),
        url :get_ajax('ajaxHandller'),
        type: 'POST',
        data: form_data,
        dataType: 'JSON',
        contentType:false,
        cache:false,
        processData:false,
        beforeSend: function(){ 
            // $('#modal_loader').show();
            $('#submit_btn').html('  <i class="fa fa-spinner fa-spin"></i>');//.attr('disabled',true)
        },
        complete: function(){ $('#submit_btn').html(btn_name);//.attr('disabled',false);
        }, 
        success: function (data) {
            console.log(data); 
            
            if(data.check=='success'){
                // fetch_all_category();
                $('#category_datatable').DataTable().ajax.reload();
                iziToast.success({
                    title: 'Success',
                    message: data.msg,
                    onClosed: function () {
                        // redirect('all_orders');
                    }
                });
                mod_wise_category.close_modal();
            }else{
                iziToast.error({
                    title: 'error',
                    message: data.msg,
                });
            }
        },
    });
});
 // if (data.action == 'edit') { 
                //  $('#referralDetailsModal select#day_count').html(daycount_html).attr('disabled', true);
                //   if (data.session_arr) {
                //     //  var sessions = JSON.parse(JSON.stringify(data.session_arr));
                //   }
            // })
        // }    




var mod_day_wise_referral = {
    referral_id: 0, 
    
    set_data: function(self){
        // alert(123);
        //  console.log(this);
        
          
         //this.trigger_js();
    },
    render: function(){
         var html = 
                `<div class="modal inmodal" id="referralDetailsModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">`
                            ; //Modal Header html += `
            html +=` <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="mod_day_wise_referral.close_modal();"><span aria-hidden="true">&times;</span></button> 
                                <h4 class="modal-title"> +this.modal_title+ referral</h4>
                            </div>
                            `; //Modal Body  
            html += ` <div class="modal-body">
                                <div class="progress" id="referral_modal_progress" style="display:none;"></div>
                                <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"> </div>
                                <div class="row">
                                    <div class="col-sm-6"><label><strong>Day Count:</strong></label> <select class="form-control" name="day_count" id="day_count"></select> </div>
                                    <div class="col-sm-6" id="session_div"><label><strong>Session:</strong></label> <select class="form-control" name="session" id="session"/></select> </div>
                                </div>
                                <br> 
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for=""><b>Desktop Thumbnail</b></label> <input class="form-control referral_desktop_thumb_file_1" type="file" autocomplete="off" name="referral_desktop_thumb_file" id="referral_desktop_thumb_file" data-id="1" value="" data-workshop_day="1" accept="image/" onchange="set_preview_image_referral_desktop_thumb(this)" > 
                                        <p id="err_file_size_referral_desktop_thumb_file_1_1" class="text-danger"></p>
                                        <input class="form-control" type="hidden" autocomplete="off" name="referral_desktop_thumb" id="referral_desktop_thumb" value="" > <img src="" class="image referral_desktop_thumb_image" data-fetchimgsize="" id="referral_desktop_thumb_image_1" /> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for=""><b>Mobile Thumbnail</b></label> <input class="form-control referral_mobile_thumb_file_1" type="file" autocomplete="off" name="referral_mobile_thumb_file" id="referral_mobile_thumb_file" data-id="" value="" data-workshop_day="1" accept="image/" onchange="set_preview_image_referral_mobile_thumb(this)" > 
                                        <p id="err_file_size_referral_mobile_thumb_file" class="text-danger"></p>
                                        <input class="form-control" type="hidden" autocomplete="off" name="referral_mobile_thumb" id="referral_mobile_thumb" value=""> <img src="" class="image referral_mobile_thumb_image" data-fetchimgsize="" id="referral_mobile_thumb_image_1"/> 
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                        <label for=""><b>Referral On/Off</b></label> <input type="checkbox" class="js-switch ml-3" id="referral_on_off_1" onchange="referral_on_off(1)" /> 
                                        <p id="err_referral_on_off" class="text-danger"></p>
                                    </div>
                                </div>
                                <div class="form-row referral_video_link_div_1 d-none">
                                    <div class="form-group col-sm-6">
                                        <label for=""><b>Referral Link</b></label> <input class="form-control" name="referral_video_link" id="referral_video_link" value=""/> 
                                        <p id="err_referral_video_link_1" class="text-danger"></p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-6"> <label><b>Lock:</b></label> <input type="checkbox" class="js-switch" id="status_1" name="status" onchange="switchery_status_multi_session_change_referral(this);"/> <input name="status" type="hidden" id="hidden_status_1" value=""/> </div>
                                </div>
                            </div>
                            `; //Modal Footer
                             html +=  `  
                            <div class="modal-footer">; html += <button type="button" id="submit_btn" class="btn btn-primary" onclick="mod_day_wise_referral.submit_referral_form(this);">Submit</button>; html += <button type="button" class="btn btn-white border" onclick="mod_day_wise_referral.close_modal();">Close</button>; html += </div>
                            ; html += 
                        </div>
                    </div>
                </div>`;
        $('body').append(html);
        setTimeout(function() {
        mod_day_wise_referral.render_referral_details_html(); }, 200);
    
    },
    open_modal: function(){ 
            $('#referralDetailsModal').modal('show');
    },
        
    close_modal: function(){

             this.referral_id = 0; this.workshop_date_form_id = 0; this.workshop_form_id = 0; this.day_count = 0; this.session = ''; 
             $('#referralDetailsModal').modal('hide'); 
             $('#referralDetailsModal').remove(); 
    },
    
    render_referral_details_html: function () { //call for set data i modal
        
        var ajax_page_url = site_url + "ajax/dashboard.php"; 
            
        $.ajax({ 
            url: ajax_page_url,
             dataType: 'JSON',
              type: 'POST',
               data: { 'referral_id': this.referral_id, 'workshop_form_id': this.workshop_form_id, 'workshop_date_form_id': this.workshop_date_form_id, 'day_count': this.day_count, 'session': this.session, 'ajax_action': 'render_referral_details_html' },
             beforeSend: function(){ 
                $('#referral_modal_progress').show();
             },
             complete: function(){ mod_day_wise_referral.trigger_js(); },
              success: function (data) { console.log(data); if (data.check == 'success') {
                if (data.action == 'edit') { 
                 $('#referralDetailsModal select#day_count').html(daycount_html).attr('disabled', true);
                  if (data.session_arr) {
                     var sessions = JSON.parse(JSON.stringify(data.session_arr));
                  }
                    
                // var session_html = '<option> Select Session </option
     

        $('#referralDetailsModal select#session').html(session_html);
        } }
        else{ iziToast.error({ title: 'Error', message: data.message, position: 'topRight', }); }
        
        $('#referral_modal_progress').hide(); }, 
        
        error: function (xhr, status, error) { } });

    }, 
 
    submit_referral_form: async function(self){
     
           
        //          iziToast.success({
        //              title: 'Success', message: data.message, position: 'topRight', onClosing: function () {
                
        //         mod_day_wise_referral.close_modal(); window.open(site_url + '?action=approval_workshop_date_form'); } });
            
        //     } else{ iziToast.error({ title: 'Error', message: data.message, position: 'topRight', }); } }, 
        //     error: function (xhr, status, error) { } 
        
        // });
    },
             
    get_sessions: function(self){
        this.day_count = $(self).val(); var ajax_page_url = site_url + "ajax/dashboard.php";
             
        $.ajax({
            url: ajax_page_url,
            dataType: 'JSON',
            type: 'POST',
            data: {
                 'workshop_form_id': this.workshop_form_id, 'workshop_date_form_id': this.workshop_date_form_id,
               'day_count': this.day_count, 
                'ajax_action': 'get_sessions_by_day_count' }, 
            beforeSend: function(){
                $('#referral_modal_progress').show(); }, 
            success: function (data) {
                if (data.check == 'success') {
                //  if (data.session_arr) { 
            // var sessions = JSON.parse(JSON.stringify(data.session_arr));
        // iziToast.error({ 
        //     title: 'Error', message: data.message, position: 'topRight', 
        // }); 
    // $('#referral_modal_progress').hide();
                }
    
            },
        });
    }
}       


                // document.write(`${result.msg}`+'<br>');
                
              // } 
// if(window.fetch){
    //     //if browser support fetch function
    // }else{

    // }
// }    
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

function change_user_type(){
    // var form_data = new FormData();
    // form_data.append("ajax_action", "change_user_type");
    $('#button').attr('disabled',true);

    const form_data = {
        user_type : document.querySelector('#user_type').value,
        ajax_action: "change_user_type"
    };
    fetch(get_ajax('ajaxHandller'), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
            // 'Content-Type':'application/json; charset=UTF-8', //if json data
            // 'Content-Type' : 'application/x-www-form-urlencoded'  //when only json data
            // 'Content-Type': 'application/json'
          },
        body : new URLSearchParams(form_data).toString()
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        if(data.check == 'success'){
            $('#button').attr('disabled',false);
            // iziToast.success({
            //     title: 'Success',
            //     message: data.msg,
            //     onClosed: function () {
            //         // redirect('all_orders');
            //     }
            // });
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
}
function change_category(self){
    // var category_id = $('input[name="category_id"]:checked').val();
    var category_id = $('select[name="category_id"]').val();
    if(category_id == '12'){
        $('#is_encrypt').prop('checked',true);
    }else {
        $('#is_encrypt').prop('checked',false);
    }
}
function load_source_data(id){
    if(!id){
        return false;
    }
    var form_data = {
        'id' : id, 
        'ajax_action': "get_source_data"
    };
    fetch(get_ajax('ajaxHandller'), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
        body : new URLSearchParams(form_data).toString()
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        if(data.check == 'success'){
            $('.js-summernote').summernote('destroy');//firstly destroy before data append then init
            // console.log(data.data.source);
            $('.js-summernote').html(data.data.source);

            setup_summernote_editor();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
function load_projects_list(){
    $('#dt-basic-example').dataTable({
        responsive: true,
        ordering : false,
        pageLength: 100,
        order: [
            [2, 'desc']
        ],
        rowGroup:
        {
            dataSrc: 1 //show heading
        },
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax":{
            'url' : ajax_url('ajaxDatatable.php'), 
            'type': "post",
            'data' : {
                'ajax_action' : 'fetch_project_details' 
            }
        }
    });
} 
function load_emojis(){
    //load emojis
    $.ajax({
        url: 'https://api.github.com/emojis',
        async: false
    }).then(function(data) {
        window.emojis = Object.keys(data);
        window.emojiUrls = data;
    });
}   
function showPanel(panel_name){
    $('main').addClass('d-none');
    $('#'+panel_name).removeClass('d-none');
    window.history.replaceState({}, '', urlWithoutAction+panel_name);
    // $('#user_type').removeClass('d-none');  
    $('.single-select2').select2(); //call once for reload                                                                                                                                                                                                                                                                                                                                                                                            
}
