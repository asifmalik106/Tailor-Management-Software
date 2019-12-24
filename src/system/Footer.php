 <!-- BEGIN FOOTER -->
            <div class="page-footer">
                <div class="page-footer-inner">
                    
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div>
        </div>

        <!--[if lt IE 9]>
<script src="<?php echo BASE_URL; ?>asset/global/plugins/respond.min.js"></script>
<script src="<?php echo BASE_URL; ?>asset/global/plugins/excanvas.min.js"></script> 
<script src="<?php echo BASE_URL; ?>asset/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo BASE_URL; ?>asset/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>asset/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>asset/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>asset/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>asset/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>asset/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo BASE_URL; ?>asset/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo BASE_URL; ?>asset/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>asset/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>asset/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>asset/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
	<?php
		if(isset($data['js'])){
			foreach ($data['js'] as $js) {
				echo '<script type="text/javascript" src="'.BASE_URL.'asset/'.$js.'"></script>';
			}
		}
	?>
</body>
</html>