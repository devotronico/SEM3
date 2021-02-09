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
// echo '<br>=======================================<br>';
// echo '<pre>'; print_r($lines); echo '</pre>';
// echo '<br>=======================================<br>';

foreach ($lines as $key => $value) {
    ?>
    <li>
        <p>
            <span class="version"><?=$lines[$key]['head']['version']?></span>
            <span class="date"><?=$lines[$key]['head']['date']?></span>

        </p>
        <?php
        foreach ($lines[$key]['body'] as $key => $value) {
        ?>
        <p>
            <span class="type"><?=strtoupper($value['type'])?></span>
            <span class="message"><?=$value['message']?></span>
            <span class="commit"><?=$value['commit']?></span>
        </p>
        <?php
        }
        ?>
    </li>
    <?php
}
?>
</ul>
</body>
</html>