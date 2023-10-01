<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Tranding News</h4>
    </div>
    <div class="bg-white border border-top-0 p-3">
        @foreach ($mostViewedBerita as $item)
            <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                <img class="img-fluid" src="{{ asset("storage/berita/".$item->berita->gambar_berita) }}" alt="" style="height:110px; width: 110px;object-fit: cover;">
                <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                    <div class="mb-2">
                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" 
                        href="/single/{{$item->berita->slug}}">{{$item->berita->kategori->nama_kategori}}</a>
                        <a class="text-body" href="/single/{{$item->berita->slug}}">
                            <small>{{$item->berita->updated_at->translatedFormat('d F Y')}}</small>
                        </a>
                    </div>
                    <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="/single/{{$item->berita->slug}}">{{ substr($item->berita->judul_berita, 0, 40) . (strlen($item->berita->judul_berita) > 40 ? '...' : '') }}</a>
                </div>
            </div>
        @endforeach

    </div>
</div>
