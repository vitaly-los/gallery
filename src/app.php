<?php

/** defined constant that consists page title  */
define('PAGE_TITLE', 'Image Gallery');
/** defined image placeholder  */
define('IMAGE_PLACEHOLDER', 'https://fakeimg.pl/300x200/282828/eae0d0/?retina=1');
/** defined constant with path to images stored in JSON format */
define('IMAGE_RESOURCE_URL', 'https://picsum.photos/list');

/**
 * Get image array
 *
 * @return array
 */
function getImages()
{
    //read file content to string $jsonList, @ means suppress errors in case of problems with service availability, but it's bad practice
    $jsonList = @file_get_contents(IMAGE_RESOURCE_URL);

    if (!empty($jsonList)) { //check if string is not empty
        /** @var array with images $images */
        $images = [];

        //json_decode converts string to array, array_slice select first 9 elements
        foreach (array_slice(json_decode($jsonList, true), 0, 9) as $key => $value) {
            /*
             * set new array element
             *
             * NOTE: Here is one issue: url https://picsum.photos/0016_gkT4FfgHO5o.jpeg
             * doesn't return image that exists on page https://unsplash.com/photos/gkT4FfgHO5o
             * so if we use one of that solution it will display wrong image. So we need to extract correct images by some rule:
             * The idea is finding some pattern in source page (https://unsplash.com/photos/gkT4FfgHO5o) and getting correct link
             *
             * found url with direct link to image in source of page https://unsplash.com/photos/gkT4FfgHO5o/download?force=true
             * alternative solution is using https://picsum.photos/500/500/?image=16 URL
            */
            $image = imageExists($value['post_url'] . '/download');
            list($width, $height) = getimagesize($image);
            $images[] = [
                'url' => $image,
                'thumbnail' => $value['post_url'] . '/download',
                'description' => $value['author'],
                'width' => $width,
                'height' => $height,
                'created_at' => getCurrentDate()
            ];
        }
    } else {
        // set empty array
        $images = [];
    }
    sortImages($images);

    return $images;
}

/**
 * Sort array of images
 * @param $images
 */
function sortImages(&$images)
{
    if (!empty($images)) {
        //sorting part
        usort($images, function ($imageA, $imageB) {
            if ($imageA['description'] == $imageB['description']) {
                return 0;
            }
            return ($imageA['description'] < $imageB['description']) ? -1 : 1;
        });
    }
}

/**
 * Get formatted current time
 *
 * @return false|string
 */
function getCurrentDate()
{
    return date('d M Y H:i:s', time());
}

/**
 * Return image page or placeholder
 *
 * @param $imagePath
 * @return string
 */
function imageExists($imagePath)
{
    if (isset($imagePath) && !empty($imagePath)) {
        return $imagePath;
    } else {
        return IMAGE_PLACEHOLDER;
    }
}