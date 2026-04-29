<?php


use yii\helpers\Html;
use yii\helpers\Url;
?>

<header>
  <div class="container-fluid">
    <nav class="d-flex flex-row align-items-center justify-content-between">
      <div class="menu-burger">
        <span></span>
      </div>
      <div class="header-actions d-flex flex-row align-items-center">
        <div class="date-time"></div>
        <div class="theme-toggler night-mode d-flex flex-row align-items-center">
          <span class="_active material-symbols-outlined">
            light_mode
          </span>
          <span class="material-symbols-outlined"> dark_mode </span>
        </div>

        <div class="profile-header d-flex flex-row align-items-center">
          <div class="user-info d-flex flex-column">
            <p>Hey, <b>Admin</b></p>
          </div>

        </div>
      </div>
    </nav>
  </div>
</header>