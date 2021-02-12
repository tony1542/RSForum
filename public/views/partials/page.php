<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Runescape</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- jQuery, popper & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <!-- Font awesome icons -->
    <script src="https://kit.fontawesome.com/75a462d440.js" crossorigin="anonymous"></script>
    
    <?php require 'style_preference.php' // User-preferred style ?>

    <!-- Bundled assets -->
    <script src="/dist/app.bundle.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Runescape</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
            <ul class='navbar-nav'>
                <li class="nav-item">
                    <a class="nav-link" href=/StylePreference/Toggle?parameters[redirectUrl]=<?= \App\Utils\Http\Request::getUri() ?>">
                        Toggle light/dark theme
                    </a>
                </li>
                <?php if (getSignedInUser()->getID() > 0) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/User/Details/<?= getSignedInUser()->getID() ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Task/All/<?= getSignedInUser()->getID() ?>">Task List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/User/Members/">Members</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/User/Logout">Log-Out</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/User/SignIn">Sign-In</a>
                    </li>
                    <li class='nav-item'>
                        <a class="nav-link" href="/User/Register">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- In this div is where all of our dynamic content will be nested -->
    <div class='main-container container mt-4'>
        <!-- Show any rendered errors above whatever view is pulled through -->
        <div id="rendered_errors">
            <?= $data['rendered_errors'] ?>
        </div>

        <!-- Show the rendered view within this div -->
        <div id="rendered_view">
            <?= $data['rendered_view'] ?>
        </div>
    </div>
</body>
</html>
