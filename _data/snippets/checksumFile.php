id: 26
source: 2
name: checksumFile
category: 'Snippets and Output-Filters'
properties: 'a:0:{}'

-----

$assetsPath = $modx->getOption('checksumfile.assets_path');

$file = $assetsPath . $modx->getOption('file', $scriptProperties, '');
if (empty($file)) return '';

// calculate checksum
$checksum = hash_file('crc32b', str_replace('//', '/', MODX_BASE_PATH.preg_replace('/#[a-z0-9-]+\s*/', '', $file)));
if (empty($checksum)) return $file;

// add checksum to file url
return substr_replace($file, '.'.$checksum.'.', strrpos($file, '.'), 1);