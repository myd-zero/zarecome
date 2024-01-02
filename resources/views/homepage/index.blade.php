@include('header')
    
    <div class="container" style="padding: 20px">
        <h4 style="padding-bottom: 10px">Daftar Restoran</h4>
        <div class="row">
            @forelse($kuliners as $kuliner)
                <div class="col-md-4 mb-4">
                    <div class="card">
                    <img src="{{ asset('storage/' . $kuliner->file) }}" class="card-img-top img-fluid" style="object-fit: cover; width: 100%; height: 200px;" alt="{{ $kuliner->nmcafe }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kuliner->nmcafe }}</h5>
                            <a href="{{ route('detail-menu', ['id' => $kuliner->id]) }}" class="btn btn-primary">Selengkapnya</a>
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

@include('footer')
