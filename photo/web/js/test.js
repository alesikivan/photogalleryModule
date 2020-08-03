



// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


var butID1 = document.getElementById('id1');
butID1.onclick = function() {
     $.ajax({
      type: "POST",
      url: '../data/index.html',
      data: {
        slug: 'slug',
      },
      success: function(data){
          alert(data);
      }
 });
     $(".modal-content").append("<select id='select'><option>Пункт 1</option><option>Пункт 2</option></select>");
     $(".modal-content").append("<button id='btn-new'>Перемесить</button>");
     $(".choose").remove();
}



var butID2 = document.getElementById('id2');
butID2.onclick = function() {
     console.log('Button 2');
}


var buttttton = document.getElementById('btn-new');
buttttton.onclick = function() {
     // var sel = document.getElementById('btn-new');
     // console.log(sel.value);
     $.ajax({
      type: "GET",
      url: '../data/index.html',
      data: {
        slug: slug,
        ip : ip,
        i: result1
      },
      success: function(){
          alert("The vote has been accepted");
          // document.getElementById("rating").setAttribute("class", "styl")
      }
  });
}
