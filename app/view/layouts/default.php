<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bootstrap/fontawesome-free/css/fontawesome.min.css" rel="stylesheet">
    <link href="/bootstrap/fontawesome-free/css/all.min.css" rel="stylesheet">

    <title><?= $data['title'] ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
    <div class="container-fluid">
        <div class="collapse navbar-collapse ml-5" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/add-film">Add</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="import-list">Import</a>
                </li>
            </ul>
        </div>

        <div class="container-fluid ">
            <form class="d-flex" action="search">
                <div class="container col-3">
                            <span style="display: block">
                                <input type="radio" id="title" name="radio" value="title" checked>
                                <label for="title">Film name</label>
                            </span>
                    <span style="display: block">
                                <input type="radio" id="stars" name="radio" value="stars">
                                <label for="stars">Star</label>
                            </span>
                    </ul>
                </div>
                <div class="container">
                    <div class="m-0 p-0">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                               name="q" required maxlength="30" style="max-width: 230px; display: inline-block; ">
                        <button class="btn btn-outline-success col-3" style="max-width: 70px;" type="submit">Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>
<hr>
<div class="content mr-auto">
    <?= $content ?>
</div>
</div>

<!-- Optional JavaScript; choose one of the two! -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--<script src="/bootstrap/jquery/jquery.min.js"></script>-->
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
-->
</body>
</html>

</html>