 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


 <script src="{{ asset('admin/assets/js/all.min.js') }}"></script>
 <script src="{{ asset('admin/assets/js/ckeditor/ckeditor.js') }}"></script>
 <script src="{{ asset('admin/assets/js/ckeditor/config.js') }}"></script>

 @vite('resources/js/app.js')
 
 <script src="{{ asset('admin/assets/js/notifications.js') }}"></script>
 <script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

 <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
 <script src="{{ asset('admin/login/assets/js/jquery.toast.js') }}"></script>
 <script type="text/javascript">
     (() => {

         var Loader = function() {

             return {

                 show: function() {
                     jQuery("#preloader").show();
                 },

                 hide: function() {
                     jQuery("#preloader").hide();
                 }
             };

         }();
         @if (session('crawl_success'))
             $('#crawl-success-alert-modal-1').modal('show');
         @endif
         /*in page css here*/

         $('.li-dropdown').on('click', function() {
             var dropdown = $(this).find('>.dropdown-content');
             if (!dropdown.hasClass('open')) {
                 dropdown.addClass('open');
                 dropdown.slideDown(500);
             } else {
                 dropdown.removeClass('open');
                 dropdown.slideUp(500);
             }
         });

     })();
 </script>
