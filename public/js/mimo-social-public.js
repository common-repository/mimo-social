(function( $ ) {
	'use strict';

	//http://codepen.io/juanv/pen/gbgjLe
//Use the code as you want, just replace the access tokens, I don't mind, but it would be
//better if you use your own because I might delete the tokens and the code might no longer work.
//The Twitter and Vine counter require PHP, all other counters only use jQuery.
//PHP code that was used to get Vine followers is at the bottom of the page
//The Twitter counter requires two PHP files, I left some references so you can download those PHP files
//Instagram counter will only work with your access token, my access token only allows me to retrieve information from my profile
//This is not a plugin, this is just to show you how easy it is to retrieve data from APIs...
var mimo_social_data = $.parseJSON(mimo_social_general_settings);
//Get Usernames
var facebook = mimo_social_data['mimo_social_facebook_id'];
var twitter = mimo_social_data['mimo_social_twitter_username'];
var google_plus = mimo_social_data['mimo_social_google_user'];
var google_api_key = mimo_social_data['mimo_social_google_api_key'];

var pinterest = mimo_social_data['mimo_social_pinterest_username'];



if(mimo_social_data['mimo_social_facebook_id'] ) {
	//Facebook API
	//60 Day Access Token - Regenerate a new one after two months
	//https://neosmart-stream.de/facebook/how-to-create-a-facebook-access-token/
	var token = "EAAXIDV9mIJgBAAQCw78SYNSmLlCmfoTVyaJdqG27BDyU3DdWxz63HVXDvlc4FHaxrsuzyb9Nyd6vJoBYgirPveuZBZBLgkGTV6QZAY4iN4KMclQgZAGUBLI7dA2qyggqtEOSxY4DEwZAct0rNWybHaSzgKZCDBxlkZD";
	$.ajax({
	  url: 'https://graph.facebook.com/'+facebook,
	  dataType: 'json',
	  type: 'GET',
	  data: {access_token:token,fields:'likes'},
	  success: function(data) {   
	    var followers = parseInt(data.likes);
	    var k = kFormatter(followers);
	    $('#mimo_social_count .facebook .count').append(k); 
	    getTotal(followers); 
	  } 
	}); 

}


if(mimo_social_data['mimo_social_twitter_username'] ) {


	//Twitter API - Requires PHP.
	//References
	//http://stackoverflow.com/questions/17409227/follower-count-number-in-twitter
	//https://github.com/J7mbo/twitter-api-php

	$.ajax({
	  url: 'http://54.175.100.62/twitter/index.php',
	  dataType: 'json',
	  type: 'GET',
	  data:{user:twitter},
	  success: function(data) {   
	    var followers = parseInt(data.followers);
	    $('#mimo_social_count .twitter .count').append(followers).digits(); 
	    getTotal(followers); 
	  } 
	}); 

}

if(mimo_social_data['mimo_social_google_user'] && mimo_social_data['mimo_social_google_api_key'] ) {
	//Google Plus API
	var apikey = 'AIzaSyCrS76Se68IyC5u54wIMiE6zq2wD1IDAyY';
	$.ajax({
	  url: 'https://www.googleapis.com/plus/v1/people/' + google_plus,
	  type: "GET",
	  dataType: "json",
	  data:{key:apikey},
	  success: function (data) {
	    var followers = parseInt(data.circledByCount);
	    var k = kFormatter(followers);
	    $("#mimo_social_count .google .count").append(k);
	    getTotal(followers); 
	  }
	});
}

if(mimo_social_data['mimo_social_pinterest_username'] ) {
	//Pinterst API V3
	$.ajax({
	  url: 'https://api.pinterest.com/v3/pidgets/users/'+pinterest+'/pins',
	  dataType: 'jsonp',
	  type: 'GET',
	  success: function(data) {   
	    var followers = data.data.user.follower_count;
	    var k = kFormatter(followers);
	    $('#mimo_social_count .pinterest .count').append(k); 
	    getTotal(followers); 
	  } 
	}); 
}


//Function to add commas to the thousandths
$.fn.digits = function(){ 
  return this.each(function(){ 
    $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
  })
}

//Function to add K to thousands
function kFormatter(num) {
  return num > 999 ? (num/1000).toFixed(1) + 'k' : num;
}
//Total Counter
var total = 0;
//Get an integer paramenter from each ajax call
function getTotal(data) {
  total = total + data;
  $("#mimo_social_total").html(total).digits();
  $("#mimo_social_total_k").html(kFormatter(total));
}


})( jQuery );
