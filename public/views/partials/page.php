<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Runescape</title>
    
    <!-- Bundled assets -->
    <script src="/dist/app.bundle.js"></script>

    <!-- User-preferred style -->
    <?php
        use App\Utils\StylePreference;
    
        $preference = StylePreference::get();
    
        if ($preference === StylePreference::STYLE_LIGHT) {
            echo '<script src="/dist/appLight.bundle.js"></script>';
        } elseif ($preference === StylePreference::STYLE_DARK) {
            echo '<script src="/dist/appDark.bundle.js"></script>';
        }
    ?>
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
                    <a class="nav-link" href="/StylePreference/Toggle?parameters[redirectUrl]=<?= \App\Utils\Http\Request::getUri() ?>">
                        <?php if (\App\Utils\Http\Session::get(\App\Utils\StylePreference::SESSION_KEY) === \App\Utils\StylePreference::STYLE_LIGHT) : ?>
                            <span class="fas fa-moon"></span>
                        <?php else : ?>
                            <span class="fas fa-sun"></span>
                        <?php endif; ?>
                    </a>
                </li>
                <?php if (getSignedInUser()->getID() > 0) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/User/Details/<?= getSignedInUser()->getID() ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Post/All">Posts</a>
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
    <div class='main-container container mt-4 mb-4 rounded'>
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
