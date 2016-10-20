(function( self, undefined) {
  var BASE_URL = location.hostname == "localhost" ? "http://localhost/vapeboxph" : "http://www.vapebox.ph";
  var API_URL = BASE_URL + "/index.php";

  function isWindow( obj ) {
    return obj != null && obj === obj.window;
  }
  
  function getWindow( elem ) {
      return isWindow( elem ) ? elem : elem.nodeType === 9 && elem.defaultView;
  }

  function offset( elem ) {
      var docElem, win,
          box = { top: 0, left: 0 },
          doc = elem && elem.ownerDocument;

      docElem = doc.documentElement;

      if ( typeof elem.getBoundingClientRect !== typeof undefined ) {
          box = elem.getBoundingClientRect();
      }
      win = getWindow( doc );
      return {
          top: box.top + win.pageYOffset - docElem.clientTop,
          left: box.left + win.pageXOffset - docElem.clientLeft
      };
  };

  var determineDropDirection = function(btnGroups) {
    for (var i = 0; i < btnGroups.length; i++) {
      var dropdownlist = btnGroups[i].querySelector('.dropdown-menu');
      dropdownlist.parentNode.classList.remove('dropup');
      dropdownlist.classList.add('dropdown-check');

      if (offset(dropdownlist).top + dropdownlist.offsetHeight > window.innerHeight + window.scrollY){
        dropdownlist.parentNode.classList.add("dropup");
      }

      dropdownlist.classList.remove('dropdown-check');
    }
  };

  self.initHome = function() {
    var slider = new Slider('#homeBanners', '.banner-item', {
      interval: 12,
      duration: 1
    });

    var btnGroups = document.getElementsByClassName('btn-group');


    document.addEventListener('click', function(){
      for (var i = 0; i < btnGroups.length; i++) {
        btnGroups[i].classList.add('closed');
      }
    });

    for (var i = 0; i < btnGroups.length; i++) {
      btnGroups[i].addEventListener('click', function(e) {
        e.stopPropagation();
        this.classList.toggle('closed');
      }, false);
    }

    window.addEventListener('scroll', function() {
      determineDropDirection(btnGroups)
    });
    
    window.onscroll = function() {
      determineDropDirection(btnGroups);
    };


  };

  return {
    initHome: self.initHome
  }

} (window.vapeshop = window.vapeshop || {}));

// vapeshop.initHome();
// vapebox.initWheel();
// google.maps.event.addDomListener(window, 'load', vapebox.initMap);