@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Checklist List</div>
    <div class="card-body">
        @can('create-checklist')
            <a href="{{ route('checklists.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Checklist</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">S#</th>
                <th scope="col">Done</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($checklists as $checklist)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $checklist->is_done ? 'Yes' : 'No' }}</td>
                    <td>{{ $checklist->name }}</td>
                    <td>{{ $checklist->description }}</td>
                    <td>
                        <form action="{{ route('checklists.destroy', $checklist->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('checklists.show', $checklist->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                            @can('edit-checklist')
                                <a href="{{ route('checklists.edit', $checklist->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan

                            @can('delete-checklist')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this checklist?');"><i class="bi bi-trash"></i> Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>No Checklist Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $checklists->links() }}

    </div>
</div>
@endsection