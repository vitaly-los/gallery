<?php

/** defined constant that consists page title  */
define('PAGE_TITLE', 'Image Gallery');
/** defined image placeholder  */
define('IMAGE_PLACEHOLDER', 'https://fakeimg.pl/300x200/282828/eae0d0/?retina=1');
/** defined constant with path to images stored folder */
define('IMAGE_RESOURCE_URL', 'pub/media/images/');
/** defined constant with path to images stored folder */
define('IMAGE_THUMBNAIL_URL', 'pub/media/thumbnails/');
/** defined constant with path to csv files */
define('DATA_PATH', 'pub/media/data/');
/** text file with users list */
define('USERS_FILE', 'var/users.txt');
/** text file with users list */
define('ERROR_LOG', 'var/error.log');

/** Get image array
 *
 * @param $data
 * @return array
 * @throws Exception
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
            $image = imageExists($value);
            $width = 348;
            $height = 0;
            list($author, $description) = getData($image);
            $images[] = [
                'url' => $image,
                'thumbnail' => generateThumbnail($image, $width, $height),
                //'thumbnail' => $image,
                'author' => $author,
                'description' => $description,
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
    if (file_exists(IMAGE_RESOURCE_URL . $imagePath)) {
        return IMAGE_RESOURCE_URL . $imagePath;
    } else {
        return IMAGE_PLACEHOLDER;
    }
}

/** Generate image thumbnail
 *
 * @param $imagePath
 * @param $width
 * @param $height
 * @return bool|string
 * @throws Exception
 */
function generateThumbnail($imagePath, &$width, &$height)
{
    if (!createDir(IMAGE_THUMBNAIL_URL)) {
        return IMAGE_PLACEHOLDER;
    }

    $params = getOriginalSize($imagePath);
    $thumnailPath = resizeImage($imagePath, $width, $height, $params);
    list($width, $height) = $params;
    if ($thumnailPath) {
        return $thumnailPath;
    } else {
        return IMAGE_PLACEHOLDER;
    }
}

/** Resize Image
 *
 * @param $imagePath
 * @param $width
 * @param $height
 * @param $params
 * @return bool|string
 * @throws Exception
 */
function resizeImage($imagePath, $width, $height, $params)
{
    $filename = IMAGE_THUMBNAIL_URL . basename($imagePath);
    if (file_exists($filename)) {
        return $filename;
    }

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
            throw new Exception('this file format isn\'t supported');
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

    //return buffer output as string
    ob_start();
    $imageSaveFunc($bufferImage);
    $imageSource = ob_get_clean();

    if (file_put_contents($filename, $imageSource)) {
        return $filename;
    }

    return false;

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
    if (file_exists(IMAGE_RESOURCE_URL)) {
        $images = array_filter(scandir(IMAGE_RESOURCE_URL), function ($item) {
            return !is_dir(IMAGE_RESOURCE_URL . $item);
        });
        return $images;
    }
    return false;
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
    if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
        $errors = '';
        foreach ($_SESSION['errors'] as $error) {
            $errors .= $error . '<br>';
        }
        unset($_SESSION['errors']);
        return $errors;
    }

    return false;
}

/** Validate upload form field values
 *
 * @param $data
 * @return array|bool
 */
function validateUpload($data)
{
    $errors = array();

    if (empty($data['authorname']) || strlen($data['authorname']) > 40) {
        $errors[] = 'Author shouldn\'t be empty or more 40 characters';
    }

    if (empty($data['description']) || strlen($data['description']) > 255) {
        $errors[] = 'Description shouldn\'t be empty or more 255 characters';
    }
    if (empty($_FILES)) {
        $errors[] = 'You should choose file';
    }
    if (!in_array(getimagesize($_FILES['image']['tmp_name'])['mime'], ['image/jpeg', 'image/png', 'image/gif'])) {
        $errors[] = 'File should be JPEG, PNG, GIF';
    }

    if (!empty($errors)) {
        $_SESSION['fields'] = $data;
        $_SESSION['errors'] = $errors;
        return false;
    } else {
        return true;
    }
}

/** Processing data from form
 *
 * @param $data
 */
function process(&$data)
{
    if (is_array($data)) {
        foreach ($data as &$value) {
            addslashes($value);
        }
    }
}

/** Move file into destination directory, check directory existing
 *
 * @param $file
 * @return bool|string
 */
function uploadFile($file)
{
    if (!createDir(IMAGE_RESOURCE_URL)) {
        return false;
    }

    $filename = IMAGE_RESOURCE_URL . time() . $file['name'];
    if (move_uploaded_file($file['tmp_name'], $filename)) {
        return $filename;
    }

    return false;
}

/** save data from form to CSV file, check directory existing
 *
 * @param $filename
 * @return bool
 */
function saveData($filename)
{
    if (!createDir(DATA_PATH)) {
        return false;
    }

    $handle = fopen(DATA_PATH . basename($filename) . '.csv', 'w');
    if ($handle) {
        fputcsv($handle, array($_REQUEST['authorname'], $_REQUEST['description']));
    }

    fclose($handle);

    return true;
}

/** save everything including file, form data and generate thumbnail
 *
 * @return bool
 */
function save()
{
    if ($filename = uploadFile($_FILES['image'])) {
        $width = 348;
        $height = 0;
        generateThumbnail($filename, $width, $height);
        if (!saveData($filename)) {
            return false;
        }
    }
    $_SESSION['messages'] = ['You have uploaded new image'];
    unset($_SESSION['fields']);

    return true;
}

/** Get data from CSV file
 *
 * @param $filename
 * @return array|bool|false|null
 */
function getData($filename)
{
    if (file_exists(DATA_PATH . basename($filename) . '.csv')) {
        $handle = fopen(DATA_PATH . basename($filename) . '.csv', 'r');
        if ($handle) {
            return fgetcsv($handle);
        }
        fclose($handle);
    }

    return false;
}

/** Check directory existing and create it if not
 *
 * @param $path
 * @return bool
 */
function createDir($path)
{
    if (!file_exists($path)) {
        return mkdir($path, 0777);
    }
    return true;
}

/** Check if user is logged in
 *
 * @return bool
 */
function isLoggedIn()
{
    if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
        return true;
    }

    return false;
}

/** Check if page is allowed for non logged in users
 *
 * @param $page
 * @return mixed
 */
function isAllowedPage($page)
{
    if ((!isLoggedIn() && $page == 'form') || (isLoggedIn() && ($page == 'login' || $page == 'register'))) {
        header('Location: /');
        exit();
    }

    return $page;
}

/** Authorize user
 *
 * @param $postUser
 * @param $postPass
 * @return bool
 */
function authUser($postUser, $postPass)
{
    if (file_exists(USERS_FILE)) {
        $users = file(USERS_FILE);
        foreach ($users as $user) {
            list($user, $password) = explode(':', $user);
            if (trim($user) == $postUser && trim($password) == $postPass) {
                $_SESSION['auth'] = true;
                $_SESSION['messages'] = ['You have logged in successfuly'];
                unset($_SESSION['fields']);
                return true;
                break;
            }
        }
    }
    $_SESSION['errors'] = ['Incorrect Login'];
    $_SESSION['fields'] = $_POST;

    return false;
}

/** Validate login form field values
 *
 * @param $data
 * @return array|bool
 */
function validateLogin($data)
{
    $errors = array();

    if (empty($data['login'])) {
        $errors[] = 'Login shouldn\'t be empty';
    }

    if (empty($data['pass'])) {
        $errors[] = 'Password shouldn\'t be empty';
    }


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['fields'] = $data;
        return false;
    } else {
        return true;
    }
}

/** Get filed value from session
 *
 * @param $field
 * @return string
 */
function getFieldValue($field)
{
    if (isset($_SESSION['fields'][$field])) {
        return $_SESSION['fields'][$field];
    }

    return '';
}

/** Get messages from session
 *
 * @return bool|string
 */
function getMessages()
{
    if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])) {
        $messages = '';
        foreach ($_SESSION['messages'] as $message) {
            $messages .= $message . '<br>';
        }
        unset($_SESSION['messages']);
        return $messages;
    }

    return false;
}

/** Unset auth session
 *
 */
function logOut()
{
    unset($_SESSION['auth']);
    $_SESSION['messages'] = ['You have logged out'];
    header('Location: /');
}

/** Write error to log file
 *
 * @param $errorNo
 * @param $errorMessage
 * @param $errorFile
 * @param $errorLine
 */
function errorHandler($errorNo, $errorMessage, $errorFile, $errorLine)
{
    $error = 'Error level: ' . $errorNo . ' Text: ' . $errorMessage . ' in file: ' . $errorFile . ' on line: ' . $errorLine . "\n";
    error_log($error, 3, $_SERVER['DOCUMENT_ROOT'] . ERROR_LOG);
}

/** Write fatal error to log file and show error page
 */
function shutDown()
{
    if ($error = error_get_last()) {
        error_log($error['message'], 3, $_SERVER['DOCUMENT_ROOT'] . ERROR_LOG);
        require($_SERVER['DOCUMENT_ROOT'] . 'view/error.php');
    }
}

/** Write exception to log and show error page
 *
 * @param $e
 */
function exceptionHandler($e)
{
    error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT'] . ERROR_LOG);
    require($_SERVER['DOCUMENT_ROOT'] . 'view/error.php');
}

/** Remove image
 *
 * @param $imagePath
 * @return bool
 */
function deleteImage($imagePath)
{
    if (isLoggedIn()) {
        unlink($imagePath);
        $_SESSION['messages'] = ['You have deleted image'];
        return true;
    } else {
        $_SESSION['errors'] = ['You haven\'t permitted to delete images'];
        return false;
    }
}

/** Validate registration form
 *
 * @param $data
 * @return bool
 */
function validateRegistration($data)
{
    $errors = array();

    if (empty($data['login'])) {
        $errors[] = 'Login shouldn\'t be empty';
    }

    if (empty($data['pass']) || empty($data['repass'])) {
        $errors[] = 'Password shouldn\'t be empty';
    }

    if ($data['pass'] != $data['repass']) {
        $errors[] = 'Passwords don\'t match';
    }


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['fields'] = $data;
        return false;
    } else {
        return true;
    }
}

/** add user info into file and auth user
 *
 * @param $login
 * @param $pass
 * @return bool
 */
function createUser($login, $pass)
{
    if (file_exists(USERS_FILE)) {
        $userFile = fopen(USERS_FILE, 'a+');
    } else {
        $userFile = fopen(USERS_FILE, 'w');
    }
    if (fwrite($userFile, implode(':', array($login, $pass)) . "\n")) {
        $_SESSION['messages'][] = 'Your account has been created';
        authUser($login, $pass);
        return true;
    }
    fclose($userFile);

    $_SESSION['errors'] = ['Something went wrong'];
    return false;
}
