@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
  <a href="{{ route('admin.skills.index') }}" class="btn btn-sm btn-outline-secondary">
    <i class="bi bi-arrow-left"></i>
  </a>
  <h4 class="mb-0" style="color:#fff;">
    {{ $skill->exists ? 'Edit Skill' : 'Add Skill' }}
  </h4>
</div>

<div class="admin-card" style="max-width:560px;">
  <form action="{{ $skill->exists ? route('admin.skills.update', $skill) : route('admin.skills.store') }}"
        method="POST">
    @csrf
    @if($skill->exists) @method('PUT') @endif

    <div class="row g-3">

      <div class="col-3">
        <label class="form-label">Icon (emoji)</label>
        <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
               value="{{ old('icon', $skill->icon) }}" placeholder="⚡" maxlength="10">
        @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-9">
        <label class="form-label">Skill Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $skill->name) }}" placeholder="e.g. C++ / Systems">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <label class="form-label">Description <span style="color:#555;">(shown under the skill name)</span></label>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
               value="{{ old('description', $skill->description) }}"
               placeholder="e.g. Memory management, templates, RAII, concurrency">
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-8">
        <label class="form-label">Proficiency: <span id="profVal" style="color:#00bfff;">{{ old('proficiency', $skill->proficiency ?? 80) }}%</span></label>
        <input type="range" name="proficiency" id="profRange"
               class="form-range" min="0" max="100"
               value="{{ old('proficiency', $skill->proficiency ?? 80) }}"
               oninput="document.getElementById('profVal').textContent = this.value + '%'">
        @error('proficiency')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>

      <div class="col-4">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control"
               value="{{ old('sort_order', $skill->sort_order ?? 0) }}" min="0">
      </div>

      <div class="col-12 pt-2">
        <button type="submit" class="btn btn-accent">
          <i class="bi bi-check-lg me-1"></i>
          {{ $skill->exists ? 'Update Skill' : 'Save Skill' }}
        </button>
      </div>

    </div>
  </form>
</div>
@endsection
