
//Sort random function
function random(owlSelector){
    owlSelector.children().sort(function(){
        return Math.round(Math.random()) - 0.5;
        }).each(function(){
          $(this).appendTo(owlSelector);
        });
    }     
    $(document).ready(function() {
      $("#owl-demo-blog").owlCarousel({
        itemsCustom : [
        [0, 1],
        [450, 1],
        [600, 1],
        [700, 1],
        [1000, 1],
        [1200, 1],
        [1400, 1],
        [1600, 1]
        ],
        navigation: true,
        autoPlay: true,

        beforeInit : function(elem){
          random(elem);
        }   
    });
});
