// search index for WYSIWYG Web Builder
var database_length = 0;

function SearchPage(url, title, keywords, description)
{
   this.url = url;
   this.title = title;
   this.keywords = keywords;
   this.description = description;
   return this;
}

function SearchDatabase()
{
   database_length = 0;
   this[database_length++] = new SearchPage("UnitedAnimations.html", "United Animations", "Copyright © 2022 UnitedAnimations  CONTACT INFORMATION  We are always open to views and opinion Email   UnitedVidsic@gmail.com  Our Studio  Our Studio is focused on the piority of sharing our own animations with our community and fans And ensuring that our audience shares their views with us  Our the ultimate end goal is building an official brand of animations that showcases who we are and what we do and are about  We our work we will be able to borden the scope and expand our work internationally   ", "This website is for sharing my Animations i created");
   this[database_length++] = new SearchPage("Contact-us.php", "Untitled Page", " ", "");
   this[database_length++] = new SearchPage("Donate.html", "Untitled Page", "DONATIONS  SUBSCRIPTION   ", "");
   this[database_length++] = new SearchPage("Login-in.html", "Untitled Page", "UNDER  DEVELOPMENT 😢   ", "");
   this[database_length++] = new SearchPage("thank-you-contact.html", "Untitled Page", " ", "");
   this[database_length++] = new SearchPage("error-contact.html", "Untitled Page", " ", "");
   return this;
}
