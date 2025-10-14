function onlyLetters(event){

	const pressedkey = event.key;
	const letters = ["1","A","e",];

	if (!letters.includes(pressedkey)) {
		return false
	}

}


function validarEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}
