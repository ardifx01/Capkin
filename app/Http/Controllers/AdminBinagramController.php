<?php

namespace App\Http\Controllers;

use App\Models\DataIku;
use App\Models\Indikator;
use App\Models\IndikatorPenunjang;
use App\Models\SubIndikator;
use App\Models\Triwulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sasaran;
use App\Models\Tujuan;
use App\Models\Bidang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminBinagramController extends Controller
{
    public function view_master_data()
    {
        $iku = Tujuan::where('iku', 0)->with(['sasaran.indikator.indikator_penunjang', 'sasaran.indikator.sub_indikator'])->get();
        $iku_sup = Tujuan::where('iku', 1)->with(['sasaran.indikator.indikator_penunjang', 'sasaran.indikator.sub_indikator'])->get();
        $triwulan = Triwulan::all();

        return view('adminbinagram.dashboard', [
            'iku' => $iku,
            'iku_sup' => $iku_sup,
            'triwulan' => $triwulan
        ]);
    }

    public function store(Request $request)
    {
        if ($request->has('tujuan') && $request->has('iku')) {
            // Logika untuk menyimpan tujuan
            $request->validate([
                'tujuan' => 'required|min:6',
                'iku' => 'required',
            ]);

            $tujuan = new Tujuan();
            $tujuan->tujuan = $request->tujuan;
            $tujuan->iku = $request->iku;

            if ($tujuan->save()) {
                return response()->json(['message' => 'Data tujuan berhasil dimasukkan'], 200);
            } else {
                return response()->json(['message' => 'Gagal memasukkan data tujuan'], 500);
            }
        } else if ($request->has('sasaran') && $request->has('tujuan_id')) {
            // Logika untuk menyimpan sasaran
            $request->validate([
                'sasaran' => 'required|min:6',
                'tujuan_id' => 'required',
            ]);

            $sasaran = new Sasaran();
            $sasaran->sasaran = $request->sasaran;
            $sasaran->tujuan_id = $request->tujuan_id;

            if ($sasaran->save()) {
                return response()->json(['message' => 'Data sasaran berhasil dimasukkan'], 200);
            } else {
                return response()->json(['message' => 'Gagal memasukkan data sasaran'], 500);
            }
        } else if ($request->has('indikator') && $request->has('sasaran_id')) {
            // Logika untuk menyimpan indikator, indikator penunjang, dan sub indikator
            $request->validate([
                'indikator' => 'required|min:6',
                'sasaran_id' => 'required',
            ]);

            try {
                DB::transaction(function () use ($request) {
                    $indikator = new Indikator();
                    $indikator->indikator = $request->indikator;
                    $indikator->sasaran_id = $request->sasaran_id;
                    $indikator->save();

                    $indikatorPenunjang = null;
                    if ($request->input('indikator_penunjang') !== null) {
                        $indikatorPenunjang = new IndikatorPenunjang();
                        $indikatorPenunjang->indikator_penunjang = $request->indikator_penunjang;
                        $indikatorPenunjang->indikator_id = $indikator->id;
                        $indikatorPenunjang->save();
                    }

                    if ($request->input('sub_indikator') !== null) {
                        $sub_indikator = new SubIndikator();
                        $sub_indikator->sub_indikator = $request->sub_indikator;
                        $sub_indikator->indikator_id = $indikator->id;
                        $sub_indikator->indikator_penunjang_id = $indikatorPenunjang ? $indikatorPenunjang->id : null;
                        $sub_indikator->bidang_id = $request->has('bidang_id') ? $request->bidang_id : null;
                        $sub_indikator->save();
                    }
                });

                return response()->json(['message' => 'Data indikator berhasil dimasukkan'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Gagal memasukkan data indikator', 'error' => $e->getMessage()], 500);
            }
        } elseif ($request->has('indikator_penunjang') && $request->has('indikator_id')) {
            // Logika untuk menyimpan indikator penunjang dan sub indikator
            $request->validate([
                'indikator_id' => 'required',
            ]);

            try {
                DB::transaction(function () use ($request) {
                    $indikator_penunjang = null;
                    if ($request->input('indikator_penunjang') !== null) {
                        $indikator_penunjang = new IndikatorPenunjang();
                        $indikator_penunjang->indikator_penunjang = $request->indikator_penunjang;
                        $indikator_penunjang->indikator_id = $request->indikator_id;
                        $indikator_penunjang->save();
                    }

                    $sub_indikator = null;
                    if ($request->input('sub_indikator') !== null) {
                        $sub_indikator = new SubIndikator();
                        $sub_indikator->sub_indikator = $request->sub_indikator;
                        $sub_indikator->indikator_penunjang_id = $indikator_penunjang ? $indikator_penunjang->id : null;
                        $sub_indikator->indikator_id = $request->indikator_id;
                        $sub_indikator->bidang_id = $request->has('bidang_id') ? $request->bidang_id : null;
                        $sub_indikator->save();
                    }
                });

                return response()->json(['message' => 'Data indikator berhasil dimasukkan'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Gagal memasukkan data indikator', 'error' => $e->getMessage()], 500);
            }
        } else if ($request->has('sub_indikator') && ($request->has('indikator_id') || $request->has('indikator_penunjang_id'))) {
            // Logika untuk menyimpan sub indikator
            $request->validate([
                'sub_indikator' => 'required|min:6',
                'indikator_id' => 'sometimes|nullable',
                'indikator_penunjang_id' => 'sometimes|nullable',
            ]);

            try {
                DB::transaction(function () use ($request) {
                    $sub_indikator = new SubIndikator();
                    $sub_indikator->sub_indikator = $request->sub_indikator;
                    $sub_indikator->indikator_id = $request->has('indikator_id') ? $request->indikator_id : null;
                    $sub_indikator->indikator_penunjang_id = $request->has('indikator_penunjang_id') ? $request->indikator_penunjang_id : null;
                    $sub_indikator->bidang_id = $request->has('bidang_id') ? $request->bidang_id : null;
                    $sub_indikator->save();
                });

                return response()->json(['message' => 'Data sub indikator berhasil dimasukkan'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Gagal memasukkan data sub indikator', 'error' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['message' => 'Permintaan tidak valid'], 400);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->has('tujuan')) {
            $request->validate([
                'tujuan' => 'required|min:6',
            ]);

            $tujuan = Tujuan::findOrFail($id);
            $tujuan->tujuan = $request->tujuan;
            $tujuan->save();

            return response()->json(['message' => 'Data tujuan berhasil diperbarui'], 200);
        } elseif ($request->has('sasaran')) {
            $request->validate([
                'sasaran' => 'required|min:6',
            ]);

            $sasaran = Sasaran::findOrFail($id);
            $sasaran->sasaran = $request->sasaran;
            $sasaran->save();

            return response()->json(['message' => 'Data sasaran berhasil diperbarui'], 200);
        } elseif ($request->has('indikator')) {
            $request->validate([
                'indikator' => 'required|min:6'
            ]);

            $indikator = Indikator::findOrFail($id);
            $indikator->indikator = $request->indikator;
            $indikator->save();

            return response()->json(['message' => 'Data indikator berhasil diperbarui'], 200);
        } elseif ($request->has('indikator_penunjang')) {
            $request->validate([
                'indikator_penunjang' => 'required|min:6'
            ]);

            $indikator_penunjang = IndikatorPenunjang::findOrFail($id);
            $indikator_penunjang->indikator_penunjang = $request->indikator_penunjang;
            $indikator_penunjang->save();

            return response()->json(['message' => 'Data indikator penunjang berhasil diperbarui'], 200);
        } elseif ($request->has('sub_indikator')) {
            $request->validate([
                'sub_indikator' => 'required|min:6'
            ]);

            $sub_indikator = SubIndikator::findOrFail($id);
            $sub_indikator->sub_indikator = $request->sub_indikator;
            $sub_indikator->bidang_id = $request->has('bidang_id') ? $request->bidang_id : null;
            $sub_indikator->save();

            return response()->json(['message' => 'Data indikator penunjang berhasil diperbarui'], 200);
        } else {
            return response()->json(['message' => 'Permintaan tidak valid'], 400);
        }
    }

    public function delete($id)
    {
        try {
            if (request()->has('is_sasaran') && request()->is_sasaran) {
                $sasaran = Sasaran::findOrFail($id);
                $sasaran->delete();

                return response()->json(['message' => 'Data sasaran berhasil dihapus'], 200);
            } elseif (request()->has('is_indikator') && request()->is_indikator) {
                $indikator = Indikator::findOrFail($id);
                $indikator->delete();

                return response()->json(['message' => 'Data indikator berhasil dihapus'], 200);
            } elseif (request()->has('is_indikator_penunjang') && request()->is_indikator_penunjang) {
                $indikator_penunjang = IndikatorPenunjang::findOrFail($id);
                $indikator_penunjang->delete();

                return response()->json(['message' => 'Data indikator penunjang berhasil dihapus'], 200);
            } elseif (request()->has('is_sub_indikator') && request()->is_sub_indikator) {
                $sub_indikator = SubIndikator::findOrFail($id);
                $sub_indikator->delete();

                return response()->json(['message' => 'Data sub indikator berhasil dihapus'], 200);
            } else {
                $tujuan = Tujuan::findOrFail($id);
                $tujuan->delete();

                return response()->json(['message' => 'Data tujuan berhasil dihapus'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data'], 500);
        }
    }

    public function activate_triwulan($id)
    {
        try {
            $triwulan = Triwulan::findOrFail($id);

            // Toggle status (close to open, or open to close)
            $triwulan->status = $triwulan->status === 'close' ? 'open' : 'close';
            $triwulan->save();

            return response()->json(['success' => true, 'message' => 'Status triwulan berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status triwulan.']);
        }
    }

    public function view_uploaded_master_data(Request $request)
    {
        $search = $request->input('search');
        $bidangId = Auth::user()->bidang_id;

        // Inisialisasi query
        $dataIkuQuery = DataIku::whereIn('status', ['pending_approval', 'pending_binagram'])
            ->with(['sub_indikator', 'indikator_penunjang', 'indikator', 'user'])
            ->orderBy('created_at', 'desc');

        // Tambahkan kondisi pencarian jika ada
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

        // Paginate the results
        $dataIku = $dataIkuQuery->paginate(5);

        // Return view dengan data
        return view('adminbinagram.pending-master-data', compact('dataIku'));
    }

    public function view_approved_master_data(Request $request)
    {
        $search = $request->input('search');
        $bidangId = Auth::user()->bidang_id;

        $dataIkuQuery = DataIku::where('status', 'approved')
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

        return view('adminbinagram.approved-master-data', compact('dataIku'));
    }


    public function view_rejected_master_data(Request $request)
    {
        $search = $request->input('search');
        $bidangId = Auth::user()->bidang_id;

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

        return view('adminbinagram.rejected-master-data', compact('dataIku'));
    }


    public function filter_by_bidang(Request $request)
    {
        $filter_bidang = $request->input('filter_bidang');



        // Inisialisasi query
        $dataIkuQuery = DataIku::where('status', 'approved')
            ->with(['sub_indikator', 'indikator_penunjang', 'indikator', 'user', 'approved_by'])
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan bidang
        if ($filter_bidang) {
            $dataIkuQuery->whereHas('user', function ($query) use ($filter_bidang) {
                $query->where('bidang_id', $filter_bidang);
            });
        }

        // Mengambil daftar bidang kecuali "Pimpinan"
        $bidangList = Bidang::where('nama_bidang', '!=', 'Pimpinan')->get();

        // Paginate the results setelah semua filter diterapkan
        $dataIku = $dataIkuQuery->paginate(5);

        $bidangList = Bidang::all();

        // Return view with the data
        return view('adminbinagram.pending-master-data', [
            'dataIku' => $dataIku,
            'bidangList' => $bidangList,
            'filter_bidang' => $filter_bidang
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

        // Fetch DataIku based on entity id
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

        return view('adminbinagram.edit-master-data', [
            'entityType' => $type,
            'entityName' => $entityName,
            'entityId' => $id,
            'dataIku' => $dataIku,
            'triwulan' => $triwulan_id,
            'triwulanStatus' => $triwulanStatus
        ]);
    }

    public function approve_data($id)
    {
        $dataIku = DataIku::find($id);

        if ($dataIku && $dataIku->status === DataIku::STATUS_PENDING_BINAGRAM && is_null($dataIku->approve_by_binagram)) {
            $dataIku->update([
                'status' => DataIku::STATUS_APPROVED,
                'approve_by_binagram' => Auth::id()
            ]);

            return response()->json(['success' => [
                "title" => "Data Approved Successfully",
                "message" => "Data berhasil disetujui."
            ]], 200);
        }

        return response()->json(['error' => [
            "title" => "Approval Failed",
            "message" => "Data tidak ditemukan atau sudah disetujui."
        ]], 400);
    }
    public function dashboard_ab()
    {
        // Mengambil data IKU
        $iku = Tujuan::where('iku', 0)
            ->whereIn('id', [1, 2, 3, 4])
            ->with(['sasaran.indikator.indikator_penunjang.sub_indikator.bidang'])
            ->get();

        $iku_sup = Tujuan::where('iku', 1)
            ->with(['sasaran.indikator.indikator_penunjang', 'sasaran.indikator.sub_indikator'])
            ->get();

        // Mengambil data berdasarkan sub-indikator yang disetujui
        $data_iku_by_sub_indikator = DataIku::where('status', 'approved')
            ->select(
                'sub_indikator_id',
                'link_bukti_dukung_capaian',
                'upaya_yang_dilakukan',
                'link_bukti_dukung_upaya_yang_dilakukan',
                'kendala',
                'solusi_atas_kendala',
                'rencana_tidak_lanjut',
                'pic_tidak_lanjut',
                'tenggat_tidak_lanjut'
            )
            ->get()
            ->groupBy('sub_indikator_id');

        // Mengelompokkan data penunjang berdasarkan triwulan
        $data_iku_by_triwulan = DataIku::where('status', 'approved')
            ->select(
                'sub_indikator_id',
                'triwulan_id',
                'perjanjian_kinerja_target_kumulatif',
                'perjanjian_kinerja_realisasi_kumulatif',
                'capaian_kinerja_kumulatif',
                'capaian_kinerja_target_setahun'
            )
            ->get()
            ->groupBy('sub_indikator_id');

        // Mengelompokkan data berdasarkan triwulan_id
        $data_penunjang_by_triwulan = $data_iku_by_triwulan->map(function ($items) {
            return $items->groupBy('triwulan_id');
        });

        // Mengambil data indikator
        $indikator = Indikator::all();

        //Menghitung sub-indikator yang belum terisi
        $bidang_counts_unfil = DB::table('md_sub_indikator')
            ->leftJoin('data_iku', 'md_sub_indikator.id', '=', 'data_iku.sub_indikator_id')
            ->select('md_sub_indikator.bidang_id', DB::raw('count(md_sub_indikator.id) as total'), DB::raw('count(data_iku.id) as filled'))
            ->groupBy('md_sub_indikator.bidang_id')
            ->get()
            ->keyBy('bidang_id')
            ->map(function ($item) {
                return $item->total - $item->filled;
            });


        // Menghitung sub-indikator yang terisi berdasarkan triwulan
        $bidang_counts = DB::table('md_sub_indikator')
            ->leftJoin('data_iku', 'md_sub_indikator.id', '=', 'data_iku.sub_indikator_id')
            ->select('md_sub_indikator.bidang_id', 'data_iku.triwulan_id', DB::raw('count(data_iku.id) as filled'))
            ->where('data_iku.status', 'approved') // Tambahkan kondisi ini
            ->whereIn('data_iku.triwulan_id', [1, 2, 3, 4])
            ->groupBy('md_sub_indikator.bidang_id', 'data_iku.triwulan_id')
            ->get()
            ->groupBy('bidang_id', 'triwulan_id');

        // Menghitung total realisasi kumulatif per triwulan untuk setiap bidang
        $realisasi_total_by_bidang = DB::table('md_sub_indikator')
            ->leftJoin('data_iku', 'md_sub_indikator.id', '=', 'data_iku.sub_indikator_id')
            ->select('md_sub_indikator.bidang_id', 'data_iku.triwulan_id', DB::raw('sum(data_iku.perjanjian_kinerja_realisasi_kumulatif) as total_realisasi'))
            ->where('data_iku.status', 'approved')
            ->whereIn('data_iku.triwulan_id', [1, 2, 3, 4])
            ->groupBy('md_sub_indikator.bidang_id', 'data_iku.triwulan_id')
            ->get()
            ->groupBy('bidang_id');


        // Menghitung total target kumulatif per triwulan untuk setiap bidang dan indikator penunjang
        $target_total_by_indikator_penunjang = DB::table('md_sub_indikator')
            ->leftJoin('data_iku', 'md_sub_indikator.id', '=', 'data_iku.sub_indikator_id')
            ->select('md_sub_indikator.indikator_penunjang_id', 'data_iku.triwulan_id', DB::raw('sum(data_iku.perjanjian_kinerja_target_kumulatif) as total_target'))
            ->where('data_iku.status', 'approved')
            ->whereIn('data_iku.triwulan_id', [1, 2, 3, 4])
            ->groupBy('md_sub_indikator.indikator_penunjang_id', 'data_iku.triwulan_id')
            ->get()
            ->groupBy('indikator_penunjang_id');


        return view('adminbinagram.dashboard-ab', [
            'iku' => $iku,
            'data_iku_by_triwulan' => $data_penunjang_by_triwulan,
            'data_iku_by_sub_indikator' => $data_iku_by_sub_indikator,
            'indikator' => $indikator,
            'bidang_counts' => $bidang_counts,
            'bidang_counts_unfill' => $bidang_counts_unfil,
            'iku_sup' => $iku_sup,
            'realisasi_total_by_bidang' => $realisasi_total_by_bidang,
            'target_total_by_indikator_penunjang' => $target_total_by_indikator_penunjang,
        ]);
    }

    public function reject_data(Request $request, $id)
    {
        $dataIku = DataIku::find($id);

        if ($dataIku && $dataIku->status === 'pending_binagram' && $dataIku->pending_approval === null) {
            $dataIku->status = 'rejected_binagram';
            $dataIku->reject_comment = $request->reject_comment;
            $dataIku->reject_by_binagram = Auth::id();
            $dataIku->save();

            return response()->json(['success' => [
                "title" => "Data Reject Succesfully",
                "message" => "Data berhasil ditolak"
            ]], 200);
        } else {
            return response()->json(['error' => [
                "title" => "Rejection Failed",
                "message" => "Data tidak ditemukan atau belum disetujui oleh approval"
            ]], 400);
        }
    }
}
