var element = $(".blink");
var shown = true;

setInterval(toggle, 300);

function toggle() {
   if(shown) {
       element.hide();
       shown = false;
   } else {
       element.show();
       shown = true;
   }
}
