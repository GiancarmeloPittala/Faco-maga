<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="src/css/main.css">
  <title>Gestione Magazzino Semplificata</title>
</head>
  <body>
    
    <main class="container-xxl d-flex justify-content-center align-items-center min-vh-100 py-3">
      <div class=" d-flex flex-column gap-4">
        <div class="text-center">
          <h1>Gestione Magazzino Semplificata</h1>
        </div>
        <?php include_once './components/article/SingleArticleSearch.php' ?>
        <?php include_once './components/article/SingleArticleForm.php' ?>
        <?php include_once './components/article/InitialModalSelezioneMagazzino.php' ?>
      </div>
    </main>

    <script>
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
  </body>
</html>