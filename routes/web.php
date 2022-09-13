<?php

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
    return view('home');
});

//Rutas de socio
Route::get('partners','PartnerController@index')->name('partners.index');
Route::get('partnersNew','PartnerController@ViewCreate')->name('partners.create');
Route::post('partnersNew','PartnerController@create')->name('partners.form');
Route::delete('partners{partner}','PartnerController@destroy')->name('partners.destroy');
Route::get('partnersUpdate{id}','PartnerController@edit')->name('partners.updateForm');
Route::post('partnersUpdate{id}','PartnerController@update')->name('partner.update');
Route::get('partnerFile{id}','PartnerController@partnerFile')->name('partner.file');
Route::get('partnerList','PartnerController@partnerList')->name('partner.list');
Route::post('/directivosocio','PartnerController@cargoDirectivo')->name('asignar.directivo');
Route::get('vistaExecutive','PartnerController@vistaDirectivo')->name('vistaDirectivo');
Route::get('resumenPartner','PartnerController@resumenSocio')->name('resumenSocio');
Route::get('resumenDatos{nombre}','PartnerController@resumenDatos')->name('resumenDatos');
Route::get('panel','PartnerController@panel')->name('panel');
Route::get('deuda11','PartnerController@deuda11')->name('deuda11');
Route::get('deuda12','PartnerController@deuda12')->name('deuda12');
Route::get('socioRetirado{id}','PartnerController@socioRetirado')->name('socioRetirado');
Route::get('vistaSocioRetirado','PartnerController@listaSociosRetirados')->name('vistaSocioRetirado');

//Ruta directivos
Route::get('vistaExecutive','PartnerController@vistaDirectivo')->name('vistaDirectivo');

//Rutas de socio fallecido
Route::post('socioFallecido','PartnerDeceasedController@guardar')->name('socio.fallecido');
Route::get('listadoFallecidos','PartnerDeceasedController@index')->name('lista.fallecidos');

//Rutas de beneficiario
Route::get('beneficiariesIndex','BeneficiaryController@index')->name('beneficiaries.index');
Route::get('beneficiaries{partner}','BeneficiaryController@form')->name('beneficiaries.form');
Route::post('beneficiaries','BeneficiaryController@create')->name('beneficiaries.create');
Route::delete('beneficiariesIndex{id}','BeneficiaryController@destroy')->name('beneficiary.destroy');
Route::get('BeneficiariesActualizar{beneficiary}/{partnerId}','BeneficiaryController@edit')->name('beneficiaries.edit');
Route::post('beneficiariesActualizar{id}','BeneficiaryController@update')->name('beneficiaries.update');
Route::get('beneficiaries','BeneficiaryController@list')->name('beneficiaries.list');


//Rutas de pagos
//Route::get('/payment','PaymentController@Index')->name('payment.index');
//Route::post('payment','PaymentController@create')->name('payment.create');
Route::get('/buscador','PaymentController@buscador')->name('buscador.payment');
Route::get('/boleta','PaymentController@boleta')->name('boleta.payment');
Route::get('/reportePagos{id}','PaymentController@reportePagos')->name('reportePagos');
Route::get('/paymentNuevo','PaymentController@nuevoIndex')->name('payment.indexNuevo');
Route::get('/datosSocio{dni}','PaymentController@datosSocio')->name('datosSocio');
Route::post('/paymentguardar','PaymentController@guardar')->name('pagosguardar');


//Rutas de productos (ELIO)
Route::resource('products','ProductController');
//Route::get('productsNew','ProductController@ViewCreate')->name('products.create');
//Route::post('productsNew','ProductController@create')->name('products.form');
Route::get('productsUpdate{id}','ProductController@edit')->name('products.updateForm');
//Route::post('productsUpdate{id}','ProductController@update')->name('product.update');
Route::get('productList','ProductController@productList')->name('product.list');
Route::get('productsBuys','ProductController@select')->name('products.buysForm');
Route::post('ProductsBuys','ProductController@create_buys')->name('product.updateStock');
//Route::post('productActualizar{id}','ProductController@update')->name('actualizar.product');
//Laura
Route::post('actualizarProducts{id}','ProductController@actualizar')->name('actualizarprod');
Route::post('productGuardar','ProductController@create')->name('products.create');
//Checks de actualizar producto (categoria)
Route::get('atributosCheck{id}','ProductController@checkAtributos')->name('atributosCheck');


//Rutas de opciones de productos (ELIO)
Route::resource('option_products','OptionProductController');
Route::get('option_productsUpdate{id}','OptionProductController@edit')->name('option_products.updateForm');
//Route::post('productsUpdate{id}','ProductController@update')->name('product.update');
Route::delete('option_productsEliminar{sku}','OptionProductController@destroy')->name('option_products.destroy');
Route::get('option_productList','OptionProductController@productList')->name('option_product.list');
Route::get('option_productsBuys','OptionProductController@select')->name('option_products.buysForm');
Route::post('OptionProductsBuys','OptionProductController@create_buys')->name('option_product.updateStock');
Route::post('option_productActualizar{sku}','OptionProductController@actualizar')->name('actualizar.option_product');
Route::post('option_productGuardar','OptionProductController@create')->name('option_products.create');
Route::get('accederDatosProduct{id}', 'OptionProductController@acceder')->name('accederDatosProduct');
Route::get('camposact{sku}', 'OptionProductController@camposActualizar')->name('camposact');
Route::get('sku', 'OptionProductController@inputSku')->name('sku');
//buys
Route::post('buys_productCancel{id}','OptionProductController@cancel')->name('buys_product.anular');
Route::get('buys_productList','OptionProductController@buysproductList')->name('buys_product.list');


//Rutas de servicios (ELIO)
Route::resource('services','ServiceController');
Route::get('servicesUpdate{id}','ServiceController@edit')->name('services.updateForm');
Route::get('serviceList','ServiceController@serviceList')->name('service.list');
Route::post('serviceActualizar{id}','ServiceController@update')->name('actualizar.service');
Route::post('serviceGuardar','ServiceController@create')->name('services.create');

//Rutas de opciones de servicios (ELIO)
Route::resource('option_services','OptionServiceController');
Route::get('option_servicesUpdate{id}','OptionServiceController@edit')->name('option_services.updateForm');
Route::get('option_serviceList','OptionServiceController@serviceList')->name('option_service.list');
//Route::get('option_servicesBuys','OptionServiceController@select')->name('option_services.buysForm');
Route::post('option_servicesBuys','OptionServiceController@create_buys')->name('option_service.updateStock');
Route::post('option_serviceActualizar{id}','OptionServiceController@update')->name('actualizar.option_service');
Route::post('option_serviceGuardar','OptionServiceController@create')->name('option_services.create');
Route::get('accederDatosService{id}', 'OptionServiceController@acceder')->name('accederDatosService');
//buys
Route::post('buys_serviceCancel{id}','OptionServiceController@cancel')->name('buys_service.anular');
Route::get('buys_serviceList','OptionServiceController@buysserviceList')->name('buys_service.list');


//Rutas de proveedores (ELIO)
Route::resource('providers','ProviderController');
Route::get('providersUpdate{id}','ProviderController@edit')->name('providers.updateForm');
Route::get('providerList','ProviderController@providerList')->name('provider.list');
Route::post('providerActualizar{id}','ProviderController@update')->name('actualizar.provider');
Route::post('providerGuardar','ProviderController@create')->name('providers.create');


//Rutas Entrega de Beneficio
//Route::resource('benefitDelivery','BenefitDeliveryController');
Route::get('entrega','BenefitDeliveryController@entrega')->name('entrega');
Route::get('busadorEntrega','BenefitDeliveryController@buscadorEntrega')->name('buscadorEntrega');
Route::get('llenarDatosEntrega{carne}','BenefitDeliveryController@llenarDatosEntrega')->name('llenarDatosEntrega');
Route::get('serviciosProductos','BenefitDeliveryController@serviciosProd')->name('serviciosProd');

Route::post('guardarEntrega','BenefitDeliveryController@guardarEntrega')->name('guardarEntrega');







Route::get('prueba','PartnerController@prueba')->name('prueba');

Auth::routes();



//Route::get('/home', 'HomeController@index')->name('home');


//Verificando que se subio a github