<?php

namespace App\Http\Controllers;

use App\Models\DataIku;
use App\Models\Indikator;
use App\Models\IndikatorPenunjang;
use App\Models\SubIndikator;
use App\Models\Triwulan;
use App\Models\Tujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class OperatorController extends Controller
{
    public function view_master_data(Request $request)
    {
        $bidangId = Auth::user()->bidang_id;
        $iku = Tujuan::where('iku', 0)
            ->with(['sasaran.indikator.indikator_penunjang', 'sasaran.indikator.sub_indikator' => function ($query) use ($bidangId) {
                $query->where('bidang_id', $bidangId);
            }])
            ->get();
        $iku_sup = Tujuan::where('iku', 1)
            ->with(['sasaran.indikator.indikator_penunjang', 'sasaran.indikator.sub_indikator' => function ($query) use ($bidangId) {
                $query->where('bidang_id', $bidangId);
            }])
            ->get();
        $triwulan = Triwulan::all();

        // Mendapatkan nomor triwulan dari query parameter
        $selectedTriwulan = $request->query('triwulan', null);

        // Mengambil status triwulan dari database
        $triwulanStatus = Triwulan::find($selectedTriwulan)->status ?? null;

        // Memeriksa apakah triwulan memiliki status 'close'
        if ($triwulanStatus === 'close') {
            // Jika triwulan memiliki status 'close', lakukan redirect atau tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Data untuk triwulan ' . $selectedTriwulan . ' tidak tersedia.');
        }

        // Filter DataIku based on selected triwulan
        $existingDataSubIndikator = DataIku::when($selectedTriwulan, function ($query, $selectedTriwulan) {
            return $query->where('triwulan_id', $selectedTriwulan);
        })->pluck('sub_indikator_id')->toArray();

        $existingDataIndikatorPenunjang = DataIku::when($selectedTriwulan, function ($query, $selectedTriwulan) {
            return $query->where('triwulan_id', $selectedTriwulan);
        })->pluck('indikator_penunjang_id')->toArray();

        $existingDataIndikator = DataIku::when($selectedTriwulan, function ($query, $selectedTriwulan) {
            return $query->where('triwulan_id', $selectedTriwulan);
        })->pluck('indikator_id')->toArray();

        $existingDataSubIndikatorApproved = DataIku::when($selectedTriwulan, function ($query, $selectedTriwulan) {
            return $query->where('triwulan_id', $selectedTriwulan)
                ->Where('status', 'approved');
        })->pluck('sub_indikator_id')->toArray();

        $existingDataIndikatorPenunjangApproved = DataIku::when($selectedTriwulan, function ($query, $selectedTriwulan) {
            return $query->where('triwulan_id', $selectedTriwulan)
                ->Where('status', 'approved');
        })->pluck('indikator_penunjang_id')->toArray();

        $existingDataIndikatorApproved = DataIku::when($selectedTriwulan, function ($query, $selectedTriwulan) {
            return $query->where('triwulan_id', $selectedTriwulan)
                ->Where('status', 'approved');
        })->pluck('indikator_id')->toArray();

        return view('operator.dashboard', [
            'iku' => $iku,
            'iku_sup' => $iku_sup,
            'triwulan' => $triwulan,
            'triwulanStatus' => $triwulanStatus,
            'existingDataSubIndikator' => $existingDataSubIndikator,
            'existingDataIndikatorPenunjang' => $existingDataIndikatorPenunjang,
            'existingDataIndikator' => $existingDataIndikator,
            'selectedTriwulan' => $selectedTriwulan,
            'existingDataSubIndikatorApproved' => $existingDataSubIndikatorApproved,
            'existingDataIndikatorPenunjangApproved' => $existingDataIndikatorPenunjangApproved,
            'existingDataIndikatorApproved' => $existingDataIndikatorApproved
        ]);
    }


    public function view_add_master_data(Request $request, $type, $id)
    {
        // Fetch entity based on type and id
        if ($type === 'sub_indikator') {
            $entity = SubIndikator::find($id);
            $entityName = $entity->sub_indikator ?? null;
        } elseif ($type === 'indikator_penunjang') {
            $entity = IndikatorPenunjang::find($id);
            $entityName = $entity->indikator_penunjang ?? null;
        } elseif ($type === 'indikator') {
            $entity = Indikator::find($id);
            $entityName = $entity->indikator ?? null;
        } else {
            $entity = null;
            $entityName = null;
        }

        if (!$entity) {
            return redirect()->back()->with('error', 'Entitas tidak ditemukan');
        }

        $triwulan = Triwulan::all();
        $selectedTriwulan = $request->query('triwulan', null);
        $triwulanStatus = Triwulan::find($selectedTriwulan)->status ?? null;

        // Memeriksa apakah triwulan memiliki status 'close'
        if ($triwulanStatus === 'close') {
            // Jika triwulan memiliki status 'close', lakukan redirect atau tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Data untuk triwulan ' . $selectedTriwulan . ' tidak tersedia.');
        }

        return view('operator.tambah-master-data', [
            'entityType' => $type,
            'entityName' => $entityName,
            'entityId' => $id,
            'triwulan' => $triwulan,
            'selectedTriwulan' => $selectedTriwulan,
            'triwulanStatus' => $triwulanStatus,
        ]);
    }



    public function view_edit_master_data(Request $request, $type, $id)
    {
        $triwulan_id = $request->input('triwulan');

        // Fetch entity based on type and id
        if ($type === 'sub_indikator') {
            $entity = SubIndikator::find($id);
            $entityName = $entity->sub_indikator ?? null;
        } elseif ($type === 'indikator_penunjang') {
            $entity = IndikatorPenunjang::find($id);
            $entityName = $entity->indikator_penunjang ?? null;
        } elseif ($type === 'indikator') {
            $entity = Indikator::find($id);
            $entityName = $entity->indikator ?? null;
        } else {
            $entity = null;
            $entityName = null;
        }

        if (!$entity) {
            return redirect()->back()->with('error', 'Entitas tidak ditemukan');
        }

        // Fetch DataIku based on entity id and triwulan_id
        $dataIku = DataIku::where(function ($query) use ($id, $type) {
            if ($type === 'sub_indikator') {
                $query->where('sub_indikator_id', $id);
            } elseif ($type === 'indikator_penunjang') {
                $query->where('indikator_penunjang_id', $id);
            } elseif ($type === 'indikator') {
                $query->where('indikator_id', $id);
            }
        })
            ->where('triwulan_id', $triwulan_id)
            ->first();

        if (!$dataIku) {
            return redirect()->back()->with('error', 'Data IKU tidak ditemukan');
        }

        $selectedTriwulan = $request->query('triwulan', null);
        $triwulanStatus = Triwulan::find($selectedTriwulan)->status ?? null;

        // Memeriksa apakah triwulan memiliki status 'close'
        if ($triwulanStatus === 'close') {
            // Jika triwulan memiliki status 'close', lakukan redirect atau tampilkan pesan kesalahan
            return redirect()->back()->with([
                'error' => [
                    "title" => "Cannot Edit Data",
                    "message" => "Triwulan sedang ditutup"
                ]
            ]);
        }

        return view('operator.edit-master-data', [
            'entityType' => $type,
            'entityName' => $entityName,
            'entityId' => $id,
            'dataIku' => $dataIku,
            'triwulan' => $triwulan_id,
            'triwulanStatus' => $triwulanStatus
        ]);
    }


    public function add_master_data(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'perjanjian_kinerja_target_kumulatif' => 'required|integer',
            'perjanjian_kinerja_realisasi_kumulatif' => 'required|integer',
            'capaian_kinerja_kumulatif' => 'required|numeric',
            'link_bukti_dukung_capaian' => 'required|string',
            'upaya_yang_dilakukan' => 'required|string',
            'link_bukti_dukung_upaya_yang_dilakukan' => 'required|string',
            'kendala' => 'required|string',
            'solusi_atas_kendala' => 'required|string',
            'rencana_tidak_lanjut' => 'required|string',
            'pic_tidak_lanjut' => 'required|string',
            'tenggat_tidak_lanjut' => 'required|date',
            'triwulan' => 'required|integer|exists:triwulan,id', // Pastikan triwulan valid
            'type' => 'required|string|in:sub_indikator,indikator_penunjang,indikator',
            'entity_id' => 'required|integer'
        ]);

        try {
            // Simpan data ke database dengan status awal `pending_approval`
            $dataIku = new DataIku();
            $dataIku->perjanjian_kinerja_target_kumulatif = $request->input('perjanjian_kinerja_target_kumulatif');
            $dataIku->perjanjian_kinerja_realisasi_kumulatif = $request->input('perjanjian_kinerja_realisasi_kumulatif');
            $dataIku->capaian_kinerja_kumulatif = $request->input('capaian_kinerja_kumulatif');

            // Hitung target setahun jika triwulan 4
            if ($request->input('triwulan') == 4) {
                $dataIku->capaian_kinerja_target_setahun = $request->input('perjanjian_kinerja_target_kumulatif') / 4;
            } else {
                $dataIku->capaian_kinerja_target_setahun = 0; // Atau nilai default lainnya
            }

            $dataIku->link_bukti_dukung_capaian = $request->input('link_bukti_dukung_capaian');
            $dataIku->upaya_yang_dilakukan = $request->input('upaya_yang_dilakukan');
            $dataIku->link_bukti_dukung_upaya_yang_dilakukan = $request->input('link_bukti_dukung_upaya_yang_dilakukan');
            $dataIku->kendala = $request->input('kendala');
            $dataIku->solusi_atas_kendala = $request->input('solusi_atas_kendala');
            $dataIku->rencana_tidak_lanjut = $request->input('rencana_tidak_lanjut');
            $dataIku->pic_tidak_lanjut = $request->input('pic_tidak_lanjut');
            $dataIku->tenggat_tidak_lanjut = $request->input('tenggat_tidak_lanjut');
            $dataIku->status = 'pending_approval'; // Status awal: Menunggu Admin Approval
            $dataIku->upload_by = Auth::id();
            $dataIku->triwulan_id = $request->input('triwulan');
            $dataIku->entity_id = $request->input('entity_id');

            // Menentukan entitas berdasarkan type
            $type = $request->input('type');
            $entity_id = $request->input('entity_id');

            if ($type === 'sub_indikator') {
                $dataIku->sub_indikator_id = $entity_id;
            } elseif ($type === 'indikator_penunjang') {
                $dataIku->indikator_penunjang_id = $entity_id;
            } elseif ($type === 'indikator') {
                $dataIku->indikator_id = $entity_id;
            }

            // Simpan data
            $dataIku->save();

            return redirect()->back()->with([
                'success' => [
                    "title" => "Data Submitted Successfully",
                    "message" => "Data berhasil diisi dan menunggu persetujuan Admin Approval."
                ]
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])->withInput();
        }
    }


    public function update_master_data(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'perjanjian_kinerja_target_kumulatif' => 'required|integer',
            'perjanjian_kinerja_realisasi_kumulatif' => 'required|integer',
            'capaian_kinerja_kumulatif' => 'required|numeric',
            'capaian_kinerja_target_setahun' => 'required|numeric',
            'link_bukti_dukung_capaian' => 'required|string',
            'upaya_yang_dilakukan' => 'required|string',
            'link_bukti_dukung_upaya_yang_dilakukan' => 'required|string',
            'kendala' => 'required|string',
            'solusi_atas_kendala' => 'required|string',
            'rencana_tidak_lanjut' => 'required|string',
            'pic_tidak_lanjut' => 'required|string',
            'tenggat_tidak_lanjut' => 'required|date',
        ]);

        // Cari data yang akan diupdate
        $data = DataIku::findOrFail($id);

        // Memeriksa apakah semua input sama dengan nilai sebelumnya
        if (
            $data->perjanjian_kinerja_target_kumulatif == $request->input('perjanjian_kinerja_target_kumulatif') &&
            $data->perjanjian_kinerja_realisasi_kumulatif == $request->input('perjanjian_kinerja_realisasi_kumulatif') &&
            $data->capaian_kinerja_kumulatif == $request->input('capaian_kinerja_kumulatif') &&
            $data->capaian_kinerja_target_setahun == $request->input('capaian_kinerja_target_setahun') &&
            $data->link_bukti_dukung_capaian == $request->input('link_bukti_dukung_capaian') &&
            $data->upaya_yang_dilakukan == $request->input('upaya_yang_dilakukan') &&
            $data->link_bukti_dukung_upaya_yang_dilakukan == $request->input('link_bukti_dukung_upaya_yang_dilakukan') &&
            $data->kendala == $request->input('kendala') &&
            $data->solusi_atas_kendala == $request->input('solusi_atas_kendala') &&
            $data->rencana_tidak_lanjut == $request->input('rencana_tidak_lanjut') &&
            $data->pic_tidak_lanjut == $request->input('pic_tidak_lanjut') &&
            $data->tenggat_tidak_lanjut == $request->input('tenggat_tidak_lanjut')
        ) {
            return redirect()->back()->with([
                'warning' => [
                    "title" => "No Changes Made",
                    "message" => "Tidak ada perubahan yang dilakukan."
                ]
            ]);
        }

        // Menentukan status setelah update
        $newStatus = 'pending_approval';

        // Memperbarui data
        $data->update([
            'perjanjian_kinerja_target_kumulatif' => $request->input('perjanjian_kinerja_target_kumulatif'),
            'perjanjian_kinerja_realisasi_kumulatif' => $request->input('perjanjian_kinerja_realisasi_kumulatif'),
            'capaian_kinerja_kumulatif' => $request->input('capaian_kinerja_kumulatif'),
            'capaian_kinerja_target_setahun' => $request->input('capaian_kinerja_target_setahun'),
            'link_bukti_dukung_capaian' => $request->input('link_bukti_dukung_capaian'),
            'upaya_yang_dilakukan' => $request->input('upaya_yang_dilakukan'),
            'link_bukti_dukung_upaya_yang_dilakukan' => $request->input('link_bukti_dukung_upaya_yang_dilakukan'),
            'kendala' => $request->input('kendala'),
            'solusi_atas_kendala' => $request->input('solusi_atas_kendala'),
            'rencana_tidak_lanjut' => $request->input('rencana_tidak_lanjut'),
            'pic_tidak_lanjut' => $request->input('pic_tidak_lanjut'),
            'tenggat_tidak_lanjut' => $request->input('tenggat_tidak_lanjut'),
            'upload_by' => Auth::id(),
            'status' => $newStatus, // Mengatur status menjadi pending_approval setelah update
        ]);

        // Menghapus komentar penolakan jika ada
        if ($data->reject_comment) {
            $data->update(['reject_comment' => null]);
        }

        try {
            // Memasukkan data ke dalam database
            $data->save();

            return redirect()->back()->with([
                'success' => [
                    "title" => "Data Updated Successfully",
                    "message" => "Data berhasil diperbarui dan dikirim ulang."
                ]
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->withErrors(['error' => 'Duplikat entri terdeteksi. Data dengan ID yang sama sudah ada.'])->withInput();
            }
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
    }


    /**
     * Menampilkan data pending yang diinput oleh operator.
     */
    public function view_uploaded_master_data(Request $request)
    {
        $search = $request->input('search');
        $bidangId = Auth::user()->bidang_id;

        $dataIkuQuery = DataIku::whereIn('status', ['pending_approval', 'pending_binagram'])
            ->where(function ($query) use ($bidangId) {
                $query->whereHas('sub_indikator', function ($q) use ($bidangId) {
                    $q->whereNull('bidang_id')->orWhere('bidang_id', $bidangId);
                })
                    ->orWhereHas('indikator', function ($q) use ($bidangId) {
                        $q->whereNull('bidang_id')->orWhere('bidang_id', $bidangId);
                    });
            })
            ->with(['sub_indikator', 'indikator_penunjang', 'indikator', 'user'])
            ->orderBy('created_at', 'desc');

        if ($search) {
            $dataIkuQuery->where(function ($query) use ($search) {
                $query->whereHas('sub_indikator', function ($q) use ($search) {
                    $q->where('sub_indikator', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('indikator_penunjang', function ($q) use ($search) {
                        $q->where('indikator_penunjang', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('indikator', function ($q) use ($search) {
                        $q->where('indikator', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }


        $dataIku = $dataIkuQuery->paginate(5);

        return view('operator.pending-master-data', compact('dataIku'));
    }


    /**
     * Menampilkan data yang sudah diapprove oleh Binagram.
     */
    public function view_approved_master_data(Request $request)
    {
        $search = $request->input('search');
        $bidangId = Auth::user()->bidang_id;

        $dataIkuQuery = DataIku::where('status', DataIku::STATUS_APPROVED)
            ->whereNotNull('approve_by_binagram')
            ->where(function ($query) use ($bidangId) {
                $query->whereHas('sub_indikator', function ($q) use ($bidangId) {
                    $q->whereNull('bidang_id')->orWhere('bidang_id', $bidangId);
                })
                    ->orWhereHas('indikator', function ($q) use ($bidangId) {
                        $q->whereNull('bidang_id')->orWhere('bidang_id', $bidangId);
                    });
            })
            ->with([
                'sub_indikator',
                'indikator_penunjang',
                'indikator',
                'user',
                'approved_by' => function ($query) {
                    $query->with('bidang');
                }
            ])
            ->orderBy('created_at', 'desc');

        if ($search) {
            $dataIkuQuery->where(function ($query) use ($search) {
                $query->whereHas('sub_indikator', function ($q) use ($search) {
                    $q->where('sub_indikator', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('indikator_penunjang', function ($q) use ($search) {
                        $q->where('indikator_penunjang', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('indikator', function ($q) use ($search) {
                        $q->where('indikator', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $dataIku = $dataIkuQuery->paginate(5);

        return view('operator.approved-master-data', [
            'dataIku' => $dataIku,
        ]);
    }

    /**
     * Menampilkan data yang ditolak oleh Admin Approval **dan** Binagram.
     */
    public function view_rejected_master_data(Request $request)
    {
        $search = $request->input('search');

        $dataIkuQuery = DataIku::whereIn('status', ['rejected_approval', 'rejected_binagram'])
            ->with(['sub_indikator', 'indikator_penunjang', 'indikator', 'user'])
            ->orderBy('updated_at', 'desc');

        if ($search) {
            $dataIkuQuery->where(function ($query) use ($search) {
                $query->whereHas('sub_indikator', function ($q) use ($search) {
                    $q->where('sub_indikator', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('indikator_penunjang', function ($q) use ($search) {
                        $q->where('indikator_penunjang', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('indikator', function ($q) use ($search) {
                        $q->where('indikator', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }


        $dataIku = $dataIkuQuery->paginate(5);

        return view('operator.rejected-master-data', compact('dataIku'));
    }
}
