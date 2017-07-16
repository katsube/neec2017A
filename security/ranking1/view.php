<?php
require_once('config.php');

//--------------------------
// データファイルをそのまま返却
//--------------------------
echo file_get_contents(RANKING_FILE);

exit(0);