<?php

namespace app\models\user\forms;



use Yii;
use app\models\user\User;
use yii\helpers\ArrayHelper;

class UpdateUserForm extends User
{

  public $model;
  public $status;
  public $role;


  function __construct($model)
  {
    $this->model = $model;

    $this->role = $this->getRoles();

    $this->status = $model->status;
  }

  /**
   * @return array the validation rules.
   */
  public function rules()
  {
    return [
      [['role', 'status'], 'required'],
      [['role'], 'validateRole'],
      [['status'], 'integer', 'min' => 0, 'max' => 3]
    ];
  }


  public function validateRole($attribute)
  {
    if (!in_array($this->$attribute, ['admin', 'moderator'])) {
      $this->addError($attribute, 'Rolul ' . $this->role . ' nu există');
    }
  }



  public function getRoles()
  {
    $role = Yii::$app->authManager->getRolesByUser($this->model->id);
    foreach ($role as $item) {
      return $item->name;
    }
  }


  public function saveRecord()
  {

    if ($this->validate()) {

      $this->model->status = $this->status;
      // $this->model->updated_at = $dateTime = date('Y-m-d H-i-s', time());

      Yii::$app->authManager->revokeAll($this->model->id);
      if ($role = Yii::$app->authManager->getRole($this->role)) {
        Yii::$app->authManager->assign($role, $this->model->id);
      }

      $this->model->save();

      return $this->model;
    }
  }
}
