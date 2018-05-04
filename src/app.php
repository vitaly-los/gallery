<?php

/** defined constant that consists page title  */
define('PAGE_TITLE', 'Image Gallery');
/** defined image placeholder  */
define('IMAGE_PLACEHOLDER', 'https://fakeimg.pl/300x200/282828/eae0d0/?retina=1');
/** defined constant with path to images stored in JSON format */
define('IMAGE_RESOURCE_URL', 'https://picsum.photos/list');

/**
 * function sor sorting images
 * @param $imageA
 * @param $imageB
 * @return int
 */
function sortImages($imageA, $imageB)
{
    if ($imageA['description'] == $imageB['description']) {
        return 0;
    }
    return ($imageA['description'] < $imageB['description']) ? -1 : 1;
}

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
         * NOTE: Here is one issue: url https://picsum.photos/0016_gkT4FfgHO5o.jpeg or https://picsum.photos/500/500/?image=16
         * doesn't return image that exists on page https://unsplash.com/photos/gkT4FfgHO5o
         * so if we use one of that solution it will display wrong image. So we need to extract correct images by some rule:
         * The idea is finding some pattern in source page (https://unsplash.com/photos/gkT4FfgHO5o) and getting correct link
         *
         * found url with direct link to image in source of page https://unsplash.com/photos/gkT4FfgHO5o/download?force=true
        */
        $images[] = [
            'url' => $value['post_url'] . '/download',
            'thumbnail' => $value['post_url'] . '/download',
            'description' => $value['author'],
            'width' => $value['width'],
            'height' => $value['height']
        ];
    }
} else {
    // set empty array
    $images = [];
}

if (!empty($images)) {
//sorting part
    usort($images, 'sortImages');
}