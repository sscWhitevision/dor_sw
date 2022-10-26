<?php
require_once __DIR__ . '/base.class.php';

/**
 * Generates a list of all folders up to a certain depth within the specified media source
 *
 * Class RedactorMediaDirectoriesProcessor
 */
class RedactorMediaDirectoriesProcessor extends RedactorMediaProcessor {

    /**
     * Process the request by loading all directories within the configured limit in the media source
     *
     * @return string
     */
    public function process()
    {
        $maxDepth = $this->configurationSet->getConfiguredOption('simpleBrowserDirectoryDepth', 5);

        $path = $this->basePath .= '/';
        $path = $this->redactor->parsePathVariables($path);
        $path = trim($path, '/');
        $results = $this->getFolders($path, $maxDepth);

        return json_encode($results);
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
        return json_encode([
            'error' => true,
            'message' => $msg,
        ]);
    }

    /**
     * Grab the folders within the specified $path, recursively up to $depth levels deep.
     *
     * @param string $path
     * @param int $depth
     * @return array
     */
    public function getFolders($path, $depth)
    {
        $cacheManager = $this->modx->getCacheManager();
        $cacheKey = 'media_' . $this->source->get('id') . '/' . $path;
        $cacheOptions = [
            xPDO::OPT_CACHE_KEY => 'redactor',
        ];
        $cached = $cacheManager->get($cacheKey, $cacheOptions);
        if (is_array($cached)) {
            return $cached;

        }

        try {
            $list = $this->source->getContainerList($path);
        }
        catch (Exception $e) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, get_class($e)  . ' while loading directories in ' . $path . ': ' . $e->getMessage());
            return [];
        }

        $results = [];
        foreach ($list as $folder) {
            // Skip files
            if ($folder['type'] !== 'dir') {
                continue;
            }

            // MODX 3 started rawurlencode'ing path names; reverse that process.
            if (strpos($folder['id'], '%2F') !== false) {
                $folder['id'] = rawurldecode($folder['id']);
            }
            
            // Prepare the folder item
            $path = trim($folder['id'], '/');
            $path = str_replace(trim($this->basePath, '/'), '', $path);
            $path = trim($path, '/');
            $results[] = [
                'path' => $path
            ];

            // Only if we're within the approved depth, we will add subfolders if there are any
            $childDepth = $depth - 1;
            if ($folder['leaf'] === false && $childDepth > 0) {
                // Recursively get the folders of the children
                $children = $this->getFolders($folder['pathRelative'], $childDepth);
                // If we have children, add them to the item
                if (!empty($children)) {
                    foreach ($children as $child) {
                        $results[] = $child;
                    }
                }
            }
        }

        $cacheManager->set($cacheKey, $results, 300, $cacheOptions);

        // return the list of folders within $path
        return $results;
    }
}

return 'RedactorMediaDirectoriesProcessor';