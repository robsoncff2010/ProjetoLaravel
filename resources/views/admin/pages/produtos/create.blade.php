@extends('admin.layouts.app')

@section('content')
    
    <h1>Cadastrar novo Produto</h1>

    @include('admin.includes.alerts')

    <form action="{{ route('produtos.store') }}" method="post" enctype="multipart/form-data" class = "form">

        @csrf
        @include('admin.pages.produtos._partials.form')
    </form>
@endsection