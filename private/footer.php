    
</div>    
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="<?php echo url_for('/assets/js/jquery-slim.min.js'); ?>"></script>
    <script src="<?php echo url_for('/assets/js/tether.min.js'); ?>"></script>
    <script src="<?php echo url_for('/assets/js/bootstrap.min.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
  </body>
</html>

<?php
    db_disconnect($db);
?>