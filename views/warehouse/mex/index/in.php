<?php $template->fill('content') ?>
<?php $template->insert('partials/alert') ?>
<?php $template->insert('partials/validation') ?>
<div class="card">
    <div class="card-header">
        <div class="float-right">
            <a href="<?= url('bodega/salida') ?>" class="btn btn-outline-primary btn-sm">Cambiar a salida</a>
        </div>
        <span class="lead">Bodega MEX | Entrada</span>
    </div>
    <div class="card-body">
        <form id="frm-registrar" action="<?= url('bodega/registrar/numero/entrada') ?>" method="post" autocomplete="off">
            <div class="row">
                <div class="col-sm form-group">
                    <label for="conductor">Conductor</label>
                    <select name="conductor" id="conductor" class="form-control" required>
                        <option selected disabled></option>
                    <?php foreach($crossing['drivers'] as $driver): ?>
                        <?php $selected = $driver->id === $crossing['driver_selected'] ? 'selected' : '' ?>
                        <option value="<?= $driver->id ?>" <?= $selected ?>><?= $driver->nombre ?></option>
                    <?php endforeach ?>
                    </select>
                </div>
                <div class="col-sm form-group">
                    <label for="vehiculo">Vehiculo</label>
                    <select name="vehiculo" id="vehiculo" class="form-control" required>
                        <option selected disabled></option>
                    <?php foreach($crossing['cars'] as $car): ?>
                        <?php $selected = $car->id === $crossing['car_selected'] ? 'selected' : '' ?>
                        <option value="<?= $car->id ?>" <?= $selected ?>><?= $car->alias ?></option>
                    <?php endforeach ?>
                    </select>
                </div>
                <div class="col-sm form-group">
                    <label for="numero_vuelta">Número de vuelta</label>
                    <input name="numero_vuelta" value="<?= $crossing['return_number'] ?>"  type="number" step="1" min="1" id="numero_vuelta" class="form-control" required>
                </div>
            </div>
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
        <button class="btn btn-success" type="submit" form="frm-registrar">Registrar como entrada</button>
    </div>
</div>
<?php $template->stop() ?>
<?php $template->expand('layouts/navless') ?>