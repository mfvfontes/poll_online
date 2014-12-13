<?
	function paginate($SELECT, $SQL, $PAGE, $ROWS_PER_PAGE){ 
    // nº linhas da query
    //echo 'SELECT COUNT(*) '.$SQL; die();
	//echo 'SELECT COUNT(*) '.$SQL; 
	$mysql_result = mysql_query('SELECT COUNT(*) '.$SQL);
    $row = mysql_fetch_row($mysql_result); 
    $num_rows = $row[0];
    //nº de páginas
    $num_pages = ceil($num_rows/$ROWS_PER_PAGE); 
    //corrigir a primeira página, caso necessário
    $cur_page = max(0, min($PAGE - 1, $num_pages - 1)); 
    // próxima página ou anterior página, caso existam
    $prev_page = max(0, min($cur_page - 1, $num_pages - 1)); 
    $next_page = max(0, min($cur_page + 1, $num_pages - 1)); 
    // página actual
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