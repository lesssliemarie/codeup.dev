
function ask8Ball() {
	// generate random number between 1 and 20
	var num = Math.floor(Math.random()*20);
	// set switch for different answers
	switch(num) {
		case 1:
			return 'IT IS CERTAIN';
			break;
		case 2:
			return 'IT IS DECIDEDLY SO';
			break;
		case 3:
			return 'WITHOUT A DOUBT';
			break;
		case 4:
			return 'YES DEFINITELY';
			break;
		case 5:
			return 'YOU MAY RELY ON IT';
			break;
		case 6:
			return 'AS I SEE IT, YES';
			break;
		case 7:
			return 'MOST LIKELY';
			break;
		case 8:
			return 'OUTLOOK GOOD';
			break;
		case 9:
			return 'YES';
			break;
		case 10:
			return 'SIGNS POINT TO YES';
			break;
		case 11:
			return 'REPLY HAZY TRY AGAIN';
			break;
		case 12:
			return 'ASK AGAIN LATER';
			break;
		case 13:
			return 'BETTER NOT TELL YOU NOW';
			break;
		case 14:
			return 'CANNOT PREDICT NOW';
			break;
		case 15:
			return 'CONCENTRATE AND ASK AGAIN';
			break;
		case 16:
			return "DON'T COUNT ON IT";
			break;
		case 17:
			return 'MY REPLY IS NO';
			break;
		case 18:
			return 'MY SOURCES SAY NO';
			break;
		case 19:
			return 'OUTLOOK NOT SO GOOD';
			break;
		case 20:
			return 'VERY DOUBTFUL';
			break;
		default:
			return 'PSHHHHHHHT';
	}	
}
// // set answer to variable
// var answer = ask8Ball();
// // log variable to console
// console.log(answer);



