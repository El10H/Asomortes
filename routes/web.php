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
Route::Resource('partners','PartnerController')->only(['index', 'destroy', 'store', 'edit', 'update']);
//Route::get('partners','PartnerController@index')->name('partners.index');
//Route::get('partnersNew','PartnerController@ViewCreate')->name('partners.create');
//Route::post('partnersNew','PartnerController@create')->name('partners.form');
//Route::delete('partners{partner}','PartnerController@destroy')->name('partners.destroy');
//Route::get('partnersUpdate{id}','PartnerController@edit')->name('partners.updateForm');
//Route::post('partnersUpdate{id}','PartnerController@update')->name('partner.update');
Route::get('partnerFile{id}','PartnerController@pdf_resumen')->name('partners.pdf_resumen');
Route::get('partnerList','PartnerController@pdf')->name('partners.pdf');
//Route::post('/directivosocio','PartnerController@cargoDirectivo')->name('asignar.directivo');
//Route::get('vistaExecutive','PartnerController@vistaDirectivo')->name('vistaDirectivo');
Route::post('/directivosocio','PartnerController@cargoDirectivo')->name('asignar.directivo');
Route::get('vistaExecutive','PartnerController@vistaDirectivo')->name('vistaDirectivo');
Route::get('updateExecutive{id}','PartnerController@quitarCargo')->name('quitarCargo');

Route::get('resumenPartner','PartnerController@resumenSocio')->name('resumenSocio');
Route::get('resumenDatos{nombre}','PartnerController@resumenDatos')->name('resumenDatos');

Route::get('deuda11','PartnerController@deuda11')->name('deuda11');
Route::get('deuda12','PartnerController@deuda12')->name('deuda12');
Route::get('deuda2','PartnerController@deuda2')->name('deuda2');
Route::get('socioRetirado{id}','PartnerController@socioRetirado')->name('socioRetirado');
Route::get('vistaSocioRetirado','PartnerController@listaSociosRetirados')->name('vistaSocioRetirado');

//Ruta de panel administrativo
Route::get('panel','panelController@index')->name('panel');
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
Route::get('/paymentNuevo','PaymentController@nuevoIndex')->middleware('can:payment.indexNuevo')->name('payment.indexNuevo');
Route::get('/datosSocio{dni}','PaymentController@datosSocio')->name('datosSocio');
Route::post('/paymentguardar','PaymentController@guardar')->name('pagosguardar');
Route::get('/listaPayment','PaymentController@listaPagos')->name('listaPagos');
Route::get('/detallePagos{id}','PaymentController@detallePagos')->name('detallePagos');

//Rutas de productos (ELIO)
Route::Resource('products','ProductController')->only(['index', 'destroy', 'store', 'update']); //index, destroy. store, update
Route::get('productPdf','ProductController@pdf')->name('products.pdf');
//Checks de actualizar producto (categoria)
Route::get('atributosCheck{id}','ProductController@checkAtributos')->name('atributosCheck');
//Route::get('productsBuys','ProductController@select')->name('products.buysForm');
//Route::post('ProductsBuys','ProductController@create_buys')->middleware('can:product.updateStock')->name('product.updateStock');
//Laura
//Route::post('actualizarProducts{id}','ProductController@update')->name('actualizarprod');
//Route::post('productGuardar','ProductController@create')->name('products.create');
//Route::get('productsNew','ProductController@ViewCreate')->name('products.create');
//Route::post('productsNew','ProductController@create')->name('products.form');
//Route::get('/productsUpdate{id}','ProductController@edit')->name('products.updateForm');
//Route::post('productsUpdate{id}','ProductController@update')->name('product.update');
//Route::post('productActualizar{id}','ProductController@update')->name('actualizar.product');


//Rutas de opciones de productos (ELIO)
Route::resource('option_products','OptionProductController');
Route::get('option_productList','OptionProductController@pdf')->name('option_products.pdf');
Route::get('option_productsBuys','OptionProductController@select')->name('option_products.buysForm');
Route::post('OptionProductsBuys','OptionProductController@create_buys')->middleware('can:option_products.create_buys')->name('option_products.create_buys');
Route::get('accederDatosProduct{id}', 'OptionProductController@acceder')->name('accederDatosProduct');
Route::get('camposact{sku}', 'OptionProductController@camposActualizar')->name('camposact');
Route::get('sku', 'OptionProductController@inputSku')->name('sku');
//Route::post('option_productActualizar{sku}','OptionProductController@actualizar')->name('actualizar.option_product');
//Route::get('option_productsUpdate{id}','OptionProductController@edit')->name('option_products.updateForm');
//Route::post('productsUpdate{id}','ProductController@update')->name('product.update');
//Route::delete('option_productsEliminar{sku}','OptionProductController@destroy')->name('option_products.destroy');
//Route::post('option_productGuardar','OptionProductController@create')->name('option_products.create');
//buys
Route::post('buys_productCancel{id}','OptionProductController@cancel')->middleware('can:buys_products.anular')->name('buys_products.anular');
Route::get('buys_productList','OptionProductController@buysproductPdf')->name('buys_products.pdf');


//Rutas de servicios (ELIO)
Route::resource('services','ServiceController')->only(['index', 'destroy', 'store', 'update']); //index, destroy. store, update
Route::get('servicePdf','ServiceController@pdf')->name('services.pdf');
//Route::get('servicesUpdate{id}','ServiceController@edit')->name('services.updateForm');
//Route::post('serviceActualizar{id}','ServiceController@update')->name('actualizar.service');
//Route::post('serviceGuardar','ServiceController@create')->name('services.create');

//Rutas de opciones de servicios (ELIO)
Route::resource('option_services','OptionServiceController')->only(['index', 'destroy', 'store', 'update']);
Route::get('option_servicePdf','OptionServiceController@pdf')->name('option_services.pdf');
Route::post('option_servicesBuys','OptionServiceController@create_buys')->middleware('can:option_services.create_buys')->name('option_services.create_buys');
Route::get('accederDatosService{id}', 'OptionServiceController@acceder')->name('accederDatosService');
//Route::get('option_servicesUpdate{id}','OptionServiceController@edit')->name('option_services.updateForm'); ****
//Route::get('option_servicesBuys','OptionServiceController@select')->name('option_services.buysForm');
//Route::post('option_serviceActualizar{id}','OptionServiceController@update')->name('actualizar.option_service'); ****
//Route::post('option_serviceGuardar','OptionServiceController@create')->name('option_services.create'); ****
//buys_services
Route::post('buys_serviceCancel{id}','OptionServiceController@cancel')->middleware('can:buys_services.anular')->name('buys_services.anular');
Route::get('buys_serviceList','OptionServiceController@buysservicePdf')->name('buys_services.pdf');
Route::post('receptionDelivery','OptionServiceController@receptionDelivery')->middleware('can:recepcionEntrega')->name('recepcionEntrega');


//Rutas de proveedores (ELIO)
Route::resource('providers','ProviderController')->only(['index', 'destroy', 'store', 'update']);
Route::get('providerPdf','ProviderController@pdf')->name('providers.pdf');
//Route::get('providersUpdate{id}','ProviderController@edit')->name('providers.updateForm');
//Route::post('providerActualizar{id}','ProviderController@update')->name('actualizar.provider');
//Route::post('providerGuardar','ProviderController@create')->name('providers.create');


//Rutas Entrega de Beneficio
//Route::resource('benefitDelivery','BenefitDeliveryController');
Route::get('entrega','BenefitDeliveryController@entrega')->middleware('can:entrega')->name('entrega');
Route::get('busadorEntrega','BenefitDeliveryController@buscadorEntrega')->middleware('can:entrega')->name('buscadorEntrega');
Route::get('llenarDatosEntrega{carne}','BenefitDeliveryController@llenarDatosEntrega')->middleware('can:entrega')->name('llenarDatosEntrega');
Route::get('serviciosProductos','BenefitDeliveryController@serviciosProd')->middleware('can:entrega')->name('serviciosProd');
Route::post('guardarEntrega','BenefitDeliveryController@guardarEntrega')->middleware('can:entrega')->name('guardarEntrega');

//Rutas de datosConfig
Route::get('datosConfig','datosConfigController@index')->name('datosConfig');
Route::post('datosConfigUpdate','datosConfigController@update')->name('datosConfigUpdate');

//Rutas de user (ELIO)
Route::resource('users', 'UserController')->only(['index', 'destroy', 'store', 'update']);//->name('admin.users');
//Route::post('userGuardar','UserController@create')->name('users.create');
//Route::post('userActualizar{id}','UserController@update')->name('actualizar.user');


//Rutas de roles (ELIO)
Route::resource('roles', 'RoleController')->only(['index', 'destroy', 'store', 'update']);





Route::get('prueba','PartnerController@prueba')->name('prueba');

Auth::routes();



Route::get('/', 'HomeController@index')->name('home');


//Verificando que se subio a github
//cambio ++