<?
// your available sites
$sites = [ 'tx', 'address', 'api', 'block', 'home', 'index', 'wallet', 'contact' ];

$path = $_GET['path'];
$params = explode( "/", $path );
$site = array_shift($params);

if( in_array( $site, $sites ) ){
    include($site.".php");
}
?>