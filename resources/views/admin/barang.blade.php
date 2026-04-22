@extends('layouts.app')

@section('content')
<div class="container-fluid">
    {{-- Alert Berhasil --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <span class="me-2"><i class="fas fa-check-circle"></i></span>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Alert Error (Sangat Penting buat Debugging PKL) --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="fw-bold">Waduh, ada yang salah:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark">Data Inventaris</h3>
            <p class="text-muted small">Kelola aset kantor secara terpusat dan efisien.</p>
        </div>
        <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahBarang">
            <i class="fas fa-plus me-2"></i>Tambah Barang
        </button>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-muted small fw-bold">NAMA BARANG</th>
                            <th class="py-3 text-muted small fw-bold">KATEGORI</th>
                            <th class="py-3 text-muted small fw-bold">KONDISI</th>
                            <th class="py-3 text-muted small fw-bold">STATUS</th>
                            <th class="py-3 text-muted small fw-bold text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $b)
                        <tr>
                            <td class="px-4 fw-semibold text-dark">{{ $b->nama }}</td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-3">
                                    <i class="fas fa-tag me-1 small"></i> {{ $b->category->nama ?? 'Umum' }}
                                </span>
                            </td>
                            <td>
                                @if($b->kondisi == 'baik')
                                    <span class="badge bg-success-subtle text-success border border-success px-3">Layak</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger px-3">{{ ucfirst($b->kondisi) }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $b->status == 'tersedia' ? 'bg-primary' : 'bg-warning' }} px-3">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm rounded-3 overflow-hidden border">
                                    {{-- BUTTON EDIT DENGAN IKON --}}
                                    <button class="btn btn-sm btn-white edit-button text-primary px-3" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalEditBarang"
                                        data-id="{{ $b->id }}"
                                        data-nama="{{ $b->nama }}"
                                        data-kategori="{{ $b->category_id }}"
                                        data-kondisi="{{ $b->kondisi }}"
                                        data-status="{{ $b->status }}"
                                        data-tanggal="{{ $b->tanggal_masuk }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    {{-- BUTTON HAPUS DENGAN IKON --}}
                                    <form action="{{ route('barang.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-white text-danger px-3 border-start">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted small">
                                <i class="fas fa-box-open fa-3x mb-3 opacity-25"></i>
                                <br>Belum ada data barang yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH BARANG --}}
<div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">Tambah Barang Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Nama Barang</label>
                            <input type="text" name="nama" class="form-control rounded-3" placeholder="Contoh: Laptop ThinkPad" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Kategori</label>
                            <select name="category_id" class="form-select rounded-3" required>
                                <option value="" disabled selected>Pilih Kategori...</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Kondisi</label>
                            <select name="kondisi" class="form-select rounded-3">
                                <option value="baik">Baik / Layak</option>
                                <option value="rusak">Rusak</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Status</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="tersedia">Tersedia</option>
                                <option value="dipinjam">Dipinjam</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control rounded-3" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT BARANG --}}
<div class="modal fade" id="modalEditBarang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">Edit Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Nama Barang</label>
                            <input type="text" name="nama" id="edit_nama" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Kategori</label>
                            <select name="category_id" id="edit_category_id" class="form-select rounded-3" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Kondisi</label>
                            <select name="kondisi" id="edit_kondisi" class="form-select rounded-3">
                                <option value="baik">Baik / Layak</option>
                                <option value="rusak">Rusak</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Status</label>
                            <select name="status" id="edit_status" class="form-select rounded-3">
                                <option value="tersedia">Tersedia</option>
                                <option value="dipinjam">Dipinjam</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" id="edit_tanggal_masuk" class="form-control rounded-3">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Update Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-button');
        const editForm = document.getElementById('formEdit');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                // Set Action Form
                editForm.action = `/barang/${id}`;

                // Isi Data Modal Edit
                document.getElementById('edit_nama').value = this.getAttribute('data-nama');
                document.getElementById('edit_category_id').value = this.getAttribute('data-kategori');
                document.getElementById('edit_kondisi').value = this.getAttribute('data-kondisi');
                document.getElementById('edit_status').value = this.getAttribute('data-status');
                document.getElementById('edit_tanggal_masuk').value = this.getAttribute('data-tanggal');
            });
        });
    });
</script>
@endsection