

<?php
function getVersion() {
    $file = dirname(__FILE__) . '/package.json';
    if (!file_exists($file)) {
    die('Il file ' . $file . ' NON esiste');
    }
    $strJsonFileContents = file_get_contents($file);
    $array = json_decode($strJsonFileContents, true);
    return $array['version'];
}


function parseArray($data) {
    $lines = [];
    foreach ($data as $value) {
        if (preg_match('/^#\s/', $value, $outputNotUsed)) {
            if ( preg_match('/(^#\s\[)(.*)(\].*)([\d]{4}-[\d]{2}-[\d]{2})/', $value, $output)) {
                // print_r($output);die;
                $line['head'] = ['version'=> $output[2],'date'=> $output[4]];
            } else if ( preg_match('/(^#\s)(.*)(\s\()([\d]{4}-[\d]{2}-[\d]{2})/', $value, $output)) {
                $line['head'] = ['version'=> $output[2],'date'=> $output[4]];
            }
        }
        $lines[] = $line;
    }
    echo '<br>=======================================<br>';
    echo '<pre>'; print_r($lines); echo '</pre>';
}

function readChangelog() {
    $file = dirname(__FILE__) . '/CHANGELOG.md';
    $fn = fopen($file, "r");
    $data = [];
    while(! feof($fn))  {
        $result = fgets($fn);
        echo $result . '<br>';
        $data[] = $result;
    }
    fclose($fn);
    parseArray($data);
    // return $result;
}