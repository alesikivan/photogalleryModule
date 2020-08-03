

var elem = document.querySelector('.grid');
var msnry = new Masonry( elem, {
// options
itemSelector: '.grid-item',
columnWidth: 200,
gutter : 10,
transitionDuration: '1s',
});


var elem2 = document.querySelector('.grid');
var infScroll = new InfiniteScroll( elem2, {
  // options
 // path: '../page/{{#}}.html',
 path: function() {
   // no value returned after 4th loaded page
   if ( this.loadCount < (loops) )
   {
        var nextIndex = this.loadCount + 2;
        setTimeout(job, 2000)
        return location.href + '/page/'+ nextIndex;
   }
   console.log("step");
 },
  append: '.grid-item',
  outlayer: msnry,
  checkLastPage: true,
});


function job ()
{
     (function() {
         baguetteBox.run('.baguetteBoxOne');
         console.log("Work2!")
     })()
}
