<?php
require_once __DIR__ . '/base.class.php';

/**
 * Generates a list of all files within the specified directory in the chosen media source
 *
 * Class RedactorMediaFilesProcessor
 */
class RedactorMediaFilesProcessor extends RedactorMediaProcessor {

    /**
     * Process the request by loading all directories within the configured limit in the media source
     *
     * @return string
     */
    public function process()
    {
        $path = (string)$this->getProperty('dir', '/');
        $path = '/' . trim($path, '/') . '/';
        $path = $this->basePath .= $path;
        $path = $this->redactor->parsePathVariables($path);
        $path = trim($path, '/') . '/';
        return json_encode($this->getFiles($path));
    }

    /**
     * Failure JSON generation
     *
     * @param string $msg
     * @param null $object
     * @return string
     */
    public function failure($msg = '', $object = null)
    {
        return json_encode(array(
            'error' => true,
            'message' => $msg,
        ));
    }

    /**
     * Grab the files within the specified $path.
     *
     * @param string $path
     * @return array
     */
    public function getFiles($path)
    {
        $results = array();

        $list = [];
        try {
            $list = $this->source->getObjectsInContainer($path);
        }
        catch (Exception $e) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, get_class($e) . ' while listing files in ' . $path . ': ' . $e->getMessage());
        }

        foreach ($list as $file) {
            $thumb = $src = $file['fullRelativeUrl'];

            // If requested with no type param, or if type=image, only show images
            $imageOnly = ($this->getProperty('type', 'image') === 'image');
            $imageExtensions = $this->redactor->getOption('upload_images');
            $imageExtensions = array_filter(
                array_map('trim',
                    explode(',', $imageExtensions)
                )
            );

            $extension = strtolower(pathinfo($src, PATHINFO_EXTENSION));
            if ($imageOnly && !in_array($extension, $imageExtensions, true)) {
                continue;
            }

            // Handle dynamic thumbs
            $dynamicThumbs = $this->redactor->getBooleanOption('redactor.dynamicThumbs');
            if ($dynamicThumbs && in_array($extension, $imageExtensions)) {
                $token = $this->modx->user->getUserToken('mgr');
                if (substr($thumb, 0, 1) !== '/' && substr($thumb, 0, 4) !== 'http') {
                    $thumb = '/' . $thumb;
                }
                $thumbQuery = http_build_query(array(
                    'src' => $thumb,
                    'w' => 180,
                    'h' => 135,
                    'HTTP_MODAUTH' => $token,
                    'q' => 70,
                    'wctx' => 'mgr',
                    'zc' => 1
                    //'source' => $this->get('id'),
                ));
                $thumb = $this->modx->getOption('connectors_url') . 'system/phpthumb.php?'.urldecode($thumbQuery);
            }
            // Make sure we can show the image in the editor by prepending the base url if it's not added
            if (substr($src, 0, 1) !== '/' && substr($src, 0, 4) !== 'http') {
                $src = MODX_BASE_URL . $src;
                if (!$dynamicThumbs) {
                    $thumb = MODX_BASE_URL . $thumb;
                }
            }

            $item = array(
                'thumb' => $thumb,
                'url' => $src,
                'name' => $file['name'],
                'dimensions' => array_key_exists('image_width', $file) ? $file['image_width'] . 'x' . $file['image_height'] . 'px' : '',
                'filesize' => $this->formatBytes($file['size']),
                'modified' => $file['lastmod'] > 0 ? date($this->redactor->getOption('manager_date_format'), $file['lastmod']) : '',
            );

            $results[] = $item;
        }

        // return the list of files within $path
        return $results;
    }
}

return 'RedactorMediaFilesProcessor';