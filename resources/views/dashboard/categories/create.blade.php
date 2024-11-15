@extends('layout.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Categorie</li>
@endsection

@section('content')

    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories.form',['button_text'=>'Create'])
    </form>
@endsection
