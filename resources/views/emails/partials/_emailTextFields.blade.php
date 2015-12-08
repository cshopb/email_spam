@for($email_count = 0; $email_count < count($emails); $email_count++)
    <!-- Email Form Input -->
    <!-- http://stackoverflow.com/questions/18838964/add-bootstrap-glyphicon-to-input-box -->
    <!-- http://getbootstrap.com/css/#forms-control-validation -->
    <div class="form-group {{ $input_color_feedback[$email_count] }} has-feedback">
        <span class='glyphicon {{ $icon[$email_count] }} form-control-feedback'></span>
        {!! Form::text(
            'email[' .$email_count .']',
            $emails[$email_count],
            ['class'        => 'form-control',
             'data-toggle'  => 'tooltip',
             'title'        => $tooltip[$email_count]]
        ) !!}
    </div>
@endfor

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>