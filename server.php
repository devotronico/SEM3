

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
    $line = [];
    foreach ($data as $value) {
        if (preg_match('/^#{1,3}\s/', $value, $outputNotUsed)) {
            if ( preg_match('/(^##?\s\[)([\d]{1,3}\.[\d]{1,3}\.[\d]{1,3})(\].*)([\d]{4}-[\d]{2}-[\d]{2})/', $value, $output)) {
                $line['head'] = ['version'=> $output[2],'date'=> $output[4]];
            } else if (preg_match('/(^#\s)([\d]{1,3}\.[\d]{1,3}\.[\d]{1,3})(\s\()([\d]{4}-[\d]{2}-[\d]{2})/', $value, $output)) {
                $line['head'] = ['version'=> $output[2],'date'=> $output[4]];
            } else if (preg_match('/(^###\s)([a-z-A-Z\s]{3,30})/', $value, $output)) {
                $line['type'] = $output[2];
            }
        } else if (preg_match('/(^\*\s)(.*)(\s\(\[)([a-z0-9]{7})(\]\()(.*)/', $value, $output)) {
            $line['body'] =['message'=> $output[2],'commit'=> $output[4]];
        }

        if (isset($line)) {
            if (isset($line['head']) && isset($line['type']) && isset($line['body'])) {
                $lines[] = $line;
                $line = [];
                // unset($line);
            }
        }
    }
    // echo '<br>=======================================<br>';
    // echo '<pre>'; print_r($lines); echo '</pre>';
    return $lines;
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
    return parseArray($data);
    // return $result;
}