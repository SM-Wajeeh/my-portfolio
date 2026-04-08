@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
  <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-secondary">
    <i class="bi bi-arrow-left"></i>
  </a>
  <h4 class="mb-0" style="color:#fff;">
    {{ $project->exists ? 'Edit Project' : 'Add Project' }}
  </h4>
</div>

<div class="admin-card" style="max-width:680px;">
  <form action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}"
        method="POST">
    @csrf
    @if($project->exists) @method('PUT') @endif

    <div class="row g-3">

      <div class="col-3">
        <label class="form-label">Number</label>
        <input type="text" name="number" class="form-control @error('number') is-invalid @enderror"
               value="{{ old('number', $project->number) }}" placeholder="01" maxlength="5">
        @error('number')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-9">
        <label class="form-label">Tag / Category</label>
        <input type="text" name="tag" class="form-control @error('tag') is-invalid @enderror"
               value="{{ old('tag', $project->tag) }}" placeholder="e.g. Game Development">
        @error('tag')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $project->title) }}" placeholder="e.g. VOIDRIFT">
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3"
                  class="form-control @error('description') is-invalid @enderror"
                  placeholder="Short project description...">{{ old('description', $project->description) }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-12">
        <label class="form-label">
          Stack Tags
          <span style="color:#555;"> — comma-separated, e.g. <code style="color:#aaa;">C++, SDL2, OpenGL</code></span>
        </label>
        <input type="text" name="stack" class="form-control @error('stack') is-invalid @enderror"
               value="{{ old('stack', $project->stack) }}" placeholder="C++, SDL2, OpenGL, CMake">
        @error('stack')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-6">
        <label class="form-label">Project Link <span style="color:#555;">(optional)</span></label>
        <input type="url" name="link" class="form-control @error('link') is-invalid @enderror"
               value="{{ old('link', $project->link) }}" placeholder="https://github.com/...">
        @error('link')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-6">
        <label class="form-label">Background Image URL <span style="color:#555;">(optional)</span></label>
        <input type="url" name="bg_image" class="form-control @error('bg_image') is-invalid @enderror"
               value="{{ old('bg_image', $project->bg_image) }}" placeholder="https://images.unsplash.com/...">
        @error('bg_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="col-4">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control"
               value="{{ old('sort_order', $project->sort_order ?? 0) }}" min="0">
      </div>

      <div class="col-12 pt-2">
        <button type="submit" class="btn btn-accent">
          <i class="bi bi-check-lg me-1"></i>
          {{ $project->exists ? 'Update Project' : 'Save Project' }}
        </button>
      </div>

    </div>
  </form>
</div>
@endsection
