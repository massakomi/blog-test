<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Мой блог</title>

    <style type="text/css">
    h1 {margin-top:20px;}
    .btn-add {margin-bottom:20px;}
    .post-date {
        display: block;
        margin-top: -.5rem;
        margin-bottom: 1rem;
        color: #767676;
    }
    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    .post-title {
        margin-top: 0;
        font-size: 2rem;
        margin-bottom: .5rem;
        color: #303030;
    }

    /* лоадер на css */
    #loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        width: 52px;
        height: 52px;
        animation: spin 2s linear infinite;
        position:absolute;
        top:7px; left:10px;
        display:none;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
  </head>
  <body>
  <div id="loader"></div>

<div class="container">
    <h1><a href="<?=BASE_URL?>">Мой блог</a></h1>
    <?php include_once $viewFile; ?>

</div>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    </div>
  </div>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript" src="main.js"></script>
  </body>
</html>