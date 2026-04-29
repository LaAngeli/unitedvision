<?php

use app\helpers\RecordHelper;
use yii\helpers\Html;
use app\modules\admin\components\PaginationWidget as Pagination;

?>

<div class="grid-table d-flex flex-column align-items-baseline resp">
  <?php if (isset($options)) : ?>
    <?php if (in_array('search_summary', $options)) : ?>
      <?php foreach ($_GET as $params => $value) : ?>
        <?php if (!empty($value) and $params !== 'page' and $params !== 'limit') : ?>
          <p class='search-param'> <span class='search-title'><?= $dataProvider->model->getAttributeLabel($params) ?>:</span> <?= $value ?> </p>
        <?php else : ?>
        <?php endif ?>
      <?php endforeach ?>
    <?php endif ?>



    <?php if (isset($options['totals'])) : ?>
      <div class="totals-wrapper d-flex flex-column">
        <?php foreach ($options['totals'] as $item => $value) : ?>
          <h4 class="totals-table"><?php if (is_array($value) and isset($value['label'])) : ?>
              <?= $value['label'] ?>
            <?php elseif (is_array($value) and !isset($value['label'])) : ?>
              <?= $dataProvider->model->getAttributeLabel($item) ?>
            <?php else : ?>
              <?= $dataProvider->model->getAttributeLabel($value) ?>
            <?php endif ?>
            : <?php if (is_array($value)) : ?>
              <?= RecordHelper::getSum(['data' => $dataProvider->data], $item) ?>
            <?php else : ?>
              <?= RecordHelper::getSum(['data' => $dataProvider->data], $value) ?>
            <?php endif ?>
            <?php if (is_array($value) and isset($value['sign'])) : ?>
              <?= $value['sign'] ?>
            <?php endif ?>
          </h4>
        <?php endforeach ?>
      </div>
    <?php endif ?>


    <?php if (isset($options['averages'])) : ?>
      <div class="totals-wrapper d-flex flex-column">
        <?php foreach ($options['averages'] as $item => $value) : ?>
          <h4 class="totals-table"><?php if (is_array($value) and isset($value['label'])) : ?>
              <?= $value['label'] ?>
            <?php elseif (is_array($value) and !isset($value['label'])) : ?>
              <?= $dataProvider->model->getAttributeLabel($item) ?>
            <?php else : ?>
              <?= $dataProvider->model->getAttributeLabel($value) ?>
            <?php endif ?>
            : <?php if (is_array($value)) : ?>
              <?= round(array_sum(array_column($dataProvider->data, $item)) / count(array_column($dataProvider->data, $item)), 4) ?>
            <?php else : ?>
              <?= round(array_sum(array_column($dataProvider->data, $value)) / count(array_column($dataProvider->data, $value)), 4) ?>
            <?php endif ?>
            <?php if (is_array($value) and isset($value['sign'])) : ?>
              <?= $value['sign'] ?>
            <?php endif ?>
          </h4>
        <?php endforeach ?>
      </div>
    <?php endif ?>


    <?php if (in_array('results_summary', $options) or  in_array('pages_summary', $options)) : ?>
      <div class="nums-wrapper d-flex flex-row justify-content-between flex-wrap">
        <?php if (in_array('pages_summary', $options)) : ?>
          <div class="counting-nums pag ">
            <span>Pagina</span> <?= $dataProvider->page ?>
            <span>din</span> <?= $dataProvider->pagination ?>
          </div>
        <?php endif ?>
        <?php if (in_array('results_summary', $options)) : ?>
          <div class="counting-nums res ">
            <span>Rezultat</span> <?= ($dataProvider->page - 1) * $dataProvider->limit + 1 . '-' . ($dataProvider->page - 1) * $dataProvider->limit + $dataProvider->dataCountPage  ?>
            <span>din</span> <?= $dataProvider->dataCountAll ?>
          </div>
        <?php endif ?>
      </div>
    <?php endif ?>
  <?php endif ?>
  <table class="list-view resp">

    <thead>

      <tr>

        <?php if (isset($options)) : ?>
          <?php if (in_array('numbering', $options) or isset($options['numbering'])) : ?>
            <?php if (isset($options['numbering']) and isset($options['numbering']['label'])) : ?>
              <th><?= $options['numbering']['label'] ?></th>
            <?php elseif (isset($options['numbering']) and !isset($options['numbering']['label']) or in_array('numbering', $options)) : ?>
              <th>#</th>
            <?php endif ?>
          <?php endif ?>
        <?php endif ?>



        <?php foreach ($attributes as $attribute => $record) : ?>

          <?php if (isset($record['label'])) : ?>

            <th><?= $record['label'] ?></th>

          <?php elseif (!isset($record['label']) and isset($record['value'])) : ?>

            <th><?= $dataProvider->model->getAttributeLabel(Html::encode($attribute)) ?></th>

          <?php elseif (!isset($record['label'])) : ?>

            <th><?= $dataProvider->model->getAttributeLabel(Html::encode($record)) ?></th>

          <?php else : ?>

            <th><?= $dataProvider->model->getAttributeLabel(Html::encode($attribute)) ?></th>

          <?php endif; ?>

        <?php endforeach; ?>


        <?php if (!isset($buttons)) : ?>
        <?php else : ?>
          <th class="color-dark" scope="col"></th>
        <?php endif ?>



      </tr>

    </thead>

    <tbody>

      <?php if (!empty($dataProvider->data) and $dataProvider->data !== null) : ?>

        <?php foreach ($dataProvider->data as $number => $model) : ?>

          <tr>



            <?php if (isset($options)) : ?>
              <?php if (in_array('numbering', $options) or isset($options['numbering'])) : ?>
                <td data-label="<?php if (isset($options['numbering']['label'])) : ?>
                  <?= $options['numbering']['label'] ?>
                  <?php else : ?>
                    <?= '#' ?>
                  <?php endif ?>">
                  <?php if (!in_array('sequential', $options['numbering'])) : ?>
                    <?= $number + 1 ?>
                  <?php else : ?>
                    <?= ($dataProvider->page - 1) * $dataProvider->limit + $number + 1 ?>
                  <?php endif ?>
                </td>
              <?php endif ?>
            <?php endif ?>





            <?php foreach ($attributes as $attribute => $record) : ?>

              <?php if (isset($record['value']) and $record['value'] === '' and !is_callable($record['value']) or (isset($record['value']) and $record['value'] === null and !is_callable($record['value']))) : ?>

                <td data-label="<?= $dataProvider->model->getAttributeLabel($attribute) ?>"><i class='danger'>(Nu este setat)</i></td>

              <?php elseif (isset($record['value'])  and is_callable($record['value']) and $record['value']($model) === null or isset($record['value'])  and is_callable($record['value']) and $record['value']($model) === '') : ?>

                <td data-label="<?= $dataProvider->model->getAttributeLabel($attribute) ?>"><i class='danger'>(Nu este setat)</i></td>

              <?php elseif (isset($record['value']) and !is_callable($record['value'])) : ?>

                <td data-label="<?= $dataProvider->model->getAttributeLabel($attribute) ?>"><?= $record['value'] ?></td>

              <?php elseif (isset($record['value']) and is_callable($record['value'])) : ?>

                <td data-label="<?= $dataProvider->model->getAttributeLabel($attribute) ?>"><?= $record['value']($model) ?></td>

              <?php elseif (!isset($record['value']) and isset($record['label'])) : ?>

                <td data-label="<?= $dataProvider->model->getAttributeLabel($attribute) ?>"><?= Html::encode($model->$attribute) ?></td>

              <?php elseif (!isset($record['value'])) : ?>

                <td data-label="<?= $model->getAttributeLabel($record) ?>"><?= Html::encode($model->$record) ?></td>

              <?php else : ?>

                <td data-label="<?= $dataProvider->model->getAttributeLabel($attribute) ?>"><?= Html::encode($model->$attribute) ?></td>

              <?php endif; ?>

            <?php endforeach ?>





            <?php if (!isset($buttons)) : ?>

            <?php else : ?>
              <td data-label="View" class="primary table-actions">

                <div class="table-actions-symbs">
                  <?php foreach ($buttons as $button) : ?>
                    <?php if (isset($button['options']) and is_callable($button['options'])) : ?>
                      <?= Html::a($button['label'], $button['action']($model), $button['options']($model)) ?>
                    <?php elseif (isset($button['options']) and !is_callable($button['options'])) : ?>
                      <?= Html::a($button['label'], $button['action']($model), $button['options']) ?>
                    <?php else : ?>
                      <?= Html::a($button['label'], $button['action']($model)) ?>
                    <?php endif ?>
                  <?php endforeach ?>
                </div>

              </td>
            <?php endif ?>








          </tr>

        <?php endforeach ?>

      <?php else : ?>

        <!-- <caption class='not-found'>Nu a fost găsit nici un rezultat!<caption> -->

        <tr class='not-found-wrapper'>
          <td class='not-found'>Nu a fost găsit nici un rezultat!</td>
        </tr>


      <?php endif ?>

    </tbody>

  </table>

  <?php if (isset($options['totals'])) : ?>
    <div class="totals-wrapper d-flex flex-column">
      <?php foreach ($options['totals'] as $item => $value) : ?>
        <h4 class="totals-table"><?php if (is_array($value) and isset($value['label'])) : ?>
            <?= $value['label'] ?>
          <?php elseif (is_array($value) and !isset($value['label'])) : ?>
            <?= $dataProvider->model->getAttributeLabel($item) ?>
          <?php else : ?>
            <?= $dataProvider->model->getAttributeLabel($value) ?>
          <?php endif ?>
          : <?php if (is_array($value)) : ?>
            <?= RecordHelper::getSum(['data' => $dataProvider->data], $item) ?>
          <?php else : ?>
            <?= RecordHelper::getSum(['data' => $dataProvider->data], $value) ?>
          <?php endif ?>
          <?php if (is_array($value) and isset($value['sign'])) : ?>
            <?= $value['sign'] ?>
          <?php endif ?>
        </h4>
      <?php endforeach ?>
    </div>
  <?php endif ?>

  <?php if (isset($options['averages'])) : ?>
    <div class="totals-wrapper d-flex flex-column">
      <?php foreach ($options['averages'] as $item => $value) : ?>
        <h4 class="totals-table"><?php if (is_array($value) and isset($value['label'])) : ?>
            <?= $value['label'] ?>
          <?php elseif (is_array($value) and !isset($value['label'])) : ?>
            <?= $dataProvider->model->getAttributeLabel($item) ?>
          <?php else : ?>
            <?= $dataProvider->model->getAttributeLabel($value) ?>
          <?php endif ?>
          : <?php if (is_array($value)) : ?>
            <?= round(array_sum(array_column($dataProvider->data, $item)) / count(array_column($dataProvider->data, $item)), 4) ?>
          <?php else : ?>
            <?= round(array_sum(array_column($dataProvider->data, $value)) / count(array_column($dataProvider->data, $value)), 4) ?>
          <?php endif ?>
          <?php if (is_array($value) and isset($value['sign'])) : ?>
            <?= $value['sign'] ?>
          <?php endif ?>
        </h4>
      <?php endforeach ?>
    </div>
  <?php endif ?>

</div>





<?php if (!isset($paginationView) and $paginationView !== false) : ?>
  <?= Pagination::widget(['page' => $dataProvider->page, 'pagination' => $dataProvider->pagination]) ?>
<?php endif ?>