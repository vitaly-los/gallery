<?php
/**
 * In our case we use images from picsum.photos so function check server status
 * @return boolean
 */
function checkServerStatus($content)
{
    file_get_contents($content);
    if (in_array('HTTP/1.1 200 OK', $http_response_header))
        return true;
    else
        return false;
}

/**
 *
 * @param string list of images in JSON format
 * @return array
 */
function imagesList(string $content)
{

    $imagesList = [];
    $res = file_get_contents($content);
    $json = json_decode($res, true);

    foreach ($json as $key => $value){
        $imagesList[] = [
            'width' => $value['width'],
            'height' => $value['height'],
            'id' => $value['id'],
            //'author' => $value['author']
        ];
    }
    return $imagesList;
}

/**
 *
 * @param string $data
 * @return type
 */
function test_input(string $data)
{
    return trim(htmlspecialchars(stripslashes($data)));
}

/**
 *
 * @param string $value
 * @param int $max
 * @return boolean
 */
function stringLengh(string $value, int $max)
{
    $lenth = strlen($value);
    return $lenth < $max;
}
