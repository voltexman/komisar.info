<?php

/* @var $interview Interview */

use backend\models\Interview;

$this->title = $interview->name;
$this->registerMetaTag(['name' => 'keywords', 'content' => $interview->meta_keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $interview->meta_description]);

?>
<section class="about-us">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <br>

                <iframe width="100%" height="400"
                        src="https://www.youtube.com/embed/<?= $interview->getVideoUrl($interview->url) ?>"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>

                <?= $interview->text ?>

            </div>
        </div>

    </div>
</section>