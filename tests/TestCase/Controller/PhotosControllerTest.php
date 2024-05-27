<?php
// tests/TestCase/Controller/PhotosControllerTest.php

namespace App\Test\TestCase\Controller;

use App\Controller\PhotosController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class PhotosControllerTest extends TestCase
{
    use IntegrationTestTrait;

    public $fixtures = [
        'app.PhotosFixture'
    ];

    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testIndex()
    {
        $this->get('/photos');
        $this->assertResponseOk();
        $this->assertResponseContains('<h1>Photos</h1>');
    }

    public function testAdd()
    {
        $data = [
            'title' => 'Test Photo',
            'description' => 'This is a test photo',
            'file_path' => [
                'tmp_name' => TMP . 'test_photo.jpg',
                'type' => 'image/jpeg',
                'size' => 500,
                'error' => 0,
                'name' => 'test_photo.jpg',
            ]
        ];

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post('/photos/add', $data);

        $this->assertResponseSuccess();
        $photos = $this->getTableLocator()->get('Photos');
        $query = $photos->find()->where(['title' => 'Test Photo']);
        $this->assertEquals(1, $query->count());
    }

    public function testView()
    {
        $photoId = 1; // Supondo que há uma foto com ID 1 no fixture
        $this->get("/photos/view/{$photoId}");
        $this->assertResponseOk();
        $this->assertResponseContains('<h1>Photo Details</h1>');
    }
}