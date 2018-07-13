<?php

class Pagination
{

    public $currentpage;
    public $perpage;
    public $countimages;

    function __construct($perpage = 6, $countimages = 0)
    {
        $this->currentpage = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
        $this->perpage = $perpage;
        $this->countimages = $countimages;
    }

    public function offset()
    {
        return ($this->currentpage - 1) * $this->perpage;
    }

    public function totalPages()
    {
        return ceil($this->countimages / $this->perpage);
    }

    public function previousPage()
    {
        return $this->currentpage - 1;
    }

    public function nextPage()
    {
        return $this->currentpage + 1;
    }

    public function hasPreviousPage()
    {
        return $this->previousPage() >= 1 ? true : false;
    }

    public function hasNextPage()
    {
        return $this->nextPage() <= $this->totalPages() ? true : false;
    }

    public function outputPagination()
    {
        if ($this->totalPages() > 1) {

            $output = '';
            if ($this->hasPreviousPage()) {
                $output .= "<li class='page-item'><a class='page-link' href='/?page=";
                $output .= $this->previousPage();
                $output .= "'>&laquo; Previous</a></li> ";
            }

            for ($i = 1; $i <= $this->totalPages(); $i++) {
                if ($i == $this->currentpage) {
                    $output .= " <li class='page-item active'><a class='page-link' href='#'>" . $i . "</a></li>";
                } else {
                    $output .= "<li class='page-item'><a class='page-link' href='/?page=" . $i . "'>" . $i . "</a></li>";
                }
            }

            if ($this->hasNextPage()) {
                $output .= " <li class='page-item'><a class='page-link' href='/?page=";
                $output .= $this->nextPage();
                $output .= "'>Next &raquo;</a></li>";
            }
        }
        if ($output != null) {
            return $output;
        }
    }

    public static function countImages()
    {
        $imagescount = Database::run('SELECT COUNT(image_id) FROM images')->fetch(PDO::FETCH_NUM);
        $returnInt = $imagescount[0];
        return $returnInt;
    }

}
