<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <!-- action is provided with jQuery -->
                {!! Form::open(['id' => 'delete-form', 'method' => 'DELETE', 'class' => 'form-inline']) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<!-- http://getbootstrap.com/javascript/#modals-related-target -->
<!-- Change the email depending which button was pressed -->
<script type="text/javascript">
    $('#deleteModal').on('show.bs.modal', function (event) {
        // Button variable will have the data of the button
        // that was pressed on the original form, not on modal.
        // In our case it is the <a> for deletion.
        var button = $(event.relatedTarget);
        var link;
        var message;
        if (button.data('email') != null) {
            var email = button.data('email');
            link = '/emails/';
            message = 'Are you sure you want to permanently delete ' + email + '?';
        } else if (button.data('customer') != null) {
            var customer = button.data('customer');
            link = '/customers/';
            message = 'Are you sure you want to permanently delete ' + customer
                        + '? This will delete all the emails that are associated with this customer!';
        }
        var id = button.data('id');
        var modal = $(this);

        modal.find('.modal-title').text('Delete');
        modal.find('.modal-body p').text(message);

        $('#delete-form').attr('action', 'http://' + window.location.host + link + id);
    })
</script>