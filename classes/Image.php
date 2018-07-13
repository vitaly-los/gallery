<?php

class Image extends Pagination
{

    /**
     * @var arguments for thumbnail generator
     */
    private $width = 400;
    private $height = 400;

    /**
     * @var path for image upload
     */
    private $target = 'images/';
    private $pathtosave = 'images/thumb/';

    /**
     * 
     * @param type $authorname validated data from POST INPUT
     * @param type $description validated data from POST INPUT
     * @return boolean
     */
    public function saveImage($authorname, $description)
    {
        $file = $_FILES['image']['tmp_name'];

        /**
         * var $imageinfo get info from uploaded file
         */
        $imageinfo = getimagesize($file);

        /**
         * var $filename set random name for uploaded file
         */
        $filename = uniqid(rand(), true);

        /**
         * var get $ext from uploaded file
         */
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        /**
         * $imagetype get MIME type from uploaded file
         */
        $imagetype = $imageinfo[2];

        /**
         * using switch we check uploaded file's mime type and create thumbnail
         */
        switch ($imagetype) {
            case IMAGETYPE_PNG:
                $imageresourceid = imagecreatefrompng($file);
                $targetlayer = $this->thumbnail($imageresourceid, $imageinfo[0], $imageinfo[1]);
                imagepng($targetlayer, $this->pathtosave . $filename . "." . $ext);
                break;

            case IMAGETYPE_GIF:
                $imageresourceid = imagecreatefromgif($file);
                $targetlayer = $this->thumbnail($imageresourceid, $imageinfo[0], $imageinfo[1]);
                imagegif($targetlayer, $this->pathtosave . $filename . "." . $ext);
                break;

            case IMAGETYPE_JPEG:
                $imageresourceid = imagecreatefromjpeg($file);
                $targetlayer = $this->thumbnail($imageresourceid, $imageinfo[0], $imageinfo[1]);
                imagejpeg($targetlayer, $this->pathtosave . $filename . "." . $ext);

                break;

            default:
                die("Can not generate thumbmail");
        }

        if (move_uploaded_file($file, $this->target . $filename . "." . $ext)) {

            /**
             * if file was uploaded insert file's info into database
             */
            $query = 'INSERT INTO images(image_id, image_path, thumbnail_path, description, author_name, created_at, user_id)
                    VALUES(NULL, :image_path, :thumbnail_path, :description, :author_name, CURRENT_TIMESTAMP(), :user_id)';
            $args = [
                ':image_path' => $this->target . $filename . "." . $ext,
                ':thumbnail_path' => $this->pathtosave . $filename . "." . $ext,
                ':description' => $description,
                ':author_name' => $authorname,
                ':user_id' => $_SESSION['user_id']
            ];
            Database::run($query, $args);
            return true;
        }
    }

    /**
     * 
     * @param type $imageresourceid
     * @param type $width
     * @param type $height
     * @return generated thumbnail
     */
    private function thumbnail($imageresourceid, $width, $height)
    {
        $targetlayer = imagecreatetruecolor($this->width, $this->height);

        imagecopyresampled($targetlayer, $imageresourceid, 0, 0, 0, 0, $this->width, $this->height, $width, $height);
        return $targetlayer;
    }

    /**
     * 
     * @return result of database query for main page
     */
    public function mainGallery()
    {
        $sql = 'SELECT images.image_id, image_path, thumbnail_path, author_name, description, created_at, images.user_id, username FROM images
            LEFT JOIN users on images.user_id = users.user_id LIMIT ' . $this->perpage . ' OFFSET ' . $this->offset();
        $result = Database::run($sql);
        return $result;
    }

}
