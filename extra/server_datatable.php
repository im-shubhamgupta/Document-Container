<?php 
// $tr[] = '<table id="document_datatable" class="table table-bordered table-hover table-striped w-100">
    
$tr =   '
        <tr>
            <td>#ID</td>
            <td>Category</td>
            <td>Category</td>
            <td>Text</td>
            <td width="80%">Images</td>
            <td>Action</td>
        </tr>
        <tr>
            <td>#ID</td>
            <td>Category</td>
            <td>Category</td>
            <td>Text</td>
            <td width="80%">Images</td>
            <td>Action</td>
        </tr>
    ';
    // echo $tr;
// </table>';
$data[] = $tr;
$json_data = array(
    "draw"            => intval(12),
    "recordsTotal"    => intval(78 ), 
    "recordsFiltered" => intval(45 ),
    "data"            => $data,
    // "preparedHTML" =>$data,
);
echo json_encode($json_data);