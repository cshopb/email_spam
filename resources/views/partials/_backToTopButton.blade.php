<a href="#" class="back-to-top">
    <span class="glyphicon glyphicon-chevron-up back-to-top"></span>
</a>

<script language="JavaScript" type="text/javascript">
    var amountScrolled = 100;

    // Fade in and out effect.
    $(window).scroll(function () {
        if ($(window).scrollTop() > amountScrolled) {
            $('a.back-to-top').fadeIn('slow');
        } else {
            $('a.back-to-top').fadeOut('slow');
        }
    });

    // Animation when moving up. If removed it will still move up,
    // but instead of animation it will just snap to top.
    $('a.back-to-top').click(function() {
        $('body, html').animate({
            scrollTop: 0
        }, 700);
        return false;
    });
</script>