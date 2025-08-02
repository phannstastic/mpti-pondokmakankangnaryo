@extends('layouts.app')
@section('title', 'Semua Menu - Restorun')
@section('content')

<section class="container py-5" style="margin-top: 80px;">
    <div class="menu-header text-center mb-5">
        <h2>Semua Menu Kami</h2>
        <p>Temukan hidangan favorit Anda dari daftar lengkap kami.</p>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-auto">
            <div class="btn-group" role="group" aria-label="Filter Menu">
                <a href="{{ route('menu.page') }}" class="btn {{ !request('kategori') ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
                <a href="{{ route('menu.page', ['kategori' => 'makanan']) }}" class="btn {{ request('kategori') == 'makanan' ? 'btn-primary' : 'btn-outline-primary' }}">Makanan</a>
                <a href="{{ route('menu.page', ['kategori' => 'minuman']) }}" class="btn {{ request('kategori') == 'minuman' ? 'btn-primary' : 'btn-outline-primary' }}">Minuman</a>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($menuItems as $item)
            <div class="col-lg-4 col-md-6 my-4 text-center">
                <div class="card p-4 border-0 h-100" data-aos="fade-up">
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" style="aspect-ratio: 1/1; object-fit: cover;" alt="{{ $item->name }}">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">{{ $item->name }}</h3>
                        <p class="card-text flex-grow-1">{{ $item->description }}</p>
                        <h3 class="mt-auto"><span>Rp {{ number_format($item->price, 0, ',', '.') }}</span></h3>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Maaf, tidak ada menu yang cocok dengan filter ini.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $menuItems->links() }}
    </div>
</section>
@endsection
