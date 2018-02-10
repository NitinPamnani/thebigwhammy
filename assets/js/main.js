/*
 * Change Navbar color while scrolling
*/



function sortTable(tableId, valueToCompare, elementTypeToCompare){
	var table,rows,switching, i, x, y, shouldSwitch;
	table = document.getElementById(tableId);
	switching = true;
	
	while(switching){
		switching = false;
		rows = table.getElementByTagName("TR");
		for(i = 1; i < (rows.length - 1); i++) {
			shouldSwitch = false;
			x = rows[i].getElementByTagName(elementTypeToCompare)[valueToCompare];
			y = rows[i + 1].getElementByTagName(elementTypeToCompare)[valueToCompare];
			if(x.innerHTML < y.innerHTML){
				shouldSwitch = true;
				break;
			}
		}
		if (shouldSwitch){
			
			rows[i].parentNode.insertBefore(rows[i+1], rows[i]);
			switching = true;
		}
		
	}
	
}
function wrapText(context, text, x, y, maxWidth, lineHeight) {
    var words = text.split(' ');
    var line = '';

    for(var n = 0; n < words.length; n++) {
        var testLine = line + words[n] + ' ';
        var metrics = context.measureText(testLine);
        var testWidth = metrics.width;
        if (testWidth > maxWidth && n > 0) {
            context.fillText(line, x, y);
            line = words[n] + ' ';
            y += lineHeight;
        }
        else {
            line = testLine;
        }
    }
    context.fillText(line, x, y);
}

function applyEverestAward(gameWeekEverest, player, gameWeekPoints){


    var name = player;
    var texts = player+"has  earned  the  maximum  points  in  a  single  gameweek  so  far. "+" The  player  earned  "+gameWeekPoints+"  points  for  gameweek "+gameWeekEverest;
    var nameSplit = name.split(" ");
    var initials = nameSplit[0].charAt(0).toUpperCase() + nameSplit[1].charAt(0).toUpperCase();


    applyAward("everest-award",initials,texts);
}

function applyIronManAward(playerName, RankJump){


    var name = playerName;
    var texts = name+" climbed  "+RankJump+"  ranks  since  game  week  19.";
    var nameSplit = name.split(" ");
    var initials = nameSplit[0].charAt(0).toUpperCase() + nameSplit[1].charAt(0).toUpperCase();


    applyAward("ironman-award",initials,texts);
}

function applyMonthlyAward(month, playerName, cumulativePoints, header){

    var name = playerName;
    var texts = name+" scored  the  highest  cumulative  points, "+cumulativePoints+"  at  the  end  of  month- "+month;
    var nameSplit = name.split(" ");
    var initials = nameSplit[0].charAt(0).toUpperCase() + nameSplit[1].charAt(0).toUpperCase();



    applyAward("monthly-"+month,initials, texts, header);
}

function applyAward(awardId,initials,texts,header){
    var canvas = document.getElementById(awardId);
    var context = canvas.getContext("2d");

    var colours = ["#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50", "#f1c40f", "#e67e22", "#e74c3c", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"];

    var charIndex = initials.charCodeAt(0) - 65,
        colourIndex = charIndex % 19;
    if((typeof header != 'undefined')){
        charIndex = header.charCodeAt(0) - 65;
        colourIndex = charIndex % 19;
    }
    var canvasWidth = $(canvas).attr("width"),
        canvasHeight = $(canvas).attr("height"),
        canvasCssWidth = canvasWidth,
        canvasCssHeight = canvasHeight;

    if (window.devicePixelRatio) {
        $(canvas).attr("width", canvasWidth * window.devicePixelRatio);
        $(canvas).attr("height", canvasHeight * window.devicePixelRatio);
        $(canvas).css("width", canvasCssWidth);
        $(canvas).css("height", canvasCssHeight);
        context.scale(window.devicePixelRatio, window.devicePixelRatio);
    }

    context.fillStyle = colours[colourIndex];
    context.fillRect (0, 0, canvas.width, canvas.height);
    context.textAlign = "center";
    context.fillStyle = "#FFF";
    context.font = "36px Arial";
    if((typeof header != 'undefined')) {
        context.fillText(header, canvasCssWidth / 2, canvasCssHeight / 7.5);
    }
    context.font = "128px Arial";
    context.fillText(initials, canvasCssWidth / 2, canvasCssHeight / 1.5);
    context.font = "14px Arial";
    context.textAlign = "justified";
    wrapText(context, texts, 175, 180, 300, 20) ;
}


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
                    "                        <th data-toggle=\"tooltip\" title=\"Individual Game Week Points\">GAME WEEK POINTS</th>\n" +
                    "                        <th data-toggle=\"tooltip\" title=\"Cumulative Game Week Points\">TOTAL POINTS</th>\n" +
                    "                        <th data-toggle=\"tooltip\" title=\"Event Transfers\">EVENT TRANSFERS</th>\n" +
                    "                        <th data-toggle=\"tooltip\" title=\"Transfer Costs\">TRANSFER COSTS</th>\n" +
                    "                        <th data-toggle=\"tooltip\" title=\"Game Week RankT\">GAME WEEK RANK</th>\n" +

                    "                        </tr>\n" +
                    "                        \n";//Show fetched data from url
                //console.log(JSON.stringify(data.history));
                if(data) {
                    var gameWeekPoints = 0;
                    var individualGameWeekPoints = 0;
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
                        individualGameWeekPoints =(value.points - value.event_transfers_cost);
                        gameWeekPoints += individualGameWeekPoints;
                        htmlData += "<tr><td>"+value.event+"</td>\n"+"<td>"+(individualGameWeekPoints)+"</td>\n"+"<td>"+(gameWeekPoints)+"</td>\n"+"<td>"+value.event_transfers+"</td>\n"+"<td>"+value.event_transfers_cost+"</td>\n"+"<td>"+gwRank+"</td>\n"+"</tr>";
						
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

    var ironManPlayer;
    var ironManRankJump = -1;
    var jsnForPrize;
    $.getJSON("tableOutputPoints.json", function (jsonPoints) {
        //console.log(jsonPoints);
        jsnForPrize = jsonPoints;
        $.each(jsnForPrize, function(gameWeek, mapOfUsers){
            $.each(mapOfUsers, function(playerName, playerPoints){
                if(playerPoints > pointsEverest){
                    gameWeekEverest = gameWeek;
                    playerNameEverest = playerName;
                    pointsEverest = playerPoints;
                }
            });
        });
        applyEverestAward(gameWeekEverest, playerNameEverest, pointsEverest);
    });
    $.getJSON("tableOutputRanks.json", function(jsonRanks){
       var arrayOfNames = Object.keys(jsonRanks[10]);
       $.each(arrayOfNames, function(index,playerName){
           var rankJump = jsonRanks[19][playerName] - jsonRanks[26][playerName];
           if(rankJump > 0 && rankJump > ironManRankJump){
               ironManRankJump = rankJump;
               ironManPlayer = playerName;
           }
       });
       applyIronManAward(ironManPlayer, ironManRankJump);
    });

    /*var months = ["August", "September", "October", "November", "December", "January"];
    $.each(months, function(index,month){
        applyAward("monthly-"+month,":)","Go Slow. Work In Progress here.",month);
    });*/
    $.getJSON("tableOutPutMonthWinners.json", function(data){
        $.each(data, function(monthName){
            console.log(monthName+"\n");
            var player = Object.keys(data[monthName]);
            //alert(monthName +" "+Object.keys(data[monthName])+" "+data[monthName][player]);
            applyMonthlyAward(String(monthName), String(player), String(data[monthName][player]),String(monthName));

        });
    });

   //$(".EverestCard").click(function(e){

       //alert(playerNameEverest+"has earned the maximum points in a single gameweek so far.\n"+"GameWeek:"+gameWeekEverest+"\n"+"Points:"+pointsEverest+"\n");
   //});

  $.getJSON("tableOutputRankJumps.json", function(data){
      var htmlData = "<table class=\"table table-hover table-responsive\">\n" +
          "                        <tr>\n" +
          "                        <th data-toggle=\"tooltip\" title=\"PlayerName\">PLAYER NAME</th>\n" +
          "                        <th data-toggle=\"tooltip\" title=\"Rank After GAmeWeek 19\">RANK AFTER GW19</th>\n" +
          "                        <th data-toggle=\"tooltip\" title=\"Current Rank\">CURRENT RANK</th>\n" +
          "                        <th data-toggle=\"tooltip\" title=\"Ranks Climbed\">RANKS CLIMBED</th>\n" +
          "                        </tr>\n" +
          "                        \n";

          var gameWeekPoints = 0;
          var individualGameWeekPoints = 0;
          $.each(data, function (playerName, playerDetails) {
              //console.log(userName);
              //console.log("Rank for event"+value.event+":"+jsn[value.event][userName]);

              //individualGameWeekPoints =(value.points - value.event_transfers_cost);
              //gameWeekPoints += individualGameWeekPoints;
              htmlData += "<tr><td>"+playerName+"</td>\n"+"<td>"+playerDetails['gw19rank']+"</td>\n"+"<td>"+playerDetails['presentrank']+"</td>\n"+"<td>"+playerDetails['climbed']+"</td>\n"+"</tr>";

          });
          htmlData += "</table>";
          $('.ironManModal').html(htmlData);

  });









});



/*
 * SmoothScroll
*/

smoothScroll.init();
