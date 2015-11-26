@if (Session::has('flash_notification'))
            <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4>{{ Session::get('flash_notification.message') }}</h4>
            </div>

@endif