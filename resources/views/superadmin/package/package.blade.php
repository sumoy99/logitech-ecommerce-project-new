@extends('superadmin.navigation')
   
@section('content')
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Package') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('Package') }}</a></li>
                        <li><a href="#">{{ get_phrase('Pricing') }}</a></li>
                    </ul>
                </div>
                <div class="export-btn-area">
                    <div class="export-btn-area">
                      <a href="javascript:;" class="export_btn" onclick="rightModal('{{ route('superadmin.package.package_create') }}', 'Create package')"><i class="bi bi-plus"></i>{{ get_phrase('Add Package') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--====== Start pricing section ======-->
<section class="pricing-area pricing-area-v1 dark-blue-bg pattern-bg pt-130 pb-120">
    <div class="container">
        <div class="row ">
            @foreach($packages as $package)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="pricing-item pricing-item-two bg-white mb-40 wow fadeInUp" data-wow-delay=".3s">
                    @if($package->status == '1')
                    <div class="ribbon2">{{get_phrase('Active')}}</div>
                    @else
                    <div class="ribbon2 ribbon3">{{get_phrase('Deactive')}} </div>
                    @endif

                    @if($package->type == '1')
                    <div class="ribbon"> Popular </div>
                    @else 
                    @endif
                    <div class="pricing-head text-center">
                        <span class="plan">{{ $package->name }}</span>
                        <h2 class="price"  style="font-size: 26px;"><span class="currency"></span>{{ currency($package->price) }}</h2>
                    </div>
                    <div class="pricing-body">
                        <p>{{ $package->description }}</p>
                        <ul class="pricing-list">
                            @php
						        $packages_features = json_decode($package->features);
					        @endphp 
                            @foreach ($packages_features as $packages_feature)
                                <li class="check"><p> {{ $packages_feature }}</p></li>
                            @endforeach
                            
                        </ul>
                        <div class="adminTable-action">
                            <button
                              type="button"
                              class="eBtn eBtn-black dropdown-toggle table-action-btn-2"
                              data-bs-toggle="dropdown"
                              aria-expanded="false"
                            >
                             {{ get_phrase('Actions')}} 
                            </button>
                            <ul
                              class="dropdown-menu dropdown-menu-end eDropdown-menu-2 eDropdown-table-action"
                            >
                              <li>
                                <a class="dropdown-item" href="javascript:;" onclick="rightModal('{{ route('superadmin.package.package_edit', ['id' => $package->id]) }}', '{{ get_phrase('Edit Package') }}')">{{ get_phrase('Edit') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('superadmin.package.delete', ['id' => $package->id]) }}', 'undefined');">{{ get_phrase('Delete')}}</a>
                              </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="pagination p1">
                <ul>
                  @if ($packages->previousPageUrl())
                      <a href="{{ $packages->previousPageUrl() }}"><li><</li></a>
                  @endif
                  @for ($i = 1; $i <= $packages->lastPage(); $i++)
                      <a href="{{ $packages->url($i) }}" class="{{ $packages->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
                  @endfor
                  @if ($packages->nextPageUrl())
                      <a href="{{ $packages->nextPageUrl() }}"><li>></li></a>
                  @endif
                </ul>
              </div>
        </div>
    </div>
</section><!--====== End pricing section ======-->
@endsection