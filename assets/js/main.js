/*
 * Change Navbar color while scrolling
*/



$(window).scroll(function(){
	handleTopNavAnimation();
});

$(window).load(function(){
	handleTopNavAnimation();
});

function handleTopNavAnimation() {
	var top=$(window).scrollTop();

	if(top>10){
		$('#site-nav').addClass('navbar-solid'); 
	}
	else{
		$('#site-nav').removeClass('navbar-solid');
	}
}

/*
 * Registration Form
*/
$('form[name="registration"]').on('submit', function(){
   $('#registration-btn').prop('disabled', true);
});
$('#registration-form').submit(function(e){
    e.preventDefault();
    
    var postForm = { //Fetch form data
            'fname'     : $('#registration-form #fname').val(),
            'lname'     : $('#registration-form #lname').val(),
            'email'     : $('#registration-form #email').val(),
            'cell'      : $('#registration-form #cell').val(),
            'address'   : $('#registration-form #address').val(),
            'zip'       : $('#registration-form #zip').val(),
            'city'      : $('#registration-form #city').val(),
            'program'   : $('#registration-form #program').val()
    };

    $.ajax({
            type      : 'POST',
            url       : './assets/php/contact.php',
            data      : postForm,
            dataType  : 'json',
            success   : function(data) {
                            if (data.success) {
                                $('#registration-msg .alert').html("Registration Successful");
                                $('#registration-msg .alert').removeClass("alert-danger");
                                $('#registration-msg .alert').addClass("alert-success");
                                $('#registration-msg').show();
                            }
                            else
                            {
                                $('#registration-msg .alert').html("Registration Failed");
                                $('#registration-msg .alert').removeClass("alert-success");
                                $('#registration-msg .alert').addClass("alert-danger");
                                $('#registration-msg').show();
                            }
                        }
        });
});

$(document).ready(function(){
    var jsnForPrize;
    $.getJSON("tableOutputPoints.json", function (jsonPoints) {
        console.log(jsonPoints);
        jsnForPrize = jsonPoints;
    });


    $('#footballLoader').hide();
    $('#gwHistoryModal').on('show.bs.modal', function (e) {

        var jsn;
        $.getJSON("tableOutputRanks.json", function(json){
             console.log(json);
             jsn = json;
        });

        var userName = $(e.relatedTarget).data('name');
        var userId = $(e.relatedTarget).data('id');
        var url = "https://fantasy.premierleague.com/drf/entry/"+userId+"/history";
        var proxy = 'https://cors-anywhere.herokuapp.com/';

        $('.gwHistoryModal').html("");
        $('#footballLoader').show();
        $.ajax({

            url : proxy+url, //Here you will fetch records
            //useCORS: true,
            //beforeSend: xhr.setRequestHeader('Authorization',''),
            //jsonpCallback: 'myJsonMethod',
            contentType: "application/json",
            dataType: 'json',
            async: true,

            success : function(data){
                $('#footballLoader').hide();


                var htmlData = "<table class=\"table table-hover table-responsive\">\n" +
                    "                        <tr>\n" +
                    "                        <th data-toggle=\"tooltip\" title=\"Game Week\">GAME WEEK</th>\n" +
                    "                        <th data-toggle=\"tooltip\" title=\"Game Week Points\">GAME WEEK POINTS</th>\n" +
                    "                        <th data-toggle=\"tooltip\" title=\"Event Transfers\">EVENT TRANSFERS</th>\n" +
                    "                        <th data-toggle=\"tooltip\" title=\"Transfer Costs\">TRANSFER COSTS</th>\n" +
                    "                        <th data-toggle=\"tooltip\" title=\"Game Week RankT\">GAME WEEK RANK</th>\n" +
					"                        <th data-toggle=\"tooltip\" title=\"Rank Movement\">RANK MOVEMENT</th>\n" +
                    "                        </tr>\n" +
                    "                        \n";//Show fetched data from url
                //console.log(JSON.stringify(data.history));
                if(data) {
                    $.each(data.history, function (key, value) {
                        //console.log(userName);
						//console.log("Rank for event"+value.event+":"+jsn[value.event][userName]);
                        var gwRank;
                        if(typeof jsn[value.event] == "undefined"){
                            gwRank = 0;
                        }else {
                            console.log(value.event+"\n");
                            gwRank = jsn[value.event][userName];
                        }
                        htmlData += "<tr><td>"+value.event+"</td>\n"+"<td>"+value.points+"</td>\n"+"<td>"+value.event_transfers+"</td>\n"+"<td>"+value.event_transfers_cost+"</td>\n"+"<td>"+gwRank+"</td>\n"+"<td>"+value.movement+"</td></tr>";
						
                    });
                    htmlData += "</table>";
                    $('.gwHistoryModal').html(htmlData);
                }

            }

    });

        /*$.getJSON("https://fantasy.premierleague.com/drf/entry/"+userId+"/history", function(data){
            console.log(data);
        });*/
    });

    var gameWeekEverest;
    var playerNameEverest;
    var pointsEverest = -1;

    $(".EverestCard").click(function(e){
       $.each(jsnForPrize, function(gameWeek, mapOfUsers){
          $.each(mapOfUsers, function(playerName, playerPoints){
              if(playerPoints > pointsEverest){
                  gameWeekEverest = gameWeek;
                  playerNameEverest = playerName;
                  pointsEverest = playerPoints;
              }
          });
       });
       alert(playerNameEverest+"has earned the maximum points in a single gameweek so far.\n"+"GameWeek:"+gameWeekEverest+"\n"+"Points:"+pointsEverest+"\n");
    });





   $(".dropdown-menu li a").click(function(){
    $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
    $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
   });

   
});



/*
 * SmoothScroll
*/

smoothScroll.init();
