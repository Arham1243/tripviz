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
                                <h2>Tour Reviews</h2>
                            </div>
                        </div>
                         <div class="col-lg-6 col-12">
                            <div class="text-right">
                                {{--<a href="{{ route('admin.tour-reviews.create') }}" class="primary-btn primary-bg">Add New</a>--}}
                            </div>
                        </div>
                        </div>


                        <div class="table-responsive">
                            <table id="user-table" class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Tour</th>
                                        <th>Username</th>
                                        <th>Review Title</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Added On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $review->tour->title ?? 'N/A' }}</td>
                                            <td>{{ $review->user->full_name ?? 'N/A' }}</td>
                                            <td>{{ $review->title }}</td>
                                            <td>
                                                <div class="stars">
                        @for ($i = 0; $i < 5; $i++)
                            <i class='bx {{ $i < $review->rating ? 'bxs' : 'bx' }}-star'></i>
                        @endfor
                    </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $review->is_active == 1 ? 'success' : 'danger' }}">
                                                    {{ $review->is_active == 1 ? 'Active' : 'Non-Active' }}</span>
                                            </td>
                                            <td>{{ date('d-M-Y', strtotime($review->created_at)) }}</td>
                                            <td>
                                                <div class="dropdown show action-dropdown">
                                                    <a class=" dropdown-toggle" href="#" role="button"
                                                        id="action-dropdown" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="action-dropdown">

                                                        <a class="dropdown-item"
   href="{{ route('admin.tour-reviews.edit', $review->id) }}"><i
        class="fa fa-pen" aria-hidden="true"></i> View Details</a>

<a class="dropdown-item"
   href="{{ route('admin.tour-reviews.suspend', $review->id) }}"><i
        class="fa fa-ban" aria-hidden="true"></i>
    {{ $review->is_active != 0 ? 'Suspend' : 'Activate' }}</a>

<form action="{{ route('admin.tour-reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete?')">
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
