<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;
class Dokter extends RestController
{
    public function __construct()
  {
    parent::__construct();
    $this->load->model('dokter_model', 'dokter');
    $this->methods['index_get']['limit'] = 2;
  }

  public function index_get()
  {
    $id = $this->get('id');  
    if ($id === null) {
        $p = $this->get('page', true);
        $p = (empty($p) ? 1 : $p);
        $total_data = $this->dokter->count();
        $total_page = ceil($total_data / 3);
        $start = ($p - 1) * 3;
    $list=$this->dokter->get(null, 3, $start);
    if ($list) {
        $data = [
          'status' => true,
          'page' => $p,
          'total_data' => $total_data,
          'total_page' => $total_page,
          'data' => $list
        ];
      } else {
        $data = [
          'status' => false,
          'msg' => 'Data tidak ditemukan'
        ];
      }
      $this->response($data, RestController::HTTP_OK);
    }
    else
    {
        $data = $this->dokter->get($id);
        if ($data) {
            $this->response($data, RestController::HTTP_OK);
          } else {
            $this->response(['status' => false, 'msg' => $id . ' tidak ditemukan'], RestController::HTTP_NOT_FOUND);
          }
    }
  }

  public function index_post()
  {
    $data = [
      'id' => $this->post('id', true),
      'nama' => $this->post('nama', true),
      'spesialis' => $this->post('spesialis', true),
      'umur' => $this->post('umur', true)
    ];
    $simpan = $this->dokter->add($data);
    if ($simpan['status']) {
      $this->response(['status' => true, 'msg' => $simpan['data'] . ' Data telah berhasil ditambahkan'], RestController::HTTP_CREATED);
    } else {
      $this->response(['status' => false, 'msg' => $simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index_put()
  {
    $data = [
      'id' => $this->put('id', true),
      'nama' => $this->put('nama', true),
      'spesialis' => $this->put('spesialis', true),
      'umur' => $this->put('umur', true)
    ];
    $id = $this->put('id', true);
    if ($id === null) {
      $this->response(['status' => false, 'msg' => 'Masukkan ID Dokter yang akan di Update'], RestController::HTTP_BAD_REQUEST);
    }
    $simpan = $this->dokter->update($id, $data);
    if ($simpan['status']) {
      $status = (int)$simpan['data'];
      if ($status > 0)
        $this->response(['status' => true, 'msg' => $simpan['data'] . ' Data telah berhasil di Update'], RestController::HTTP_OK);
      else
        $this->response(['status' => false, 'msg' => 'Tidak ada data yang di Update'], RestController::HTTP_BAD_REQUEST);
    } else {
      $this->response(['status' => false, 'msg' => $simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index_delete()
  {
    $id = $this->delete('id', true);
    if ($id === null) {
      $this->response(['status' => false, 'msg' => 'Masukkan ID Dokter yang akan di Delete'], RestController::HTTP_BAD_REQUEST);
    }
    $delete = $this->dokter->delete($id);
    if ($delete['status']) {
      $status = (int)$delete['data'];
      if ($status > 0)
        $this->response(['status' => true, 'msg' => $id . ' data telah berhasil di Delete'], RestController::HTTP_OK);
      else
        $this->response(['status' => false, 'msg' => 'Tidak ada data yang di Delete'], RestController::HTTP_BAD_REQUEST);
    } else {
      $this->response(['status' => false, 'msg' => $delete['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }
}