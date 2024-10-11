<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Append Server-Side Prepared Data to DataTable</title>
  <!-- Include DataTables CSS and JavaScript -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <link rel="stylesheet"  href="../resources/css/datagrid/datatables/datatables.bundle.css">
  
</head>
<body>

<table id="example" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Name</th>
      <th>Position</th>
      <th>Office</th>
      <th>Age</th>
      <th>Start date</th>
      <th>Salary</th>
    </tr>
  </thead>
  <tbody>
    <!-- Existing table body rows -->
  </tbody>
</table>


  <!-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"  crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  <!-- <script type="text/javascript" src="../resources/js/datagrid/datatables/datatables.bundle.js"></script> -->
<!-- <script type="text/javascript" src="../resources/js/datagrid/datatables/datatables.export.js"></script> -->
  <script>
$(document).ready(function() {
    // Initialize DataTable with AJAX
    var table = $('#example').DataTable();

// Fetch data via AJAX,

$.ajax({
    url: 'server_datatable.php', // Replace with your endpoint URL
    // method: 'GET',
    //     dataType: 'json', // Assuming the server returns HTML directly
    // success: function(htmlData) {
    //   console.log(htmlData.data);
    
            
    //         // Refresh the DataTable to recognize the newly added rows
    //         // table.rows.add($('#example tbody tr')).draw();
    //     $('#example tbody').append(htmlData.data);
            
    //         // Destroy the old DataTable instance
    //         table.destroy();
            
    //         // Reinitialize DataTable to include the newly appended rows
    //         table = $('#example').DataTable({
    //             "order": [], // Maintain the default order
    //             "paging": true, // Enable pagination
    //             "searching": true, // Enable search
    //             "info": true // Enable info display
    //         });
    // },
    // error: function(xhr, status, error) {
    //     console.error('Error fetching data:', error);
    // }
});
    /*
    var table = $('#example').DataTable({

            "lengthMenu": [ [10, 25, 50, 100,-1], [10, 25, 50, 100,'All'] ],
            // 'order':[0,'DESC'],
            'order':[],
            responsive: true,
            "columnDefs" : [ {"targets": '_all', "className": "text-center", },
                ],
           
            "processing": true,
            "serverSide": true,
            "ordering": true,
            // "scrollX": true,
          
            "ajax": {
                "url": "server_datatable.php",
                "type" : 'POST',
                'dataType': 'json',
                success: function(htmlData) {
            // Append server-side prepared HTML to table tbody
                  $('#example tbody').append(htmlData);
                  
                  // Refresh the DataTable to recognize the newly added rows
                  table.rows.add($('#example tbody tr')).draw();
              },
              error: function(xhr, status, error) {
                  console.error('Error fetching data:', error);
              }
                // "dataSrc": function(data) {
                //   // console.log(data.preparedHTML);
                // //     // Append server-side prepared HTML to table tbody
                //     // $('#example tbody').append(data.preparedHTML);
                //     // return data.data; // Return the regular data array
                // },
                // "success" : function(data){

                //   $('#example tbody').append(data.preparedHTML);
                //   console.log(data);
                // }
            },
            "columns": [
                { "data": "name" },
                { "data": "position" },
                { "data": "office" },
                { "data": "age" },
                { "data": "start_date" },
                { "data": "salary" }
            ]
    });*/
});
</script>

</body>
</html>
