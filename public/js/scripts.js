    //
    // $(document).ready(function(){
    //
    //     $('#gallery').lightGallery({
    //         counter: false,
    //         controls: false,
    //         mousewheel: false,
    //         enableSwipe: false,
    //         closable: false,
    //     });
    //
    //     $('#gallery').lightGallery();
    //
    //     var $lg = $('#gallery');
    //
    //     $lg.lightGallery();
    //
    //     $lg.on('onBeforeClose.lg',function(event){
    //         $(".single-image-rightbar").modal("hide");
    //     });
    //
    // });


    // image gallery
    // init the state from the input
    $(".image-checkbox").each(function () {
        if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
            $(this).addClass('image-checkbox-checked');
        }
        else {
            $(this).removeClass('image-checkbox-checked');
        }
    });

    // sync the state to the input
    $(".image-checkbox").on("click", function (e) {
        $(this).toggleClass('image-checkbox-checked');
        var $checkbox = $(this).find('input[type="checkbox"]');
        $checkbox.prop("checked",!$checkbox.prop("checked"))

        e.preventDefault();
    });

