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

  <form action="{{ URL::current() }}" method="GET" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="Search..." class="mx-2" :value="request('name')"/>
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active')>Active</option>
        <option value="archived" @selected(request('status')=='archived')>Inactive</option>
    </select>
    <button type="submit" class="btn btn-gray">Filter</button>
  </form>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Status</th>
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
                    <td>{{ $category->status }}</td>
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
    {{ $categories->withQueryString()->links() }}
@endsection
