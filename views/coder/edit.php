<?php $template->fill('content') ?>
<?php $template->insert('partials/alert') ?>
<?php $template->insert('partials/validation') ?>
<div class="card">
    <div class="card-header">
        <p class="m-0 lead">Editar código de reempacado</p>
    </div>
    <div class="card-body">
        <form action="<?= url('codigos_reempacado/actualizar/'.$coder->id) ?>" method="post">
            <div class="form-group">
                <label for="">Código</label>
                <input name="codigo" value="<?= $coder->codigo ?>" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Descripción</label>
                <textarea name="descripcion" class="form-control" required><?= $coder->descripcion ?></textarea>
            </div>
            <button class="btn btn-warning mb-3 mb-md-0" type="submit">Actualizar código de reempacado</button>
            <a href="<?= url('reempaque') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
<?php $template->stop() ?>
<?php $template->expand('layouts/main') ?>