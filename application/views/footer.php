 </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="<?= base_url()?>plantillas/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="<?= base_url()?>plantillas/js/plugins.js"></script>
    <script src="<?= base_url()?>plantillas/js/main.js"></script>


    <!-- <script src="<?= base_url()?>plantillas/js/lib/chart-js/Chart.bundle.js"></script> -->
    <!-- <script src="<?= base_url()?>plantillas/js/dashboard.js"></script> -->
    <!-- <script src="<?= base_url()?>plantillas/js/widgets.js"></script> -->

    <?php
        if(isset($script)) {
            $this->load->view($script);
        }
    ?>
</body>
</html>