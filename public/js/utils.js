function isInt(n) {
  return n % 1 === 0;
}

function isFloat(x) {
  // return !!(x % 1); 
  return Number(x) === x && x % 1 !== 0;
}    

//checking if the string is empty or not
function isBlank(str) {
  return (!str || /^\s*$/.test(str));
}

function calcDaysBetween(startDate, endDate) {
  return (endDate - startDate) / (1000 * 60 * 60 * 24);
}

function IsNumeric(input){
	var RE = /^-{0,1}\d*\.{0,1}\d+$/;
	return (RE.test(input));
}
