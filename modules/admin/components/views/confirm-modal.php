<div class="modal-confirm-wrapper">
    <div class="modal-confirm d-flex flex-column">
        <h2 class='d-flex flex-row align-items-center'><?= $heading_icon ?><?= $heading ?></h2>
        <p class="confirm-text"></p>
        <div class="buttons align-self-end d-flex ">
            <a href="" class="accept-confirm d-flex justify-content-center align-items-center text-center <?= $confirmClass ?>" method="<?= $data_method ?>">Confirmă</a>
            <a class="cancel-confirm d-flex justify-content-center align-items-center text-center">Anulare</a>
        </div>
    </div>
</div>


<div class="modal-error-wrapper">
    <div class="modal-error d-flex flex-column">
        <h2 class='d-flex flex-row align-items-center'><span class="material-symbols-outlined">
                warning
            </span>ATENȚIE!</h2>
        <p class="error-text"></p>
        <div class="buttons align-self-end d-flex ">
            <a class="cancel-error d-flex justify-content-center align-items-center text-center">Ok</a>
        </div>
    </div>
</div>