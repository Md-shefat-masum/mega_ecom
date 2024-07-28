<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_medicines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->nullable();

            $table->string('p_name', 200)->nullable();
            $table->string('p_strength', 100)->nullable();
            $table->string('p_form', 100)->nullable();
            $table->integer('p_generic_id')->unsigned()->nullable();
            $table->string('p_generic_name', 200)->nullable();
            $table->integer('p_company_id')->unsigned()->nullable();
            $table->integer('p_manufacturer_id')->unsigned()->nullable();
            $table->string('p_type', 100)->nullable();
            $table->string('p_manufacturer', 200)->nullable();
            $table->text('p_product_keywords')->nullable();
            $table->integer('p_brand_id')->unsigned()->nullable();
            $table->string('p_brand', 100)->nullable();
            $table->integer('is_antibiotics')->unsigned()->nullable();
            $table->integer('is_controlled')->unsigned()->nullable();
            $table->integer('p_id')->unsigned()->nullable();
            $table->integer('p_rx_req')->unsigned()->nullable();
            $table->integer('p_medicine_id')->unsigned()->nullable();
            $table->string('p_attribute', 100)->nullable();
            $table->string('p_vendor_foreign_ids', 100)->nullable();
            $table->integer('p_allow_sales')->unsigned()->nullable();
            $table->string('p_description', 100)->nullable();
            $table->string('p_meta_description', 100)->nullable();
            $table->string('p_yt_key', 100)->nullable();
            $table->string('p_yt_title', 100)->nullable();
            $table->integer('p_allow_purchase')->unsigned()->nullable();
            $table->integer('p_variant_count')->unsigned()->nullable();
            $table->string('p_active_status', 100)->nullable();
            $table->integer('p_cat_id')->unsigned()->nullable();
            $table->integer('p_cold')->unsigned()->nullable();
            $table->integer('p_weight')->unsigned()->nullable();
            $table->integer('p_product_category_id')->unsigned()->nullable();
            $table->integer('p_version_change_status')->unsigned()->nullable();
            $table->integer('p_reference_id')->unsigned()->nullable();
            $table->integer('p_forward_reference_id')->unsigned()->nullable();
            $table->integer('p_backward_reference_id')->unsigned()->nullable();
            $table->integer('p_trending_score')->unsigned()->nullable();
            $table->integer('p_suggested_product_id')->unsigned()->nullable();
            $table->string('p_created_at', 100)->nullable();
            $table->integer('p_created_by')->unsigned()->nullable();
            $table->string('p_modified_at', 100)->nullable();
            $table->integer('p_modified_by')->unsigned()->nullable();
            $table->integer('p_supervised_by')->unsigned()->nullable();
            $table->string('p_deleted_at', 100)->nullable();
            $table->integer('p_deleted_by')->unsigned()->nullable();
            $table->string('p_supervised_at', 100)->nullable();
            $table->string('poster', 100)->nullable();
            $table->integer('haveImage')->unsigned()->nullable();
            $table->integer('productCountViewed')->unsigned()->nullable();
            $table->integer('productCountOrdered')->unsigned()->nullable();
            $table->integer('productCountWishlist')->unsigned()->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_medicines');
    }
};
