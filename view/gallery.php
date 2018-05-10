<div class="container">
    <div class="row">

        <?php
        foreach ($images as $image) {

            if ($image['id'] < $imagesOnPage) {
                ?>
                <div class="col-sm-4 thumb">
                    <a class="fancyimage" data-fancybox-group="group" href="<?php echo 'https://picsum.photos/' . $image['width'] . '/' . $image['height'] . '?image=' . $image['id'] ++; ?>">
                        <img class="img-responsive" src="<?php echo 'https://picsum.photos/300/300?image=' . $image['id'] ++; ?>" /> </a>
                </div>
                <?php
            }
        }
        /**
         * @todo Make pagination using PHP
         */
        ?>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div>
<script type="text/javascript"> $(document).ready(function () {
        $("a.fancyimage").fancybox();
    });</script>
