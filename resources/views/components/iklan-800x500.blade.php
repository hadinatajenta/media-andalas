<div class="mb-3">
    <div class="section-title mb-0">
        <h4 class="m-0 text-uppercase font-weight-bold">Advertisement</h4>
    </div>
    
    <div class="bg-white text-center border border-top-0 p-3">
        @if($iklan)
        <a href="{{ $iklan->website }}"><img class="img-fluid" src="/uploads/{{ $iklan->gambar_iklan }}" alt=""></a>
        @else
    <p>Tidak ada iklan</p>
@endif
    </div>
</div>
