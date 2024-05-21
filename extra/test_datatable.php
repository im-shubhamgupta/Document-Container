<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Append Server-Side Prepared Data to DataTable</title>
  <!-- Include DataTables CSS and JavaScript -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
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

<script>
$(document).ready(function() {
    // Initialize DataTable with AJAX
    $('#example').DataTable({
        "ajax": {
            "url": "your_data_endpoint_url",
            "dataSrc": function(data) {
                // Append server-side prepared HTML to table tbody
                $('#example tbody').append("<tr><td>hello</td></tr>");
                return data.data; // Return the regular data array
            }
        },
        "columns": [
            { "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "age" },
            { "data": "start_date" },
            { "data": "salary" }
        ]
    });
});
</script>

</body>
</html>
