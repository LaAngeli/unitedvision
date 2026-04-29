<?php

namespace app\modules\admin\controllers;


use app\models\site\forms\SiteInfoForm;
use app\models\site\SiteInfo;
use app\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SiteInfoController implements the CRUD actions for SiteInfo model.
 */
class SiteInfoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['get'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $model = SiteInfo::find()->one();

        return $this->render('view', [
            'model' => $model
        ]);
    }



    /**
     * Creates a new SiteInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate()
    // {
    //     $model = new SiteInfo();

    //     $addForm = new SiteInfoForm($model);


    //     $fileUpload = new FileHelper;

    //     if ($this->request->isPost) {
    //         if ($addForm->load($this->request->post())) {

    //             $fileUpload->getInstance([
    //                 'files' =>
    //                 [
    //                     'model' =>  $addForm,
    //                     'property' => 'logo_footer',
    //                 ],
    //                 [
    //                     'model' =>  $addForm,
    //                     'property' => 'logo_header',
    //                 ],
    //                 [
    //                     'model' =>  $addForm,
    //                     'property' => 'site_image',
    //                 ],
    //             ]);

    //             if ($addForm->validate()) {
    //                 $fileUpload->uploadFile([
    //                     'files' => [
    //                         'model' =>  $addForm,
    //                         'property' => 'logo_header',
    //                         'uploadedFile' => $addForm->logo_header,
    //                         'filePath' => $addForm->filePath,
    //                     ],
    //                     [
    //                         'model' =>  $addForm,
    //                         'property' => 'logo_footer',
    //                         'uploadedFile' => $addForm->logo_footer,
    //                         'filePath' => $addForm->filePath,
    //                     ],
    //                     [
    //                         'model' =>  $addForm,
    //                         'property' => 'site_image',
    //                         'uploadedFile' => $addForm->site_image,
    //                         'filePath' => $addForm->filePath,
    //                     ]
    //                 ]);
    //                 $record = $addForm->saveRecord();
    //                 return $this->redirect(['index']);
    //             }
    //         }
    //     } else {
    //         $addForm->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'addForm' => $addForm,
    //     ]);
    // }

    /**
     * Updates an existing SiteInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model = SiteInfo::find()->one();

        $addForm = new SiteInfoForm($model);

        $fileUpload = new FileHelper;

        $oldHeaderLogo = $addForm->logo_header;
        $oldFooterLogo = $addForm->logo_footer;
        $oldSiteImage = $addForm->site_image;

        if ($this->request->isPost) {
            if ($addForm->load($this->request->post())) {

                $fileUpload->getInstance([
                    'files' =>
                    [
                        'model' =>  $addForm,
                        'property' => 'logo_footer',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'logo_header',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'site_image',
                    ]
                ]);
                if ($addForm->validate()) {
                    $fileUpload->uploadFile([
                        'files' => [
                            'model' =>  $addForm,
                            'property' => 'logo_header',
                            'uploadedFile' => $addForm->logo_header,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldHeaderLogo
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'logo_footer',
                            'uploadedFile' => $addForm->logo_footer,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldFooterLogo
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'site_image',
                            'uploadedFile' => $addForm->site_image,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldSiteImage
                        ]
                    ]);
                    $record = $addForm->saveRecord();
                    return $this->redirect(['index']);
                } else {
                    $addForm->loadDefaultValues();
                }
            }
        }
        return $this->render('update', [
            'addForm' => $addForm,
            'model' => $model,
        ]);
    }
}
