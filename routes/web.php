<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
    
});
Route::get('/api', 'testApi@testApi');
   
    

// Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','developer']], function () {
    Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','receptionist']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });
    Route::get('account-settings', 'UsersController@getSettings');
    Route::post('account-settings', 'UsersController@saveSettings');
    Route::get('get-states-by-select-country/{country_id?}', 'UsersController@getStates');
    Route::get('get-cities-by-select-state/{state_id?}', 'UsersController@getCities');
    Route::get('delete-customer/{id?}', 'Customer\CustomerController@deleteCustomer');
    // Route::get('get-states/{country_id?}', 'Customer/CustomerController@getState');
    // Route::get('get-cities/{state_id?}', 'CustomerController@getCitie');
    
    
});
Route::group(['middleware' => 'guest'],function (){
    
    Route::get('aboutus','BlogController@AboutUs')->name('aboutus');
    Route::get('jobs','BlogController@Jobs')->name('jobs');
    Route::get('reviews','BlogController@Reviews')->name('reviews');
    Route::get('game/{slug}','PagesController@Game');
    // Route::get('game/{slug}','PagesController@OverWatch')->name('overwatch');
    Route::get('elo-boost','BlogController@EloBoost')->name('elo-boost');
    Route::get('Placement-Games','BlogController@PlacementGames')->name('Placement-Games');
    Route::get('FAQ','BlogController@FAQ')->name('FAQ');
    Route::get('terms_of_service','BlogController@TermsOfService')->name('terms_of_service');
    Route::get('privacy_policy','BlogController@PrivacyPolicy')->name('privacy_policy');
    Route::get('news','BlogController@News')->name('news');
    // Route::post('submitjobform')->name('submitjobform');
    // /game/{slug}->cs-go/csgo/dota2/ 
    // Route::resource('jobform','JobController');
    Route::resource('e-l-o_-booster', 'ELOBoosterController\\ELO_BoosterController');
    Route::resource('games', 'GameController\\GameController');
    // Route::get('games','GameController\\GameController@GameListing')->name('games');
    Route::get('gamedetail/{id}','GameController\\GameController@GameDetail')->name('gamedetail');
    Route::resource('game-level', 'GameLevelController\\GameLevelController');
    Route::get('GetGameLevels/{id}','GameLevelController\\GameLevelController@GetGameLevels')->name('GetGameLevels');
    Route::get('gamelevelprices/{id}','GameController\\GameController@GameLevelPricing')->name('gamelevelprices');
    // Route::post('cs-go_submit','BlogController@CS_GO_Submit')->name('cs-go_submit');
    Route::resource('orders', 'OrderController\\OrdersController');
    Route::get('userlevelprice/{userlevel}/{desiredlevel}/{gameId}','GameController\\GameController@UserLevelPrice');
    Route::get('addmoney/stripe', array('as' => 'addmoney.paystripe','uses' => 'MoneySetupController@PaymentStripe'));
    Route::post('addmoney/stripe', array('as' => 'addmoney.stripe','uses' => 'MoneySetupController@postPaymentStripe'));
    Route::post('gamepayment','OrderController\\OrdersController@GamePayment');
    Route::post('paypal','OrderController\\OrdersController@PayWithPayPal');
    Route::get('status','OrderController\\OrdersController@getPaymentStatus');

    Route::get('practiceJsonP','OrderController\\OrdersController@practiceJsonP');

});




Route::group(['middleware' => 'auth'], function () {

    /*routes for blog*/
    Route::group(['prefix' => 'blog'], function () {
        Route::get('/create', 'BlogController@create');
        Route::post('/create', 'BlogController@store');
        Route::get('delete/{id}', 'BlogController@destroy')->name('blog.delete');
        Route::get('edit/{id}', 'BlogController@edit')->name('blog.edit');
        Route::post('edit/{id}', 'BlogController@update');
        Route::get('view/{id}', 'BlogController@show');
//        Route::get('{blog}/restore', 'BlogController@restore')->name('blog.restore');
        Route::post('{id}/storecomment', 'BlogController@storeComment')->name('storeComment');
       
    });
    Route::resource('blog', 'BlogController');

    /*routes for blog category*/
    Route::group(['prefix' => 'blog-category'], function () {
        Route::get('/', 'BlogCategoryController@getIndex');
        Route::get('/create', 'BlogCategoryController@create');
        Route::post('/create', 'BlogCategoryController@save');
        Route::get('/delete/{id}', 'BlogCategoryController@delete');
        Route::get('/edit/{id}', 'BlogCategoryController@edit');
        Route::post('/edit/{id}', 'BlogCategoryController@update');
    });
    Route::resource('blogcategory', 'BlogCategoryController');

    
    
});

// Route::group(['middleware' => ['auth', 'roles'],'roles' => 'admin','roles'=>'developer'], function () {
    Route::group(['middleware' => ['auth', 'roles'],'roles' => 'admin','receptionist'], function () {
    Route::get('index2', function () {
        return view('dashboard.index2');
    });
    Route::get('index3', function () {
        return view('dashboard.index3');
    });
    Route::get('index4', function () {
        return view('ecommerce.index4');
    });
    Route::get('products', function () {
        return view('ecommerce.products');
    });
    Route::get('product-detail', function () {
        return view('ecommerce.product-detail');
    });
    Route::get('product-edit', function () {
        return view('ecommerce.product-edit');
    });
    Route::get('product-orders', function () {
        return view('ecommerce.product-orders');
    });
    Route::get('product-cart', function () {
        return view('ecommerce.product-cart');
    });
    Route::get('product-checkout', function () {
        return view('ecommerce.product-checkout');
    });
    Route::get('panels-wells', function () {
        return view('ui-elements.panels-wells');
    });
    Route::get('panel-ui-block', function () {
        return view('ui-elements.panel-ui-block');
    });
    Route::get('portlet-draggable', function () {
        return view('ui-elements.portlet-draggable');
    });
    Route::get('buttons', function () {
        return view('ui-elements.buttons');
    });
    Route::get('tabs', function () {
        return view('ui-elements.tabs');
    });
    Route::get('modals', function () {
        return view('ui-elements.modals');
    });
    Route::get('progressbars', function () {
        return view('ui-elements.progressbars');
    });
    Route::get('notification', function () {
        return view('ui-elements.notification');
    });
    Route::get('carousel', function () {
        return view('ui-elements.carousel');
    });
    Route::get('user-cards', function () {
        return view('ui-elements.user-cards');
    });
    Route::get('timeline', function () {
        return view('ui-elements.timeline');
    });
    Route::get('timeline-horizontal', function () {
        return view('ui-elements.timeline-horizontal');
    });
    Route::get('range-slider', function () {
        return view('ui-elements.range-slider');
    });
    Route::get('ribbons', function () {
        return view('ui-elements.ribbons');
    });
    Route::get('steps', function () {
        return view('ui-elements.steps');
    });
    Route::get('session-idle-timeout', function () {
        return view('ui-elements.session-idle-timeout');
    });
    Route::get('session-timeout', function () {
        return view('ui-elements.session-timeout');
    });
    Route::get('bootstrap-ui', function () {
        return view('ui-elements.bootstrap');
    });
    Route::get('starter-page', function () {
        return view('pages.starter-page');
    });
    Route::get('blank', function () {
        return view('pages.blank');
    });
    Route::get('blank', function () {
        return view('pages.blank');
    });
    Route::get('search-result', function () {
        return view('pages.search-result');
    });
    Route::get('custom-scroll', function () {
        return view('pages.custom-scroll');
    });
    Route::get('lock-screen', function () {
        return view('pages.lock-screen');
    });
    Route::get('recoverpw', function () {
        return view('pages.recoverpw');
    });
    Route::get('animation', function () {
        return view('pages.animation');
    });
    Route::get('profile', function () {
        return view('pages.profile');
    });
    Route::get('invoice', function () {
        return view('pages.invoice');
    });
    Route::get('gallery', function () {
        return view('pages.gallery');
    });
    Route::get('pricing', function () {
        return view('pages.pricing');
    });
    Route::get('400', function () {
        return view('pages.400');
    });
    Route::get('403', function () {
        return view('pages.403');
    });
    Route::get('404', function () {
        return view('pages.404');
    });
    Route::get('500', function () {
        return view('pages.500');
    });
    Route::get('503', function () {
        return view('pages.503');
    });
    Route::get('form-basic', function () {
        return view('forms.form-basic');
    });
    Route::get('form-layout', function () {
        return view('forms.form-layout');
    });
    Route::get('icheck-control', function () {
        return view('forms.icheck-control');
    });
    Route::get('form-advanced', function () {
        return view('forms.form-advanced');
    });
    Route::get('form-upload', function () {
        return view('forms.form-upload');
    });
    Route::get('form-dropzone', function () {
        return view('forms.form-dropzone');
    });
    Route::get('form-pickers', function () {
        return view('forms.form-pickers');
    });
    Route::get('basic-table', function () {
        return view('tables.basic-table');
    });
    Route::get('table-layouts', function () {
        return view('tables.table-layouts');
    });
    Route::get('data-table', function () {
        return view('tables.data-table');
    });
    Route::get('bootstrap-tables', function () {
        return view('tables.bootstrap-tables');
    });
    Route::get('responsive-tables', function () {
        return view('tables.responsive-tables');
    });
    Route::get('editable-tables', function () {
        return view('tables.editable-tables');
    });
    Route::get('inbox', function () {
        return view('inbox.inbox');
    });
    Route::get('inbox-detail', function () {
        return view('inbox.inbox-detail');
    });
    Route::get('compose', function () {
        return view('inbox.compose');
    });
    Route::get('contact', function () {
        return view('inbox.contact');
    });
    Route::get('contact-detail', function () {
        return view('inbox.contact-detail');
    });
    Route::get('calendar', function () {
        return view('extra.calendar');
    });
    Route::get('widgets', function () {
        return view('extra.widgets');
    });
    Route::get('morris-chart', function () {
        return view('charts.morris-chart');
    });
    Route::get('peity-chart', function () {
        return view('charts.peity-chart');
    });
    Route::get('knob-chart', function () {
        return view('charts.knob-chart');
    });
    Route::get('sparkline-chart', function () {
        return view('charts.sparkline-chart');
    });
    Route::get('simple-line', function () {
        return view('icons.simple-line');
    });
    Route::get('fontawesome', function () {
        return view('icons.fontawesome');
    });
    Route::get('map-google', function () {
        return view('maps.map-google');
    });
    Route::get('map-vector', function () {
        return view('maps.map-vector');
    });

    #Permission management
    Route::get('permission-management', 'PermissionController@getIndex');
    Route::get('permission/create', 'PermissionController@create');
    Route::post('permission/create', 'PermissionController@save');
    Route::get('permission/delete/{id}', 'PermissionController@delete');
    Route::get('permission/edit/{id}', 'PermissionController@edit');
    Route::post('permission/edit/{id}', 'PermissionController@update');
    
    
    // Route::get('aboutus','BlogController@AboutUs')->name('aboutus');
    // Route::get('jobs','BlogController@Jobs')->name('jobs');
    // Route::get('reviews','BlogController@Reviews')->name('reviews');
    // Route::get('cs-go','BlogController@CS_GO')->name('cs-go');
    // Route::get('overwatch','BlogController@OverWatch')->name('overwatch');
    // Route::get('elo-boost','BlogController@EloBoost')->name('elo-boost');
    // Route::get('Placement-Games','BlogController@PlacementGames')->name('Placement-Games');
    // Route::get('FAQ','BlogController@FAQ')->name('FAQ');
    // Route::get('terms_of_service','BlogController@TermsOfService')->name('terms_of_service');
    // Route::get('privacy_policy','BlogController@PrivacyPolicy')->name('privacy_policy');


    
    

    #Role management
    Route::get('role-management', 'RoleController@getIndex');
    Route::get('role/create', 'RoleController@create');
    Route::post('role/create', 'RoleController@save');
    Route::get('role/delete/{id}', 'RoleController@delete');
    Route::get('role/edit/{id}', 'RoleController@edit');
    Route::post('role/edit/{id}', 'RoleController@update');

    #CRUD Generator
    Route::get('/crud-generator', ['uses' => 'ProcessController@getGenerator']);
    Route::post('/crud-generator', ['uses' => 'ProcessController@postGenerator']);

    # Activity log
    Route::get('activity-log', 'LogViewerController@getActivityLog');
    Route::get('activity-log/data', 'LogViewerController@activityLogData')->name('activity-log.data');

    #User Management routes
    Route::get('users', 'UsersController@getIndex');
    Route::get('user/create', 'UsersController@create');
    Route::post('user/create', 'UsersController@save');
    Route::get('user/edit/{id}', 'UsersController@edit');
    Route::post('user/edit/{id}', 'UsersController@update');
    Route::get('user/delete/{id}', 'UsersController@delete');
    Route::get('user/deleted/', 'UsersController@getDeletedUsers');
    Route::get('user/restore/{id}', 'UsersController@restoreUser');

});

//Log Viewer
Route::get('log-viewers', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index')->name('log-viewers');
Route::get('log-viewers/logs', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs')->name('log-viewers.logs');
Route::delete('log-viewers/logs/delete', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete')->name('log-viewers.logs.delete');
Route::get('log-viewers/logs/{date}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@show')->name('log-viewers.logs.show');
Route::get('log-viewers/logs/{date}/download', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@download')->name('log-viewers.logs.download');
Route::get('log-viewers/logs/{date}/{level}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel')->name('log-viewers.logs.filter');
Route::get('log-viewers/logs/{date}/{level}/search', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@search')->name('log-viewers.logs.search');
Route::get('log-viewers/logcheck', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@logCheck')->name('log-viewers.logcheck');

#blog routes frontend
// Route::get('/', 'BlogController@getBlogList');
Route::get('/', 'PagesController@HomePage');
Route::get('blogs/{slug}', 'BlogController@getBlog');
Route::get('blogs/category/{slug}', 'BlogController@getCategoryBlog');
Route::get('blogs/tag/{slug}', 'BlogController@getTagBlog');
Route::get('blogs/author/{slug}', 'BlogController@getAuthorBlog');


Route::get('auth/{provider}/', 'Auth\SocialLoginController@redirectToProvider');
Route::get('{provider}/callback', 'Auth\SocialLoginController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();

Route::resource('testing/testing', 'TestingController\\TestingController');


Route::resource('news/news', 'NewsController\\NewsController');
Route::resource('news/news', 'NewsController\\NewsController');
Route::resource('news/news', 'NewsController\\NewsController');
Route::resource('news/news', 'NewsController\\NewsController');
Route::resource('news/news', 'NewsController\\NewsController');
Route::resource('news/news', 'NewsController\\NewsController');
Route::resource('news/news', 'NewsController\\NewsController');
Route::resource('news/news', 'NewsController\\NewsController');
Route::resource('category', 'CategoryController\\CategoryController');
Route::resource('category', 'CategoryController\\CategoryController');

Route::resource('game-detail', 'GameDetailController\\GameDetailController');
Route::resource('game-options', 'GameOptionsController\\GameOptionsController');
Route::resource('testimonials', 'TestimonialsController\\TestimonialsController');
Route::resource('orders', 'OrderController\\OrdersController');
Route::resource('order-account-detail', 'OrderAccountDetailControl\\OrderAccountDetailController');
Route::resource('order-account-detail', 'OrderAccountDetailControl\\OrderAccountDetailController');
Route::resource('payment-detail', 'PaymentDetailController\\PaymentDetailController');
Route::resource('payment-detail', 'PaymentDetailController\\PaymentDetailController');
Route::resource('about-us', 'AboutUsController\\AboutUsController');
Route::resource('about-us', 'AboutUsController\\AboutUsController');
Route::resource('best', 'BestController\\BestController');
Route::get('getcslevels','GameLevelController\\GameLevelController@GetCSLevels')->name('getcslevels');
Route::post('submitgamelevelpricing','GameController\\GameController@SubmitGameLevelPricing')->name('submitgamelevelpricing');
// Route::post('submitgamelevelpricing','GameController\\GameController@SubmitGameLevelPricing')->name('submitgamelevelpricing');
Route::post('updategamelevelpricing','GameController\\GameController@UpdateGameLevelPricing')->name('updategamelevelpricing');


Route::resource('game-region', 'GameRegionController\\GameRegionController');
Route::resource('game-roles', 'GameRolesController\\GameRolesController');
Route::resource('category', 'CategoryController\\CategoryController');
Route::resource('category', 'CategoryController\\CategoryController');
Route::resource('product-type', 'ProductTypeController\\ProductTypeController');
Route::resource('item', 'ItemController\\ItemController');
Route::resource('shape', 'ShapeController\\ShapeController');
Route::resource('course', 'CourseController\\CourseController');
Route::resource('chapter', 'ChapterController\\ChapterController');
Route::resource('class', 'ClassController\\ClassController');
Route::resource('topic', 'TopicController\\TopicController');
Route::resource('customer/customer', 'Customer\\CustomerController');

// routes for romm type
Route::resource('roomcategory/room-category', 'RoomCategory\\RoomCategoryController');
Route::get('room-status-change/', 'RoomCategory\\RoomCategoryController@roomStatus');
Route::get('delete-room-type/{id?}', 'RoomCategory\\RoomCategoryController@deleteRoom');

