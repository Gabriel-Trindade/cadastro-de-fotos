
<?= $this->Form->create($photo, [
    'type' => 'file',
    'class' => 'needs-validation',
    'novalidate' => true,
    'accept' => 'image/*' // Aceitar apenas arquivos de imagem
    ]) ?>
<div class="card mt-5">
    <div class="card-header">
        <h2 class="card-title"><?= __('Adicionar foto') ?></h2>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <?= $this->Form->control('title', ['label' => 'Título', 'class' => 'form-control', 'required' => true]) ?>
        </div>
        <div class="mb-3">
            <?= $this->Form->control('description', ['label' => 'Descrição', 'type' => 'textarea', 'class' => 'form-control']) ?>
        </div>
        <div class="mb-3">
        <?= $this->Form->control('file_path', [
                'label' => 'Arquivo',
                'type' => 'file',
                'class' => 'form-control',
                'required' => true,
                'accept' => 'image/*' // Aceitar apenas arquivos de imagem
            ]) ?>
        </div>
    </div>
    <div class="card-footer text-end">
        <?= $this->Form->button(__('Enviar'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('Voltar para a galeria', ['action' => 'index'], ['class' => 'btn btn-secondary ms-2']) ?>
    </div>
</div>
<?= $this->Form->end() ?>
