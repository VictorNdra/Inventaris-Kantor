@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <span class="me-2">✅</span>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark">Kategori Barang</h3>
            <p class="text-muted small">Kelompokkan barang agar inventaris lebih terorganisir.</p>
        </div>
        <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
            + Tambah Kategori
        </button>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-muted small fw-bold" style="width: 30%">NAMA KATEGORI</th>
                            <th class="py-3 text-muted small fw-bold">DESKRIPSI</th>
                            <th class="py-3 text-muted small fw-bold text-center" style="width: 20%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                        <tr>
                            <td class="px-4">
                                <div class="fw-semibold text-dark">{{ $cat->nama }}</div>
                                <small class="text-muted">ID: #{{ $cat->id }}</small>
                            </td>
                            <td>
                                <p class="mb-0 text-muted small">{{ $cat->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                            </td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                                    <button class="btn btn-sm btn-white border-end edit-kategori-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalEditKategori"
                                        data-id="{{ $cat->id }}"
                                        data-nama="{{ $cat->nama }}"
                                        data-deskripsi="{{ $cat->deskripsi }}">
                                        Edit
                                    </button>
                                    
                                    <form action="{{ route('kategori.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Menghapus kategori akan berdampak pada data barang terkait. Yakin?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-white text-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted small">
                                <img src="https://illustrations.popsy.co/gray/paper-stack.svg" alt="empty" style="width: 80px;" class="mb-3 opacity-50">
                                <br>Belum ada kategori yang dibuat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">Buat Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Nama Kategori</label>
                        <input type="text" name="nama" class="form-control rounded-3" placeholder="Misal: Elektronik, Alat Tulis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" class="form-control rounded-3" rows="3" placeholder="Penjelasan singkat kategori..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditKategori" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditKategori" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Nama Kategori</label>
                        <input type="text" name="nama" id="edit_nama_kategori" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Deskripsi</label>
                        <textarea name="deskripsi" id="edit_deskripsi_kategori" class="form-control rounded-3" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-kategori-btn');
        const editForm = document.getElementById('formEditKategori');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                
                // Set Action Form Update
                editForm.action = `/kategori/${id}`;

                // Isi input modal edit
                document.getElementById('edit_nama_kategori').value = this.getAttribute('data-nama');
                document.getElementById('edit_deskripsi_kategori').value = this.getAttribute('data-deskripsi');
            });
        });
    });
</script>
@endsection