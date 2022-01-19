/**
 * @fileoverview Menú aprMenu, desplegable con efecto expansión suavizado
 * @author Rafael Martinez
 * @class accion
 * Esta clase estatica sirve para gestionar las funciones de la página.
*/

/**
 * La funcion toma una direccion URL y sustituye el valor del atributo src
 * de la imagen por la que toma.
 * @param  {string}
 * Direccion URL de la foto.
 */
function showPhoto(imagen){
    return photo.src = imagen;
}

/**
 * La funcion genera números aleatorios de cuatro cifras.
 */
function genRandomNumbers(){

    let number = Math.floor(Math.random() * (9999 - 1000) )+ 1000;
    return number;
}

/**
 * La funcion toma un email y extrae las cuatro primeras letras y
 * le añade un número de cuatro cifras para generar un nick.
 * @param  {string}
 * Email del usuario.
 * @return {string}
 * Nick de usuario
 */
function genNick(email){

    email=email.trim();
    let nick = email.substring(0,5);
    let number = genRandomNumbers();
    nick = nick + number;
    
    return nickI.value = nick;
}

/**
 * La funcion toma un string y comprueba que no este vacio o este
 * compuesto por espacios.
 * @param  {string}
 * Un string.
 * @return {boolean}
 * Indica si el string es correcto o no.
 */
function testIsVoid(string) {

    string = string.trim();
    let isVoid = string === "";
    let correct = false;

    if (!isVoid) {
        correct = true;
    }

    return correct;

}

/**
 * La funcion toma un nick, comprueba que no este vacio, 
 * que la longitud del nick sea correcta.
 * @param  {string}
 * Nick del usuario
 * @return {boolean}
 * Indica si el nick es correcto o no.
 */
function testNick(nick){
    
    nick = nick.trim();    
    let correct = false;
    let isNotVoid = testIsVoid(nick);
    let lengthCorrect = nick.length > 8 && nick.length < 16;

    if(isNotVoid && lengthCorrect){
        correct = true;
    }

    return correct;
}

/**
 * La funcion toma un email, comprueba que este bien
 * formado.
 * @param  {string}
 * Email del usuario
 * @return {boolean}
 * Indica si el Email esta bien formado.
 */
function testWellFormed(email){

    let  re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    let correct = true;

        if(!re.exec(email)){
            correct = false;
        }
    
        return correct;
}

/**
 * La funcion toma un email, comprueba que no este vacio, 
 * que este bien formado.
 * @param  {string}
 * Email del usuario
 * @return {boolean}
 * Indica si el email es correcto o no.
 */
function testEmail(email){

    email=email.trim();
    let isNotVoid = testIsVoid(email);
    let isWellFormed = testWellFormed(email);
    correct = false;

    if(isNotVoid && isWellFormed){
        correct = true;
    }

    return correct;
}

/**
 * La funcion toma un año, comprueba que no este vacio, 
 * que este dentro de un rango.
 * @param  {int}
 * Año de producion de la pelicula.
 * @return {boolean}
 * Indica si el año es correcto o no.
 */
function testYear(year){

    year=year.trim();
    let isNotVoid = testIsVoid(year);
    let isInRange= year >= 1800 && year <= 2100;
    let correct = false;

    if(isNotVoid && isInRange){

        correct = true;
    }

    return correct;
}

/**
 * La funcion toma una nota, comprueba que no este vacio, 
 * y que esta dentro de un rango.
 * @param  {int}
 * Nota de valoracion de la película.
 * @return {boolean}
 * Indica si la nota  es correcto o no.
 */
function testMark(mark){

    mark = parseInt(mark);
    let isNumeric = !isNaN(mark); //Comprueba si el valor no es númerico y si esta vacio
    let isInRange = mark >= 0 && mark <= 5;

    if(isNumeric && isInRange){
        document.insertRating.submit();
      
    }else{
        //En caso que el dato no sea correcto genera un pop-up
        popUp('sendRating','popup-wrapper-mark', 'popup-close-mark');
    }
    
}

/**
 * La funcion toma un comentario, comprueba que no este vacio, 
 * y que esta dentro de un rango.
 * @param  {string}
 * Comentario de la película.
 * @return {boolean}
 * Indica si el comentario  es correcto o no.
 */
function testComment(comment){

    comment = comment.trim();
    let isNotVoid = testIsVoid(comment);
    let isCommentInRange = comment.length>=10 && comment.length<=200;
   

    if(isNotVoid && isCommentInRange){
        document.insertComment.submit();
    }else{
        //En caso que el dato no sea correcto genera un pop-up
        popUp('sendComment','popup-wrapper-comment', 'popup-close-comment');        
    }  
}

/**
 * La funcion toma un nick, email y una dirección URL, comprueba que no esten vacios, 
 * y esten correctos.
 * @param  {string}
 * Nick, email, direccion URL foto avatar del usuario.
 * @return {boolean}
 * Indica si el comentario  es correcto o no.
 */
function testInsertUser(nick, email, url){
    
    email = email.toLowerCase();
    let nickIsValid = testNick(nick);
    let emailIsValid = testEmail(email);
    let urlIsValid = testIsVoid(url);

    let userIsValid = nickIsValid && emailIsValid && urlIsValid;

   if(userIsValid){
        document.sendUserForm.submit();
    }else{
        //En caso que el dato no sea correcto genera un pop-up
        popUp('sendUser','popup-wrapper', 'popup-close');   
    }
}

/**
 * La funcion toma un nombre, año, una dirección URL y una sinopsis
 * de una pelicula comprueba que no esten vacios, y esten correctos.
 * @param  {string}
 * Nombre, año, direccion URL foto y sinopsis de una película.
 * @return {boolean}
 * Indica si el comentario  es correcto o no.
 */
function testFilm(name, year, director, url, synopsis){
    let nameIsValid = testIsVoid(name);
    let yearIsValid = testYear(year);
    let directorIsValid = testIsVoid(director);
    let urlIsValid = testIsVoid(url);
    let sinopsisIsValid = testIsVoid(synopsis);

    filmIsValid = nameIsValid && yearIsValid && directorIsValid && urlIsValid
    && sinopsisIsValid;

    if(filmIsValid){

        document.sendFilmForm.submit();
    }else{
        //En caso que el dato no sea correcto genera un pop-up
        popUp('sendFilm', 'popup-wrapper', 'popup-close');
    }
}


/**
 * La funcion que genera un pop-up que se abre justa al pinchar el 
 * boton de borrar película.
 */
function popUpDelete(){

    /*Esta funcion obtiene el id en funcion de la clase se la pasa al popUp */
    var elemento = document.getElementsByClassName('deleteB'); 
    var id = elemento[0].getAttribute('id');
    //En caso que el dato no sea correcto genera un pop-up
    popUp(id, 'popup-wrapper', 'popup-close');
}

/**
 * La funcion toma un id de boton, y las clases de los comentarios 
 * del pop-up y genera un pop-up.
 * @param  {string}
 * Id del boton, clases del comentario del pop-up.
 */
function popUp(id, clas1, clas2){

    /*Meto como parametro el identificador del boton, pero como en el html el caracter # es
    reservado, se lo añada al string antes de incluirlo en la constante*/
    
    id = "#"+ id; //añado el caracter que convierte el String en un id de html
    clas1 = "." + clas1; //Añado el caracter que convierte el String en una class html
    clas2 = "." + clas2;
    
    const button = document.querySelector(id);
    const popup = document.querySelector(clas1);
    const close = document.querySelector(clas2);
     
    button.addEventListener('click', () => {
        popup.style.display = 'block';
    });
     
    close.addEventListener('click', () => {
        popup.style.display = 'none';
    });
     
    popup.addEventListener('click', e => {
        // console.log(e);
        if(e.target.className === clas1) {
            popup.style.display = 'none';
        }
    });
}

/**
 * La funcion toma un booleano que indica si la pelicula es 
 * favorita o no.
 * @param  {boolean}
 * Nombre, año, direccion URL foto y sinopsis de una película.
 * @return {boolean}
 * Indica si el comentario  es correcto o no.
 */
function isFav(isFav){
    
    if(isFav){
        image = './Style/img/FullHeart.png';
    }else{
    
        image = './Style/img/VoidHeart.png';
    } 

    document.getElementById("isFavI").style.backgroundImage="url("+image+")";
}

/**
 * La funcion toma un valor que pertenece a un input y lo 
 * incrementa.
 * @param  {int}
 * Valor del input nota de pelicula.
 * @return {int}
 * Valor incrementado para la nota de pelicula.
 */
function stepUp(valueI){
   
    if(valueI<5){
        valueI++;
    }

    return ratingI.value = valueI;
}

/**
 * La funcion toma un valor que pertenece a un input y lo 
 * decrementa.
 * @param  {int}
 * Valor del input nota de pelicula.
 * @return {int}
 * Valor decrementado para la nota de pelicula.
 */
function stepDown(valueI){
    
    if(valueI>0){
    valueI--;
    }
    return ratingI.value = valueI;
}




