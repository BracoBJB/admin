    <!-- <script src="<?=base_url()?>plantillas/js/lib/chosen/chosen.jquery.min.js"></script> -->

    <script>
        
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });

        jQuery(document).ready(function() {
            //alert(jQuery("#error-alert").length);
            if(jQuery("#error-alert").children().length>1) {
                jQuery("#error-alert").show();
            } else {
                jQuery("#error-alert").hide();
            }
        });
         window.onload = function () {
            CKEDITOR.replace('editor1', {
                language: 'es'
            });
        };
    </script>