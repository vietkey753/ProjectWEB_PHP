<?php

$success = '';

$error = array(
    'name' => '',
    'image' => '',
);

if(isset($_GET['id']) && $_GET['id'] > 0) {
    $category_id = $_GET['id'];

    $category_one = $CategoryModel->select_category_by_id($category_id);
    extract($category_one);
}else {
    header("Location: index.php?quanli=danh-sach-danh-muc");
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_category"])) {
    $name = trim($_POST["name"]);
    $status = $_POST["status"];
    $image = $_FILES["image"]['name'];

    if(strlen($name) > 255) {
        $error['name'] = 'Tên danh mục tối đa 255 ký tự';
    }

    // Kiểm tra hình ảnh
    if(!empty($image)) {
        $img_valid = $BaseModel->is_image_valid($image);
        if (!$img_valid) {
            $error['image'] = 'File ảnh không hợp lệ';
        }
    }

    if(empty(array_filter($error))) {
        $target_dir = "../upload/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

        }

        try {
            $result = $CategoryModel->update_category($name, $image, $status, $category_id);
            setcookie('success_update', 'Cập nhật danh mục thành công', time() + 5, '/');
            header("Location: index.php?quanli=cap-nhat-danh-muc&id=".$category_id);

        } catch (Exception $e) {
            $error_message = $e->getMessage();
            echo 'Cập nhật sản phẩm thất bại: ' . $error_message;
            setcookie('success_update', 'Cập nhật danh mục thất bại', time() + 5, '/');
        }

    }
}

if(isset($_COOKIE['success_update']) && !empty($_COOKIE['success_update'])) {
    $success = $_COOKIE['success_update'];
}

$html_alert = $BaseModel->alert_error_success($error['image'], $success);
?>

<!-- Form Start -->
<div class="container-fluid pt-4" style="margin-bottom: 110px;">

    <form class="row g-4" action="" method="post" enctype="multipart/form-data">

        <div class="col-sm-12 col-xl-9">

            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="index.php?quanli=danh-sach-danh-muc" class="link-not-hover">Danh mục</a> 
                    / Cập nhật danh mục
                </h6>
                <?=$html_alert?>
                <label for="floatingInput">Tên danh mục</label>
                <div class="form-floating mb-4">
                    <input name="name" type="text" value="<?=$name?>" class="form-control" id="floatingInput">   
                    <span class="text-danger" ><?=$error['name']?></span>
                </div>
                
                <label for="floatingSelect">Trạng thái</label>
                <div class="form-floating mb-3">
                    <select name="status" class="form-select" id="floatingSelect">
                        <?php if($status == 1) {?>
                            <option selected value="1">Hiển thị</option>
                            <option value="0">Tạm ẩn</option>
                        <?php 

                        } else{ 

                        ?>
                            <option value="1">Hiển thị</option>
                            <option selected value="0">Tạm ẩn</option>
                        <?php }?>
                    </select>
                    
                </div>
                                        
            </div>
        </div>
        <div class="col-sm-12 col-xl-3">
            <div class="bg-light rounded h-100 p-4">
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Hình ảnh (JPG, PNG)</label> <br>
                    <span class="text-danger" ><?=$error['image']?></span>
                    <input style="background-color: #fff" name="image" class="form-control form-control-sm"
                        id="formFileSm" type="file">
                    <div class="my-2">
                        <img src="../upload/<?=$image?>" width="100%" class="img-thumbnail" alt="">
                    </div>
                </div>
                <h6 class="mb-4">
                    <input type="submit" name="update_category" value="Cập nhật" class="btn btn-custom">
                    
                </h6>

            </div>
        </div>

        


    </form>
</div>
<!-- Form End -->