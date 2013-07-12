var rssconfig;
var checked=new Array();

function loadConfig()//Load the Config File
{
    $.ajax({
        url: "../config/rss.cfg",
        type: "GET",
        dataType : "json",
        success: function( json )
        {
            rssconfig=json;
            loadData();
        },
        error: function( xhr, status ) {
            alert( "ERROR!" );
        },
    }); 
}

function onLoad()
{
         loadConfig();
}

function loadData()//Load The RSS-Feed Data
{
     var feed = new google.feeds.Feed(rssconfig.feed);
       feed.load(function(result) {
        if (!result.error) {
          var titles = document.getElementById("titles");
          for (var i = 0; i < result.feed.entries.length && i<rssconfig.count; i++) {
            var entry = result.feed.entries[i];
            
            var fulltitle=document.createElement("div");//Divbox for one RSS-Feed
            var title = document.createElement("div");//Divbox for the Title
            var time = document.createElement("div");//Divbox for the published Date
            
            title.innerHTML =entry.title;
            title.className += " "+"feed-title";
            time.innerHTML =entry.publishedDate;
            time.className += " "+"time";
            
            if(i%2==0)fulltitle.className += " " + "feed-even";//Even Color
            if(i%2!=0)fulltitle.className += " " + "feed-uneven";//Uneven Color
            
            fulltitle.appendChild(title);
            fulltitle.appendChild(time);
            $(fulltitle).bind('mouseover', {entry: entry}, loadPreview);//Load teh preview at Mouseover
            
            titles.appendChild(fulltitle);//Div Output
          }
        }
      });
}

function loadPreview(event)//Load feed at Mouseover
{
    var container = document.getElementById("feed");
    container.innerHTML = ''; //Remove old Feed
    var title = document.createElement("h3")
    var message = document.createElement("div") 
    title.innerHTML=event.data.entry.title;
    message.innerHTML =event.data.entry.content;
    container.appendChild(title);   //Show title
    container.appendChild(message); // Show message
}