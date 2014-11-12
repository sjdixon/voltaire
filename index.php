<html>
	<p> Hello World! </p>
	<?php

// setup the autoloading
require_once 'vendor/autoload.php';

// setup Propel
require_once 'generated-conf/config.php';
		$q = new TournamentQuery();
		$firstTournament = $q->findPK(1);
		echo $firstTournament->getName();
	?>
</html>