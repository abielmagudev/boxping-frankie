<?php $template->fill('content') ?>
<?php $template->insert('partials/alert') ?>
<?php $template->insert('partials/validation') ?>
<div class="card">
    <div class="card-header">
        <div class="float-right">
            <a href="<?= url('bodega/entrada') ?>" class="btn btn-outline-primary btn-sm">Cambiar a entrada</a>
        </div>
        <span class="lead">Bodega MEX | Salida</span>
    </div>
    <div class="card-body">
        <form id="frm-registrar" action="<?= url('bodega/registrar/numero/salida') ?>" method="post" autocomplete="off">
            <div class="form-group">
                <label>Numero de guia</label>
                <input type="text" class="form-control" name="numero" autofocus required>
            </div>
            <div class="form-group">
                <label for="">Observaciones</label>
                <textarea name="observaciones" id="observaciones" cols="30" rows="5" class="form-control"></textarea>
            </div>
        </form>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-success" type="submit" form="frm-registrar">Registrar como salida</button>
    </div>
</div>
<?php $template->stop() ?>
<?php $template->expand('layouts/navless') ?>