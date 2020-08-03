
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
//   path: function() {
//   var pageNumber = this.loadCount + 1;
//   var result = 2;
//   if(pageNumber != 3){
//        if(pageNumber == 1)
//       {
//            result = 2;
//            return '../page/'+ result +'.html';
//     }else {
//           result = pageNumber;
//           return '../page/'+ result +'.html';
//     }
// }
// },
 // path: '../page/{{#}}.html',
 path: function() {
   // no value returned after 4th loaded page
   if ( this.loadCount < loops ) {
     var nextIndex = this.loadCount + 2;
     return '../page/'+ nextIndex +'.html';
   }
 },
  append: '.grid-item',
  outlayer: msnry,
  checkLastPage: true,
});
