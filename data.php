<?php
// Database details
$db_server   = 'localhost';
$db_username = '***';
$db_password = '***';
$db_name     = '***';

// Get job (and id)
$job = '';
$id  = '';
if (isset($_GET['job'])){
  $job = $_GET['job'];
  if ($job == 'get_companies' ||
      $job == 'get_company'   ||
      $job == 'add_company'   ||
      $job == 'edit_company'  ||
      $job == 'delete_company'){
    if (isset($_GET['id'])){
      $id = $_GET['id'];
      if (!is_numeric($id)){
        $id = '';
      }
    }
  } else {
    $job = '';
  }
}

// Prepare array
$mysql_data = array();

// Valid job found
if ($job != ''){
  
  // Connect to database
  $db_connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);
  if (mysqli_connect_errno()){
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
    $job     = '';
  }
  
  // Execute job
  if ($job == 'get_companies'){
    
    // Get companies
    $query = "SELECT * FROM it_companies ORDER BY rank";
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($company = mysqli_fetch_array($query)){
        $functions  = '<div class="function_buttons"><ul>';
        $functions .= '<li class="function_edit"><a data-id="'   . $company['company_id'] . '" data-name="' . $company['company_name'] . '"><span>Edit</span></a></li>';
        $functions .= '<li class="function_delete"><a data-id="' . $company['company_id'] . '" data-name="' . $company['company_name'] . '"><span>Delete</span></a></li>';
        $functions .= '</ul></div>';
        $mysql_data[] = array(
          "rank"          => $company['rank'],
          "company_name"  => $company['company_name'],
          "industries"    => $company['industries'],
          "revenue"       => '$ ' . $company['revenue'],
          "fiscal_year"   => $company['fiscal_year'],
          "employees"     => number_format($company['employees'], 0, '.', ','),
          "market_cap"    => '$ ' . $company['market_cap'],
          "headquarters"  => $company['headquarters'],
          "functions"     => $functions
        );
      }
    }
    
  } elseif ($job == 'get_company'){
    
    // Get company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "SELECT * FROM it_companies WHERE company_id = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
        while ($company = mysqli_fetch_array($query)){
          $mysql_data[] = array(
            "rank"          => $company['rank'],
            "company_name"  => $company['company_name'],
            "industries"    => $company['industries'],
            "revenue"       => $company['revenue'],
            "fiscal_year"   => $company['fiscal_year'],
            "employees"     => $company['employees'],
            "market_cap"    => $company['market_cap'],
            "headquarters"  => $company['headquarters']
          );
        }
      }
    }
  
  } elseif ($job == 'add_company'){
    
    // Add company
    $query = "INSERT INTO it_companies SET ";
    if (isset($_GET['rank']))         { $query .= "rank         = '" . mysqli_real_escape_string($db_connection, $_GET['rank'])         . "', "; }
    if (isset($_GET['company_name'])) { $query .= "company_name = '" . mysqli_real_escape_string($db_connection, $_GET['company_name']) . "', "; }
    if (isset($_GET['industries']))   { $query .= "industries   = '" . mysqli_real_escape_string($db_connection, $_GET['industries'])   . "', "; }
    if (isset($_GET['revenue']))      { $query .= "revenue      = '" . mysqli_real_escape_string($db_connection, $_GET['revenue'])      . "', "; }
    if (isset($_GET['fiscal_year']))  { $query .= "fiscal_year  = '" . mysqli_real_escape_string($db_connection, $_GET['fiscal_year'])  . "', "; }
    if (isset($_GET['employees']))    { $query .= "employees    = '" . mysqli_real_escape_string($db_connection, $_GET['employees'])    . "', "; }
    if (isset($_GET['market_cap']))   { $query .= "market_cap   = '" . mysqli_real_escape_string($db_connection, $_GET['market_cap'])   . "', "; }
    if (isset($_GET['headquarters'])) { $query .= "headquarters = '" . mysqli_real_escape_string($db_connection, $_GET['headquarters']) . "'";   }
    $query = mysqli_query($db_connection, $query);
    if (!$query){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
    }
  
  } elseif ($job == 'edit_company'){
    
    // Edit company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "UPDATE it_companies SET ";
      if (isset($_GET['rank']))         { $query .= "rank         = '" . mysqli_real_escape_string($db_connection, $_GET['rank'])         . "', "; }
      if (isset($_GET['company_name'])) { $query .= "company_name = '" . mysqli_real_escape_string($db_connection, $_GET['company_name']) . "', "; }
      if (isset($_GET['industries']))   { $query .= "industries   = '" . mysqli_real_escape_string($db_connection, $_GET['industries'])   . "', "; }
      if (isset($_GET['revenue']))      { $query .= "revenue      = '" . mysqli_real_escape_string($db_connection, $_GET['revenue'])      . "', "; }
      if (isset($_GET['fiscal_year']))  { $query .= "fiscal_year  = '" . mysqli_real_escape_string($db_connection, $_GET['fiscal_year'])  . "', "; }
      if (isset($_GET['employees']))    { $query .= "employees    = '" . mysqli_real_escape_string($db_connection, $_GET['employees'])    . "', "; }
      if (isset($_GET['market_cap']))   { $query .= "market_cap   = '" . mysqli_real_escape_string($db_connection, $_GET['market_cap'])   . "', "; }
      if (isset($_GET['headquarters'])) { $query .= "headquarters = '" . mysqli_real_escape_string($db_connection, $_GET['headquarters']) . "'";   }
      $query .= "WHERE company_id = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query  = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
    
  } elseif ($job == 'delete_company'){
  
    // Delete company
    if ($id == ''){
      $result  = 'error';
      $message = 'id missing';
    } else {
      $query = "DELETE FROM it_companies WHERE company_id = '" . mysqli_real_escape_string($db_connection, $id) . "'";
      $query = mysqli_query($db_connection, $query);
      if (!$query){
        $result  = 'error';
        $message = 'query error';
      } else {
        $result  = 'success';
        $message = 'query success';
      }
    }
  
  }
  
  // Close database connection
  mysqli_close($db_connection);

}

// Prepare data
$data = array(
  "result"  => $result,
  "message" => $message,
  "data"    => $mysql_data
);

// Convert PHP array to JSON array
$json_data = json_encode($data);
print $json_data;
?>