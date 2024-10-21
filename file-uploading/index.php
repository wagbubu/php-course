<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Uploading</title>
</head>
<body>
  <h2>
    Upload a file
  </h2>
  <form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="files">Select File</label>
    <input type="file" name="files[]" id="files" multiple>
    <button type="submit">upload</button>
  </form>
</body>
</html>