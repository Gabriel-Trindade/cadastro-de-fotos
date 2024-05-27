<div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-4">
                <img src="<?= $this->Url->build('/' . $photo->file_path) ?>" alt="<?= h($photo->title) ?>" class="card-img-top mt-3">
                <div class="card-body text-center">
                    <h1 class="card-title"><?= h($photo->title) ?></h1>
                    <p class="card-text"><?= h($photo->description) ?></p>
                    <?= $this->Html->link('Voltar para a galeria', ['action' => 'index'], ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
            </div>
        </div>
    </div>