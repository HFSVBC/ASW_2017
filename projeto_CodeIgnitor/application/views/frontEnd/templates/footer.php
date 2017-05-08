<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
	<footer id="footerAndCopyright">
		<p id="FC-copyright">&copy; Copyright Poker Online, 2017-<?php date_default_timezone_set("Europe/Lisbon"); echo date("Y");?>. Todos os direitos reservados.</p>
	</footer>
	<div class="alert alert-info alert-dismissible" id="potAlert" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Warning!</strong> <span id="potSpan"></span>
    </div>   
</body>
</html>