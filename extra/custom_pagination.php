<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Pagination Example</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }
        .custom-pagination button {
            margin: 0 5px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            cursor: pointer;
        }
        .custom-pagination button.active {
            background-color: #007bff;
            color: white;
        }
    </style>
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
            <tr>
                <td>Name</td>
                <td>Position</td>
                <td>Office</td>
                <td>Age</td>
                <td>Start date</td>
                <td>Salary</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>Position</td>
                <td>Office</td>
                <td>Age</td>
                <td>Start date</td>
                <td>Salary</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>Position</td>
                <td>Office</td>
                <td>Age</td>
                <td>Start date</td>
                <td>Salary</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>Position</td>
                <td>Office</td>
                <td>Age</td>
                <td>Start date</td>
                <td>Salary</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>Position</td>
                <td>Office</td>
                <td>Age</td>
                <td>Start date</td>
                <td>Salary</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>Position</td>
                <td>Office</td>
                <td>Age</td>
                <td>Start date</td>
                <td>Salary</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>Position</td>
                <td>Office</td>
                <td>Age</td>
                <td>Start date</td>
                <td>Salary</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>Position</td>
                <td>Office</td>
                <td>Age</td>
                <td>Start date</td>
                <td>Salary</td>
            </tr>
            <!-- Add your rows here -->
        </tbody>
    </table>

    <div class="custom-pagination" id="custom-pagination"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                paging: true,
                pageLength: 5,
                info: false,
                dom: 'rt<"custom-pagination"p>'
            });

            function updateCustomPagination() {
                var info = table.page.info();
                var paginationContainer = $('#custom-pagination');
                paginationContainer.empty();

                for (var i = 0; i < info.pages; i++) {
                    var button = $('<button>')
                        .text(i + 1)
                        .toggleClass('active', i === info.page)
                        .on('click', (function(page) {
                            return function() {
                                table.page(page).draw('page');
                            };
                        })(i));
                    paginationContainer.append(button);
                }
            }

            table.on('draw', function() {
                updateCustomPagination();
            });

            updateCustomPagination();
        });
    </script>
</body>
</html>
