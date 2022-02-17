<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiestsenwinkel</title>
    <link rel="stylesheet" href="css/fietswinkel.css" />
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>

    <header><?= getHeader(); ?></header>



    <nav><?= getNav() ?></nav>

    <div id="main">

        <aside class="asideLeft"><?= getAside('left'); ?></aside>



        <section><?= getSection(); ?></section>



        <aside class="asideRight"><?= getAside('Right'); ?></aside>

    </div>



    <footer><?= getFooter(); ?></footer>
</body>

</html>