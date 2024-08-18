@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-12 col-12">
                    <div class="primary-heading color-dark text-center">
                        <h2>Edit City</h2>
                    </div>
                </div>

            </div>
            <form action="{{ route('admin.cities.update', $city->id) }}" method="POST" enctype="multipart/form-data"
                class="main-form">

@csrf
@method('PATCH') 

                <div class="row justify-content-center">
                      <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label> Select Country*:</label>
                            <select  name="country_id" class="form-control" required>
                                <option disabled selected>Select</option>
                                @foreach($countries as $country)
                                 <option value="{{ $country->id }}" {{ old('country_id', $city->country_id) == $country->id  ? 'selected' : ''}}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country_id'))
                                <span class="error">{{ $errors->first('country_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="form-group">
                            <label>Name*:</label>
                            <input type="text" name="name" value="{{ old('name', $city->name) }}"
                                class="form-control" placeholder="Enter name" required>
                            @if ($errors->has('name'))
                                <span class="error">{{ $errors->first('name') }}</span>
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

    </div>
@endsection
@section('css')
    <style type="text/css">
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        
    </script>
@endsection
