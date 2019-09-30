<div class="col-sm-3">
    <div class="category bg-secondary py-2 mt-3 px-3 text-white text-center">
        <h3>Categories</h3>
    </div>
    <div class="category d-block">
        <ul>
            <?php
            $categoryData = $category->index($table);
            if (!empty($categoryData)) {
                foreach ($categoryData as $category) {
                    ?>
                    <li><a href="<?= $category->cat_id; ?>"><?= $category->cat_name; ?></a></li>
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
                    <li><a href="<?= $subCategory->sub_cat_id; ?>"><?= $subCategory->sub_cat_name; ?></a></li>
            <?php
                }
            }
            ?>
        </ul>
    </div>
</div>
