@include('header')
<div class="container" style="padding: 20px;">
    <h2>{{ $kuliners->nmcafe }}</h2>
    <p>{{ $kuliners->keterangan }}</p>
    
    <div class="mb-3">
        <iframe
            width="100%"
            height="300"
            frameborder="0" style="border:0"
            src="{{ $kuliners->maps }}" allowfullscreen>
        </iframe>
    </div>
    
    <!-- <img src="{{ asset('storage/' . $kuliners->file) }}" alt="{{ $kuliners->nmcafe }}" style="max-width: 100%; height: auto; margin-bottom: 20px;"> -->
    
    <h3>Menu</h3>
    @auth
        <button class="btn btn-primary btn-sm my-2" id="addDetailButton">Tambah Menu</button>
    @endauth
    <div class="card pb-4">
        <div class="row no-gutters">
            @forelse($details as $menu)
                <div class="col-md-4" style="padding: 10px">
                    <div class="card">
                        <img src="{{ asset('storage/' . $menu->file_menu) }}" alt="{{ $menu->nmcafe }}" class="card-img-top img-fluid" style="object-fit: cover; height: 200px;">
                        <h4 class="p-2">{{ $menu->keterangan_menu }}</h4>
                        <div class="overlay py-2 px-2">
                            @auth
                            <!-- Button untuk Edit Menu -->
                            <button class="btn btn-warning btn-sm btn-overlay editDetailButton" data-id="{{ $menu->id }}">Edit</button>
                            
                            <!-- Button untuk Hapus Menu -->
                            <button class="btn btn-danger btn-sm btn-overlay deleteDetailButton" data-id="{{ $menu->id }}">Hapus</button>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>Data menu belum tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>


@include('footer')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Modal untuk Tambah Detail -->
    <div class="modal fade" id="addDetailModal" tabindex="-1" role="dialog" aria-labelledby="addDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('details.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_detail" value="{{ $kuliners->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDetailModalLabel">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                    <input type="hidden" name="id_detail" value="{{ $kuliners->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDetailModalLabel-{{ $detail->id }}">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
