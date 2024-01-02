@include('header')

<div class="container" style="padding: 20px;">
    <h2>{{ $kuliners->nmcafe }}</h2>
    <!-- <p>{{ $kuliners->altcafe }}</p> -->
    
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
    
<div class="card mb-3">
    <div class="row no-gutters">
        @forelse($details as $menu)
            <div class="col-md-4" style="padding: 10px">
                <img src="{{ asset('storage/' . $menu->file_menu) }}" alt="{{ $menu->nmcafe }}" class="card-img" style="max-width: 100%; height: auto;">
            </div>
        @empty
            <p>Data menu belum tersedia.</p>
        @endforelse
    </div>
</div>
</div>


@include('footer')
