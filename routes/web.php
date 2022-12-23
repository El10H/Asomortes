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

use App\Http\Controllers\reportesController;

Route::get('/', function () {
    return view('home');
});


//Rutas de reportes
Route::Resource('reportes','reportesController')->only(['index']);
Route::get('filtrarMes','reportesController@filtrarMes')->name('filtrarMes');
Route::get('filtrarFecha','reportesController@filtrarFecha')->name('filtrarFecha');
Route::get('detallesFechasProductos','reportesController@detallesFechasProductos')->name('detallesFechasProductos');
Route::get('detallesFechasServicios','reportesController@detallesFechasServicios')->name('detallesFechasServicios');
Route::get('detallesMesAñoProductos','reportesController@detallesMesAñoProductos')->name('detallesMesAñoProductos');
Route::get('detallesMesAñoServicios','reportesController@detallesMesAñoServicios')->name('detallesMesAñoServicios');
Route::get('detalleFechaPagos','reportesController@detalleFechaPagos')->name('detalleFechaPagos');
Route::get('detallesMesAñoPagos','reportesController@detallesMesAñoPagos')->name('detallesMesAñoPagos');

//Rutas de socio
Route::Resource('partners','PartnerController')->only(['index', 'destroy', 'store', 'edit', 'update']);
Route::get('partnerFile{id}','PartnerController@pdf_resumen')->name('partners.pdf_resumen');
Route::get('partnerList','PartnerController@pdf')->name('partners.pdf');
Route::post('/directivosocio','PartnerController@cargoDirectivo')->middleware('can:asignar.directivo')->name('asignar.directivo');
//Route::get('vistaExecutive','PartnerController@vistaDirectivo')->middleware('can:vistaDirectivo')->name('vistaDirectivo');
Route::get('updateExecutive{id}','PartnerController@quitarCargo')->middleware('can:asignar.directivo')->name('quitarCargo');

Route::get('resumenPartner','PartnerController@resumenSocio')->name('resumenSocio');
Route::get('resumenDatos{nombre}','PartnerController@resumenDatos')->middleware('can:resumenSocio')->name('resumenDatos');
//Route::get('partners','PartnerController@index')->name('partners.index');
//Route::get('partnersNew','PartnerController@ViewCreate')->name('partners.create');
//Route::post('partnersNew','PartnerController@create')->name('partners.form');
//Route::delete('partners{partner}','PartnerController@destroy')->name('partners.destroy');
//Route::get('partnersUpdate{id}','PartnerController@edit')->name('partners.updateForm');
//Route::post('partnersUpdate{id}','PartnerController@update')->name('partner.update');
//Route::post('/directivosocio','PartnerController@cargoDirectivo')->name('asignar.directivo');
//Route::get('vistaExecutive','PartnerController@vistaDirectivo')->name('vistaDirectivo');

Route::get('deuda11','PartnerController@deuda11')->name('deuda11');
Route::get('deuda12','PartnerController@deuda12')->name('deuda12');
Route::get('deuda2','PartnerController@deuda2')->name('deuda2');
Route::get('socioRetirado{id}','PartnerController@socioRetirado')->name('socioRetirado');
Route::get('vistaSocioRetirado','PartnerController@listaSociosRetirados')->name('vistaSocioRetirado');
Route::get('vistaSocioSancionado','PartnerController@listaSociosSancionados')->name('vistaSociosSancionados');
Route::get('socioSancionadoPdf','PartnerController@listaSociosSancionados_Pdf')->name('listaSociosSancionados_Pdf');

//Ruta de panel administrativo
Route::get('panel','panelController@index')->middleware('can:panel')->name('panel');

//Ruta directivos
Route::get('vistaExecutive','PartnerController@vistaDirectivo')->middleware('can:vistaDirectivo')->name('vistaDirectivo');
Route::get('vistaExecutivePdf','PartnerController@directivosPdf')->name('directivosPdf');


//Rutas de socio fallecido
Route::Resource('socioFallecidos','PartnerDeceasedController')->only(['index', 'store']);
Route::get('sociosFallecidosPdf','PartnerDeceasedController@pdf')->middleware('can:sociosFallecidos_pdf')->name('sociosFallecidos_pdf');


//Rutas de beneficiario
Route::Resource('beneficiaries','BeneficiaryController')->only(['index','store','destroy','update']);
Route::get('beneficiariesFormulario{partner}','BeneficiaryController@formulario')->name('beneficiaries.formulario'); //este es el form de crear
Route::get('BeneficiariesActualizar{beneficiary}/{partnerId}','BeneficiaryController@edit')->name('beneficiaries.edit');
Route::get('beneficiariesPdf','BeneficiaryController@list')->name('beneficiaries.list');


//Rutas de pagos
Route::Resource('payments','PaymentController')->only(['index','store']);
Route::get('/buscador','PaymentController@buscador')->middleware('can:payment')->name('buscador.payment');
Route::get('/boleta','PaymentController@boleta')->middleware('can:payment')->name('boleta.payment');
Route::get('/reportePagos{id}','PaymentController@reportePagos')->middleware('can:payment')->name('reportePagos');
//Route::get('/paymentNuevo','PaymentController@nuevoIndex')->middleware('can:payment.indexNuevo')->name('payment.indexNuevo');
Route::get('/datosSocio{dni}','PaymentController@datosSocio')->middleware('can:listaPagos')->name('datosSocio');
Route::get('/listaPayment','PaymentController@listaPagos')->middleware('can:listaPagos')->name('listaPagos');
Route::get('/detallePagos{id}','PaymentController@detallePagos')->middleware('can:listaPagos')->name('detallePagos');


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
Route::get('vercompras_productos','OptionProductController@viewBuysProducts')->name('vercompras_productos');


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
Route::get('vercompras_servicios','OptionServiceController@viewBuysServices')->name('vercompras_servicios');


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
Route::get('entregaPdf','BenefitDeliveryController@pdf')->middleware('can:entrega')->name('entrega.pdf');
Route::get('verEntregas','BenefitDeliveryController@verEntregas')->name('verEntregas'); //partnerFile{id}

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