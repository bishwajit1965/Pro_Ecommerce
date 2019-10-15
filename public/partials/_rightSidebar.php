<div class="col-sm-3">
    <div class="category bg-secondary py-2 mt-3 px-3 text-white text-center">
        <h3>Categories</h3>
    </div>
    <div class="category d-block">
        <ul>
            <?php
            include_once '../../admin/app/start.php';

            use Codecourse\Repositories\Session as Session;
            use Codecourse\Repositories\Category as Category;

            $category = new Category();
            $table = 'tbl_category';

            $session = Session::checkLogin();
            $sessionId = session_id();
            $categoryData = $category->index($table);
            if (!empty($categoryData)) {
                foreach ($categoryData as $category) {
                    ?>
            <li>
                <a href="../index.php?category_id=<?= $category->cat_id; ?>">
                    <?= $category->cat_name; ?>
                </a>
            </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
    <div class="category bg-secondary py-2 mt-3 px-3  text-white text-center">
        <h3>Sub Categories</h3>
    </div>
    <div class="category d-block mb-3">
        <ul>
            <?php
            $subCategoryData = $subCategory->index($table2);
            if (!empty($subCategoryData)) {
                foreach ($subCategoryData as $subCategory) {
                    ?>
            <li>
                <a href="../index.php?sub_category_id=<?= $subCategory->sub_cat_id; ?>">
                    <?= $subCategory->sub_cat_name; ?>
                </a>
            </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>
