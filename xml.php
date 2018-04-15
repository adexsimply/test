<?php
/* Made by Daniel K. Schneider, TECFA Jan 2010. This is freeware
   Will connect to a MySQL database, execute an SQL statement and
   then return the result as valid XML. 
 */
error_reporting(0);
$cat = $_GET['cat'];
$dom = new DomDocument('1.0', 'UTF-8'); 

// ---------------------------  Configuration section

// Fill in according to your db settings (example is for a local and locked "play" WAMP server)
// Make sure to keep the ; and the ""
// $host       = "localhost";
// $user       = "xmanbaba_mtn";
// $pass       = "Fiverrbuild123!";
// $database   = "xmanbaba_pinnacle";

$host       = "localhost";
$user       = "root";
$pass       = "";
$database   = "pinnacle";

// Replace by a query that matches your database
$SQL_query = "SELECT * FROM content_sms where category_name LIKE '%$cat%' ORDER BY id DESC";

// Optional: add the name of XSLT file.
// $xslt_file = "mysql-result.xsl"; 

// -------------------------- no changes needed below

$DB_link = mysqli_connect($host, $user, $pass, $database) or die("Could not connect to host.");
//mysqli_select_db($database, $DB_link) or die ("Could not find or access the database.");
$result = mysqli_query ($DB_link, $SQL_query) or die ("Data not found. Your SQL query didn't work... ");

// we produce XML
header("Content-type: text/xml");
$XML = "<?xml version=\"1.0\"?>\n";
// root node
$XML .= "<rss xmlns:dc='' version='2.0'>\n";
$XML .= "\t<channel>\n";
// rows
while ($row = mysqli_fetch_array($result)) {  
$XML .= "\t\t<item>\n"; 
  $i = 0;
  // cells
  foreach ($row as $cell) {
    // Escaping illegal characters - not tested actually ;)
    //$cell = str_replace("&", "&amp;", $cell);
    $cell = str_replace("<", "&lt;", $cell);
    $cell = str_replace(">", "&gt;", $cell);
    $cell = str_replace("\"", "&quot;", $cell);
    $col_name1 = mysqli_fetch_field_direct($result,$i);
    $col_name = $col_name1->name;
    // creates the "<tag>contents</tag>" representing the column
    if ($col_name !='id' && $col_name!='user' && $col_name!='word_count' && $col_name!='is_archived' && $col_name!='status') {
      //if ($col_name='category_name'){
       //$col_name = "title";
   //str_replace(search, replace, subject)
     // }
      if (!empty($cell))
      {
    $XML .= "\t\t<" . str_replace(['category_name','content','date_published'],['title', 'description','pubDate'], $col_name) . ">" .htmlspecialchars($cell) . "</" . str_replace(['category_name', 'content','date_published'],['title', 'description','pubDate'], $col_name) . ">\n";
    }
  }
    $i++;
  }
$XML .= "</item>\n";
 }
$XML .= "</channel>\n";
$XML .= "</rss>\n";

// output the whole XML string
echo $XML;
$dom->loadXML($XML);
$dom->save('document.xml');
//header('location:base_url()');
//echo $dom->$XML->saveXML() . "\n";

?>