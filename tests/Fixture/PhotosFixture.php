<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class PhotosFixture extends TestFixture
{
    public $import = ['table' => 'photos'];

    public $records = [
        [
            'id' => 1,
            'title' => 'Existing Photo',
            'description' => 'This is an existing photo',
            'file_path' => 'img/existing_photo.jpg',
            'created' => '2023-01-01 00:00:00',
            'modified' => '2023-01-01 00:00:00',
        ],
    ];
}
