@if (session ('new_notify'))
    <div class="alert alert-danger" role="alert">
        <button type="button"class="close"data-dismiss="alert"aria-label="Close"><span aria-hidden="true">x</span></button>
                <p><strong>{{ session ('new_notify') }}</strong></p>
    </div>
@endif
