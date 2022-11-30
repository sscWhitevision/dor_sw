id: 79
source: 2
name: filterNewsByYear
properties: 'a:0:{}'

-----

if (empty($_GET['year'])) return;

$yearStart = strtotime($_GET['year'] . "-01-01");
$yearEnd = strtotime($_GET['year'] . "-12-31");


return '{"publishedon:>=":"'.$yearStart.'","publishedon:<=":"'.$yearEnd.'"}';