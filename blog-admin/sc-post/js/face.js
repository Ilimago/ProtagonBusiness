window.fbAsyncInit = function() {
  // init the FB JS SDK
  FB.init({
    appId      : '1559413400971932', // App ID from the App Dashboard
    channelUrl : '//demo.xxxxxxx.se/nptest/channel.html', // Channel File for x-domain communication
    status     : true, // check the login status upon init?
    cookie     : true, // set sessions cookies to allow your server to access the session?
    xfbml      : true  // parse XFBML tags on this page?
  });

  // Additional initialization code such as adding Event Listeners goes here

};
//Publicación 1
function postToFeed(){

FB.ui(
{
 method: 'feed',
 name: 'Nevado de Toluca',

 description: (
    'Hola amigos, quiero vivir esta experiencia y lo quise compartir con ustedes, los invito a disfrutar igual que yo de estas maravillosas actividades.'
 ),

 caption: 'Liena de abajo de la publicación',
 link: 'http://www.goandlive.com.mx/index.php#calendario',
 picture: 'http://goandlive.com.mx/img/palface.png'
},
function(response) {
  if (response && response.post_id) {
    alert('Post was published.');
  } else {
    alert('Post was not published.');
  }
}
);

};




// Load the SDK's source Asynchronously
(function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
 }(document));