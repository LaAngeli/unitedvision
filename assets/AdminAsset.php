<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        'https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css',
        'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200',
        'https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css',
        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
        'css/admin/style.css',
    ];
    public $js = [
        'js/ajax.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js',
        'https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js',
        'js/admin/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}

// <?= $form->field($tourForm, 'start_time')->widget(
//     \kartik\date\DatePicker::class,
//     [
//         'type' => DatePicker::TYPE_COMPONENT_PREPEND,
//         'name' => 'check_issue_date',
//         'value' => date('Y-m-d'),
//         'options' => ['placeholder' => 'Select issue date ...'],
//         'pluginOptions' => [
//             'format' => 'dd-mm-yyyy',
//             'todayHighlight' => true
//         ]
//     ]
// ); 
