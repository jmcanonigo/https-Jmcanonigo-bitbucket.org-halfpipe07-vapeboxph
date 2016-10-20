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

  var closeAll = function(btnGroups){
    for (var i = 0; i < btnGroups.length; i++) {
      btnGroups[i].classList.add('closed');
    }
  };

  var determineDropDirection = function(btnGroups) {
    for (var i = 0; i < btnGroups.length; i++) {
      var dropdownlist = btnGroups[i].querySelector('.dropdown-menu');
      dropdownlist.parentNode.classList.remove('dropup');
      dropdownlist.classList.add('dropdown-check');
      dropdownlist.style.visibility = 'hidden';
      dropdownlist.style.display = 'block';

      if (offset(dropdownlist).top + dropdownlist.offsetHeight > window.innerHeight + window.scrollY){
        dropdownlist.parentNode.classList.add("dropup");
      }

      dropdownlist.removeAttribute('style');
    }
  };

  var putCheck = function(list) {
    for(var i = 0; i < list.length; i++) {
      if(!!list[i].checked) {
        list[i].parentNode.parentNode.classList.add('checked');
      }

      list[i].addEventListener('click', function(e) {
        if(!!this.checked) {
          this.parentNode.parentNode.classList.add('checked');
        } else {
          this.parentNode.parentNode.classList.remove('checked');
        }
      });
    }
  };

  self.initHome = function() {

    //add to cart button groups
    var btnGroups = document.getElementsByClassName('btn-group');

    document.addEventListener('click', closeAll(btnGroups));

    for (var i = 0; i < btnGroups.length; i++) {
      btnGroups[i].addEventListener('click', function(e) {
        e.stopPropagation();
        this.classList.toggle('closed');
      }, false);
    }

    window.addEventListener('scroll', function() {
      determineDropDirection(btnGroups)
    });

    //scroll up if lampas sa window
    window.onscroll = function() {
      determineDropDirection(btnGroups);
    };


  };

  self.initCategory = function() {
      // filter brands list
      var input = document.getElementById('filterBrands');
      input.onkeyup = function () {
          var filter = input.value.toUpperCase();
          var lis = document.getElementsByClassName('list-brands')[0].getElementsByTagName('li');
          for (var i = 0; i < lis.length; i++) {
              var name = lis[i].getElementsByClassName('name')[0].innerHTML;
              if (name.toUpperCase().indexOf(filter) == 0) 
                  lis[i].style.display = 'list-item';
              else
                  lis[i].style.display = 'none';
          }
      }

      //check for checked checkboxes
      putCheck(document.getElementsByClassName('list-nicotine')[0].getElementsByTagName('input'));
      putCheck(document.getElementsByClassName('list-brands')[0].getElementsByTagName('input'));


      
  };

  self.init = function() {
    var slider = new Slider('#homeBanners', '.banner-item', {
      interval: 12,
      duration: 1
    });
  }

  return {
    init: self.init,
    initHome: self.initHome,
    initCategory: self.initCategory
  }

} (window.vapeshop = window.vapeshop || {}));

// vapeshop.initHome();
// vapebox.initWheel();
// google.maps.event.addDomListener(window, 'load', vapebox.initMap);