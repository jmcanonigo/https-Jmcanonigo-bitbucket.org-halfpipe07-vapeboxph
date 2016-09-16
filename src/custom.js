(function( self, undefined) {

  self.initMap = function() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 14.6033799, lng: 121.0454897},
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        mapTypeControl: false,
        streetViewControl: false,
        draggable: false,
        styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#941a1e"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]}]
    });

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(14.6033799, 121.0454897),
        map: map,
        title: 'Redlist Property Investments'
    });
  };

  self.init = function() {
    var videoSrc = "https://www.youtube.com/embed/izQjkJDOV-c?rel=0&amp;controls=0&amp;showinfo=0";

    // instanciate new modal
    var modal = new tingle.modal({
        footer: false,
        stickyFooter: false,
        cssClass: ['video-modal'],
        onOpen: function() {
          console.log('modal open');
        },
        onClose: function() {
          var vidModal = document.querySelector("iframe[class=explainer]");
          vidModal.setAttribute('src', videoSrc);
        }
    });

    // set content
    modal.setContent('<div class="videowrapper"><iframe class="explainer" src="' + videoSrc + '" frameborder="0" allowfullscreen></iframe></div>');

    document.getElementById('bannerVid').addEventListener('click', function() {
      var vidModal = document.querySelector("iframe[class=explainer]");
      var newSrc = vidModal.getAttribute("src") + "&autoplay=1";

      vidModal.setAttribute('src', newSrc);
      modal.open();
    });

    // document.getElementsByTagName('body')[0].classList.add('loaded');

    // var slideout = new Slideout({
    //   'panel': document.getElementById('panel'),
    //   'menu': document.getElementById('menu'),
    //   'side': 'right',
    //   'padding': 256,
    //   'tolerance': 70
    // });
    //   // Toggle button
    // document.querySelector('.toggle-button').addEventListener('click', function() {
    //   slideout.toggle();
    // });

    // window.onscroll = function() {
    //   var element = document.body;
    //   var to = 0;

    //   if (element.scrollTop === to) { element.classList.add('topmost'); return; }
    //   else { element.classList.remove('topmost'); }
    // };

    // var scrollTo = function(element, to, duration) {
    //     if (duration <= 0) return;
    //     var difference = to - element.scrollTop;
    //     var perTick = difference / duration * 10;

    //     setTimeout(function() {
    //         element.scrollTop = element.scrollTop + perTick;
    //         scrollTo(element, to, duration - 10);
    //     }, 10);
    // }

    // document.getElementsByClassName('scroll-to-top-btn')[0].addEventListener('click', function() {
    //   scrollTo(document.body, 0, 600);
    // });

  };

  return {
    init: self.init,
    initMap: self.initMap
  }

} (window.vapebox = window.vapebox || {}));

vapebox.init();
// google.maps.event.addDomListener(window, 'load', vapebox.initMap);