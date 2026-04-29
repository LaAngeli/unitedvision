<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<ul class="breadcrumb d-inline-flex align-items-center justify-content-center">
  <?php foreach ($links as $item => $crumb) : ?>

    <?php if (isset($crumb['url'])) : ?>
      <li><a href="<?= Url::toRoute($crumb['url']) ?>"><?= $crumb['label'] ?></a></li>
      <span class="material-symbols-outlined">
        navigate_next
      </span>
    <?php else : ?>
      <li><a class="innactive-link"><?= $crumb['label'] ?></a></li>
    <?php endif ?>

  <?php endforeach ?>

</ul>