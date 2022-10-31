<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="public/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="public/css/main.css">

  <link rel="apple-touch-icon" sizes="180x180" href="public/img/icon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="public/img/icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="public/img/icon/favicon-16x16.png">
  <link rel="manifest" href="public/img/icon/site.webmanifest">

  <title>Gestione Magazzino Semplificata</title>
</head>
  <body>
    
    <main class="container-xxl d-flex justify-content-center align-items-center min-vh-100 py-3">
      <div class=" d-flex flex-column gap-4">
        <div class="text-center">
          <h1>Gestione Magazzino Semplificata</h1>
        </div>
        <?php include_once './src/components/article/SingleArticleSearch.php' ?>
        <?php include_once './src/components/article/SingleArticleForm.php' ?>
        <?php // include_once './src/components/article/InitialModalSelezioneMagazzino.php' ?>
      </div>
    </main>

    <script>
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
  </body>
</html>