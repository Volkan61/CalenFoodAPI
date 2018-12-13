<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Serie


// Admin



Route::get('/series',
    [
        'uses' => 'SerieController@getSeries'
    ]
);




// Episode

Route::post('/episode',
    [
        'uses' => 'EpisodeController@postEpisode'
    ]
);



Route::get('/episodes/{id}',
    [
        'uses' => 'EpisodeController@getEpisodes'
    ]
);



Route::post('/deleteAllEpisodes',
    [
        'uses' => 'EpisodeController@deleteAllEpisodes'
    ]
);


Route::post('/importEpisodes',
    [
        'uses' => 'EpisodeController@importEpisodes'
    ]
);


Route::post('/getEpisodeData',
    [
        'uses' => 'EpisodeController@getEpisodeData'
    ]
);



// Saison

Route::post('/season',
    [
        'uses' => 'SeasonController@postSeason'
    ]
);



Route::get('/seasons/{id}',
    [
        'uses' => 'SeasonController@getSeasons'
    ]
);




// Source

Route::post('/source',
    [
        'uses' => 'SourceController@postSource'
    ]
);




Route::post('/importSources',
    [
        'uses' => 'SourceController@importSources'
    ]
);

Route::post('/importSubtitles',
    [
        'uses' => 'SubtitlesController@importSubtitles'
    ]
);


Route::post('/importTitles',
    [
        'uses' => 'EpisodeController@importTitles'
    ]
);













// Category

Route::post('/category',
    [
        'uses' => 'CategoryController@postCategory'
    ]
);


Route::get('/maincategory',
    [
        'uses' => 'CategoryController@getMainCategories'
    ]
);


Route::get('/subcategories/{id}',
    [
        'uses' => 'CategoryController@getSubCategories'
    ]
);


Route::get('/categories/',
    [
        'uses' => 'CategoryController@getCategories'
    ]
);

Route::post('/drag/',
    [
        'uses' => 'CategoryController@postDrag'
    ]
);


//Listen

Route::post('/listen',
    [
        'uses' => 'ListenController@postListen'
    ]
);


//List


Route::post('/list',
    [
        'uses' => 'ListController@postList'
    ]
);

Route::get('/list/{id}',
    [
        'uses' => 'ListController@getList'
    ]
);











Route::post('/quote',
    [
        'uses' => 'QuoteController@postQuote'
    ]
);

Route::get('/quotes',
    [
        'uses' => 'QuoteController@getQuotes'
    ]
);

Route::put('/quote{id}',
    [
        'uses' => 'QuoteController@getQuotes'
    ]
);

Route::put('/quote{id}',
    [
        'uses' => 'QuoteController@deleteQuote'
    ]
);








Route::post('/video',
    [
        'uses' => 'VideoController@postVideo'
    ]
);

Route::post('/deleteVideo/{id}',
    [
        'uses' => 'VideoController@deleteVideo'
    ]
);

Route::get('/videos',
    [
        'uses' => 'VideoController@getVideos'
    ]
);

Route::put('/video/{id}',
    [
        'uses' => 'VideoController@getVideos'
    ]
);

Route::put('/video/{id}',
    [
        'uses' => 'VideoController@deleteVideo'
    ]
);



Route::post('/entry',
    [
        'uses' => 'EntryController@postEntry'
    ]
);

Route::get('/entries',
    [
        'uses' => 'EntryController@getEntries'
    ]
);

Route::put('/entry{id}',
    [
        'uses' => 'EntryController@getEntries'
    ]
);

Route::put('/entry{id}',
    [
        'uses' => 'EntryController@deleteEntry'
    ]
);




/*
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');


Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
});

*/




Route::post('/login',
    [
        'uses' => 'LoginController@login'
    ]
);

Route::post('register', 'LoginController@register');

Route::post('tokenValidity', 'LoginController@tokenValidity');



Route::middleware('auth:api')->group(function () {
    Route::get('details', 'LoginController@details');


    Route::get('isAdmin', 'LoginController@isAdmin');



    Route::get('/logout',
        [
            'uses' => 'LoginController@logout']
    );




    Route::post('/serie',
        [
            'uses' => 'SerieController@postSerie'
        ]
    );


});





Route::post('/role', 'RoleController@postRole');

Route::post('/test', 'RoleController@postRelation');






//Route::post('logout', 'PassportController@logout');
/*
$router->group(['middleware' => 'auth:api'], function () use ($router) {
    Route::get('logout', 'PassportController@logout');
});
*/