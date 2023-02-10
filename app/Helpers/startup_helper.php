<?php

	function rcStartup() {
		// Timezone
		helper('date');
		timezone_select('America/Sao_Paulo');
		
		// Composer Autoloader
		require VENDORPATH.'autoload.php';
	}