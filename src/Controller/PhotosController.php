<?php

declare(strict_types=1);


namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Http\Exception\NotFoundException;
use PHPImageWorkshop\ImageWorkshop;

/**
 * Photos Controller
 *
 * @property \App\Model\Table\PhotosTable $Photos
 */
class PhotosController extends AppController
{

    /**
     * Método index
     *
     * Lista as fotos paginadas
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 10,
            'order' => ['Photos.created' => 'desc']
        ];
        $photos = $this->paginate($this->Photos);
        $this->set(compact('photos'));
    }


    /**
     * Método view
     *
     * Exibe os detalhes de uma foto
     *
     * @param int|null $id ID da foto
     * @throws \Cake\Http\Exception\NotFoundException Quando o ID da foto não é fornecido
     * @throws \Cake\Datasource\Exception\RecordNotFoundException Quando a foto não é encontrada
     */
    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('ID da foto não fornecido'));
        }

        try {
            $photo = $this->Photos->get($id);
            $this->set(compact('photo'));
        } catch (RecordNotFoundException $e) {
            throw new NotFoundException(__('Foto não encontrada'));
        }
    }


    /**
     * Método add
     *
     * Adiciona uma nova foto
     *
     * @return void
     */
    public function add()
    {
        // Criar uma nova entidade de foto

        $photo = $this->Photos->newEmptyEntity();

        if ($this->request->is('post')) {
            // Obter os dados do formulário
            $data = $this->request->getData();
            // Obter o arquivo enviado
            $file = $data['file_path'];

            if ($file->getError() === UPLOAD_ERR_OK) {
                // Obter o nome do arquivo e extensão
                $filename = $file->getClientFilename();
                // Obter a extensão do arquivo
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                // Gerar um nome único para o arquivo
                $filename = uniqid() . '.' . $extension;
                // Diretório de destino
                $directory = WWW_ROOT . 'img';


                // Move the uploaded file to the destination
                $file->moveTo($directory . DS . $filename);

                // Redimensionar a imagem usando PHP Image Workshop
                $layer = ImageWorkshop::initFromPath($directory . DS . $filename);
                $layer->resizeInPixel(1920, 1080, true);
                $layer->save($directory, $filename, true, null, 80);

                // Atualizar o caminho da imagem no formulário
                $data['file_path'] = 'img' . DS . $filename;

                // Patch da entidade com os dados
                $photo = $this->Photos->patchEntity($photo, $data);

                // Salvar a entidade
                if ($this->Photos->save($photo)) {
                    $this->Flash->success(__('A foto foi salva.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possível adicionar a foto.'));
            } else {
                $this->Flash->error(__('Teve um problema ao adicionar a foto.'));
            }
        }
        $this->set('photo', $photo);
    }


    /**
     * Método edit
     *
     * Edita os detalhes de uma foto existente
     *
     * @param int|null $id ID da foto a ser editada
     * @throws \Cake\Datasource\Exception\RecordNotFoundException Quando a foto não é encontrada
     */
    public function edit($id = null)
    {
        // Verificar se o ID da foto foi fornecido
        $photo = $this->Photos->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Obter os dados do formulário

            $data = $this->request->getData();
            $file = $data['file_path'];

            // Verificar se um arquivo foi enviado

            if ($file->getError() === UPLOAD_ERR_OK) {

                // Obter o nome do arquivo e extensão
                $filename = $file->getClientFilename();
                // Obter a extensão do arquivo
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                // Gerar um nome único para o arquivo
                $filename = uniqid() . '.' . $extension;
                // Diretório de destino
                $directory = WWW_ROOT . 'img';

                // Move a foto enviada para o destino
                $file->moveTo($directory . DS . $filename);

                // Redimensionar a imagem usando PHP Image Workshop
                $layer = ImageWorkshop::initFromPath($directory . DS . $filename);
                $layer->resizeInPixel(1920, 1080, true);
                $layer->save($directory, $filename, true, null, 80);

                // Atualizar o caminho da imagem no formulário
                $data['file_path'] = 'img' . DS . $filename;

                // Patch da entidade com os dados
                $photo = $this->Photos->patchEntity($photo, $data);

                // Salvar a entidade
                if ($this->Photos->save($photo)) {
                    $this->Flash->success(__('A foto foi salva.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Não foi possível adicionar a foto.'));
            } else {
                $this->Flash->error(__('Teve um problema ao adicionar a foto.'));
            }
        }
        $this->set(compact('photo'));
    }

    /**
     * Método delete
     *
     * Deleta uma foto existente
     *
     * @param int|null $id ID da foto a ser deletada
     * @return \Cake\Http\Response|null Redireciona para a página index
     * @throws \Cake\Datasource\Exception\RecordNotFoundException Quando a foto não é encontrada
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $photo = $this->Photos->get($id);
        if ($this->Photos->delete($photo)) {
            $this->Flash->success(__('A foto foi deletada.'));
        } else {
            $this->Flash->error(__('A foto não pode ser deletada, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
