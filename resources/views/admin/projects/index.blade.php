@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h4 class="mb-0" style="color:#fff;">Projects</h4>
    <small class="text-muted">{{ $projects->count() }} total</small>
  </div>
  <a href="{{ route('admin.projects.create') }}" class="btn btn-accent btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Add Project
  </a>
</div>

<div class="admin-card">
  @if($projects->isEmpty())
    <p class="text-muted text-center py-4">No projects yet. Add your first one!</p>
  @else
  <table class="table table-borderless mb-0">
    <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Tag</th>
        <th>Stack</th>
        <th>Link</th>
        <th>Order</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($projects as $project)
      <tr>
        <td style="font-family:monospace; color:#555;">{{ $project->number }}</td>
        <td style="color:#fff; font-weight:700; letter-spacing:.04em;">{{ $project->title }}</td>
        <td><span class="badge-stack">{{ $project->tag }}</span></td>
        <td style="max-width:200px;">
          @foreach($project->stack_array as $badge)
            <span class="badge-stack me-1">{{ $badge }}</span>
          @endforeach
        </td>
        <td>
          @if($project->link && $project->link !== '#')
            <a href="{{ $project->link }}" target="_blank" style="color:#00bfff; font-size:.78rem;">
              <i class="bi bi-box-arrow-up-right"></i>
            </a>
          @else
            <span style="color:#444;">—</span>
          @endif
        </td>
        <td style="color:#555; font-size:.82rem;">{{ $project->sort_order }}</td>
        <td class="text-end">
          <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-outline-accent btn-sm me-1">
            <i class="bi bi-pencil"></i>
          </a>
          <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Delete this project?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
</div>
@endsection
