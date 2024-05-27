
<h1 class="my-4">Galeria de Fotos</h1>

<div class="mb-2">
<?= $this->Html->link('Adicionar foto', ['action' => 'add'], ['class' => 'btn btn-primary btn-lg mb-4']) ?>
</div>

<div class="btn-group filter-button-group mb-4" role="group" aria-label="Filtrar">
    <button class="btn btn-outline-primary active" data-sort-by="original-order">Último cadastrado</button>
    <button class="btn btn-outline-primary" data-sort-by="title">Por Título</button>
    <button class="btn btn-outline-primary" data-sort-by="id">Primeiro cadastrado</button>
</div>
<div class="photos row grid" id="photo-grid">
    <?php if (!$photos->count()) : ?>
        <div class="col-12">
            <div class="alert alert-warning">Nenhuma foto cadastrada</div>
        </div>
    <?php endif; ?>
    <?php foreach ($photos as $photo) : ?>
        <div class="col-md-3 col-sm-6 mb-4 photo grid-item" data-id="<?= $photo->id ?>" data-title="<?= strtolower($photo->title) ?>">
            <div class="card">
                <img src="<?= $this->Url->build('/' . $photo->file_path) ?>" alt="<?= h($photo->title) ?>" class="card-img-top mt-3">
                <div class="card-body">
                    <h5 class="card-title"><?= h($photo->title) ?></h5>
                    <p class="card-text"><?= h($photo->description) ?></p>
                    <div class="btn-group" role="group" aria-label="Ações">
                        <?= $this->Html->link('Visualizar', $this->Url->build('/photos/view/' . $photo->id), ['class' => 'btn btn-primary']) ?>
                        <?= $this->Html->link('Editar', $this->Url->build('/photos/edit/' . $photo->id), ['class' => 'btn btn-secondary']) ?>
                        <?= $this->Form->postLink('Deletar', $this->Url->build('/photos/delete/' . $photo->id), ['class' => 'btn btn-danger', 'confirm' => 'Tem certeza que deseja deletar esta foto?']) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<?php if (!$photos->count()) : ?>


<?php else : ?>

    <div class="paginator d-flex justify-content-center align-items-center mt-4 hidden">
        <ul class="pagination">
            <li class="page-item"><?= $this->Paginator->first('<< ' . __('primeiro'), ['class' => 'page-link']) ?></li>
            <li class="page-item"><?= $this->Paginator->prev('< ' . __('anterior'), ['class' => 'page-link']) ?></li>
            <?= $this->Paginator->numbers(['class' => 'page-item']) ?>
            <li class="page-item"><?= $this->Paginator->next(__('próximo') . ' >', ['class' => 'page-link']) ?></li>
            <li class="page-item"><?= $this->Paginator->last(__('último') . ' >>', ['class' => 'page-link']) ?></li>
        </ul>
    </div>
<?php endif; ?>