<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OfisialModel;
use App\Models\UserModel;
use App\Models\OfisialAssignmentModel;
use App\Models\EventModel;

class Ofisial extends BaseController
{
    protected $ofisialModel;
    protected $userModel;
    protected $assignmentModel;
    protected $eventModel;

    public function __construct()
    {
        $this->ofisialModel = new OfisialModel();
        $this->userModel = new UserModel();
        $this->assignmentModel = new OfisialAssignmentModel();
        $this->eventModel = new EventModel();
    }

    /**
     * List all ofisial
     */
    public function index()
    {
        $data = [
            'title' => 'Kelola Ofisial',
            'ofisials' => $this->ofisialModel->getOfisialWithDetails(),
            'total' => $this->ofisialModel->countAllResults(),
            'aktif' => $this->ofisialModel->where('status', 'aktif')->countAllResults(),
            'nonaktif' => $this->ofisialModel->where('status', 'nonaktif')->countAllResults(),
        ];

        return view('admin/ofisial/index', $data);
    }

    /**
     * Create new ofisial
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Ofisial',
        ];

        return view('admin/ofisial/create', $data);
    }

    /**
     * Store new ofisial
     */
    public function store()
    {
        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[user.username]',
            'email' => 'required|valid_email|is_unique[user.email]',
            'no_hp' => 'required|min_length[10]|max_length[15]',
            'nomor_lisensi' => 'required|min_length[5]|max_length[50]|is_unique[ofisial.nomor_lisensi]',
            'status' => 'required|in_list[aktif,nonaktif]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        try {
            $this->userModel->transBegin();

            // Create user
            $userId = $this->generateUUID();
            $userData = [
                'id_user' => $userId,
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('no_hp'),
                'password_hash' => password_hash('ofisial2025', PASSWORD_DEFAULT),
                'peran' => 'ofisial',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ];

            $this->userModel->insert($userData);

            // Create ofisial
            $ofisialData = [
                'id_user' => $userId,
                'nomor_lisensi' => $this->request->getPost('nomor_lisensi'),
                'status' => $this->request->getPost('status'),
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ];

            $this->ofisialModel->insert($ofisialData);

            $this->userModel->transCommit();

            return redirect()->to('admin/ofisial')
                ->with('success', 'Ofisial berhasil ditambahkan. Password default: ofisial2025');
        } catch (\Exception $e) {
            $this->userModel->transRollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Edit ofisial
     */
    public function edit($id)
    {
        $ofisial = $this->ofisialModel->find($id);

        if (!$ofisial) {
            return redirect()->to('admin/ofisial')
                ->with('error', 'Ofisial tidak ditemukan');
        }

        $user = $this->userModel->find($ofisial['id_user']);

        $data = [
            'title' => 'Edit Ofisial',
            'ofisial' => $ofisial,
            'user' => $user,
        ];

        return view('admin/ofisial/edit', $data);
    }

    /**
     * Update ofisial
     */
    public function update($id)
    {
        $ofisial = $this->ofisialModel->find($id);

        if (!$ofisial) {
            return redirect()->to('admin/ofisial')
                ->with('error', 'Ofisial tidak ditemukan');
        }

        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'no_hp' => 'required|min_length[10]|max_length[15]',
            'nomor_lisensi' => 'required|min_length[5]|max_length[50]',
            'status' => 'required|in_list[aktif,nonaktif]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        try {
            $this->userModel->transBegin();

            // Update user
            $this->userModel->update($ofisial['id_user'], [
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('no_hp'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ]);

            // Update ofisial
            $this->ofisialModel->update($id, [
                'nomor_lisensi' => $this->request->getPost('nomor_lisensi'),
                'status' => $this->request->getPost('status'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ]);

            $this->userModel->transCommit();

            return redirect()->to('admin/ofisial')
                ->with('success', 'Ofisial berhasil diperbarui');
        } catch (\Exception $e) {
            $this->userModel->transRollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Delete ofisial
     */
    public function delete($id)
    {
        $ofisial = $this->ofisialModel->find($id);

        if (!$ofisial) {
            return redirect()->to('admin/ofisial')
                ->with('error', 'Ofisial tidak ditemukan');
        }

        try {
            $this->userModel->transBegin();

            // Delete assignments
            $this->assignmentModel->where('id_ofisial', $id)->delete();

            // Delete ofisial
            $this->ofisialModel->delete($id);

            // Delete user
            $this->userModel->delete($ofisial['id_user']);

            $this->userModel->transCommit();

            return redirect()->to('admin/ofisial')
                ->with('success', 'Ofisial berhasil dihapus');
        } catch (\Exception $e) {
            $this->userModel->transRollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Assign ofisial to event
     */
    public function assignEvent()
    {
        $data = [
            'title' => 'Assign Ofisial ke Turnamen',
            'ofisials' => $this->ofisialModel->getOfisialAktif(),
            'events' => $this->eventModel->where('status', 'aktif')->findAll(),
        ];

        return view('admin/ofisial/assign_event', $data);
    }

    /**
     * Store assignment
     */
    public function storeAssignment()
    {
        $rules = [
            'id_ofisial' => 'required|numeric',
            'id_event' => 'required|numeric',
            'role_assignment' => 'required|in_list[wasit,juri,pencatat,verifikator]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $idOfisial = $this->request->getPost('id_ofisial');
        $idEvent = $this->request->getPost('id_event');

        // Check if already assigned
        if ($this->assignmentModel->isAssigned($idOfisial, $idEvent)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ofisial sudah ditugaskan ke turnamen ini');
        }

        $data = [
            'id_ofisial' => $idOfisial,
            'id_event' => $idEvent,
            'role_assignment' => $this->request->getPost('role_assignment'),
            'status' => 'aktif',
            'dibuat_pada' => date('Y-m-d H:i:s'),
            'diperbarui_pada' => date('Y-m-d H:i:s'),
        ];

        if ($this->assignmentModel->insert($data)) {
            return redirect()->to('admin/ofisial/assignment')
                ->with('success', 'Ofisial berhasil ditugaskan ke turnamen');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menugaskan ofisial');
        }
    }

    /**
     * List assignments
     */
    public function assignment()
    {
        $data = [
            'title' => 'Penugasan Ofisial',
            'assignments' => $this->assignmentModel->getAssignmentWithDetails(),
        ];

        return view('admin/ofisial/assignment', $data);
    }

    /**
     * Delete assignment
     */
    public function deleteAssignment($id)
    {
        $assignment = $this->assignmentModel->find($id);

        if (!$assignment) {
            return redirect()->to('admin/ofisial/assignment')
                ->with('error', 'Penugasan tidak ditemukan');
        }

        if ($this->assignmentModel->delete($id)) {
            return redirect()->to('admin/ofisial/assignment')
                ->with('success', 'Penugasan berhasil dihapus');
        } else {
            return redirect()->back()
                ->with('error', 'Gagal menghapus penugasan');
        }
    }

    /**
     * Generate UUID v4
     */
    private function generateUUID()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
