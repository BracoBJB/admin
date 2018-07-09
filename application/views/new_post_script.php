    <script src="<?=base_url()?>plantillas/js/lib/chosen/chosen.jquery.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });

         window.onload = function () {
            CKEDITOR.replace('editor1', {
                language: 'es'
            });
        };
    </script>