var elementNodeList;

var buttons = document.getElementsByClassName("delete");

for(var i = 0; i < buttons.length; i++)
{
     buttons[i].onclick = doSomething;
}

function doSomething(eventObj)
{
     var obj = eventObj.target;

     // console.log(obj.id + " work");
     // console.log(document.querySelector('.select-tag').children);



     document.getElementById("myNav").style.width = "100%";
     $('#form-to-move').prepend('<div class="del"><p class="par">Фотографии из<input type="text" name="fromCat" class="special-input" value="'+ obj.id +'">переместить в</p></del>');
     $('#i9').prepend('<input type="text" style="visibility: hidden;" name="fromCat2" class="del" value="'+ obj.id +'">');
     var array = document.querySelector('.select-tag').children;
     for (var i = 0; i < array.length; i++) {
          if(array[i].innerHTML == obj.id)
          {
               // console.log(array[i]);
               elementNodeList = array[i];
               hideElement(array[i]);
          }
     }
}
/* Open when someone clicks on the span element */


/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
  document.getElementById("myNav").style.width = "0%";
  $('.del').remove();
  showElement(elementNodeList);
}

function hideElement(obj)
{
     obj.style.display = "none";
}

function showElement(obj)
{
     obj.style.display = "block";
}
