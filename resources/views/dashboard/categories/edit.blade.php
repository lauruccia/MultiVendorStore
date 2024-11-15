@extends('layout.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Categories</li>
    <li class="breadcrumb-item ">Edit Categorie</li>
@endsection

@section('content')

    <form action="{{ route('categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
       @include('dashboard.categories.form',[
        'button_text'=>'Update',
       ])
    </form>
@endsection
