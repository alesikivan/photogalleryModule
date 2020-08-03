var elem = document.querySelector('.grid');
var msnry = new Masonry( elem, {
  itemSelector: '.grid-item',
});

var counter = 2;

var elem2 = document.querySelector('.grid');
var infScroll = new InfiniteScroll( elem2, {
     path: function() {
               var nextIndex = this.loadCount + counter;
               var a = document.getElementsByClassName('block');
               if(nextIndex >= 2 && a.length < categories)
               {
                    return '../web/'+ nextIndex;
                    counter = 1;
                    nextIndex = this.loadCount + counter;
               }

       },
     append: '.grid-item',
     outlayer: msnry,
});
