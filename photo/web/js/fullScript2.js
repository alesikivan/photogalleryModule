
var buttons = document.getElementsByClassName("delete");

for(var i = 0; i < buttons.length; i++)
{
     buttons[i].onclick = doSomething;
}

function doSomething(eventObj)
{
     var obj = eventObj.target;

     // console.log(obj.id + " work");
     document.getElementById("myNav").style.width = "100%";
     $('#form-to-move').prepend('<div class="del"><p class="par">Фотографии из<input type="text" name="fromCat" class="special-input" value="'+ obj.id +'">переместить в</p></del>');
     $('#i9').prepend('<input type="text" style="visibility: hidden;" name="fromCat2" class="del" value="'+ obj.id +'">');
}
/* Open when someone clicks on the span element */


/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
  document.getElementById("myNav").style.width = "0%";
  $('.del').remove();
}
