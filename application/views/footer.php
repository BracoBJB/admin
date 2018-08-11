 </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script type="text/javascript">
        var baseurl="<?=base_url();?>";
    </script>

    <?php
        if(isset($script)) {
            $this->load->view($script);
        }
    ?>

    <?php 
    if($this->uri->segment(1)=='blog') { 
        if($this->uri->segment(2)=='comentarios') {
        ?>
        <script src="<?= base_url() ?>plantillas/js/comentarios.js"></script>
    <?php 
        }
        if($this->uri->segment(2)=='lista_blocked') {
        ?>
        <script src="<?= base_url() ?>plantillas/js/list_blocked.js"></script>
    <?php
        }
    } 
    ?>
</body>
</html>