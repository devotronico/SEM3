

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
    $type = '';
    foreach ($data as $key => $value) {
        // var_dump(count($data));
        // die();
        echo  $value . '---<br>';
        $resetArrayLine = false;
        if (preg_match('/^#{1,3}\s/', $value, $outputNotUsed)) {
            if (preg_match('/(^##?\s)\[?([\d]{1,3}\.[\d]{1,3}\.[\d]{1,3})\]?(.*)([\d]{4}-[\d]{2}-[\d]{2})/', $value, $output)) {
                if (count($line) > 0) {
                    $lines[] = $line;
                }
                $line = [];
                $line['head'] = ['version'=> $output[2],'date'=> $output[4]];
                // if ($key !== 0) { $resetArrayLine = true; } else { $resetArrayLine = false;}
            } else if (preg_match('/(^###\s)([a-z-A-Z\s]{3,30})/', $value, $output)) {
                $type = $output[2];
                // $line['type'][] = $output[2];
            }
        } else if (preg_match('/(^\*\s)(.*)(\s\(\[)([a-z0-9]{7})(\]\()(.*)/', $value, $output)) {
            $line['body'][] =['type'=> $type, 'message'=> $output[2], 'commit'=> $output[4]];
        } else if (preg_match('/@/', $value, $output)) {
            $lines[] = $line;
        }

        // if (isset($line)) {
        //     if (isset($line['head']) && isset($line['type']) && isset($line['body'])) {
        //         $lines[] = $line;
        //         if ($resetArrayLine === true) {
        //             $line = [];
        //         }
        //     }
        // }
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
        // echo $result . '<br>';
        $data[] = $result;
    }
    $data[] = '@';
    fclose($fn);
    return parseArray($data);
    // return $result;
}