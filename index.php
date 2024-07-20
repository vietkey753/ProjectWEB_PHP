<?php
    ob_start();
    session_start();


    require_once "models/pdo_library.php";
    require_once "models/BaseModel.php";
    require_once "models/ProductModel.php";
    require_once "models/CategoryModel.php";
    require_once "models/CustomerModel.php";
    require_once "models/CommentModel.php";
    require_once "models/CartModel.php";
    require_once "models/OrderModel.php";
    require_once "models/PostModel.php";
    define('BASE_URL', 'index.php?url=');
    define('URL_MOMO', 'http://localhost/DUAN1_BOOKSTORE/cam-on');
    define('URL_ORDER', 'http://localhost/DUAN1_BOOKSTORE/don-hang');

    require_once "components/head.php";
    require_once "components/header.php";


    if(!isset($_GET['url'])) {
        require_once "views/home.php";
    }else {
        switch ($_GET['url']) {
            case 'trang-chu':
                         
                require_once "views/home.php";
                break;
            case 'cua-hang':
                         
                require_once "views/shop.php";
                break;
            case 'chitietsanpham':
                
                require_once "views/productdetail.php";
                break;
            case 'danh-muc-san-pham':
                        
                require_once "views/shop-by-category.php";
                break;    
            case 'lien-he':    
                require_once "views/contact.php";
                break;
            case 'gio-hang':    
                require_once "views/cart.php";
                break;
            case 'thanh-toan':    
                require_once "views/checkout.php";
                break;  
            case 'thanh-toan-2':    
                require_once "views/checkout-address.php";
                break; 
            case 'thanh-toan-momo':    
                require_once "views/checkout/checkout_momo.php";
                break;
            case 'cam-on':    
                require_once "views/thanks.php";
                break; 
            case 'don-hang':    
                require_once "views/my-order.php";
                break;       
            case 'chi-tiet-don-hang':    
                require_once "views/my-orderdetails.php";
                break; 
            // User
            case 'dang-nhap':    
                require_once "views/user/login.php";
                break; 
            case 'dang-ky':    
                require_once "views/user/register.php";
                break;  
            case 'dang-xuat':    
                unset($_SESSION['user']);
                header("Location: index.php");
                break;  
            case 'thong-tin-tai-khoan':    
                require_once "views/user/user-infor.php";
                break;  
            case 'ho-so':    
                require_once "views/user/edit-profile.php";
                break; 
            case 'doi-mat-khau':    
                require_once "views/user/change-password.php";
                break;
            case 'quen-mat-khau':    
                require_once "views/user/forgot-password.php";
                break;
            case 'khoi-phuc-mat-khau':    
                require_once "views/user/password-recovery.php";
                break;

            //Bài viết
            case 'bai-viet':    
                require_once "views/blog/blogs.php";
                break;    
            case 'chi-tiet-bai-viet':    
                require_once "views/blog/blog-details.php";
                break;    
            case 'danh-muc-bai-viet':    
                require_once "views/blog/blog-by-category.php";
                break;
            //Bài viết
            case 'tim-kiem':    
                require_once "views/search.php";
                break;    

            default:
                require_once "views/not-page.php";
                break;
        }
    }

    require_once "components/minicart.php";

    require_once "components/footer.php";


    
    ob_end_flush();
?>
<br>

