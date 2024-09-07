@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-12 col-12">
                    <div class="primary-heading color-dark text-center">
                        <h2>Add FAQ</h2>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.tours-faqs.store') }}" method="POST" class="main-form">
                @csrf

                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Select Tour*:</label>
                            <select name="tour_id" class="form-control">
                                <option disabled selected>Select</option>
                                @foreach ($tours as $tour)
                                    <option value="{{ $tour->id }}" {{ old('tour_id') == $tour->id ? 'selected' : '' }}>
                                        {{ $tour->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tour_id'))
                                <span class="error">{{ $errors->first('tour_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Question*:</label>
                            <input type="text" name="question" class="form-control" placeholder="Enter Question" required
                                value="{{ old('question') }}">
                            @if ($errors->has('question'))
                                <span class="error">{{ $errors->first('question') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Answer*:</label>
                            <textarea name="answer" class="form-control" placeholder="Enter Answer" required>{{ old('answer') }}</textarea>
                            @if ($errors->has('answer'))
                                <span class="error">{{ $errors->first('answer') }}</span>
                            @endif
                        </div>
                    </div>



                    <div class="col-lg-12 col-12">
                        <div class="text-center">
                            <button class="primary-btn primary-bg">Add FAQ</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <style type="text/css">
        /*in page css here*/
        .img-fluid {
            max-width: 113px;
            height: 113px;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        // Custom JS here if needed
    </script>
@endsection
