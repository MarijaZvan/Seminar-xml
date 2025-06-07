<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Provjera XML</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #111;
      color: #fff;
    }
    .container {
      margin-top: 50px;
    }
    .result {
      margin-top: 20px;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">The Clash</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="provjera.php">Provjera XML</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <h2 class="mb-4">Provjera XML-a prema XSD schemi</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="xmlFile" class="form-label">Odaberite XML datoteku</label>
      <input class="form-control" type="file" name="xmlFile" id="xmlFile" required>
    </div>
    <div class="mb-3">
      <label for="xsdFile" class="form-label">Odaberite XSD schemu</label>
      <input class="form-control" type="file" name="xsdFile" id="xsdFile" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Provjera</button>
  </form>
  <div class="result">
    <?php
    if (isset($_POST['submit'])) {
      $xmlPath = $_FILES['xmlFile']['tmp_name'];
      $xsdPath = $_FILES['xsdFile']['tmp_name'];

      libxml_use_internal_errors(true);
      $xml = new DOMDocument();
      $xml->load($xmlPath);

      if ($xml->schemaValidate($xsdPath)) {
        echo '<div class="alert alert-success mt-3">XML je valjan prema zadanoj XML schemi.</div>';
      } else {
        echo '<div class="alert alert-danger mt-3"><strong>❌ XML nije valjan.</strong><br>';
        foreach (libxml_get_errors() as $error) {
          echo htmlspecialchars($error->message) . "<br>";
        }
        echo '</div>';
      }
      libxml_clear_errors();
    }
    ?>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
