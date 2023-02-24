<?php

	function rcStartup() {
		// Timezone
		timezone_select('America/Sao_Paulo');
	}

	function rcTitle($titleArray=array()) {
		return 'Rádio Clube de Pelotas' . (count($titleArray)>0?chr(32).'-'.chr(32):null) . implode(chr(32).chr(45).chr(32),$titleArray);
	}

	function rcDateToDb($date) {
		return date_create_from_format(_('d/m/Y'),$date)->format('Y-m-d');
	} 

	function rcDateFromDb($date) {
		return date_create_from_format(_('Y-m-d'),$date)->format('d/m/Y');		
	}
