<form class=communications-subscription__form method="POST" action="{{ route('newsletter-save') }}">
    <div class=form-field>
        @csrf
        <div class=form-input>
            <input id=email type=email name=email placeholder="Email" required>
            <span class="c-input__icon c-input__icon--posticon">
                <span class=c-icon>
                    <i class="bx bx-envelope"></i>
                </span>
            </span>
        </div>
    </div>
    <button type=submit class="app-btn themeBtn">Sign up</button>
</form>
