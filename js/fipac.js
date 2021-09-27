$(document).ready(function(){

    var totalR = document.getElementById("totalR").value;
    var totalM = document.getElementById("totalM").value;
    var totalT = document.getElementById("totalT").value;


    let containerA = document.getElementById("circleA");

    let circleA = new ProgressBar.Circle(containerA,{
        
        color:'#40E0D0',
        strokeWidth:8,
        duration:1400,
        from:{color:'#FFFFFF'},
        to:{color:'#40E0D0'},

        step: function(state,circle){
            circle.path.setAttribute('stroke', state.color);

            let value =Math.round(circle.value()*totalR);

            circle.setText(value);


        }
    });

    let containerB = document.getElementById("circleB");

    let circleB = new ProgressBar.Circle(containerB,{
        
        color:'#40E0D0',
        strokeWidth:8,
        duration:1600,
        from:{color:'#FFFFFF'},
        to:{color:'#40E0D0'},

        step: function(state,circle){
            circle.path.setAttribute('stroke', state.color);

            let value =Math.round(circle.value()*totalM);

            circle.setText(value);


        }
    });

    let containerC= document.getElementById("circleC");

    let circleC = new ProgressBar.Circle(containerC,{
        
        color:'#40E0D0',
        strokeWidth:8,
        duration:2000,
        from:{color:'#FFFFFF'},
        to:{color:'#40E0D0'},

        step: function(state,circle){
            circle.path.setAttribute('stroke', state.color);

            let value =Math.round(circle.value()*totalT);

            circle.setText(value);


        }
    });

    let containerD = document.getElementById("circleD");

    let circleD = new ProgressBar.Circle(containerD,{
        
        color:'#40E0D0',
        strokeWidth:8,
        duration:2200,
        from:{color:'#FFFFFF'},
        to:{color:'#40E0D0'},

        step: function(state,circle){
            circle.path.setAttribute('stroke', state.color);

            let value =Math.round(circle.value()*totalT*10);

            circle.setText(value);


        }
    });
    let area = $('#transp').offset();
    let stop = 0;
    $(window).scroll(function(){
        let scroll = $(window).scrollTop();

        if(scroll > (area.top-500) && stop == 0){
        
            circleA.animate(1.0);
            circleB.animate(1.0);
            circleC.animate(1.0);
            circleD.animate(1.0);

            stop = 1;
        }
    });

    setTimeout(function() {
        $('#transp').parallax({imageSrc: 'img/fundo5.jpeg'});
      }, 200);

});

