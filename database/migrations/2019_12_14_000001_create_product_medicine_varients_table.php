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
        Schema::create('product_medicine_varients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->nullable();

            $table->string('pu_base_unit_label', 100)->nullable();
            $table->string('pu_b2c_sales_unit_label', 100)->nullable();
            $table->string('pu_b2b_sales_unit_label', 100)->nullable();
            $table->string('pv_attribute', 100)->nullable();
            $table->string('pv_sku', 100)->nullable();
            $table->integer('pv_id')->unsigned()->nullable();
            $table->integer('pv_p_id')->unsigned()->nullable();
            $table->integer('pv_medicine_id')->unsigned()->nullable();
            $table->integer('pv_mrp')->unsigned()->nullable();
            $table->integer('pv_b2c_discounted_price')->unsigned()->nullable();
            $table->integer('pv_b2c_min_qty')->unsigned()->nullable();
            $table->integer('pv_b2c_max_qty')->unsigned()->nullable();
            $table->integer('pv_b2b_discounted_price')->unsigned()->nullable();
            $table->integer('pv_b2b_min_qty')->unsigned()->nullable();
            $table->integer('pv_b2b_max_qty')->unsigned()->nullable();
            $table->integer('pv_allow_purchase')->unsigned()->nullable();
            $table->integer('pv_allow_sales')->unsigned()->nullable();
            $table->integer('pv_is_base')->unsigned()->nullable();
            $table->integer('pv_sales_vat')->unsigned()->nullable();
            $table->integer('pv_stock_status')->unsigned()->nullable();
            $table->integer('pv_weight')->unsigned()->nullable();
            $table->string('pv_slug', 100)->nullable();
            $table->integer('pv_weekly_requirement')->unsigned()->nullable();
            $table->string('pv_dimension', 100)->nullable();
            $table->integer('pv_purchase_price')->unsigned()->nullable();
            $table->integer('pv_trending_score')->unsigned()->nullable();
            $table->string('pv_created_at', 100)->nullable();
            $table->integer('pv_created_by')->unsigned()->nullable();
            $table->string('pv_modified_at', 100)->nullable();
            $table->integer('pv_modified_by')->unsigned()->nullable();
            $table->string('pv_deleted_at', 100)->nullable();
            $table->integer('pv_deleted_by')->unsigned()->nullable();
            $table->integer('pv_b2c_price')->unsigned()->nullable();
            $table->integer('pv_b2b_price')->unsigned()->nullable();
            $table->integer('pv_b2c_mrp')->unsigned()->nullable();
            $table->integer('pv_b2b_mrp')->unsigned()->nullable();
            $table->integer('pu_base_unit_multiplier')->unsigned()->nullable();
            $table->integer('pu_b2c_base_unit_multiplier')->unsigned()->nullable();
            $table->integer('pu_b2b_base_unit_multiplier')->unsigned()->nullable();
            $table->integer('pu_b2c_sales_unit_id')->unsigned()->nullable();
            $table->integer('pu_b2b_sales_unit_id')->unsigned()->nullable();
            $table->integer('pv_b2c_discount_percent')->unsigned()->nullable();
            $table->integer('pv_b2b_discount_percent')->unsigned()->nullable();

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
        Schema::dropIfExists('product_medicine_varients');
    }
};
