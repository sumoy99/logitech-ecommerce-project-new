<div class="row">
  <div class="col-12 mx-auto">
    <div class="card">
      <div class="card-body table-responsive">
        <div class="row mb-3">
            <div class="col-md-4 col-sm-6">
                <form method="GET" action="{{ $search_route }}">
                  <div class="search-box">
                    <div class="InputContainer">
                      <input value="{{ request()->get('search') }}" name="search" placeholder="Search.."/>
                    </div>
                    <button type="submit" class="Icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#657789" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                  </div>
              </form> 
            </div>
          </div>
          <table class="table table-bordered table-hover align-middle">
              <thead class="table-light">
                  <tr>
                      <th>#</th>
                      <th>Thumbnail</th>
                      <th>Name</th>
                      <th>Added By</th>
                      <th>Info</th>
                      <th>Total Stock</th>
                      <th>Status</th>
                      <th width="150">Actions</th>
                  </tr>
              </thead>
              <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="w-10">{{ $loop->iteration }}</td>
                        <td>
                            @if(!empty($product->productFile->thumbnail))

                                <img src="{{ $product->productFile->thumbnail ? asset('assets/upload/products/thumbnails/' . $product->productFile->thumbnail) : asset('assets/backend/assets/img/placeholder.png') }}" alt="Thumbnail" height="40">
                            @else
                                <span class="text-muted">No Thumbnail</span>
                            @endif
                        </td>
                        <td><a href="{{ route('frontend.product_details', ['product_slug' => $product->slug, 'id' => $product->id]) }}" target="_blank">{{ $product->name }}</a><br>
                        </td>
                        <td>
                            @if($product->user)
                                {{ $product->user->name }} <br>
                                {{-- <small class="text-muted">({{ $product->user->role }})</small> --}}
                            @else
                                <span class="text-muted">No User</span>
                            @endif 
                        </td>
                        <td>
                            <strong>Price:</strong> {{ currency($product->price) }} <br>
                            
                            <strong>Final-Price:</strong> {{ currency($product->final_price) }}<br>
                            @if($product->brand)
                                <strong>Brand:</strong> {{ $product->brand->name }} <br>
                            @else
                                <span class="text-muted">No Brand</span> <br>
                            @endif
                        </td>
                        <td class="text-center">{{ $product->stock }}<br>
                            @if ($product->stock <= $product->low_stock_warning)
                                <span class="badge bg-danger">Low</span>
                            @endif
                        </td>
                        <td>
                            @if($product->status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route($edit_route, ['id' => $product->id]) }}" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-edit"></i></a>

                            <a href="javascript:;" class="btn btn-sm btn-danger revert-btn" data-url="{{ route($delete_route, ['id' => $product->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                    
                </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No products found.</td>
                    </tr>
                @endforelse
              </tbody>
          </table>
        </div>
        
      </div>
       <div class="pagination p1">
            <ul>
            @if ($products->previousPageUrl())
                <a href="{{ $products->previousPageUrl() }}"><li><</li></a>
            @endif
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <a href="{{ $products->url($i) }}" class="{{ $products->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
            @endfor
            @if ($products->nextPageUrl())
                <a href="{{ $products->nextPageUrl() }}"><li>></li></a>
            @endif
            </ul>
        </div>
  </div>
</div>