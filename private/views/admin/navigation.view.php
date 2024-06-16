<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ASSETS ?>/css/style.css?verision=1">
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="check_button"><i class="fas fa-bars"></i></label>
        <a href="#"><label class="logo">QuickCuisne</label></a>
        <ul>
            <li><a href="#">Dashboard</a></li>

            <li><a href="#">Summary</a></li>

            <li><a href="#">Analytics</a></li>

            <li><a href="<?=ROOT?>/logout">Logout <i class="fas fa-sign-in-alt"></i></a></li>

            <div class="search">
                <form>
                    <input type="text" placeholder="Search..">
                    <button type="submit">Go</button>
                </form>

            </div>

        </ul>


    </nav>