<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>


<!-- ASIDE START -->

<aside class="d-flex flex-column">
  <h1 class="logo"><a href='<?= Url::toRoute('/admin/home') ?>'>UV</a></h1>

  <ul class="d-flex flex-column">
    <b>Pagina Principală</b>
    <li class="d-flex flex-row">
      <a class="d-flex flex-row" href='/'><span class="material-symbols-outlined"> home </span>Pagina Principală</a>
    </li>
  </ul>
  <ul class="d-flex flex-column">
    <b>Panou de bord</b>
    <li class="d-flex flex-row">
      <a class="d-flex flex-row" href='<?= Url::toRoute('/admin') ?>'><span class="material-symbols-outlined"> line_axis </span>Panou de bord</a>
    </li>
  </ul>
  <ul class="d-flex flex-column">
    <b>Brand</b>
    <li class="d-flex flex-row">
      <a class="d-flex flex-row align-items-center" href="<?= Url::toRoute('/admin/producer') ?>"><span class="material-symbols-outlined"> <span class="material-symbols-outlined">
            copyright
          </span> </span>Brand-uri</a>
    </li>
  </ul>
  <ul class="d-flex flex-column">
    <b>Produs</b>
    <li class="d-flex flex-row">
      <a class="d-flex flex-row align-items-center" href='<?= Url::toRoute('/admin/category') ?>'><span class="material-symbols-outlined">
          <span class="material-symbols-outlined">
            shopping_cart
          </span>
        </span>Produse</a>
    </li>

  </ul>
  <ul class="d-flex flex-column">
    <b>Utilizatori</b>
    <li class="d-flex flex-row align-items-center">
      <a class="d-flex flex-row align-items-center" href="<?= Url::toRoute('/admin/user') ?>"><span class="material-symbols-outlined">
          group
        </span>Utilizatori</a>
    </li>
  </ul>
  <ul class="d-flex flex-column">
    <b>Apeluri</b>
    <li class="d-flex flex-row align-items-center">
      <a class="d-flex flex-row align-items-center" href="<?= Url::toRoute('/admin/callback') ?>"><span class="material-symbols-outlined">
          phone_in_talk
        </span>Apeluri</a>
    </li>
  </ul>
  <ul class="d-flex flex-column">
    <b>Servicii</b>
    <li class="d-flex flex-row"><a class="d-flex flex-row align-items-center" href='<?= Url::toRoute('/admin/services') ?>'><span class="material-symbols-outlined">
          <span class="material-symbols-outlined">
            engineering
          </span>
        </span>Servicii</a></li>
  </ul>
  <ul class="d-flex flex-column">
    <b>Content</b>
    <li class="d-flex flex-row"><a class="d-flex flex-row align-items-center" href='<?= Url::toRoute('/admin/main-banner') ?>'>
        <span class="material-symbols-outlined">
          wallpaper_slideshow
        </span>Banner Principal
      </a></li>
    <li class="d-flex flex-row"><a class="d-flex flex-row align-items-center" href='<?= Url::toRoute('/admin/about') ?>'>
        <span class="material-symbols-outlined">
          contact_support
        </span>Despre noi
      </a></li>
    <li class="d-flex flex-row"><a class="d-flex flex-row align-items-center" href='<?= Url::toRoute('/admin/reviews') ?>'>
        <span class="material-symbols-outlined">
          reviews
        </span>Recenzii
      </a></li>
    <li class="d-flex flex-row"><a class="d-flex flex-row align-items-center" href='<?= Url::toRoute('/admin/site-info') ?>'>
        <span class="material-symbols-outlined">
          info
        </span>Informații generale
      </a></li>
  </ul>
  <ul class="d-flex flex-column">
    <b>Logout</b>
    <li class="d-flex flex-row"><a class="d-flex flex-row align-items-center" href='<?= Url::toRoute('/auth/logout') ?>'><span class="material-symbols-outlined">
          logout
        </span>Ieșire</a></li>
  </ul>
</aside>
<!-- ASIDE END -->