<?php

use yii\helpers\Html;


?>

<table class="detail-view">

    <?php foreach ($attributes as $attribute => $record) : ?>
        <tr>

            <?php if (isset($record['label'])) : ?>

                <th><?= $record['label'] ?></th>

            <?php elseif (!isset($record['label']) and isset($record['value'])) : ?>

                <th><?= $model->getAttributeLabel(Html::encode($attribute)) ?></th>

            <?php elseif (!isset($record['label'])) : ?>

                <th><?= $model->getAttributeLabel(Html::encode($record)) ?></th>

            <?php else : ?>

                <th><?= $model->getAttributeLabel(Html::encode($attribute)) ?></th>

            <?php endif; ?>



            <?php if (isset($record['value']) and $record['value'] === '' and !is_callable($record['value']) or (isset($record['value']) and $record['value'] === null and !is_callable($record['value']))) : ?>

                <td><i class='danger'>(Nu este setat)</i></td>

            <?php elseif (isset($record['value'])  and is_callable($record['value']) and $record['value']($model) === null or isset($record['value'])  and is_callable($record['value']) and $record['value']($model) === '') : ?>

                <td><i class='danger'>(Nu este setat)</i></td>

            <?php elseif (isset($record['value']) and !is_callable($record['value'])) : ?>

                <td><?= $record['value'] ?></td>

            <?php elseif (isset($record['value']) and is_callable($record['value'])) : ?>

                <td><?= $record['value']($model) ?></td>

            <?php elseif (!isset($record['value']) and isset($record['label'])) : ?>

                <td><?= Html::encode($model->$attribute) ?></td>

            <?php elseif (!isset($record['value'])) : ?>

                <td><?= Html::encode($model->$record) ?></td>

            <?php else : ?>

                <td><?= Html::encode($model->$attribute) ?></td>

            <?php endif; ?>

        </tr>

    <?php endforeach ?>

</table>