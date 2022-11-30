id: 78
source: 2
name: getNewsYearOptions
properties: 'a:0:{}'

-----

$years = array();
$output;

$resources = $modx->getCollection('modResource', array(
    'template' => 5,
    'published' => true,
));

foreach ($resources as $res) {
    $years[] = date("Y", $res->publishedon);
}

// remove dublicates and sort
$years = array_unique($years);
asort($years);

// templating
foreach ($years as $year) {
    $selected = ($_GET['year'] == $year) ? 'selected' : '';
    $output .= '<option '. $selected .'>'. $year .'</option>';
}

return $output;