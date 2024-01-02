<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kuliner') }}
        </h2>
        <button class="btn btn-primary mt-2" id="addKulinerButton">Add Data</button>
    </x-slot>
    <div class="container">
        <div class="card px-4 mt-4">
            <div class="table-responsive mt-3">
                <table class="table table-striped" id="table_id">
                    <thead>
                        <tr>
                            <th>Kuliner</th>
                            <th>Alamat</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kuliners as $kuliner)
                            <tr>
                                <td>{{ $kuliner->nmcafe }}</td>
                                <td>{{ $kuliner->altcafe }}</td>
                                <td>{{ $kuliner->keterangan }}</td>
                                <td>
                                    <button class="btn btn-primary editKulinerButton" data-id="{{ $kuliner->id }}">Edit</button>
                                    <button class="btn btn-danger deleteKulinerButton" data-id="{{ $kuliner->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                        <h5 class="modal-title" id="addKulinerModalLabel">Add Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">      
                            <label for="nmcafe">Nama Cafe</label>
                            <input type="text" class="form-control" id="nmcafe" name="nmcafe" required>
                        </div>
                        <div class="form-group">
                            <label for="altcafe">Alamat Cafe</label>
                            <input type="text" class="form-control" id="altcafe" name="altcafe" required>
                        </div>
                        <div class="form-group">
                            <label for="file">Gambar</label>
                            <input type="file" class="form-control-file" id="file" name="file" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
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
                    <h5 class="modal-title" id="editKulinerModalLabel-{{ $kuliner->id }}">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">      
                        <label for="nmcafe">Nama Cafe</label>
                        <input type="text" class="form-control" id="nmcafe" name="nmcafe" value="{{ $kuliner->nmcafe }}" required>
                    </div>
                    <div class="form-group">
                        <label for="altcafe">Alamat Cafe</label>
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
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>{{ $kuliner->keterangan }}</textarea>
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
                        <h5 class="modal-title" id="deleteKulinerModalLabel-{{ $kuliner->id }}">Delete Data</h5>
                        <button type="button" class="close" data-dismiss="modal fade" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Yakin ingin menghapus data ini?</h4>
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
