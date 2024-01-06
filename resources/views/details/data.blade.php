<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Menu') }}
        </h2>
        <button class="btn btn-primary mt-2" id="addDetailButton">Add Data</button>
    </x-slot>

    <div class="container">
        <div class="card px-4 mt-4">
            <div class="table-responsive mt-3">
                <table class="table table-striped" id="table_id">
                    <thead>
                        <tr>
                            <th>Kuliner</th>
                            <th>Gambar Menu</th>
                            <th>Keterangan Menu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td>{{ $detail->nmcafe }}</td>
                                <td>
                                    @if($detail->file_menu)
                                        <img src="{{ asset('storage/' . $detail->file_menu) }}" alt="{{ $detail->nmcafe }}" style="max-width: 100px; max-height: 100px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $detail->keterangan_menu }}</td>
                                <td>
                                    <button class="btn btn-primary editDetailButton" data-id="{{ $detail->id }}">Edit</button>
                                    <button class="btn btn-danger deleteDetailButton" data-id="{{ $detail->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk Tambah Detail -->
<div class="modal fade" id="addDetailModal" tabindex="-1" role="dialog" aria-labelledby="addDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('details.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addDetailModalLabel">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_detail">Nama Cafe</label>
                        <select class="form-control" id="id_detail" name="id_detail" required>
                            @foreach($kuliners as $kuliner)
                                <option value="{{ $kuliner->id }}">{{ $kuliner->nmcafe }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file_menu">Gambar Menu</label>
                        <input type="file" class="form-control-file" id="file_menu" name="file_menu" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan_menu">Keterangan Menu</label>
                        <textarea class="form-control" id="keterangan_menu" name="keterangan_menu" rows="3" required></textarea>
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



   <!-- Modal untuk Edit dan Hapus Detail -->
@foreach ($details as $detail)
    <!-- Modal body untuk Edit Detail -->
    <div class="modal fade" id="editDetailModal-{{ $detail->id }}" tabindex="-1" role="dialog" aria-labelledby="editDetailModalLabel-{{ $detail->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('details.update', $detail->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDetailModalLabel-{{ $detail->id }}">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_detail">Nama Cafe</label>
                            <select class="form-control" id="id_detail" name="id_detail" required>
                                @foreach($kuliners as $kuliner)
                                    <option value="{{ $kuliner->id }}" {{ $kuliner->id == $detail->id_detail ? 'selected' : '' }}>{{ $kuliner->nmcafe }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file_menu">Gambar Menu</label>
                            <input type="file" class="form-control-file" id="file_menu" name="file_menu" accept="image/*">
                            <!-- Menampilkan gambar saat ini -->
                            @if($detail->file_menu)
                                <img src="{{ asset('storage/' . $detail->file_menu) }}" alt="{{ $detail->nmcafe }}" class="mt-2" style="max-width: 200px; max-height: 200px;">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="keterangan_menu">Keterangan Menu</label>
                            <textarea class="form-control" id="keterangan_menu" name="keterangan_menu" rows="3" required>{{ $detail->keterangan_menu }}</textarea>
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

    <!-- Modal untuk Hapus Detail -->
    <div class="modal fade" id="deleteDetailModal-{{ $detail->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteDetailModalLabel-{{ $detail->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDetailModalLabel-{{ $detail->id }}">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('details.destroy', $detail->id) }}">
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

        $('#addDetailButton').on('click', function() {
            $('#addDetailModal').modal('show');
        });

        $('.editDetailButton').on('click', function() {
            const detailId = $(this).data('id');
            $(`#editDetailModal-${detailId}`).modal('show');
        });

        $('.deleteDetailButton').on('click', function() {
            const detailId = $(this).data('id');
            $(`#deleteDetailModal-${detailId}`).modal('show');
        });
    });
</script>
