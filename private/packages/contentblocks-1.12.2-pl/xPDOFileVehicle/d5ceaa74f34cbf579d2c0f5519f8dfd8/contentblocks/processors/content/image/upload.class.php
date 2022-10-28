<?php

use Imagine\Filter\Basic\Autorotate;
use Imagine\Image\Box;
use Imagine\Image\ManipulatorInterface;

require_once('processimage.class.php');
/**
 * @package moreGallery
 */
class ContentBlocksImageUploadProcessor extends ContentBlocksImageProcessor {

    /**
     * @return bool|string
     */
    public function initialize() {
        if(parent::initialize()) {
            /**
             * Make sure the upload path exists. We unset errors to prevent issues if it already exists.
             */
            $this->source->createContainer($this->path, '/');
            $this->source->errors = array();

            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function process() {
        if (!$this->source->checkPolicy('create')) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }

        $file = $_FILES['file'];
        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileExtension = strtolower($fileExtension);

        $fileTypes = $this->getAllowedFileTypes();
        if (!in_array($fileExtension, $fileTypes, true)) {
            return $this->failure($this->modx->lexicon('contentblocks.file_types.disallowed'));
        }

        $_FILES['file']['name'] = $this->cleanFilename($fileName, $fileExtension);

        /**
         * Do the upload
         */
        $this->contentBlocks->renames = array();
        $uploaded = $this->source->uploadObjectsToContainer($this->path, $_FILES);
        if (!$uploaded) {
            $errors = $this->source->getErrors();
            $errors = implode('<br />', $errors);
            return $this->failure($errors);
        }

        /**
         * Check if the file has been renamed by a plugin like FileSluggy
         */
        $newFileName = reset($this->contentBlocks->renames);
        if (!empty($newFileName)) {
            $baseMediaPath = $this->source->getBasePath() . $this->path;
            $baseMediaPath = str_replace('://', '__:_/_/', $baseMediaPath);
            $baseMediaPath = str_replace('//', '/', $baseMediaPath);
            $baseMediaPath = str_replace('__:_/_/', '://', $baseMediaPath);

            // If the $newFileName starts with the base media path + upload path, grab just the file name from it
            if (strpos($newFileName, $baseMediaPath) === 0) {
                $newFileName = substr($newFileName, strlen($baseMediaPath));
            }
            // If it doesn't (which appears to be the case on MODX 3 due to getBasePath or OnFileManagerFileRename change)
            // then grab the filename by taking the last path from it.
            else {
                $newFileName = substr($newFileName, strrpos($newFileName, '/') + 1);
            }
            $_FILES['file']['name'] = $newFileName;
        }

        // Make sure the connection closes for sites with keep-alive enabled
        header("Connection: close");

        // clean up any double-slashes
        $url = $this->source->getObjectUrl($this->path . $_FILES['file']['name']);
        $url = str_replace('://', '__:_/_/', $url);
        $url = str_replace('//', '/', $url);
        $url = str_replace('__:_/_/', '://', $url);
        $this->url = $url;

        $size = false;

        $imageExtensions = $this->contentBlocks->getOption('contentblocks.image.supported_extensions', null, 'png, gif, jpg, jpeg, bmp, tiff', true);
        $imageExtensions = array_map('trim', explode(',', $imageExtensions));
        if (in_array($fileExtension, $imageExtensions, true)) {
            $image = $this->source->getObjectContents($this->path . $_FILES['file']['name']);
            $size = @getimagesizefromstring($image['content']);

            $imagine = $this->contentBlocks->getImagine();
            if ($imagine) {
                try {
                    // Load the image with imagine and create a resized version
                    $img = $imagine->load($image['content']);
                    $this->isAnimated = $this->isAnimated($img, $fileExtension);

                    // Use the autorotate filter to rotate the image if needed
                    $filter = new Autorotate();
                    $filter->apply($img);

                    $maxWidth = (int)$this->contentBlocks->getOption('contentblocks.image.max_upload_width');
                    $maxHeight = (int)$this->contentBlocks->getOption('contentblocks.image.max_upload_height');

                    if ($maxWidth > 0 && $maxHeight > 0) {
                        // Animated images should have their layers coalesced then resized seperately.
                        if ($this->isAnimated) {
                            $img->layers()->coalesce();
                            foreach ($img->layers() as $frame) {
                                $frame->thumbnail(new Box($maxWidth, $maxHeight),
                                    ManipulatorInterface::THUMBNAIL_INSET);
                            }
                        }
                        else {
                            $img = $img->thumbnail(
                                new Box($maxWidth, $maxHeight),
                                ManipulatorInterface::THUMBNAIL_INSET
                            );
                        }
                    }

                    if ((bool)$this->contentBlocks->getOption('contentblocks.image.strip_meta', null, true)) {
                        $img->strip();
                    }

                    // Even if not resized, an animated image needs the "animated" option set to true.
                    $options = $this->isAnimated ? ['animated' => true] : [];
                    $binary = $img->get($fileExtension, $options);
                    $this->source->updateObject($this->path . $_FILES['file']['name'], $binary);

                } catch (Exception $e) {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, 'Exception ' . get_class($e) . ' while processing image upload ' . $url . '  for crop into imagine: [' . get_class($e)  . '] ' . $e->getMessage() . ' ' . $e->getTraceAsString());
                    return $this->failure('Received an exception processing your image. Details are available in the MODX Error Log.');
                }
            }
        }

        $success = [
            'url' => $url,
            'filename' => $_FILES['file']['name'],
            'size' => $_FILES['file']['size'],
            'upload_date' => strtotime('now'),
            'extension' => $fileExtension,
            'width' => $size ? $size[0] : 0,
            'height' => $size ? $size[1] : 0,
        ];

        return $this->success('', $success);
    }
}

return 'ContentBlocksImageUploadProcessor';
