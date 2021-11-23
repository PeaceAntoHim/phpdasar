$(document).ready(function() {
    
    // Hilangkan tombol cari
    $('#tombol-cari').hide();

    // Event ketika keyword di tulis
    $('#keyword').on('keyup', function() {
        // Munculkan icon loading
        $('.loader').show();

        // ajax mengguanakan load
        // $('#container').load('ajax/mafia.php?keyword=' + $('#keyword').val());
        
        // $.get()
        $.get('ajax/mafia.php?keyword=' + $('#keyword').val(), function(data) {
            $('#container').html(data);
            $('.loader').hide();
        });
    });


});

