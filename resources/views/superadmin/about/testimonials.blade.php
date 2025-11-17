@extends('superadmin.navigation')
@section('content') 
<div class="mainSection-title">
    <div class="row">
        <div class="col-12">
            <div
              class="d-flex justify-content-between align-items-center flex-wrap gr-15"
            >
                <div class="d-flex flex-column">
                    <h4>{{ get_phrase('Testimonials') }}</h4>
                    <ul class="d-flex align-items-center eBreadcrumb-2">
                        <li><a href="#">{{ get_phrase('About Us') }}</a></li>
                        <li><a href="#">{{ get_phrase('Testimonials') }}</a></li>
                    </ul>
                </div>
                <div class="export-btn-area">
                    <div class="export-btn-area">
                      <a href="javascript:;" class="export_btn" onclick="rightModal('{{ route('superadmin.about.testimonial_create') }}', 'Create Testimonials')"><i class="bi bi-plus"></i>{{ get_phrase('Add Testimonials') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-12">
      <div class="eSection-wrap">
          <div class="eMain">
            <div class="row">
              <div class="table-responsive">
                <table class="table eTable align-middle">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ get_phrase('Name')}} </th>
                        <th scope="col">{{ get_phrase('Description')}}</th>
                        <th scope="col">{{ get_phrase('Action')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 0;
                        @endphp
                        @foreach ($testimonials as $testimonial)
                        <tr>
                            <th scope="row">{{ ++$counter }}</th>
          
                            <td>
                              <div
                                class="dAdmin_profile d-flex align-items-center min-w-200px"
                              >
                                <div class="dAdmin_profile_img">
                                  <img
                                    width="50"
                                    height="50"
                                    src="{{asset('public/assets/upload/about_us/client_image/'. $testimonial->image)}}"
                                  />
                                </div>
                                <div class="dAdmin_profile_name">
                                  <h4>{{ $testimonial->name }}</h4>
                                  <span>{{ $testimonial->designation }}</span>
                                </div>
                              </div>
                            </td>
          
                            <td>
                                <div class="reservation min-w-250px">
                                    <p style="font-size: 11px;">{{ $testimonial->description }}</p>
                                </div>
                            </td>
                            <td>
                              <div class="adminTable-action" style="margin-left: 0;">
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
                                    <a class="dropdown-item" href="javascript:;" onclick="rightModal('{{ route('superadmin.about.testimonial_edit', ['id' => $testimonial->id]) }}', 'Edit Review')">{{ get_phrase('Edit')}}</a>
                                  </li>
                                  <li>
                                    <a class="dropdown-item" href="javascript:;" onclick="confirmModal('{{ route('superadmin.about.testimonial_delete', ['id' => $testimonial->id]) }}', 'undefined');">{{ get_phrase('Delete')}}</a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
<div class="pagination p1">
  <ul>
    @if ($testimonials->previousPageUrl())
        <a href="{{ $testimonials->previousPageUrl() }}"><li><</li></a>
    @endif
    @for ($i = 1; $i <= $testimonials->lastPage(); $i++)
        <a href="{{ $testimonials->url($i) }}" class="{{ $testimonials->currentPage() == $i ? 'is-active' : '' }}"><li>{{ $i }}</li></a>
    @endfor
    @if ($testimonials->nextPageUrl())
        <a href="{{ $testimonials->nextPageUrl() }}"><li>></li></a>
    @endif
  </ul>
</div>

@endsection