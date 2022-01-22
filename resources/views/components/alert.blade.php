<div class="{{ $class  }}" id="alert">
   {{ $slot  }}
</div>


<script>
    setTimeout(function() {
        $('#alert').fadeOut('fast');
    }, 2000);
</script>
