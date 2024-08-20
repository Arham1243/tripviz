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
                                <h2>Testimonials Management</h2>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="text-right">
                                <a href="{{ route('admin.testimonials.create') }}" class="primary-btn primary-bg">Add New</a>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table id="user-table" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Main Image</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $testimonial->title }}</td>
                                        <td>{{ $testimonial->content }}</td>
                                        <td>
                                            <a href="{{ asset($testimonial->main_img_path ?? 'admin/assets/images/placeholder.png') }}"
                                                data-fancybox="gallery">
                                                <img src='{{ asset($testimonial->main_img_path ?? 'admin/assets/images/placeholder.png') }}'
                                                    alt='image' class='imgFluid list-img' loading='lazy'>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="stars">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class='bx {{ $i < $testimonial->rating ? 'bxs' : 'bx' }}-star'></i>
                                                @endfor
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $testimonial->is_active == 1 ? 'success' : 'danger' }}">
                                                {{ $testimonial->is_active == 1 ? 'Active' : 'Non-Active' }}</span>
                                        </td>
                                        <td>{{ date('d-M-Y', strtotime($testimonial->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown show action-dropdown">
                                                <a class=" dropdown-toggle" href="#" role="button"
                                                    id="action-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="action-dropdown">

                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.testimonials.edit', $testimonial->id) }}"><i
                                                            class="fa fa-pen" aria-hidden="true"></i> Edit</a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.testimonials.suspend', $testimonial->id) }}"><i
                                                            class="fa fa-ban" aria-hidden="true"></i>
                                                        {{ $testimonial->is_active != 0 ? 'Suspend' : 'Activate' }}</a>

                                                    <form
                                                        action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                                        </button>
                                                    </form>

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
        .stars {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stars i {
            color: orange;
            font-size: 1.25rem;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript"></script>
@endsection
