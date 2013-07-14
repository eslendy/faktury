<?php

namespace Faktury\Multimedia;

/**
 * Handles images
 * 
 * Requires GD 2
 * 
 */
class Image {


    /**
     * Creates a thumbnail
     *
     * <code>
     * <?php
     *     $imageHelper = new \Faktury\Multimedia\Image();
     *     $imageHelper->createThumbnail('/tmp/upload.jpg', '/var/www/img/scaled.jpg', 640, 480, 2);
     * ?>
     * </code>
     * 
     * @param  string  $file           Source file
     * @param  string  $thumbnailFile  Name of the thumbnail file 
     * @param  int     $maxWidth       Desired width
     * @param  int     $maxHeight      Desired height
     * @param  int     $fitMethod      Fit method. 1 = Stretch to fit, 2 = Scale to fit, 3 = Crop to fit
     * 
     * @return bool Returns true on success, or false on error.
     */
    public function createThumbnail($file, $thumbnailFile, $maxWidth, $maxHeight, $fitMethod = 2) {
        if (!file_exists($file)) {
            throw new \InvalidArgumentException(get_class($this) . '->createThumbnail() error: File not found ("' . $file . '")');
        }
        if (file_exists($thumbnailFile)) unlink($thumbnailFile);        
        list($imageWidth, $imageHeight, $imageType) = getimagesize($file);
        $img = false;
        switch ($imageType) {
            case IMAGETYPE_GIF:
                $img = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG:
                $img = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG:
                $png = imagecreatefrompng($file);
            break;
        }        
        if ($img === false) {
            throw new \Exception(get_class($this) . '->createThumbnail() error: Unablo to load image file ("' . $file . '")');
        }
        switch ($fitMethod) {

            case 1:     // Stretch to fit
                $thumbnail = imagecreatetruecolor($maxWidth, $maxHeight);
                imagecopyresampled($thumbnail, $img, 0, 0, 0, 0, $maxWidth, $maxHeight, $imageWidth, $imageHeight);
                return imagejpeg($thumbnail, $thumbnailFile);
                break;

            case 2:     // Scale to fit
                $thumbWidth  = $maxWidth;
                $thumbHeight = $maxHeight;
                if ($imageWidth < $maxWidth && $imageHeight < $maxHeight) {
                    $thumbWidth  = $imageWidth;
                    $thumbHeight = $imageHeight;
                } else {
                    $requiredRatio  = $maxWidth/$maxHeight;
                    $actualRatio    = $imageWidth/$imageHeight;
                    if ($requiredRatio < $actualRatio) {            // Portrait
                        $thumbWidth  = $maxWidth;
                        $thumbHeight = round($imageHeight * $maxWidth / $imageWidth);
                    } elseif  ($requiredRatio > $actualRatio) {     // Landscape
                        $thumbHeight = $maxHeight;
                        $thumbWidth  = round($imageWidth * $maxHeight / $imageHeight);
                    }
                }
                $thumbnail = imagecreatetruecolor($thumbWidth, $thumbHeight);
                imagecopyresampled($thumbnail, $img, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $imageWidth, $imageHeight);
                return imagejpeg($thumbnail, $thumbnailFile);
                break;

            case 3:     // Crop to fit
                $aspectRatio = $imageWidth / $imageHeight;
                $desiredAspectRatio = $maxWidth / $maxHeight;
                if ($aspectRatio > $desiredAspectRatio) { // Landscape
                    $tempHeight = $maxHeight;
                    $tempWidth = ( int ) ($maxHeight * $aspectRatio);
                } else {    // Portrait
                    $tempWidth = $maxWidth;
                    $tempHeight = ( int ) ($maxWidth / $aspectRatio);
                }
                // Resize the image into a temporary GD image
                $tempImg = imagecreatetruecolor($tempWidth, $tempHeight);
                imagecopyresampled($tempImg, $img, 0, 0, 0, 0, $tempWidth, $tempHeight, $imageWidth, $imageHeight);
                // Copy cropped region from temporary image into the desired GD image
                $x0 = ($tempWidth - $maxWidth) / 2;
                $y0 = ($tempHeight - $maxHeight) / 2;
                $thumbnail = imagecreatetruecolor($maxWidth, $maxHeight);
                imagecopy($thumbnail, $tempImg, 0, 0, $x0, $y0, $maxWidth, $maxHeight);
                return imagejpeg($thumbnail, $thumbnailFile);
                break;

            default:
                throw new \InvalidArgumentException(get_class($this) . '->createThumbnail() error: Unknown fit method ("' . $fitMethod . '")');
                break;
        }
    }


    /**
     * Retrieves an array of metadata of an image file
     *
     * <code>
     * <?php
     *     $imageManager = new \Faktury\Multimedia\Image();
     *     $info = $imageManager->getImageFileMetadata('/tmp/upload.jpg');
     *     echo('Width : ' . $info['width']);
     *     echo('Height: ' . $info['height']);
     *     echo('Format: ' . $info['format']);
     * ?>
     * </code>
     *
     * @return array Returns an associative array of image data
     */
    public function getImageFileMetadata($fullPathFilename) {
        if (!file_exists($fullPathFilename)) {
            throw new \InvalidArgumentException(get_class($this) . '->getImageFileMetadata() error: File not found ("' . $fullPathFilename . '")');
        }
        if (!is_readable($fullPathFilename)) {
            throw new \InvalidArgumentException(get_class($this) . '->getImageFileMetadata() error: Unable to read file ("' . $fullPathFilename . '")');
        }
        list($width, $height, $format, $attr) = getimagesize($fullPathFilename);
        switch ($format) {
            case IMAGETYPE_GIF: 
                $format = 'gif';
                break;
            case IMAGETYPE_JPEG: 
                $format = 'jpg';
                break;
            case IMAGETYPE_PNG: 
                $format = 'png';
                break;
        }
        return array(
            'width'  => $width,
            'height' => $height,
            'format' => $format
        );
    }


}