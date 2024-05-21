<?php
echo "<pre>";
print_r($_POST);
echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Summernote Example</title>
  <!-- Include Bootstrap CSS (optional) -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Include Summernote CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
</head>
<body>
  <!-- Your content goes here -->

  <form method="post" action="">
  <div class="d-none" id="summernote" name="content"></div>
  <button type="submit">Submit</button>
</form>

  <!-- Include jQuery (required) -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Include Summernote JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

  <script>
    $(document).ready(function() {
    $('#summernote').summernote();
    });


</script>
</body>

</html>

