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
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var email = button.data('email');
        var id = button.data('id');
        var modal = $(this);

        modal.find('.modal-title').text('Delete ' + email);
        modal.find('.modal-body p').text('Are you sure you want to permanently delete ' + email + '?');

        $('#delete-form').attr('action', 'http://' + window.location.host + '/emails/' + id);
    })
</script>