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
</body>
</html>