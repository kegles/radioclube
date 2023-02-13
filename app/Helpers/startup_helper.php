<?php

	function rcStartup() {
		// Timezone
		helper('date');
		timezone_select('America/Sao_Paulo');
	}

	function rcTitle() {
		return 'Rádio Clube de Pelotas';
	}