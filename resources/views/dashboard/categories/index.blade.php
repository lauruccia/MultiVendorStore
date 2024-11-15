@extends('layout.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Categorie</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">Add category</a>
    </div>
  <x-alert type="success"/>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Created at</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td><img src="{{ asset('storage/'.$category->image)}}" alt="" height="50"></td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
