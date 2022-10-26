id: 19
source: 2
name: formatPrice
category: 'Snippets and Output-Filters'
properties: 'a:0:{}'

-----

/*
 * formatPrice
 *
 * formats a float/int to a price: seperatet by comma - dot for thousand seperator
 *
 * Usage examples:
 * [[+tv:formatPrice]]
 *
 * @author Jan Dähne <jan.daehne@quadro-system.de>
 */
 
$input = str_replace(',', '.', $input);
 
return number_format($input, 2, ',', '.');