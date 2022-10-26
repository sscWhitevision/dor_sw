<?php
require_once dirname(__FILE__) . '/base.class.php';

/**
 * Handles uploading of an image
 *
 * Class RedactorMediaUploadProcessor
 */
class RedactorMediaUploadProcessor extends RedactorMediaProcessor
{
    protected function initializeFromConfiguration()
    {
        $options = $this->configurationSet->getProcessedOptions();
        $type = $this->getMediaType();
        switch ($type) {
            case 'file':
                return $this->getSource((int)$options['fileUploadSource']);

            case 'image':
            default:
                return $this->getSource((int)$options['imageUploadSource']);
        }
    }

    /**
     * Process the request by loading all directories within the configured limit in the media source
     *
     * @return string
     */
    public function process()
    {
        if (!$this->source->checkPolicy('create')) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }

        $path = $this->getPath();

        // Create the path if it doesn't exist yet
        // Prevent errors from being logged later; most errors here are "folder already exists" errors.
        $this->source->createContainer($path, '/');
        $this->source->errors = [];

        $results = [];
        $i = 0;
        $_FILES = $this->normalizeFiles($_FILES);

        // Empty $_FILES mean nothing was accepted by the server
        if (count($_FILES) === 0) {
            return $this->failure($this->modx->lexicon('redactor.file_err_ns'));
        }

        foreach ($_FILES as $upload) {
            $i++;

            // Make sure the upload was successful
            if ($upload['error'] !== 0) {
                return $this->failure($this->modx->lexicon('file_err_upload'));
            }

            $filename = $this->getFilename($upload['name']);
            $originalFilename = $upload['name'];
            $upload['name'] = $filename;

            // This is how we'll return this file
            $file = [
                'url' => $this->source->getObjectUrl($path . $filename),
                'name' => $originalFilename,
                'id' => $originalFilename,
            ];

            $this->redactor->renames = [];
            $this->source->errors = [];
            $success = $this->source->uploadObjectsToContainer($path, ['upload' => $upload]);
            if (!$success || $this->source->hasErrors()) {
                $errors = $this->source->getErrors();
                $errors = implode('<br />', $errors);

                return $this->failure($errors);
            }

            $newFileName = reset($this->redactor->renames);
            if (!empty($newFileName)) {
                $baseMediaPath = $this->source->getBasePath() . $path;
                $newFileName = substr($newFileName, strlen($baseMediaPath));
                $newLink = $this->source->getObjectUrl($path . $newFileName);
                $file['url'] = $newLink;
            }
            $results['file-' . $i] = $file;
        }
        return json_encode($results, JSON_PRETTY_PRINT);
    }

    /**
     * Grabs and prepares the upload path.
     *
     * @return mixed
     */
    protected function getPath()
    {
        $type = $this->getMediaType();
        $path = (string)$this->configurationSet->getConfiguredOption($type . 'UploadPath', 'assets/uploads/');
        $path = $this->redactor->parsePathVariables($path);
        $path = str_replace(array('..', '.', '//', '\\'), DIRECTORY_SEPARATOR, $path);
        $path = trim($path, '/') . '/';
        return $path;
    }

    /**
     * Sanitises and prepares the file name
     *
     * @param $name
     * @return string
     */
    protected function getFilename($name)
    {
        $filename = pathinfo($name, PATHINFO_FILENAME);

        // Cleaning up the file name from weird characters and stuff
        if ($this->configurationSet->getConfiguredOption('uploadCleanFilenames', true)) {
            $filename = $this->redactor->sanitize($filename);
        }

        // Preventing overwriting existing images by adding an incremental number to the filename until it is unique
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $increment = $this->configurationSet->getConfiguredOption('uploadIncrementFilenames', true);
        if ($increment && ($this->source instanceof modFileMediaSource || $this->source instanceof \MODX\Revolution\Sources\modFileMediaSource)) {
            $bases = $this->source->getBases($this->getPath());

            $i = 0;
            $incrementedFilename = $filename;
            while (file_exists($bases['pathAbsoluteWithPath'] . $incrementedFilename . '.' . $ext)) {
                $i++;
                $incrementedFilename = $filename . '_' . $i;
            }
            $filename = $incrementedFilename;
        }

        // Return the file name
        return $filename . '.' . $ext;
    }

    /**
     * Sanitizes the provided file name.
     *
     * @param $name
     *
     * @return string
     */
    protected function sanitizeFileName($name)
    {
        $replace = $this->redactor->getOption('redactor.sanitizeReplace', null, '_');
        $pattern = $this->redactor->getOption('redactor.sanitizePattern', null, "/([[:alnum:]_\.-]*)/");
        $name = str_replace(str_split(preg_replace($pattern, $replace, $name)), $replace, $name);

        return $name;
    }

    public function failure($msg = '', $object = null)
    {
        return json_encode([
            'error' => true,
            'message' => $msg,
        ]);
    }

    private function normalizeFiles($before)
    {
        $after = [];
        foreach ($before as $key => $parts) {
            foreach ($parts as $partKey => $part) {
                if (is_array($part)) {
                    foreach ($part as $idx => $value) {
                        $after[$key . '-' . $idx][$partKey] = $value;
                    }
                }
                else {
                    $after[$key] = $part;
                }
            }
        }

        return $after;
    }
}

return 'RedactorMediaUploadProcessor';
