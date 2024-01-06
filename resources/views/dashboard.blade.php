<x-app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="container" style="padding: 10px">
                    <div class="flex justify-between items-center py-2">
                        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
                            <!-- {{ __('Daftar Restoran') }} -->
                        </h4>
                        <button class="btn btn-primary mt-2" id="addKulinerButton">Tambah Restoran</button>
                    </div>
                    <div class="row">
                        @forelse($kuliners as $kuliner)
                            <div class="col-md-4 my-4">
                                <div class="card mb-2">
                                    <img src="{{ asset('storage/' . $kuliner->file) }}" class="card-img-top img-fluid" style="object-fit: cover; width: 100%; height: 200px;" alt="{{ $kuliner->nmcafe }}">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $kuliner->nmcafe }}</h4>
                                        <div class="text-left">
                                            <a href="{{ route('detail-menu', ['id' => $kuliner->id]) }}" class="btn btn-primary">Detail</a>
                                            <button class="btn btn-warning editKulinerButton" data-id="{{ $kuliner->id }}">Edit</button>
                                            <button class="btn btn-danger deleteKulinerButton" data-id="{{ $kuliner->id }}">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p>Data belum tersedia.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
        </div>
    </div>

        <!-- Modal untuk Tambah Kuliner -->
        <div class="modal fade" id="addKulinerModal" tabindex="-1" role="dialog" aria-labelledby="addKulinerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('kuliners.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addKulinerModalLabel">Tambah Restoran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">      
                            <label for="nmcafe">Nama Restoran</label>
                            <input type="text" class="form-control" id="nmcafe" name="nmcafe" required>
                        </div>
                        <div class="form-group">
                            <label for="altcafe">Alamat Restoran</label>
                            <input type="text" class="form-control" id="altcafe" name="altcafe" required>
                        </div>
                        <div class="form-group">
                            <label for="file">Gambar</label>
                            <input type="file" class="form-control-file" id="file" name="file" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" rows="3" required>
                        </div>
                        <div class="form-group">
                        <label for="maps">Maps</label>
                        <input type="text" class="form-control" id="maps" name="maps" required>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit dan Hapus Kuliner -->
    @foreach ($kuliners as $kuliner)
<div class="modal fade" id="editKulinerModal-{{ $kuliner->id }}" tabindex="-1" role="dialog" aria-labelledby="editKulinerModalLabel-{{ $kuliner->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('kuliners.update', $kuliner->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-header">
                    <h5 class="modal-title" id="editKulinerModalLabel-{{ $kuliner->id }}">Ubah Restoran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">      
                        <label for="nmcafe">Nama Restoran</label>
                        <input type="text" class="form-control" id="nmcafe" name="nmcafe" value="{{ $kuliner->nmcafe }}" required>
                    </div>
                    <div class="form-group">
                        <label for="altcafe">Alamat Restoran</label>
                        <input type="text" class="form-control" id="altcafe" name="altcafe" value="{{ $kuliner->altcafe }}" required>
                    </div>
                    <div class="form-group">
                        <label for="file">Gambar</label>
                        <input type="file" class="form-control-file" id="file" name="file" accept="image/*">
                        <!-- Menampilkan gambar saat ini -->
                        @if($kuliner->file)
                            <img src="{{ asset('storage/' . $kuliner->file) }}" alt="{{ $kuliner->nmcafe }}" class="mt-2" style="max-width: 200px; max-height: 200px;">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $kuliner->keterangan }}" required>
                    </div>
                    <div class="form-group">
                            <label for="maps">Maps</label>
                            <input type="text" class="form-control" id="maps" name="maps" value="{{ $kuliner->maps }}" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


        <div class="modal fade" id="deleteKulinerModal-{{ $kuliner->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteKulinerModalLabel-{{ $kuliner->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addKulinerModalLabel">Hapus Restoran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form method="post" action="{{ route('kuliners.destroy', $kuliner->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @include('footer')
</x-app-layout>


<script>
    $(document).ready( function () {
        $('#table_id').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
        });

        $('#addKulinerButton').on('click', function() {
            $('#addKulinerModal').modal('show');
        });

        $('.editKulinerButton').on('click', function() {
            const kulinerId = $(this).data('id');
            $(`#editKulinerModal-${kulinerId}`).modal('show');
        });

        $('.deleteKulinerButton').on('click', function() {
            const kulinerId = $(this).data('id');
            $(`#deleteKulinerModal-${kulinerId}`).modal('show');
        });
    });
</script>

