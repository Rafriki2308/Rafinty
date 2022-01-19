<?php

/** 
 * @file PrintInfo.php
 * @Author Rafael Martinez
 * @date 11/12/2021
 * @class PrintInfo
 * Genera un objeto que gestiona las impresiones por pantalla.
*/

class PrintInfo
{
    /**
     * @brief Constructor
     */
    public function __construct()
    {
    }


    /**
     * @brief Metodo público que toma una lista de objetos pelicula y los muestra por
     * pantalla formateados en lenguaje HTML.
     * 
     * @param $movies
     * Lista de objetos pelicula.
     */
    public function printAllMovies($movies)
    {

        foreach ($movies as $movie) {
            $publicId = $movie->getPublicId();
            $name = $movie->getName();
            $posterUrl = $movie->getPosterURL();
            $rating = $movie->getRating();
            $rating = round($rating, 2);
            $synopsis=$movie->getSynopsis();


            echo "<a href='./InfoFilm.php?publicId=$publicId && option=0'>
                    <div class='card'>
                     <div class='imgBx' onclick='./InfoFilm.php?publicId=$publicId && option=0'>
                            <img src='$posterUrl' alt= $name>
                            <br>
                            <p>$name</p>
                            <p>Nota: $rating</p>
                        </div>
                        <div class='details'>
                            <h2>Sinopsis</h2>
                            <p>$synopsis</p>
                        </div>
                    </div>
            </a>";
        }
    }

    /**
     * @brief Metodo público que toma una lista de objetos usuario y los muestra por
     * pantalla formateados en lenguaje HTML.
     * 
     * @param $users
     * Lista de objetos usuario.
     */
    public function printAllUsers($users)
    {

        foreach ($users as $user) {
            $nick = $user->getNick();
            $avatarURL = $user->getAvatarURL();
            $numFilmFav = $user->getNumFilmFav();


            echo "<a href='InfoUser.php?id=$nick'>
        <div class='user'>
            <img id='photoComment' src='$avatarURL' alt= $nick>
            <p id='name'>$nick</p>
            <p id='numFavFilm'>Número Peliculas Favoritas: $numFilmFav</p>
        </div>
    </a>";
        }
    }

    /**
     * @brief Metodo público que toma una lista de objetos comentario y los muestra por
     * pantalla formateados en lenguaje HTML.
     * 
     * @param $comments
     * Lista de objetos pelicula.
     */
    public function printCommentsInfoFilm($comments)
    {

        $i = 0;
        foreach ($comments as $comment) {
            $i++;
            $nick = $comment->getNick();
            $photoUser = $comment->getPhotoUser();
            $commentInfo = $comment->getComment();
            $commentDate = $comment->getCommentData();


            echo "<br><div id='commentsArea'>
        <div id='commentArea' onclick='location.href='>
        <text>$i</text>
        <br>
        <a href='./InfoUser.php?id=$nick'><img  id='photoUser' src='$photoUser' alt='PhotoUser'>
            <label id='nick'>nick</label>
            <label id='date'>Fecha</label>
            <br>
            <text id='nickInfo'>$nick</text>
            <br></a>
            <text id='dateInfo'>$commentDate</text>
            <p id='infoFilmComment'>$commentInfo</p>
        </div>
    </div>
    <br>";
        }
    }

    /**
     * @brief Metodo público que toma un objeto pelicula y una lista 
     * de comentarios y los muestra por pantalla formateados en lenguaje HTML.
     * 
     * @param $movie, $commentList
     * Objeto película, lista objetos comentario.
     */
    public function printInfoFilm($movie, $commentList)
    {

        $publicId = $movie->getPublicId();
        $name = $movie->getName();
        $synopsis = $movie->getSynopsis();
        $releaseYear = $movie->getReleaseYear();
        $directorName = $movie->getDirectorName();
        $posterUrl = $movie->getPosterUrl();
        $rating = $movie->getRating();
        $rating = round($rating, 2);
        $isFav = $movie->getIsFav();



        echo "<div id='photoArea'>
        <img id='photoFilm'  src='$posterUrl' alt='PhotoFilm'>
        <br>
        <label for='pmedia'>Puntuacion Media:  </label>
        <text id='pmediaInfo'>$rating</text>
        <br><br>
        <form name='insertRating' action='./insertRating.php?publicId=$publicId' method='post'>  
        <button type='button' id='sendRating' onclick='testMark(rating.value)'>Añadir Puntuacion: </button>
            <br><br>
            <div class='number-input'>
                <button type='button'onclick='stepDown(ratingI.value)' ></button>
                 <input id='ratingI' class='quantity' min='0' max='5' name='rating' value='0' type='number' requiered>
                <button type='button' onclick='stepUp(ratingI.value)' class='plus'></button>
            </div>
        </form>
        <form name='insertFav' action='./InfoFilm.php?publicId=$publicId && option=3' method='post'>
            <input id='isFavI' name='isFavI' type='submit' value='$isFav'>
        </form>
        <!--Este DIV contiene el popUp que esta oculto desde el CSS y cuando se aplica el evento del 
        boton el javaScript lo hace aparecer cuando se introduce una nota errone en una pelicula-->
        <div class='popup-wrapper-mark'>
        <div class='popup-mark'>
            <div class='popup-close-mark'>x</div>
            <div class='popup-content-mark'>
                <h2>UPS Parece que has intentado introducir una nota  no válida</h2>
                <p>Revisalo y vuelve a intentarlo</p>
                <a href='./InfoFilm.php?publicId=$publicId && option=0'>Vale</a>
            </div>
        </div>
        </div>
        </div>
        <div id='principalArea'>
            <label for='name'>Nombre de Pelicula: </label>
            <text id='nameInfo'>$name</text>
            <br><br>
            <label for='year'>Año: </label>
            <text id='yearInfo'>$releaseYear</text>
            <br><br>
            <label for='director'>Director: </label>
            <text id='directorInfo'>$directorName</text>
            <br><br>
            <label for='sinopsis'>Sinopsis</label>
            <br><br>
            <p id='sinopsisInfo'>$synopsis</p>
        </div>
        <br>";
        $this->printDeleteFilm($publicId);

        $this->printCommentsInfoFilm($commentList);

        echo "<form name='insertComment' name='insertComment' action='./infoFilm.php?publicId=$publicId 
        && option=2' method='post'><textarea name='addComment' id='addComment' 
        placeholder='Escribe tu comentario' required></textarea><button type='button' id='sendComment' 
        onclick='testComment(addComment.value)'>Comentar</button></form>
        <!--Este DIV contiene el popUp que esta oculto desde el CSS y cuando se aplica el evento del 
        boton el javaScript lo hace aparecer cuando se introduce un dato errone en una pelicula-->
        <div class='popup-wrapper-comment'>
        <div class='popup-comment'>
            <div class='popup-close-comment'>x</div>
            <div class='popup-content-comment'>
                <h2>UPS Parece que has intentado introducir un comentario no válido</h2>
                <p>Revisalo y vuelve a intentarlo</p>
                <a href='./InfoFilm.php?publicId=$publicId && option=0'>Vale</a>
            </div>
        </div>
    </div>";
    }

    /**
     * @brief Metodo público que toma un objeto usuario y 
     * una lista de objetos pelicula y los muestra por
     * pantalla formateados en lenguaje HTML.
     * 
     * @param $user, $movies
     * Objeto usuario, lista de objetos pelicula.
     */
    function printUserInfo($user, $movies)
    {

        $photoURL = $user->getavatarURL();
        $nick = $user->getNick();
        $email = $user->getEmail();


        echo "<div id='infoUser'>
        <img id='photoUser' src='$photoURL' alt='Foto Usuario'>
        <br>
        <input id='nickUser' value='$nick'></input>
        <br>
        <input id='emailUser' value='$email'></input>
    </div>";

        foreach ($movies as $movie) {
            $publicId = $movie->getPublicId();
            $name = $movie->getName();
            $posterUrl = $movie->getPosterURL();
            $rating = $movie->getRating();

            echo "<a href='InfoFilm.php?publicId=$publicId && option=0'>
            <div id='movieIndex'>
                <img id='imageIndex'src='$posterUrl' alt= $name>
                <br>
                <p id='nameMovieIndex'>$name</p>
                <p id='ratingIndex'>Nota: $rating</p>
            </div>
        </a>";
        }
    }

    /**
     * @brief Metodo público que toma una identidad pública de una película
     * e imprime por pantalla un boton de borrado para dicha pelicula.
     * 
     * @param $publicId
     * Identidad publica de la película.
     */
    public function printDeleteFilm($publicId)
    {
        echo "<button type='button' id='delete' class='deleteB' onclick='popUpDelete()'>Borrar Pelicula</button>
        <br>
        <div class='popup-wrapper'>
        <div class='popup'>
            <div class='popup-close'>x</div>
            <div class='popup-content'>
                <h3>¿Seguro que deseas eliminar la pelicula?</h3>
                <p>¡Mira que no hay vuelta atrás!</p>
                <a href='./DeleteFilm.php?id=$publicId'>Si</a>
                <a href='./InfoFilm.php?publicId=$publicId && option=0'>No</a>
            </div>
        </div>
    </div>
    <br>";
    }
}
