<?
	function paginate($SELECT, $SQL, $PAGE, $ROWS_PER_PAGE){ 
    // n� linhas da query
    //echo 'SELECT COUNT(*) '.$SQL; die();
	//echo 'SELECT COUNT(*) '.$SQL; 
	$mysql_result = mysql_query('SELECT COUNT(*) '.$SQL);
    $row = mysql_fetch_row($mysql_result); 
    $num_rows = $row[0];
    //n� de p�ginas
    $num_pages = ceil($num_rows/$ROWS_PER_PAGE); 
    //corrigir a primeira p�gina, caso necess�rio
    $cur_page = max(0, min($PAGE - 1, $num_pages - 1)); 
    // pr�xima p�gina ou anterior p�gina, caso existam
    $prev_page = max(0, min($cur_page - 1, $num_pages - 1)); 
    $next_page = max(0, min($cur_page + 1, $num_pages - 1)); 
    // p�gina actual
    $mysql_result = mysql_query('SELECT '.$SELECT.' '.$SQL.' LIMIT '.($cur_page*$ROWS_PER_PAGE).','.$ROWS_PER_PAGE); 
	//echo "SELECT $SELECT $SQL";
    $results = array(); 
    while($assoc = mysql_fetch_assoc($mysql_result)){ 
        $results[] = $assoc; 
    } 
    // resto
    return array( 
        'results' => $results 
    ,    'num_pages' => $num_pages 
    ,    'prev_page' => $prev_page + 1 
    ,    'cur_page' => $cur_page + 1 
    ,    'next_page' => $next_page + 1 
    ,    'last_page' => $num_pages - 1 
    ); 
}
?> 