@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<div class="main-sec">
      <div class="main-wrapper">
        <div class="row align-items-center mc-b-3">
          <div class="col-lg-6 col-12">
            <div class="primary-heading color-dark">
              <h2>Users</h2>
            </div>
          </div>
         
        </div>
        <form action="{{route('admin.create_users')}}" method="POST" enctype="multipart/form-data" id="create_user_form" class="main-form create_user_form">
            @csrf
        <div class="row mc-b-2">
          <div class="col-lg-8 col-md-8 col-12 col-center">
            <div class="user-img-wrapper mc-b-3">
              <figure><img src="{{asset('images/user-details.png')}}" class="user-details-img" alt="user-img"></figure>
              <label for="user-img" class="user-img-btn"><i class="fa fa-camera"></i></label>
              <input type="file"  onchange="readURL(this);" name="avatar" id="user-img" class="d-none"  accept="image/jpeg, image/png">
             
            </div>
          
          </div>
        </div>
        
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label>First Name*:</label>
                <input type="text" name="fname"  class="form-control" placeholder="Enter First Name">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label>Last Name*:</label>
                <input type="text" name="lname"  class="form-control" placeholder="Enter Last Name">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label>Email Address*:</label>
                <input type="email" name="email"  class="form-control" placeholder="Enter Email Address">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label>Password*:</label>
                <div class="relative-div">
                  <input type="password" name="password"  class="form-control" placeholder="Enter Password">
                  <a href="javascript:void(0)" class="show-password-btn"><i class="fa fa-eye-slash"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label>Confirm Password*:</label>
                <div class="relative-div">
                  <input type="password" name="password_confirmation"  class="form-control" placeholder="Enter Confirm Password">
                  <a href="javascript:void(0)" class="show-password-btn"><i class="fa fa-eye-slash"></i></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label>Status*:</label>
                <ul class="list-inline">
                  <li class="list-inline-item">
                    <div class="checkbox">
                      <input type="radio" id="user1" name="is_active"  value="1">
                      <label for="user1">Active</label>
                    </div>
                  </li>
                  <li class="list-inline-item">
                    <div class="checkbox">
                      <input type="radio" id="user2" name="is_active" value="0" >
                      <label for="user2">In Active</label>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <label>Date of Birth*:</label>
                <div class="relative-div">
                  <input type="date" name="dob" required class="form-control" >
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-12">
            <div class="text-center">
              <button type="button" class="primary-btn primary-bg add-user">Add</button>
            </div>
          </div>
          </form>
          </div>
        
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
     function readURL(input) {
        if (input.files && input.files[0]) {
            console.log('sad');
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.user-details-img')
                    .attr('src', e.target.result);
                    console.log(e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
(()=>{
    $( ".add-user" ).click(function(e) {
    e.preventDefault();
      //var data = $(".create_user_form").serialize();
      var data = new FormData(document.getElementById("create_user_form"));
       console.log(data);
    //   return 0;
      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
    			type:'POST',
    			url:'{{route('admin.create_users')}}',
    			data:data,
			    enctype: 'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
               
    			success:function(data) {
    
    		 
                   
                if(data.status == 1){
                        $.toast({
                        heading: 'Success!',
                        position: 'top-right',
                        text:  data.msg,
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 2500,
                        stack: 6
                    });
    
                    $('.create_user_form')[0].reset();
                     window.location.href = "{{route('admin.users_listing')}}";
                    // $("#change-password-modal").modal("hide"); 
                }
    
           
            if(data.status == 2){
                $.toast({
    				heading: 'Error!',
    				position: 'bottom-right',
    				text:  data.error,
    				loaderBg: '#ff6849',
    				icon: 'error',
    				hideAfter: 5000,
    				stack: 6
    			});
            }
            // $('#updatepwd')[0].reset();
    	    }
    
    			});
    });
})()
</script>
@endsection