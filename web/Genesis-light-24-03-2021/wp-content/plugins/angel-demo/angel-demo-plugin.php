<?php
/**
 * abc-demo-plugin
 *
 * Plugin Name: angel-demo-plugin
 * Plugin URI:  https://github.com/angeljl98/
 * Description: When a visitor navigates to that endpoint, the plugin has to send an HTTP request to a REST API endpoint.
 * Version:     1.0
 * Author:      Angel Lucena
 * Author URI:  https://torre.co/en/angeljl98
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: classic-editor
 * Domain Path: /
 * Requires at least: 5.4
 * Requires PHP: 7.2.9
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

defined('ABSPATH') or die( "Bye bye" );
add_filter('the_content', 'cathy_plugin_demo_filter_content');
function cathy_plugin_demo_filter_content($content)
{
    $host= $_SERVER["HTTP_HOST"];
    $url= $_SERVER["REQUEST_URI"];
    print($url);
    
    if (("-" . $url)=="-/landing-page/") {
    $content = '
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
		$("document").ready(function () {
		});
	</script>

    <table id="userstable"></table> 
	<script type="text/javascript">
	fetch("https://jsonplaceholder.typicode.com/users") 
    
    // Converting received data to JSON
    .then(response => response.json())
    .then(json => { 
   
        // Create a variable to store HTML 
        let li = `<tr>
        <th style="background-color: #eee; font-size:30%;">Id</th>
        <th style="background-color: #eee; font-size:50%;">Name</th>
		<th style="background-color: #eee; font-size:50%;">Address</th>
		<th style="background-color: #eee; font-size:50%;">Phone</th>
		<th style="background-color: #eee; font-size:50%;">Website</th>
		<th style="background-color: #eee; font-size:50%;">Company</th>
        </tr>`; 
    
        json.forEach(user => { 
            let urlUserId = `http://jsonplaceholder.typicode.com/posts?userId=${user.id}`;
            li += `<tr>
                
                <td style="font-size:50%;">${user.id}</a></td> 
                <td style="font-size:50%;">${user.name} (${user.username}), email: ${user.email}</a></td>
				<td style="font-size:50%;">${user.address.street}, ${user.address.suite}, ZIP Code ${user.address.zipcode}, ${user.address.city}; 
				(Geo-location: ${user.address.geo.lat}, ${user.address.geo.lng})</td>
				<td style="font-size:50%;">${user.phone}</td>
				<td style="font-size:50%;">${user.website}</td>
				<td style="font-size:50%;">${user.company.name} :: ${user.company.catchPhrase}</td>
            </tr>`; 
        }); 
   
    // Display result 
    document.getElementById("userstable").innerHTML = li; 
}); 
    
</script>
';
    
    }
    return $content;
}