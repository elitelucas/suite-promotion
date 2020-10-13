// Super Wheel Script
jQuery(document).ready(function($){

	$('.wheel-horizontal').superWheel({
		slices: [
			{
				text: "10 Points",
				value: 1,
				message: "You won 10 points! Share to claim",
				discount: "no",
				background: "#364C62",

			},
			{
				text: "No luck",
				value: 0,
				message: "You have no luck today",
				discount: "no",
				background: "#9575CD",

			},
			{
				text: "10 Points",
				value: 1,
				message: "You won 10 points! Share to claim",
				discount: "no",
				background: "#E67E22",

			},
			{
				text: "Lose",
				value: 0,
				message: "You Lose :(",
				discount: "no",
				background: "#E74C3C",

			},
			{
				text: "10 Points",
				value: 1,
				message: "You won 10 points! Share to claim",
				discount: "no",
				background: "#2196F3",

			},
			{
				text: "Nothing",
				value: 0,
				message: "You get Nothing :(",
				discount: "no",
				background: "#95A5A6",

			}
		],
		text : {
			color: '#fff',
			offset : 11,
			letterSpacing: 0,
			orientation: 'h',
		},
		slice : {
			background : "#333",
		},
		line: {
			width: 6,
			color: "#eee"
		},
		outer: {
			width: 10,
			color: "#eee"
		},
		inner: {
			width: 12,
			color: "#eee"
		},
		/*marker: {
			background: "#00BCD4"
		},*/
		selector: "value"
	});



	var tick = new Audio('plugins/spin-wheel/media/tick.mp3');

	$(document).on('click','.wheel-horizontal-spin-button',function(e){

		$('.wheel-horizontal').superWheel('start','value',Math.floor(Math.random() * 2));
		$(this).prop('disabled',true);
	});


	$('.wheel-horizontal').superWheel('onStart',function(results){


		$('.wheel-horizontal-spin-button').text('Spinning...');

	});
	$('.wheel-horizontal').superWheel('onStep',function(results){

		if (typeof tick.currentTime !== 'undefined')
			tick.currentTime = 0;

		tick.play();

	});


	$('.wheel-horizontal').superWheel('onComplete',function(results){
		//console.log(results.value);
		if(results.value === 1){

			swal({
				type: 'success',
				title: "Congratulations!",
				html: results.message+' <br><br>'
			});

		}else{
			swal("Oops!", results.message, "error");
		}


		$('.wheel-horizontal-spin-button:disabled').prop('disabled',false).text('Spin to win');

	});





});
