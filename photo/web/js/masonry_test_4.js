
console.log("test");

var path1 = location.href;
var path2 = path1.split('/');
if(path1.indexOf("page/") >= 0 && path2.length != 9){

     var newPath = path1.split('/');
     newPath.pop();
     newPath.pop();
     path1 = newPath.join('/');

}


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
                         return path1 + '/page/'+ nextIndex;
                    }
                    counter = 1;
                    nextIndex = this.loadCount + counter;
               }

       },
     append: '.grid-item',
     outlayer: msnry,
});
