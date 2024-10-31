@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Produtos</h1>
        @if (session('success'))            
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('info'))
            <div class="alert alert-warning">
                {{ session('info') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            @foreach ($produtos as $produto)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $produto->url_imagem }}" class="card-img-top" alt="{{ $produto->nome }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produto->nome }}</h5>
                            <p class="card-text">{{ $produto->descricao }}</p>
                            <p class="card-text"><strong>Preço:</strong> R${{ number_format($produto->preco, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
