$(document).ready(function() {

  //Sound initialization
  ion.sound({
    sounds: [
    {name: "helicopter"}
    ],
    path: "../sounds/",
    preload: true,
    volume: 1.0
  });



  /**
  * Sets the image background of the div
  **/
  var setImage = function(_imageName) {
    $("#overlay").css("background", "url(../img/"+ _imageName + ")");
    $("#overlay").css("background-repeat", "no-repeat");

    //resize object according to document size
    var object_width = $( document ).width();
    var object_height = $( document ).height();
    object_width = object_width.toString() + "px";
    object_height = object_height.toString() + "px";
    $("#overlay").css("width",  object_width);
    $("#overlay").css("height", object_height);

    $("#overlay").css("background-size", "100%");
  }

  /**
  * Displays the overlay panel
  **/
  var displayOverlay = function() {
    $("#overlay").show();
  }

  var hideOverlay = function() {
    $('#overlay').addClass('animated fadeOutLeft');
    //$("#overlay").hide();
  }

  var startAnimation = function(_animation) {
    $('#overlay').addClass('animated ' + _animation);
  }



  if ( window.addEventListener )
    {
      var kkeys = [], konami = ["caae34a5e81031268bcdaf6f1d8c04d37b7f2c349afb705b575966f63e2ebf0fd910c3b05160ba087ab7af35d40b7c719c53cd8b947c96111f64105fd45cc1b2","caae34a5e81031268bcdaf6f1d8c04d37b7f2c349afb705b575966f63e2ebf0fd910c3b05160ba087ab7af35d40b7c719c53cd8b947c96111f64105fd45cc1b2"];
      window.addEventListener("keydown", function(e){
        var length = kkeys.length;
        var strKeyCode = e.keyCode.toString();
        var shaObj = new jsSHA(strKeyCode, "TEXT");
        var hash = shaObj.getHash("SHA-512", "HEX");

        //alert(strKeyCode);
        if (konami[length] == hash )
          {
            kkeys.push(hash);
            length++;
          }
          else
            {
              kkeys = [];
            }

            if (length == konami.length)
              {
                ion.sound.play("helicopter");
                setImage("helico.png");
                displayOverlay();
                startAnimation('fadeInRight');
                $('#overlay').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
                function(){
                  $('#overlay').addClass('animated fadeOutLeft');
                  
                });

                kkeys = [];
              }
            },
            true);
          }
        });
