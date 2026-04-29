<?php

namespace app\helpers;

use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;


class FileHelper
{
  public  function uploadFile($uploadedFiles): void
  {
    foreach ($uploadedFiles as $options) {
      $image = $options['uploadedFile'];

      if (!Yii::getAlias('@web') . $options['filePath']) {
        $this->createDirectory($options['filePath']);
      }

      if ($image) {
        if (isset($options['oldFile']) and $options['oldFile'] !== null) {
          $this->deleteFile(Yii::getAlias('@web') . $options['filePath'], $options['oldFile']);
        }
        (object) $options['model'][$options['property']] = $this->saveFileAs($image, Yii::getAlias('@web') . $options['filePath']);
      } else {
        if (isset($options['oldFile']) and $options['oldFile'] !== null) {
          (object) $options['model'][$options['property']]  = $options['oldFile'];
        } else {
          (object) $options['model'][$options['property']]  = null;
        }
      }
    }
  }

  public function getInstance($files): void
  {
    foreach ($files as $file) {
      (object)$file['model'][$file['property']]  = UploadedFile::getInstance($file['model'], $file['property']);
    }
  }


  protected function saveFileAs($uploadedImage, $path)
  {
    $imageName =  htmlspecialchars(strip_tags(strtolower(md5(uniqid($uploadedImage)) . '.' . $uploadedImage->getExtension())));
    $uploadedImage->saveAs($path . $imageName);
    return $imageName;
  }


  public function fileDestroy($uploadedFiles): void
  {
    foreach ($uploadedFiles as $options) {
      $this->deleteFile(Yii::getAlias('@web') . $options['filePath'], $options['file']);
    }
  }

  private  function deleteFile($path, $image)
  {
    if (file_exists($path . $image) and $image != null and !empty($image)) {
      unlink($path . $image);
    } else {
      return true;
    }
  }

  private function createDirectory($path)
  {
    if (!file_exists(Yii::getAlias('@web') . $path)) {
      return mkdir(Yii::getAlias('@web') . $path, 0777, true);
    }
  }


  public static function getFile($options)
  {
    if (!$options['file'] or $options['file'] === null) {
      return Url::base(true) . '/uploads/no-file.png';
    } else {
      return Url::base(true) . '/' . $options['filePath'] . $options['file'];
    }
  }
}
