<?php



use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if ($pagination > 1) : ?>


  <div class="pagination d-flex align-items-center justify-content-center">

    <ul class="pagination-ul d-flex flex-row align-items-center">

      <?php if ($page > 1) : ?>
        <li class="btn prev">
          <?= Html::a('Prev', Url::current(['page' => $page - 1]), ['class' => 'page-change']) ?>
        </li>
      <?php endif ?>

      <?php for ($i = $page - $distance; $i <=  $page + $distance; $i++) : ?>
        <?php if ($i >= 1) : ?>

          <?php if ($i == $page) : ?>

            <li class="numb active d-flex align-items-center"> <?= Html::a($i, Url::current(['page' => $i]), ['class' => 'page-change']) ?> </li>

          <?php else : ?>

            <li class="numb d-flex align-items-center"> <?= Html::a($i, Url::current(['page' => $i]), ['class' => 'page-change']) ?> </li>
          <?php endif ?>
        <?php else : ?>
          <?php $i = 1 ?>
          <?php if ($page == 1) : ?>
            <li class="numb active d-flex align-items-center"> <?= Html::a($i, Url::current(['page' => $i]), ['class' => 'page-change']) ?> </li>
          <?php else : ?>
            <li class="numb d-flex align-items-center"> <?= Html::a($i, Url::current(['page' => $i]), ['class' => 'page-change']) ?> </li>
          <?php endif ?>

        <?php endif ?>

        <?php if ($i >= $pagination) : ?>
          <?php break; ?>
        <?php endif ?>
      <?php endfor ?>
      <?php if ($page < $pagination) : ?>

        <li class="btn next">

          <?= Html::a('Next', Url::current(['page' => $page + 1]), ['class' => 'page-change']) ?>
        </li>

      <?php endif ?>
    </ul>
  </div>
<?php endif ?>