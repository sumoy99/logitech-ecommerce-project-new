<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CustomerSupportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Updater;
use App\Models\CartItem;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;



// Clear application cache:
Route::get('clear-cache', function() {
    Artisan::call('cache:clear');

    //Artisan::call('route:cache');

    Artisan::call('config:clear');

    Artisan::call('view:clear');

    Artisan::call('optimize:clear');

    return 'Cache cleard';
})->name('clear.cache');





Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


// Frontend Route
Route::controller(FrontendController::class)->group (function() {

    // Frontend
    Route::get('/',  'frontendView')->name('frontend.index');

    // New
    Route::get('/category/{category_slug}/{id}',  'category_products_view')->name('frontend.category_products');
    Route::get('/product/quick-view/{id}', 'quickView')->name('partials.quick-view-modal');
    Route::get('/product/{product_slug}/{id}',  'product_details_view')->name('frontend.product_details');
    Route::get('/search-product', 'searchProduct')->name('frontend.search-products');
    Route::get('/ajax-search', 'ajaxSearch')->name('frontend.ajax-search');
    
    Route::get('/get-cities/{region}', 'getCities')->name('frontend.getCities');
    Route::get('/get-areas/{city}', 'getAreas')->name('frontend.getAreas');

    // Developer
    Route::get('/developer',  'developerView')->name('frontend.developer.index');

});


Route::controller(CustomerSupportController::class)->middleware('auth', 'customer')->group (function() {
    //Support
    Route::get('/support',  'supportViewClient')->name('frontend.customer.support.index');
    Route::get('/create-ticket',  'createTicket')->name('frontend.customer.support.ticket_create');
    Route::POST('/ticket-submit',  'ticketSubmit')->name('frontend.customer.support.ticketSubmit');
    Route::get('/support-chat/{id}',  'showSupportChat')->name('frontend.customer.support.support_chat');
    Route::post('/send-support-message/{id}',  'sendSupportMessage')->name('frontend.customer.support.send');
    Route::get('/support-chat/fetch/{id}', 'fetchChats')->name('frontend.customer.support.chat_fetch');


});

Route::controller(CustomerSupportController::class)->middleware('auth', 'superAdmin')->group (function() {

    Route::get('/superadmin-support',  'supportViewSuperadmin')->name('superadmin.customer_support.index');
    Route::get('/superadmin-support-chat/{id}',  'showChat')->name('superadmin.customer_support.support_chat');
    Route::post('/superadmin-send-support-message/{id}',  'sendChat')->name('superadmin.customer_support.send');
    Route::post('/validate-purchase-code',  'validatePurchaseCode')->name('validate.purchase.code');
    Route::get('/admin/support-chat/fetch/{id}', 'adminFetchChats')->name('superadmin.customer_support.chat_fetch');

});

// Customer Controller
Route::controller(CustomerController::class)->middleware('auth', 'customer')->group (function() {

    // Add to cart
    Route::POST('/cart/add', 'addToCart')->name('frontend.customer.addTocart');
    Route::get('/cart/modal', 'loadCartModal')->name('frontend.loadCartModal');
    Route::get('/cart/count', 'cartCount')->name('frontend.customer.cartCount');
    Route::get('/shopping-cart', 'shoppingCart')->name('frontend.customer.shopping_cart');
    Route::get('/cart-product-remove/{id}', 'CartPrdRmv')->name('frontend.customer.CartPrdRmv');
    Route::get('/buy-now', 'buyNow')->name('frontend.customer.buyNow');
    Route::post('/check-out', 'checkOutView')->name('frontend.customer.check_out');
    Route::post('/order-place', 'orderPlace')->name('frontend.order.place');
    // Route::post('/cart/update-quantity', 'updateCartQuantity')->name('frontend.customer.updateCartQty');







    Route::get('user/dashboard', 'customerDashboard')->name('frontend.customer.customer_dashboard')->middleware('role_id');
    Route::get('/user/dashboard/profile',  'customerProfile')->name('frontend.customer.customerProfile');
    Route::post('/user/dashboard/profileUpdate',  'customerProfileUpdate')->name('frontend.customer.customerProfileUpdate');
    Route::post('/add_cart',  'add_cart')->name('frontend.customer.add_cart');
    Route::post('/remove_cart',  'remove_cart')->name('frontend.customer.remove_cart');
    Route::POST('/check-out-remove-cart',  'check_out_remove_cart')->name('frontend.customer.check_out_remove_cart');
    //Route::post('/check_cart_status',  'check_cart_status')->name('frontend.customer.check_cart_status');
    Route::get('/check-out/{id}',  'check_outView')->name('frontend.customer.checkout');
    Route::get('/payment',  'paymentView')->name('frontend.customer.payment_page');
    Route::post('/set-checkout-session',  'setCheckoutSession')->name('frontend.customer.set_checkout_session');
    Route::post('/complete-order',  'complete_order')->name('frontend.customer.complete_order');
    Route::get('/checkout-success',  'checkout_success')->name('frontend.customer.checkout_success');

    Route::get('/download/{id}', 'download')->name('download.product');

    Route::get('/purchase-history',  'purchaseHistory')->name('frontend.customer.purchase_history');
    Route::post('/comments/{id}',  'commentSubmit')->name('frontend.customer.commentSubmit');
    Route::post('/comments/reply/{id}',  'userCommentReply')->name('frontend.customer.commentReply');

    //Review
    Route::get('/review/{id}',  'reviewForm')->name('frontend.customer.reviewform');
    Route::post('/submit-review/{id}',  'submitReview')->name('frontend.customer.submitReview');

    // Cart
    Route::get('/cart',  'cartView')->name('frontend.customer.cart');
    Route::get('/cart/items/ajax', function () {
        $cartItems = \App\Models\CartItem::where('user_id', auth()->id())->with('item')->latest()->get();
        $html = '';
    
        foreach ($cartItems as $cartItem) {
            if (!$cartItem->item) continue; // Skip if item is missing
        
            $html .= '<li class="notification-item d-flex mb-3 bg-light">
                        <img src="'.asset('public/assets/upload/project/'.$cartItem->item->item_thumbnail).'" width="40" height="40" class="me-2 rounded border">
                        <div>
                          <strong>'.$cartItem->item->item_title.'</strong><br>
                          <small style="color:#666;">'.($cartItem->item->subtitle ?? 'No subtitle').'</small><br>
                          <span class="text-primary">'.currency($cartItem->item->price).'</span>
                        </div>

                      </li>';
        }
        
    
        if ($cartItems->count() == 0) {
            $html = '<li class="text-muted">'.get_phrase('No items in cart.').'</li>';
        }
    
        return response()->json([
            'count' => $cartItems->count(),
            'html' => $html
        ]);
    })->name('cart.items.ajax');
    

    
    Route::get('/download-history',  'downloadHistory')->name('frontend.customer.download_history');
    Route::get('/referral',  'referralView')->name('frontend.customer.referral');
    Route::post('/apply-coupon',  'apply_coupon')->name('frontend.customer.apply_coupon');
    Route::post('/full-order-summary',  'full_order_summary')->name('frontend.customer.full_order_summary');

    // Referral-earnings
    Route::post('/referral-withdraw-request',  'requestReferralWithdraw')->name('frontend.customer.referralWithdrawRequest');

    // Inovoice
    Route::get('/invoice/{id}',  'invoiceView')->name('frontend.customer.invoice');
    Route::get('/pdf-download/{type}/{id}','pdfDownload')->name('universal.pdf_download');

    Route::get('/all-notifications',  'notificationsView')->name('frontend.customer.notification');

    Route::get('/my-account',  'myAccount')->name('frontend.customer.my_account');
    Route::get('/my-orders',  'myOrder')->name('frontend.customer.my_order');
    Route::get('/order-item/{id}',  'orderItem')->name('frontend.customer.order_item');
   
    Route::get('/wish-list',  'wishList')->name('frontend.customer.wishlist');
    Route::get('/wish-list-store/{id}',  'wishListStore')->name('frontend.customer.wishListStore');
    Route::get('/wish-list-remove/{id}',  'wishListRemove')->name('frontend.customer.wishListRemove');


});


// backend Route

Route::controller(ProductController::class)->middleware('auth','superAdmin')->group (function() {

    //Products
    Route::get('/superadmin/products/all-product',  'all_products')->name('superadmin.products.index');


    // Product create
    Route::get('/superadmin/products/create',  'createProducts')->name('superadmin.products.create');
    Route::post('/superadmin/products/store',  'storeProducts')->name('superadmin.products.store');
    // Removed {slug} from the route as it is not required for lookup or SEO. If needed, add documentation in the controller.
    Route::get('/superadmin/products/edit/{id}',  'editProducts')->name('superadmin.products.edit');
    Route::post('/superadmin/products/update/{id}',  'updateProducts')->name('superadmin.products.update');
    Route::get('/superadmin/products/delete/{id}',  'deleteProducts')->name('superadmin.products.delete');
    Route::post('/superadmin/products/remove-color-image', 'removeColorImage')->name( 'superadmin.removeColorImage');
    Route::post('/products/bulk-delete', 'productbulkDelete')->name('superadmin.products.bulk-delete');





    // Attribute
    Route::get('/superadmin/attributes',  'attributeView')->name('superadmin.attributes.all_attributes');

    Route::get('/superadmin/attributes-create',  'attributeCreate')->name('superadmin.attributes.attributes_create');

    Route::post('/superadmin/attributes-store',  'attributeStore')->name('superadmin.attributes.attributes_store');

    Route::get('/superadmin/attributes-edit/{id}',  'attributeEdit')->name('superadmin.attributes.attributes_edit');

    Route::post('/superadmin/attributes-update/{id}',  'attributeUpdate')->name('superadmin.attributes.attributes_update');

    Route::get('/superadmin/attributes-delete/{id}',  'attributeDelete')->name('superadmin.attributes.attributes_delete');

    // Attribute value
    Route::get('/superadmin/attributes/attribute-value-create/{id}',  'attributeValueCreate')->name('superadmin.attributes.attribute_value_create');

    Route::post('/superadmin/attributes/attribute-value-store',  'attributeValueStore')->name('superadmin.attributes.attributeValueStore');

    Route::post('/superadmin/attributes/attribute-value-update/{id}',  'attributeValueUpdate')->name('superadmin.attributes.attributeValueUpdate');

    Route::get('/superadmin/attributes/attribute-value-delete/{id}',  'attributeValueDelete')->name('superadmin.attributes.attributeValueDelete');

    // Colors
    Route::get('/superadmin/color',  'colorIndexView')->name('superadmin.color.index');

    Route::get('/superadmin/color/add',  'colorAdd')->name('superadmin.color.add');

    Route::post('/superadmin/color/store',  'colorStore')->name('superadmin.color.store');
    
    Route::get('/superadmin/color/edit/{id}',  'colorEdit')->name('superadmin.color.edit');

    Route::post('/superadmin/color/update/{id}',  'colorUpdate')->name('superadmin.color.update');

    Route::get('/superadmin/color/delete/{id}',  'colorDelete')->name('superadmin.color.delete');


    // Brands
    Route::get('/superadmin/brands',  'brandsIndexView')->name('superadmin.brands.index');

    Route::get('/superadmin/brands/add',  'brandsAdd')->name('superadmin.brands.add');

    Route::post('/superadmin/brands/store',  'brandsStore')->name('superadmin.brands.store');
    
    Route::get('/superadmin/brands/edit/{id}',  'brandsEdit')->name('superadmin.brands.edit');

    Route::post('/superadmin/brands/update/{id}',  'brandsUpdate')->name('superadmin.brands.update');

    Route::get('/superadmin/brands/delete/{id}',  'brandsDelete')->name('superadmin.brands.delete');

    // Warranty
    Route::get('/superadmin/warranty',  'warrantyIndexView')->name('superadmin.warranty.index');

    Route::get('/superadmin/warranty/add',  'warrantyAdd')->name('superadmin.warranty.create');

    Route::post('/superadmin/warranty/store',  'warrantyStore')->name('superadmin.warranty.store');
    
    Route::get('/superadmin/warranty/edit/{id}',  'warrantyEdit')->name('superadmin.warranty.edit');

    Route::post('/superadmin/warranty/update/{id}',  'warrantyUpdate')->name('superadmin.warranty.update');

    Route::get('/superadmin/warranty/delete/{id}',  'warrantyDelete')->name('superadmin.warranty.delete');

    // Note Type
    Route::get('/superadmin/note/note-type',  'noteTypeView')->name('superadmin.notes.note_type.index');

    Route::get('/superadmin/note/note-type/add',  'noteTypeAdd')->name('superadmin.notes.note_type.create');

    Route::post('/superadmin/note/note-type/store',  'noteTypeStore')->name('superadmin.notes.note_type.store');
    
    Route::get('/superadmin/note/note-type/edit/{id}',  'noteTypeEdit')->name('superadmin.notes.note_type.edit');

    Route::post('/superadmin/note/note-type/update/{id}',  'noteTypeUpdate')->name('superadmin.notes.note_type.update');

    Route::get('/superadmin/note/note-type/delete/{id}',  'noteTypeDelete')->name('superadmin.notes.note_type.delete');

    // Notes
    Route::get('/superadmin/note/all-notes',  'noteView')->name('superadmin.notes.all_notes.index');

    Route::get('/superadmin/note/add',  'notesAdd')->name('superadmin.notes.all_notes.create');

    Route::post('/superadmin/note/store',  'notesStore')->name('superadmin.notes.all_notes.store');
    
    Route::get('/superadmin/note/edit/{id}',  'notesEdit')->name('superadmin.notes.all_notes.edit');

    Route::post('/superadmin/note/update/{id}',  'notesUpdate')->name('superadmin.notes.all_notes.update');

    Route::get('/superadmin/note/delete/{id}',  'notesDelete')->name('superadmin.notes.all_notes.delete');

});



Route::controller(SuperadminController::class)->middleware('auth','superAdmin')->group (function() {

    Route::get('/superadmin/dashboard', 'superadminDashboard')->name('superadmin.dashboard')->middleware('role_id');

    // Category
    Route::get('/superadmin/category/category-list',  'category_list')->name('superadmin.category.category_list');
    
    Route::get('/superadmin/category/category-create',  'category_create')->name('superadmin.category.create_category');

    Route::post('/superadmin/category/category-store',  'category_store')->name('superadmin.category.category_store');


    Route::get('/superadmin/category/sub-category-add/{id}',  'sub_category_add')->name('superadmin.category.sub_category_add');

    Route::post('/superadmin/category/sub-category-store',  'sub_category_store')->name('superadmin.category.sub_category_store');

    Route::get('/superadmin/category/sub-category-edit/{id}',  'sub_category_edit')->name('superadmin.category.sub_category_edit');

    Route::post('/superadmin/category/sub-category-update/{id}',  'sub_category_update')->name('superadmin.category.sub_category_update');

    Route::get('/superadmin/category/sub-category-delete/{id}',  'sub_category_delete')->name('superadmin.category.sub_category_delete');


    Route::get('/superadmin/category/category-edit/{id}',  'category_edit')->name('superadmin.category.edit_category');

    Route::post('/superadmin/category/category-update/{id}',  'category_update')->name('superadmin.category.category_update');

    Route::get('/superadmin/category/category-delete/{id}',  'category_delete')->name('superadmin.category.category_delete');
    // Category End


    // Order
    Route::get('/superadmin/orders/order-list',  'order_list')->name('superadmin.orders.index');
    Route::get('/superadmin/orders/bulk-order-status/{status}/{id}',  'bulk_order_status')->name('superadmin.orders.bulk-order-status');
    Route::get('/superadmin/orders/order-items/{id}',  'orderItemsList')->name('superadmin.orders.order_items');

    // Banner Promotional Image
    Route::get('/superadmin/banner-images',  'bannerImage')->name('superadmin.banner_image.index');
    Route::get('/superadmin/banner-image/create',  'bannerImageCreate')->name('superadmin.banner_image.create');
    Route::post('/superadmin/banner-image/store',  'bannerImageStore')->name('superadmin.banner_image.store');
    Route::get('/superadmin/banner-image/edit/{id}',  'bannerImageEdit')->name('superadmin.banner_image.edit');
    Route::post('/superadmin/banner-image/update/{id}',  'bannerImageUpdate')->name('superadmin.banner_image.update');
    Route::get('/superadmin/banner-image/delete/{id}',  'bannerImageDelete')->name('superadmin.banner_image.delete');

    // Marquee Promotional text
    Route::get('/superadmin/marquee/list',  'marqueeList')->name('superadmin.marquee.index');
    Route::get('/superadmin/marquee/create',  'marqueeCreate')->name('superadmin.marquee.create');
    Route::post('/superadmin/marquee/store',  'marqueeStore')->name('superadmin.marquee.store');
    Route::get('/superadmin/marquee/edit/{id}',  'marqueeEdit')->name('superadmin.marquee.edit');
    Route::post('/superadmin/marquee/update/{id}',  'marqueeUpdate')->name('superadmin.marquee.update');
    Route::get('/superadmin/marquee/delete/{id}',  'marqueeDelete')->name('superadmin.marquee.delete');

    // Company Logo
    Route::get('/superadmin/company-logo',  'companyLogoList')->name('superadmin.company_logo.index');
    Route::get('/superadmin/company-logo/create',  'companyLogoCreate')->name('superadmin.company_logo.create');
    Route::post('/superadmin/company-logo/store',  'companyLogoStore')->name('superadmin.company_logo.store');
    Route::get('/superadmin/company-logo/edit/{id}',  'companyLogoEdit')->name('superadmin.company_logo.edit');
    Route::post('/superadmin/company-logo/update/{id}',  'companyLogoUpdate')->name('superadmin.company_logo.update');
    Route::get('/superadmin/company-logo/delete/{id}',  'companyLogoDelete')->name('superadmin.company_logo.delete');


    




    //Team Members
    Route::get('/superadmin/team_member/our_team_member',  'our_team_memberView')->name('superadmin.team_member.our_team_member');

    Route::get('/superadmin/team_member/team_member_add',  'team_member_add')->name('superadmin.team_member.team_member_add');

    Route::post('/superadmin/team_member/team_member_store',  'team_member_store')->name('superadmin.team_member.team_member_store');

    Route::get('/superadmin/team_member/team_member_edit/{id}',  'team_member_edit')->name('superadmin.team_member.team_member_edit');

    Route::post('/superadmin/team_member/team_member_update/{id}',  'team_member_update')->name('superadmin.team_member.team_member_update');

    Route::get('/superadmin/team_member/team_member_delete/{id}',  'team_member_delete')->name('superadmin.team_member.team_member_delete');

    // Project
    // Project Category
    Route::get('/superadmin/project/project_category',  'project_categoryView')->name('superadmin.project.project_category');

    Route::post('/superadmin/project/project_category/store',  'project_categoryStore')->name('superadmin.project.project_category_store');

    Route::get('/superadmin/project/project_category_edit/{id}',  'project_categoryEdit')->name('superadmin.project.project_category_edit');

    Route::post('/superadmin/project/project_category_update/{id}',  'project_categoryUpdate')->name('superadmin.project.project_category_update');

    Route::get('/superadmin/project/project_category_delete/{id}',  'project_categoryDelete')->name('superadmin.project.project_categoryDelete');


    // All Project
    Route::get('/superadmin/project/all_project',  'all_projectView')->name('superadmin.project.all_project');

    Route::get('/superadmin/project/add_project',  'add_projectView')->name('superadmin.project.add_project');

    Route::post('/superadmin/project/project_store',  'project_store')->name('superadmin.project.project_store');

    Route::get('/superadmin/project/edit_project/{id}',  'edit_projectView')->name('superadmin.project.edit_project');

    Route::post('/superadmin/project/update_project/{id}',  'update_project')->name('superadmin.project.update_project');

    Route::get('/superadmin/project/delete_project/{id}',  'delete_project')->name('superadmin.project.delete_project');


    //Blogs
    //Blogs Category
    Route::get('/superadmin/blogs/blog_category',  'blog_categoryView')->name('superadmin.blogs.blog_category');

    Route::post('/superadmin/blogs/blog_category/store',  'blog_categoryStore')->name('superadmin.blogs.blog_category_store');

    Route::get('/superadmin/blogs/blog_category_edit/{id}',  'blog_categoryEdit')->name('superadmin.blogs.blog_category_edit');

    Route::post('/superadmin/blogs/blog_category_update/{id}',  'blog_categoryUpdate')->name('superadmin.blogs.blog_category_update');

    Route::get('/superadmin/blogs/blog_category_delete/{id}',  'blog_categoryDelete')->name('superadmin.blogs.blog_categoryDelete');


    // All Project
    Route::get('/superadmin/blogs/all_blog',  'all_blogView')->name('superadmin.blogs.all_blog');

    Route::get('/superadmin/blogs/add_blog',  'add_blogView')->name('superadmin.blogs.add_blog');

    Route::post('/superadmin/blogs/blog_store',  'blog_store')->name('superadmin.blogs.blog_store');

    Route::get('/superadmin/blogs/edit_blog/{id}',  'edit_blogView')->name('superadmin.blogs.edit_blog');

    Route::post('/superadmin/blogs/update_blog/{id}',  'update_blog')->name('superadmin.blogs.update_blog');

    Route::get('/superadmin/blogs/delete_blog/{id}',  'delete_blog')->name('superadmin.blogs.delete_blog');




    //About us page
    Route::get('/superadmin/about/about_settings',  'about_settingsView')->name('superadmin.about.about_settings');
    Route::post('/superadmin/about/about_update',  'about_update')->name('superadmin.about.about_update');
    Route::get('/superadmin/about/testimonials',  'testimonialsView')->name('superadmin.about.testimonials');
    Route::get('/superadmin/about/testimonial_create',  'testimonial_createView')->name('superadmin.about.testimonial_create');
    Route::post('/superadmin/about/testimonial_store',  'testimonial_store')->name('superadmin.about.testimonial_store');
    Route::get('/superadmin/about/testimonial_edit/{id}',  'testimonial_editView')->name('superadmin.about.testimonial_edit');
    Route::post('/superadmin/about/testimonial_update/{id}',  'testimonial_update')->name('superadmin.about.testimonial_update');
    Route::get('/superadmin/about/testimonial_delete/{id}',  'testimonial_delete')->name('superadmin.about.testimonial_delete');
    // Partner Logo
    Route::get('/superadmin/about/partners_logo',  'partners_logoView')->name('superadmin.about.partners_logo');
    Route::post('/superadmin/about/partners_logo_store',  'partners_logo_store')->name('superadmin.about.partners_logo_store');
    Route::get('/superadmin/about/partners_logo_delete/{id}',  'partners_logo_delete')->name('superadmin.about.partners_logo_delete');

    //Services Page
    Route::get('/superadmin/services/service_settings',  'service_settingsView')->name('superadmin.services.service_settings');
    Route::post('/superadmin/services/service_settings/update',  'service_settingsUpdate')->name('superadmin.services.service_settings.update');
    Route::get('/superadmin/services/service_list',  'service_listView')->name('superadmin.services.service_list');
    Route::get('/superadmin/services/service_add',  'service_addView')->name('superadmin.services.service_add');
    Route::post('/superadmin/services/service_store',  'service_store')->name('superadmin.services.service_store');
    Route::get('/superadmin/services/service_edit/{id}',  'service_editView')->name('superadmin.services.service_edit');
    Route::post('/superadmin/services/service_update/{id}',  'service_update')->name('superadmin.services.service_update');
    Route::get('/superadmin/services/delete/{id}',  'service_dlt')->name('superadmin.services.delete');

    // Agency progress
    Route::get('/superadmin/services/agency_progress',  'agency_progressView')->name('superadmin.services.agency_progress');
    Route::get('/superadmin/services/agency_progress_add',  'agency_progress_addView')->name('superadmin.services.agency_progress_add');
    Route::post('/superadmin/services/agency_progress_store',  'agency_progress_store')->name('superadmin.services.agency_progress_store');
    Route::get('/superadmin/services/agency_progress_edit/{id}',  'agency_progreseEdit')->name('superadmin.services.agency_progress_edit');
    Route::post('/superadmin/services/agency_progress_update/{id}',  'agency_progress_update')->name('superadmin.services.agency_progress_update');
    Route::get('/superadmin/services/agency_progress_delete/{id}',  'agency_progress_dlt')->name('superadmin.services.agency_progress_delete');

    // Package
    Route::get('/superadmin/package',  'packageView')->name('superadmin.package.package');
    Route::get('/superadmin/package/create',  'packageCreate')->name('superadmin.package.package_create');
    Route::post('/superadmin/package/add',  'packageAdd')->name('superadmin.package.add');
    Route::get('/superadmin/package/edit/{id}',  'packageEdit')->name('superadmin.package.package_edit');
    Route::post('/superadmin/package/update/{id}',  'packageUpdate')->name('superadmin.package.update');
    Route::get('/superadmin/package/delete/{id}',  'package_dlt')->name('superadmin.package.delete');
    

    // Contact Page
    Route::get('/superadmin/contact_us/all_message',  'all_messageView')->name('superadmin.contact_us.all_message');
    Route::get('/superadmin/contact_us/message/{id}',  'single_messageView')->name('superadmin.contact_us.message');
    Route::get('/superadmin/contact_us/message/reply/{id}',  'messageReply')->name('superadmin.contact_us.message.reply');
    Route::get('/superadmin/contact_us/message/delete/{id}',  'messageDlt')->name('superadmin.contact_us.message.delete');

    //System Setting
    Route::get('/superadmin/settings/system_settings',  'settingsView')->name('superadmin.settings.system_settings');
    Route::post('/superadmin/settings/system_settings/update',  'systemUpdate')->name('superadmin.settings.system_settings.update');

    //Payment Settings
    Route::get('/superadmin/settings/payment_settings',  'paymentView')->name('superadmin.settings.payment_settings');
    Route::post('superadmin/settings/payment_settings/update', 'update_payment_settings')->name('superadmin.settings.update_payment_settings');


    //Website Settings
    Route::get('/superadmin/settings/website_settings',  'website_settingsView')->name('superadmin.settings.website_settings');

    //Language settings routes
    Route::get('superadmin/settings/language/{language?}', 'manageLanguage')->name('superadmin.language.manage');
    Route::post('superadmin/settings/language/add', 'addLanguage')->name('superadmin.language.add');
    Route::any('superadmin/sett/language/{language?}', 'updatedPhrase')->name('superadmin.language.update_phrase');
    Route::get('superadmin/settings/language/delete/{name}', 'deleteLanguage')->name('superadmin.language.delete');
    Route::post('superadmin/language', 'user_language')->name('superadmin.language');

    //Smtp settings routes
    Route::get('superadmin/settings/smtp', 'smtpSettings')->name('superadmin.settings.smtp_settings');
    Route::post('superadmin/settings/smtp/update', 'smtpUpdate')->name('superadmin.settings.smtp.update');
    
    // SEO 
    Route::get('/superadmin/settings/seo',  'seoView')->name('superadmin.settings.seo');

    //About routes
    Route::get('superadmin/settings/about', 'about')->name('superadmin.settings.about');

    //Profile
    Route::get('/superadmin/profile/my_account',  'my_accountView')->name('superadmin.profile.my_account');
    Route::post('/superadmin/profile/update',  'my_accountUpdate')->name('superadmin.profile.update');

    //Change Password
    Route::any('/superadmin/profile/change_password/{action_type}', 'passwordUpdate')->name('superadmin.profile.change_password');

    Route::get('/superadmin/payment-history',  'paymentHistoryView')->name('superadmin.payment_history.payment_history');

    Route::get('/superadmin/payment-approved/{id}',  'paymentApproved')->name('superadmin.payment_history.paymentApproved');
    Route::get('/superadmin/payment-reject/{id}',  'paymentReject')->name('superadmin.payment_history.paymentReject');
    
    // Lebel
    Route::get('/superadmin/lebel/',  'lebelView')->name('superadmin.lebel.lebel_list');
    Route::get('/superadmin/lebel-create/',  'lebelCreate')->name('superadmin.lebel.lebel_create');
    Route::post('/superadmin/lebel-store/',  'lebelStore')->name('superadmin.lebel.lebel_store');
    Route::get('/superadmin/lebel-edit/{id}',  'lebelEdit')->name('superadmin.lebel.lebel_edit');
    Route::post('/superadmin/lebel-update/{id}',  'lebelUpdate')->name('superadmin.lebel.lebel_update');
    Route::get('/superadmin/lebel-delete/{id}',  'lebelDelete')->name('superadmin.lebel.lebel_Delete');


    Route::get('/superadmin/referral-earnings',  'referralEarnings')->name('superadmin.payment_history.referralEarnings');
    Route::post('/superadmin/referral-earnings/mark-paid/{couponCode}',  'markReferralAsPaid')->name('superadmin.payment_history.markReferralAsPaid');

    Route::post('/superadmin/referral/withdraw/approve/{id}/{couponCode}',  'approveWithdrawRequest')->name('superadmin.payment_history.approveWithdraw');

    Route::post('/superadmin/referral/withdraw/reject/{id}',  'rejectWithdrawRequest')->name('superadmin.payment_history.rejectWithdraw');

    Route::get('/superadmin/item-payment',  'itemPayment')->name('superadmin.payment_history.item_payment');

    //Comment
    Route::get('/superadmin/all-comment',  'allComment')->name('superadmin.comment.all_comment');
    Route::get('superadmin/comment/{id}', 'showComment')->name('superadmin.comment.show');
    Route::post('superadmin/comment/{id}/reply', 'commentReply')->name('superadmin.comment.reply');


});


Route::prefix('notifications')->middleware('auth')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::DELETE('/delete/{id}', [NotificationController::class, 'notificationDelete'])->name('notifications.delete');
    Route::get('/delete-all', [NotificationController::class, 'notificationDeleteAll'])->name('notifications.deleteAll');
});


//Updater routes are here
Route::controller(Updater::class)->middleware('auth')->group(function () {

    Route::post('backend/product/update', 'update')->name('backend.product.update');

});
//Updater routes end here

//Installation routes are here
Route::controller(InstallController::class)->group(function () {

    Route::get('/install_ended', 'index');

    Route::get('install/step0', 'step0')->name('step0');
    Route::get('install/step1', 'step1')->name('step1');
    Route::get('install/step2', 'step2')->name('step2');
    Route::any('install/step3', 'step3')->name('step3');
    Route::get('install/step4', 'step4')->name('step4');
    Route::get('install/step4/{confirm_import}', 'confirmImport')->name('step4.confirm_import');
    Route::get('install/install', 'confirmInstall')->name('confirm_install');
    Route::post('install/validate', 'validatePurchaseCode')->name('install.validate');
    Route::any('install/finalizing_setup', 'finalizingSetup')->name('finalizing_setup');
    Route::get('install/success', 'success')->name('success');

});


require __DIR__.'/auth.php';
