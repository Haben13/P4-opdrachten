<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getTitle()?></title>
    <link rel ="stylesheet" href= "css/fietswinkel.css" />
</head>
<body>
    
    <div id = "page">
        <div id = "header"><?=getHeader()?></div>
        <div id = "menu"><?=getNav()?></div>
        <div id = "main">
        <div id = "aside1"><?=getAside()?></div>
        <div id = "content"><?= $content ?></div>
        <div id = "aside2"><?=getAside()?></div>
    </div>

    <div id = "Footer"><?=getFooter()?></div>  

    </div>
</body>
</html>