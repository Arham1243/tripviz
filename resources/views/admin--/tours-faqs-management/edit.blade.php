@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-12 col-12">
                    <div class="primary-heading color-dark text-center">
                        <h2>Edit FAQ</h2>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.tours-faqs.update', $faq->id) }}" method="POST" enctype="multipart/form-data" class="main-form">
                @csrf
                @method('PATCH')

                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Select Tour*:</label>
                            <select name="tour_id" class="form-control" required>
                                <option disabled selected>Select</option>
                                @foreach($tours as $tour)
                                    <option value="{{ $tour->id }}" {{ old('tour_id', $faq->tour_id) == $tour->id ? 'selected' : '' }}>
                                        {{ $tour->title }}
                                    </option>
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
                            <input type="text" name="question" value="{{ old('question', $faq->question) }}" class="form-control" placeholder="Enter question" required>
                            @if ($errors->has('question'))
                                <span class="error">{{ $errors->first('question') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Answer*:</label>
                            <textarea name="answer" class="form-control" placeholder="Enter answer" required>{{ old('answer', $faq->answer) }}</textarea>
                            @if ($errors->has('answer'))
                                <span class="error">{{ $errors->first('answer') }}</span>
                            @endif
                        </div>
                    </div>

                  

                    <div class="col-lg-12 col-12">
                        <div class="text-center">
                            <button class="primary-btn primary-bg">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style type="text/css">
        /* Custom CSS if needed */
    </style>
@endsection

@section('js')
    <script type="text/javascript">
        // Custom JavaScript if needed
    </script>
@endsection
