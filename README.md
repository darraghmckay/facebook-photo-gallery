**FACEBOOK API GALLERY**
------------------------
This library / example allows you to grab all of the photos albums of a given Facebook Page / Profile and create a photo Gallery. 

It's helpful if you don't want to have to create a photo upload system for a client / store and process all the photos.

It's built using Bootstrap for layout / design but it can be changed to your own liking. 

**DEMO**
Coming Soon

**Features**

 - Responsive Gallery
 - Pagination
 - Lightbox (Higher Resolution) Photo Viewing
 - AJAX Loading

**Set Up** 
________
Clone the repository into a new directory.

In `config.txt` change `$fb_page_id` to the page who's photos you wish to use.
This can be found easily.

 1. Visit the Facebook Page you wish to use
 2. Press `Ctrl+u` / `Cmd + u` (Windows / Mac) - To view the page source
 3. Press `Ctrl+f` / `Cmd+f` and type `page_id`
You should find something like this `page_id=131123886875208`
You need the numbers only.

Next you need to create a new Facebook Developer App

 1. While logged into facebook, visit: [Facebook Developers New Web App](https://developers.facebook.com/quickstarts/?platform=web)
 2. Follow the instructions to create a new FB App for your website / Web app
 3. For Site URL enter the site you'll be using this on (localhost works by default). Your app ID will only work on this domain
 4. Click 'Skip Quick Start' to go to your FB App Dashboard
 5. You need an `Access Token` so visit [this site](https://smashballoon.com/custom-facebook-feed/access-token/#id), that makes it easy to generate your app's access token  You'll need your AppID and your App Secret, which are found on the FB App Dashboard
 6. when you get your `Access Token` change `$access_token` in `config.txt` to this new value

Visit the directory you cloned this repo into and you should see a working gallery for the page you selected. 
_____

**Settings**
`$albums_per_page` changes the default MAX number of albums that are downloaded in the gallery per page
`$pics_per_page` changes the default MAX number of pictures that are downloaded in the gallery per page

`$show_all` is boolean (TRUE / FALSE). Setting it to TRUE shows all the albums available on FB, changing it to FALSE hides Cover Photos, Timeline Photos and Profile Pictures.


___

Created By [Darragh Mc Kay](darraghmckay.com)


    

   

