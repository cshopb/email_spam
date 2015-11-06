<script language="JavaScript" type="text/javascript">
    // http://api.jquery.com/attribute-starts-with-selector/
    $("[name^=email]").on('input', function () {
        var $emailInput = $(this);
        $.ajax({
            type: 'POST',
            url: "refresh",
            // This is needed otherwise the ajax will return CSRF error
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
            },
            data: {emailToCheck: $emailInput.val()},
            success: function (emailType) {
                // https://api.jquery.com/parent/
                // https://api.jquery.com/find/
                var $parent = $emailInput.parent();
                if (emailType == 'isEmail') {
                    $parent.attr('class', 'form-group has-success has-feedback');
                    $parent.find('span').attr('class', 'glyphicon glyphicon-ok form-control-feedback');
                } else if (emailType == 'notEmail') {
                    $parent.attr('class', 'form-group has-error has-feedback');
                    $parent.find('span').attr('class', 'glyphicon glyphicon-remove form-control-feedback');
                } else if (emailType == 'emailExists') {
                    $parent.attr('class', 'form-group has-warning has-feedback');
                    $parent.find('span').attr('class', 'glyphicon glyphicon-warning-sign form-control-feedback');
                }
            },
            error: function () {
                alert("Failure");
            }
        });
    });
</script>