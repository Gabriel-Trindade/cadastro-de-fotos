<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Galeria de fotos!';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>
    <?= $this->Html->css(['index']) ?>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>





<body>
    <header class="bg-dark text-white py-4 text-center">
        <div class="container">
            <h1 class="mb-0">Cadastro de Fotos</h1>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container">
            <p class="mb-0">© <?= date('Y') ?> Cadastro de Fotos</p>
        </div>
    </footer>

    <?php $this->start('script') ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {


            var $grid = $('.photos.grid').isotope({
                itemSelector: '.photo.grid-item',
                layoutMode: 'fitRows',
                getSortData: {
                    id: function(itemElem) {
                        // Convertendo o ID para número inteiro para garantir a ordenação correta
                        return parseInt($(itemElem).data('id'));
                    },
                    title: function(itemElem) {
                        return $(itemElem).data('title').toLowerCase();
                    },
                    created: function(itemElem) {
                        var created = $(itemElem).find('.created').text();
                        return new Date(created);
                    }
                }
            });

            // Filtrar itens ao clicar no botão
            $('.filter-button-group').on('click', 'button', function() {
                var sortByValue = $(this).attr('data-sort-by');
                $grid.isotope({
                    sortBy: sortByValue
                });
                $('.filter-button-group .is-checked').removeClass('is-checked');
                $(this).addClass('is-checked');
            });
            $('.filter-button-group').on('click', 'button', function() {
                $('.filter-button-group .active').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
    <?php $this->end('') ?>

    <?= $this->fetch('script'); ?>


    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>


</body>



</html>