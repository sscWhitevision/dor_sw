id: 9
source: 2
name: nl2li
category: 'Snippets and Output-Filters'
properties: 'a:0:{}'

-----

/*
 * nl2li
 *
 * wrapps every new line in a list-item
 *
 * Usage examples:
 * [[*tvName:nl2li]]
 *
 * @author Jan Dähne <jan.daehne@quadro-system.de>
 */

if ($input == "") return;

$items = explode("\n", $input);

$output = '';
foreach ($items as $item) {
    $output .= '<li>' . $item . '</li>';
}

return $output;