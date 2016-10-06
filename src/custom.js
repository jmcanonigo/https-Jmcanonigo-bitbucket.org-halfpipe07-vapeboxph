(function( self, undefined) {
  var BASE_URL = "http://localhost/vapeboxph";
  var API_URL = BASE_URL + "/index.php";

  var getQueryVariable = function(variable) {
         var query = window.location.search.substring(1);
         var vars = query.split("&");
         for (var i=0;i<vars.length;i++) {
                 var pair = vars[i].split("=");
                 if(pair[0] == variable){return pair[1];}
         }
         return(false);
  }

  var cookie_func = {
    create: function(name, value, hours) {
        var date = new Date();
        date.setTime(date.getTime()+(hours*60*60*1000));
        var expires = "; expires="+date.toGMTString();

        document.cookie = name+"="+value+expires+"; path=/";
    },
    get: function(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length,c.length);
            }
        }
        return "";
    }
  };

  var linkRef = function() {
    var ref_id = getQueryVariable('ref_id') || cookie_func.get('vbox_ref_id') || "";

    if(!!getQueryVariable('ref_id')) {
        cookie_func.create('vbox_ref_id', getQueryVariable('ref_id'), 24);
    }

    //assign referral
    var plan_sample = document.getElementsByClassName('plan');
    var typeform_link = plan_sample[0].querySelector('a').getAttribute('href');

    if(!!ref_id) {
      for (i=0; i < 3; i++) {
        plan_sample[i].querySelector('a').setAttribute('href', typeform_link + "?ref_id=" + ref_id);
      }
    }
    
  };

  var linkRefGiveaway = function() {
    var ref_id = getQueryVariable('ref_id') || cookie_func.get('vboxgiveaway_ref_id') || 0;

    if(!!getQueryVariable('ref_id')) {
        cookie_func.create('vboxgiveaway_ref_id', getQueryVariable('ref_id'), 24);
    }

    //assign referral
    if(!!ref_id) {
      $('#ref_id').val(ref_id);
    }
  }

  var is_valid = function(msgs) {
    var not_valid = 0; 

    for (var key in msgs) {
        if (msgs.hasOwnProperty(key) && msgs[key].length > 0) {
           not_valid++;
        }
    }

    return !not_valid;
  };
  
  var validateEmail = function(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  };

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
        title: 'VapeBox PH'
    });
  };

  self.initWheel = function() {
    var participant = {
      fname: '',
      id: 0,
      prize: 0
    };

    var l; //ladda button

    var wheel_prizes = {
      'Golden Drops': {
        min: 0,
        max: 20
      },
      'Daily Drip': {
        min: 40,
        max: 30 //increment
      },
      'Malibu': {
        min: 110,
        max: 30
      },
      'Bullet Vape': {
        min: 170,
        max: 30
      },
      'Holy Smokes': {
        min: 220,
        max: 30
      },
      'King David': {
        min: 280,
        max: 40,
      }
    };

    linkRefGiveaway();

    // var modalEnterWheel = new tingle.modal({
    //     footer: false,
    //     stickyFooter: false,
    //     cssClass: ['wheel-modal'],
    //     onOpen: function() {
    //       Ladda.bind( '.btn-contact-submit' );
    //       l = Ladda.create( document.querySelector( '.btn-contact-submit' ) );
    //       linkRefGiveaway();
    //     },
    //     onClose: function() {

    //     }
    // });

    var modalEnterWheel = $('[data-remodal-id=wheelModal]').remodal();

    $(document).on('opened', '.remodal', function () {      
      l = Ladda.create( document.querySelector( '.btn-contact-submit' ) );
      linkRefGiveaway();
    });

    //modalEnterWheel.setContent('<div class="wheel-mask"><div class="wheel-container"> <div class="wheel-step" id="wheel-one"> <h2 class="col-xs-12 m-b-sm">Enter your name and contact details below to spin the wheel now!</h2> <form id="contact" name="wheel-contact" class="form-horizontal"> <div class="form-group col-xs-12"> <input type="text" class="input-lg form-control" id="fname" name="fname" placeholder="First Name*"><p class="error fname-error"></p> </div> <div class="form-group col-xs-12"> <input type="text" name="lname" class="input-lg form-control" id="lname" placeholder="Last Name*"><p class="error lname-error"></p> </div> <div class="form-group col-xs-12"> <input type="email" name="email" class="input-lg form-control" id="email" placeholder="Email Address*"><p class="error email-error"></p> </div> <div class="form-group col-xs-12"> <input type="text" name="mobile" class="input-lg form-control" id="mobile" placeholder="Mobile Number*"><p class="error mobile-error"></p> </div> <div class="form-group col-xs-12"> <input type="hidden" class="input-lg form-control" id="ref_id" name="ref_id" ></div><div class="form-group col-xs-12 text-center"> <button type="submit" class="btn btn-lg btn-cornered ladda-button btn-contact-submit" data-style="zoom-in"><span class="ladda-label">Let\'s Play <span class="fa fa-chevron-right"></span></button> </div> </form> </div> <div class="wheel-step" id="wheel-two"> <div id="wrapper"> <h2>Spin to Win!</h2> <h4>You can only spin once.</h4> <div id="wheel"> <div id="inner-wheel"> <div class="sec"><p>King David</p><span class="fa"><img src="' + BASE_URL + '/assets/images/suppliers/king-david-60.png" alt="King David Fineries"></span></div> <div class="sec"><p>Holy Smokes</p><span class="fa"><img src="' + BASE_URL + '/assets/images/suppliers/holy-smokes-60.png" alt="Holy Smokes"></span></div> <div class="sec"><p>Bullet Vape</p><span class="fa"><img src="' + BASE_URL + '/assets/images/suppliers/bullet-vape-60.png" alt="Bullet Vape"></span></div> <div class="sec"><p>Malibu</p><span class="fa"><img src="' + BASE_URL + '/assets/images/suppliers/malibu-60.png" alt="Malibu"></span></div> <div class="sec"><p>Daily Drip</p><span class="fa"><img src="' + BASE_URL + '/assets/images/suppliers/daily-drip-60.png" alt=""></span></div> <div class="sec"><p>Golden Drops</p><span class="fa"><img src="' + BASE_URL + '/assets/images/suppliers/golden-drops-60.png" alt="Golden Drops"></span></div> </div> <div id="spin"> <div id="inner-spin"></div> </div> <div id="shine"></div> </div> <div class="prize-container"><div id="prizeTxt"></div> <button class="btn btn-cornered btn-lg" id="claimPrizeBtn" disabled>Claim My Prize</button></div> </div> </div> </div></div>');

    var error_messages = {
      fname: '',
      lname: '',
      email: '',
      mobile: ''
    };

    if(!!document.getElementById('spinWheel')) {
      // document.getElementById('spinWheel').addEventListener('click', function() {
      //   modalEnterWheel.open();
      // });

      $('#wheelContact button').on('click', function(ev) {
        ev.preventDefault();

        //validate
        error_messages.fname = ($('#fname').val() === '') ? 'First name is required.' : '';
        error_messages.lname = ($('#lname').val() === '') ? 'Last name is required.' : '';
        error_messages.email = ($('#email').val() === '') ? 'Email is required.' :
          (!validateEmail($('#email').val())) ? 'Email is invalid' : '';
        error_messages.mobile = ($('#mobile').val() === '') ? 'Mobile is required.' :
          ($('#mobile').val().length  < 10) ? 'Mobile Number should be in this format - 09171234567.' : '';

        $('.fname-error').html(error_messages.fname);
        $('.lname-error').html(error_messages.lname);
        $('.email-error').html(error_messages.email);
        $('.mobile-error').html(error_messages.mobile);

        if (!!is_valid(error_messages)) {
          l.start();
          $.post( API_URL + "/api/participant", $( "#wheelContact" ).serialize(), function( data ) {
            if(data == false) {
              $('.email-error').html("User already exists");
              l.stop();
            } else if (!data) {
              $('.email-error').html("Email is invalid");
            } else {
              participant.fname = $('#fname').val();
              participant.id = data;
              l.stop();
              $.get( API_URL + "/api/tester", function(data) {
                participant.prize = data;
                $('.wheel-container').addClass('step-two');
              });
            }
          });
        }
      });

    if(!!document.getElementById('spin')) {
      var degree = 1800;
      var clicks = 0;

      $('#spin').click(function(){
        if(!!participant.prize && participant.prize.brand.length > 0) {
          $(this).unbind('click');
          clicks++;

          setTimeout(function() {
            $('#prizeTxt').html("You just won " + participant.prize.brand + "!");
            $('#claimPrizeBtn').removeAttr('disabled').on('click', function() {
              $.post( API_URL + "/api/participant", { id: participant.id, prize: participant.prize.id }, function( data ) {
                if(!data) {
                  $('.email-error').html("User already exists");
                } else {
                  var win = window.open('https://vapebox.typeform.com/to/hcWggZ?part=' + participant.id + '&test=' + participant.prize.id + '&fname=' + encodeURI(participant.fname));
                  if (win) {
                      //Browser has allowed it to be opened
                      win.focus();
                  } else {
                      //Browser has blocked it
                      alert('Please allow popups for this website');
                  }
                }
              });
            });
          }, 6000);
          
          /*multiply the degree by number of clicks
          generate random number between 1 - 360, 
          then add to the new degree*/
          var newDegree = degree*clicks;
          var extraDegree = Math.floor(Math.random() * wheel_prizes[participant.prize.brand].max) + wheel_prizes[participant.prize.brand].min;
              // var extraDegree = Math.floor(Math.random() * (360 - 1 + 1)) + 1
              /* 20, 60, 120, 180, 240, 300 */
          totalDegree = newDegree+extraDegree;
          
          /*let's make the spin btn to tilt every
          time the edge of the section hits 
          the indicator*/
          $('#wheel .sec').each(function(){
            var t = $(this);
            var noY = 0;
            
            var c = 0;
            var n = 700;  
            var interval = setInterval(function () {
              c++;        
              if (c === n) { 
                clearInterval(interval);        
              } 
                
              var aoY = t.offset().top;
              // $("#prizeTxt").html(aoY);
              // console.log(aoY);
              
              /*23.7 is the minumum offset number that 
              each section can get, in a 30 angle degree.
              So, if the offset reaches 23.7 (23.89), then we know
              that it has a 30 degree angle and therefore, 
              exactly aligned with the spin btn*/
              if(aoY < 30){
                // console.log('<<<<<<<<');
                $('#spin').addClass('spin');
                setTimeout(function () { 
                  $('#spin').removeClass('spin');
                }, 1000);
              }
            }, 10);
            
            $('#inner-wheel').css({
              'transform' : 'rotate(' + totalDegree + 'deg)'      
            });
           
            noY = t.offset().top;
            
          });
        }

      });
    } // end of #spin

    } //end of #spinWheel

  };

  self.initHome = function() {
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

    if(!!document.getElementById('bannerVid')) {
      document.getElementById('bannerVid').addEventListener('click', function() {
        var vidModal = document.querySelector("iframe[class=explainer]");
        var newSrc = vidModal.getAttribute("src") + "&autoplay=1";

        vidModal.setAttribute('src', newSrc);
        modal.open();
      });
    }

    

    // link to referral
    linkRef();

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
    initHome: self.initHome,
    initMap: self.initMap,
    initWheel: self.initWheel
  }

} (window.vapebox = window.vapebox || {}));

// vapebox.initHome();
// vapebox.initWheel();
// google.maps.event.addDomListener(window, 'load', vapebox.initMap);