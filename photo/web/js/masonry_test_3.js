
console.log("name");
console.log("name1");
var elem4 = document.querySelector('.grid');
var msnry = new Masonry( elem4, {
  itemSelector: '.grid-item',
});

var counter = 2;

var elem5 = document.querySelector('.grid');
var infScroll = new InfiniteScroll( elem5, {
     path: function() {
               var nextIndex = this.loadCount + counter;
               var a = document.getElementsByClassName('block');
               if(nextIndex >= 2 && a.length < categories)
               {
                    if(title == 'category')
                    {
                         setTimeout(function() {
                                  baguetteBox.run('.baguetteBoxOne');
                             }, 100)
                         return '../web/'+ nextIndex;
                    }else if(title == 'photo'){
                         setTimeout(function() {
                                  baguetteBox.run('.baguetteBoxOne');
                             }, 100)
                         return location.href + '/page/'+ nextIndex;
                    }
                    counter = 1;
                    nextIndex = this.loadCount + counter;
               }

       },
     append: '.grid-item',
     outlayer: msnry,
});
