	function refreshcode(id){
		 document.getElementById(id).src="../../conf/randcode.php?"+Math.random(1);
		return;
	}