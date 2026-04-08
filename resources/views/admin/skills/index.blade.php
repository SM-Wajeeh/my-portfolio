@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h4 class="mb-0" style="color:#fff;">Skills</h4>
    <small class="text-muted">{{ $skills->count() }} total</small>
  </div>
  <a href="{{ route('admin.skills.create') }}" class="btn btn-accent btn-sm">
    <i class="bi bi-plus-lg me-1"></i>Add Skill
  </a>
</div>

<div class="admin-card">
  @if($skills->isEmpty())
    <p class="text-muted text-center py-4">No skills yet. Add your first one!</p>
  @else
  <table class="table table-borderless mb-0">
    <thead>
      <tr>
        <th>Icon</th>
        <th>Name</th>
        <th>Description</th>
        <th>Proficiency</th>
        <th>Order</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($skills as $skill)
      <tr>
        <td style="font-size:1.4rem;">{{ $skill->icon }}</td>
        <td style="color:#fff; font-weight:600;">{{ $skill->name }}</td>
        <td style="font-size:.82rem; color:#777; max-width:260px;">{{ $skill->description }}</td>
        <td style="min-width:100px;">
          <div class="d-flex align-items-center gap-2">
            <div class="prof-bar flex-grow-1">
              <div class="prof-bar-fill" style="width:{{ $skill->proficiency }}%"></div>
            </div>
            <span style="font-size:.75rem; color:#00bfff; font-family:monospace;">{{ $skill->proficiency }}%</span>
          </div>
        </td>
        <td style="color:#555; font-size:.82rem;">{{ $skill->sort_order }}</td>
        <td class="text-end">
          <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-outline-accent btn-sm me-1">
            <i class="bi bi-pencil"></i>
          </a>
          <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Delete this skill?')">
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
