<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>SEM 3</title>
</head>
<body>
    <h1>SEM 3</h1>
    <?php require_once 'server.php'; ?>
    <h2><?=getVersion()?></h2>

<ul>
<?php
$lines = readChangelog();
echo '<br>=======================================<br>';
// echo '<pre>'; print_r($lines); echo '</pre>';

foreach ($lines as $key => $value) {
    ?>
    <li>
        <p>
            <span class="version"><?=$lines[$key]['head']['version']?></span>
            <span class="date"><?=$lines[$key]['head']['date']?></span>
            <span class="commit"><?=$lines[$key]['body']['commit']?></span>
        </p>
        <p>
            <span class="type"><?=$lines[$key]['type']?></span>
            <span class="message"><?=$lines[$key]['body']['message']?></span>
        </p>
    </li>
    <?php
}
?>
</ul>
</body>
</html>