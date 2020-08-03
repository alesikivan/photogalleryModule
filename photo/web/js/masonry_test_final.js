
console.log("2");


var elem4 = document.querySelector('.grid');
var msnry = new Masonry( elem4, {
  itemSelector: '.grid-item',
});

// var counter = 2;
var num = 0;
var elem5 = document.querySelector('.grid');
var infScroll = new InfiniteScroll( elem5, {

     path: function() {
          var a = document.getElementsByClassName('block');
          var nextIndex = this.loadCount + 2;
          var nextIndex2 = this.loadCount + (online + 1);
                    if(online == 0)
                    {
                         if(a.length < categories)
                         {
                              if(title == "photo")
                              {
                                   return checkPath(location.href) + '/page/' + nextIndex;
                              }else{
                                   return checkPath(location.href) + 'page/' + nextIndex;
                              }
                         }
                    }else if(online == 1){
                         if(a.length <= (categories - online))
                         {
                              return checkPath(location.href) + '/page/' + nextIndex;
                         }
                    }else if(online > 1){
                         if(a.length <= (categories - online))
                         {
                              return checkPath(location.href) + '/page/' + nextIndex2;
                         }
                    }
       },

     append: '.grid-item',
     outlayer: msnry,
});

function checkPath(path)
{
     var sharePath = path.split('/');
     if('page' != sharePath[sharePath.length - 2])
     {
          return path;
     }else{
          sharePath.pop();
          sharePath.pop();
          if(online != 0)
          {
               return sharePath.join('/');
          }
          if(title == "photo")
          {
               return sharePath.join('/');
          }
          return sharePath.join('/') + "/";
     }
}

function update()
{
     (function() {baguetteBox.run('.baguetteBoxOne');})();
}
