@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="chart-wrapper">
                <div class="user-wrapper">
                    <div class="row align-items-center ">
                        <div class="col-lg-6 col-12 p-0 mc-b-3">
                            <div class="primary-heading color-dark">
                                <h2>Sections Management</h2>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-12">
                            <div class="text-right">
                                <a href="{{ route('admin.sections.create') }}" class="primary-btn primary-bg">Add New</a>
                            </div>
                        </div> --}}
                    </div>


                    <div class="table-responsive">
                        <table id="user-table" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Preview Image</th>
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $section->section_name)) }}</td>
                                        <td>
                                            <a href="{{ asset($section->preview_img ?? 'admin/assets/images/placeholder.png') }}"
                                                data-fancybox="gallery">
                                                <img src='{{ asset($section->preview_img ?? 'admin/assets/images/placeholder.png') }}'
                                                    alt='image' class='imgFluid list-img' loading='lazy'>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $section->is_active == 1 ? 'success' : 'danger' }}">
                                                {{ $section->is_active == 1 ? 'Active' : 'Non-Active' }}</span>
                                        </td>
                                        <td>{{ date('d-M-Y', strtotime($section->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown show action-dropdown">
                                                <a class=" dropdown-toggle" href="#" role="button"
                                                    id="action-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="action-dropdown">

                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.sections.edit_section', $section->section_name) }}"><i
                                                            class="fa fa-pen" aria-hidden="true"></i> Edit</a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.sections.suspend', $section->id) }}"><i
                                                            class="fa fa-ban" aria-hidden="true"></i>
                                                        {{ $section->is_active != 0 ? 'Suspend' : 'Activate' }}</a>
                                                    {{-- 
                                                    <form action="{{ route('admin.sections.destroy', $section->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                        </button>
                                                    </form> --}}

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('css')
    <style type="text/css">
        .list-img {
            object-fit: contain
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript"></script>
@endsection
