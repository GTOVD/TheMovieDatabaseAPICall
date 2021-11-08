<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieSearch extends Controller
{
    //Gets data from user input fields and sends results to results view blade
    public function postUserData(Request $request){
     
        $request->validate([
            'MovieName' => "required|string|max:50",
            'APIKey' => "required|string|max:33"
        ]);

        $movieName = $request->input('MovieName');
        $APIKey = $request->input('APIKey');

        $movieName = str_replace(' ', '+', $movieName);

        $queryAPICall = 'https://api.themoviedb.org/3/search/movie?api_key='.$APIKey.'&query='.$movieName;
        $movieData = Http::get($queryAPICall)->json();

        $data = $movieData['results'];
        $firstMovie = $data['0'];
        $movieID = $firstMovie['id'];

        $moviesGetDetailAPICall = 'https://api.themoviedb.org/3/movie/'.$movieID.'?api_key='.$APIKey.'&language=en-US';
        $movieDetails = Http::get($moviesGetDetailAPICall)->json();

        $movieTitle = $movieDetails['original_title'];
        $movieOverview = $movieDetails['overview'];
        $movieReleaseDate = $movieDetails['release_date']; //Year-Month-Day
        $movieRuntime = $movieDetails['runtime']; //Minutes

        $moviesGetCreditsAPICall = 'https://api.themoviedb.org/3/movie/'.$movieID.'/credits?api_key='.$APIKey.'&language=en-US';
        $movieCredits = Http::get($moviesGetCreditsAPICall)->json();
        $movieCreditData = $movieCredits['cast'];

        //Loop through array to get individual cast member names
        foreach($movieCreditData as $cast) {
            $movieCast[] = $cast['name'];
        }

        //Return view of results blade with array of movieData
        return view('results', ['movieData' => [
            'movieTitle' => $movieTitle,
            'movieOverview' => $movieOverview,
            'movieReleaseDate' => $movieReleaseDate,
            'movieRuntime' => $movieRuntime,
            'movieCast' => $movieCast]
        ]);

    }

}
