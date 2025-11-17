<span id="ajax-breadcrumb-title" class="d-none">{{ $selectedCategoryName }}</span>

<div class="row">
    @forelse ($items as $item)
      <div class="col-lg-4 col-md-6">
        @include('frontend.project-card', ['item' => $item])
      </div>
    @empty
      <p class="text-center">No items found.</p>
    @endforelse
  </div>
  