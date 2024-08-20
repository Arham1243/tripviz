
<!-- Modal -->
<div class="modal fade" id="suspnd" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('images/suspended.png') }}" alt="">
                <h6 class="dark-gren-36">Your profile has been suspended.
                    Please Contact Admin for
                    more details.</h6>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="log-out" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('images/arrow.png') }}" alt="">
                <h6 class="dark-gren-36">Are you sure you want
                    to log out ?</h6>
                <a href="login.php" class="btn yellow-btn mt-0">Yes</a>
                <a href="#_" class="btn pink-bodr-btn mt-0">No</a>
            </div>
        </div>
    </div>
</div>
