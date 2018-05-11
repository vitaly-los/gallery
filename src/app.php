<?php

/** defined constant that consists page title  */
define('PAGE_TITLE', 'Image Gallery');
/** defined image placeholder  */
define('IMAGE_PLACEHOLDER', 'https://fakeimg.pl/300x200/282828/eae0d0/?retina=1');
/** defined constant with path to images stored in JSON format */
define('IMAGE_RESOURCE_URL', 'https://picsum.photos/list');

/** Get image array
 *
 * @return array
 */
function formatImages($data)
{
    if (!empty($data)) { //check if array is not empty
        /** @var array with images $images */
        $images = [];
        $offset = isset($_GET['p']) ? $_GET['p'] - 1 : 0;
        //json_decode converts string to array, array_slice select first 9 elements
        foreach (array_slice($data, $offset * 9, 9) as $key => $value) {
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
            $width = 348;
            $height = 0;
            $images[] = [
                'url' => $image,
                //'thumbnail' => generateThumbnail($image, $width, $height),
                'thumbnail' => $image,
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

/** Sort array of images
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

/** Get formatted current time
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

/** Generate image thumbnail in base64
 *
 * @param $imagePath
 * @param $width
 * @param $height
 * @return string
 */
function generateThumbnail($imagePath, &$width, &$height)
{
    $params = getOriginalSize($imagePath);

    return 'data:' . $params['mime'] . ';base64,' . base64_encode(resizeImage($imagePath, $width, $height, $params));
}

/** Resize Image
 *
 * @param $imagePath
 * @param $width
 * @param $height
 * @param $params
 * @return string
 */
function resizeImage($imagePath, &$width, &$height, $params)
{
    $mime = $params['mime'];

    //use specific function based on image format
    switch ($mime) {
        case 'image/jpeg':
            $imageCreateFunc = 'imagecreatefromjpeg';
            $imageSaveFunc = 'imagejpeg';
            break;

        case 'image/png':
            $imageCreateFunc = 'imagecreatefrompng';
            $imageSaveFunc = 'imagepng';
            break;

        case 'image/gif':
            $imageCreateFunc = 'imagecreatefromgif';
            $imageSaveFunc = 'imagegif';
            break;

        default:
            //we will handle this once work with errors

    }

    //Variable function
    $img = $imageCreateFunc($imagePath);

    //list is php construction that allows to set array elements to variables
    list($originalWidth, $originalHeight) = $params;

    //calculate height
    if (!$height) {
        $height = ($originalHeight / $originalWidth) * $width;
    }
    //create new image
    $bufferImage = imagecreatetruecolor($width, $height);
    imagecopyresampled($bufferImage, $img, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
    //save original image size to variables for later use outside of function
    $width = $originalWidth;
    $height = $originalHeight;

    //return buffer output as string
    ob_start();
    $imageSaveFunc($bufferImage);

    return ob_get_clean();


}

/** get image size info
 *
 * @param $imagePath
 * @return array|bool
 */
function getOriginalSize($imagePath)
{
    return getimagesize($imagePath);
}

/** Return array with images
 *
 * @return mixed
 */
function getCollection()
{
    //read file content to string $jsonList, @ means suppress errors in case of problems with service availability, but it's bad practice
    $images = @file_get_contents(IMAGE_RESOURCE_URL);

    return json_decode($images, true);
}

/** Return qty of pages
 *
 * @param $collection
 * @return float|int
 */
function getPageCount($collection)
{
    return count($collection) / 9;
}

/** Get last page number
 *
 * @param $collection
 * @return int
 */
function getLastPage($collection): int
{
    return getPageCount($collection);
}

/** Get first page, first page is 1
 *
 * @return int
 */
function getFirstPage()
{
    return 1;
}

/** Get next page number
 *
 * @param $collection
 * @return bool|int
 */
function getNextPage($collection)
{
    if (isset($_REQUEST['p']) && getPageCount($collection) < $_REQUEST['p']) {
        return false;
    } elseif (isset($_REQUEST['p'])) {
        return $_REQUEST['p'] + 1;
    } else {
        return 2;
    }
}

/** Get previous page number
 *
 * @return bool|int
 */
function getPrevPage()
{
    return isset($_REQUEST['p']) && $_REQUEST['p'] > 1 ? $_REQUEST['p'] - 1 : false;
}

/** Get current page number
 *
 * @return int
 */
function getCurrentPage()
{
    return isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
}

/** Generate pagination HTML
 *
 * @param $collection
 * @return string
 */
function renderPagination($collection)
{
    $paginationHtml = '';
    if (count($collection) / 9 > 1) {
        $paginationHtml .= "<li class='page-item'><a class='page-link' href='/?p=" . getFirstPage() . "'>Go to first page</a></li>";
        if ($prevPage = getPrevPage()) {
            $paginationHtml .= "<li class='page-item'><a class='page-link' href='/?p=" . $prevPage . "'>" . $prevPage . "</a></li>";
        }
        $paginationHtml .= "<li class='page-item active'><a class='page-link' href='#'>" . getCurrentPage() . "</a></li>";
        if ($nextPage = getNextPage($collection)) {
            $paginationHtml .= "<li class='page-item'><a class='page-link' href='/?p=" . $nextPage . "'>" . $nextPage . "</a></li>";
        }
        $paginationHtml .= "<li class='page-item'><a class='page-link' href='/?p=" . getLastPage($collection) . "'>Go to last page</a></li>";
    }

    return $paginationHtml;
}

/** Get errors from request
 *
 * @return bool|string
 */
function getErrors()
{
    if (isset($_REQUEST['errors']) && !empty($_REQUEST['errors'])) {
        $errors = '';
        foreach ($_REQUEST['errors'] as $error) {
            $errors .= $error . '<br>';
        }
        return $errors;
    }

    return false;
}