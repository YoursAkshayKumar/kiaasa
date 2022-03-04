<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// WEBSITE
$route['default_controller'] = 'backend/Auth/login';


/************************************************************/




//admin api
$route['v1/createbrand'] = 'api/backend/brand/createbrand';
$route['v1/updatebrand/(:any)'] = 'api/backend/brand/updatebrand/$1';
$route['v1/delete-image'] = 'backend/media/deleteimage';

// LOGIN

$route['v1/userlogin'] = 'api/app/Auth/auth/userLogin';
$route['v1/stafflogin'] = 'api/app/Auth/auth/staffLogin';
$route['v1/customerlogin'] = 'api/app/Auth/auth/customerLogin';
$route['v1/customerregistration'] = 'api/app/Auth/auth/customerRegistration';

// ROLE & PERMISSION
$route['v1/getrole'] = 'api/app/Admin/role/getRole';
$route['v1/getuserpermission'] = 'api/app/Admin/role/getUserPermission';

// PAYMENT MODE
$route['v1/getpaymentmode'] = 'api/app/Admin/paymentmode/getPaymentMode';

// DELIVERY MODE
$route['v1/getdeliverymode'] = 'api/app/Admin/deliverymode/getDeliveryMode';

// MEDIA
$route['v1/getmedia'] = 'api/app/Admin/media/getAllImage';

// STATE
$route['v1/getstate'] = 'api/app/Admin/state/getState';

// GST REG. TYPE
$route['v1/getgstregtype'] = 'api/app/Admin/gstregtype/getGstRegType';

// UNIT
$route['v1/getunit'] = 'api/app/Admin/unit/getUnit';

// CATEGORY
// $route['v1/addcategory'] = 'api/app/Admin/category/addCategory';
// $route['v1/editcategory'] = 'api/app/Admin/category/editCategory';
$route['v1/getcategory'] = 'api/app/Admin/category/getCategory';
// $route['v1/deletecategory'] = 'api/app/Admin/category/deleteCategory';

// PRODUCT
$route['v1/addproduct'] = 'api/app/Admin/product/addProduct';
$route['v1/editproduct'] = 'api/app/Admin/product/editProduct';
$route['v1/getproduct'] = 'api/app/Admin/product/getProduct';
$route['v1/deleteproduct'] = 'api/app/Admin/product/deleteProduct';

// P New
// $route['v1/gproduct'] = 'api/app/Admin/product/getProduct';


// STORE
$route['v1/getstore'] = 'api/app/Admin/store/getStore';


// STATE
$route['v1/getstate'] = 'api/app/Admin/state/getState';


// ORDER
$route['v1/getorder'] = 'api/app/Admin/order/getOrder';

//USER
$route['v1/users'] = 'auth/auth/users';
$route['v1/userregistration'] = 'auth/auth/userRegistration';
$route['v1/getuser'] = 'auth/auth/getUser';







$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
